<template>
  <div class="container font background">
    
    <start-game-modal-component></start-game-modal-component>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#startGame" style="display: none;"
    ref="buttonStartGame"></button>
    <div v-if="data.user" style="position: absolute; height: 300px; width: 300px;">
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#endGame"
        ref="buttonGame" style="display: none;"></button>
        
      <end-modal-component :username="data.user.name" id="endGame" :character="data.user.character">
        <template v-slot:content>
          <div class="container">
            <h5 class="font">Pontuação atual: {{ score }}</h5>
          </div>
          <div class="container">
            <h5 class="font">Recorde: {{ data.score > score ? data.score : score }}</h5>
          </div>
          <div class="container">
            <img src="images/birdDown.png" alt="passaro caído" height="150">
          </div>

        </template>
      </end-modal-component>
    </div>
    <div class="row background-sky">
      
      <div class="col-12 " style="padding: 0px;">
        
        <div class="col-12 background" style="padding: 0px;" ref="backgroundSky" @click="birdUp()">
          <img :src="'gif/' + char + '.gif'" alt="passaro" class="imageChar" ref="bird"
            :style="'top: ' + birdTop + 'px;'">
          <div v-for="(barrier, index) in barriers" :key="index" class="pair-of-barriers"
            :style="'left: ' + barrier.position + 'px;'">
            <div class="barrier">
              <div class="bodyTop" :style="'height: ' + barrier.heightTop + 'px;'"></div>
              <div class="bodyBottom" :style="'height: ' + barrier.heightBottom + 'px;'"></div>
            </div>
          </div>
        </div>
        <div class="progress">{{ score }}</div>
      </div>
    </div>
  </div>
</template>

<script>
import StartGameModalComponent from './StartGameModalComponent.vue';
export default {
  components: { StartGameModalComponent },
  props: ['char', 'id'],
  data() {
    return {
      barriers: [],
      url: 'http://127.0.0.1:8000/score',
      currentWidth: '',
      spaceWidth: 350,
      middleWidth: '',
      score: 0,
      birdTop: 300,
      heightTop: -1,
      heightBottom: -1,
      onGame: true,
      barrierPosition: -1,
      data: []
    };
  },
  methods: {
    createBarrier(height, space) {
      for (let i = 0; i <= 5; i++) {
        const heightTop = Math.random() * (height - space)
        const heightBottom = height - space - heightTop
        const position = this.currentWidth + this.spaceWidth
        this.barriers.push({ heightTop, heightBottom, position })
        this.spaceWidth += 350
      }
    },

    removeBarrier() {
      this.barriers.shift()
      this.barrierPosition -= 1
    },

    updateBarriers() {
      this.removeBarrier()
      this.spaceWidth = 350
      const heightTop = Math.random() * (600 - 250)
      const heightBottom = 600 - 250 - heightTop
      const position = this.barriers[4].position + this.spaceWidth
      this.barriers.push({ heightTop, heightBottom, position })
    },

    updateCurrentWidth() {
      const backgroundSky = this.$refs.backgroundSky
      this.currentWidth = backgroundSky.getBoundingClientRect().width
      this.middleWidth = this.currentWidth / 2
    },

    loadPipes() {
      this.barriers[0].position -= 1;
      this.barriers[1].position -= 1;
      this.barriers[2].position -= 1;
      this.barriers[3].position -= 1;
      this.barriers[4].position -= 1;
      this.barriers[5].position -= 1;
    },

    birdUp() {
      if (this.onGame == true) {
        if (this.birdTop - 50 < -2) {
          this.birdTop = -2
        } else {
          this.birdTop -= 50
        }
      }
    },

    birdDown() {
      if (this.birdTop >= -2 && this.birdTop <= 558) {
        this.birdTop += 1
      }
    },

    save() {
      let formData = new FormData()

      formData.append('userId', this.id)
      formData.append('score', this.score)

      let config = {
        'Accept': 'application/json'
      }

      axios.post(this.url, formData, config)
    },

    deleteUser() {
      axios.delete(this.url + '/' + 'user' + '/' + this.id)
    },

    checkScoreDB() {
      axios.get(this.url + '/' + 'user' + '/' + this.id)
        .then((response) => {
          this.data = response.data
          if (this.score > response.data.score && response.data != null) {
            this.deleteUser()
            this.save()
          } else if(response.data === null) {
            this.save()
          }
        })
    },
    startGame() {
      let intervalGame = setInterval(() => {
        this.loadPipes()
        if (this.barriers[0].position <= -130) {
          this.updateBarriers()
        }

        if (this.barriers.some(barrier => barrier.position === this.$refs.bird.offsetLeft - 82)) {
          this.score += 1
          this.heightBottom = -1
          this.heightTop = -1
        }

        if (this.barriers.some(barrier => barrier.position === this.$refs.bird.offsetLeft + 47)) {
          const index = this.barriers.findIndex(barrier => barrier.position === this.$refs.bird.offsetLeft + 47)
          this.heightTop = this.barriers[index].heightTop
          this.heightBottom = this.barriers[index].heightBottom
          this.barrierPosition = index
        }

        if (this.heightBottom != -1 && this.heightTop != -1) {

          if (this.birdTop < this.heightTop || 559 - this.birdTop < this.heightBottom) {
            clearInterval(intervalGame)
            clearInterval(intervalBird)
            this.onGame = false
            if (this.birdTop < this.heightTop && this.barriers[this.barrierPosition].position < this.$refs.bird.offsetLeft + 47) {
              this.birdTop = this.heightTop
            }
            this.checkScoreDB()
          }
        }

      }, 5)

      let intervalBird = setInterval(() => {
        this.birdDown()
      }, 7)
    }
  },
  updated() {
    if (this.data.user) {
      const modalButton = this.$refs.buttonGame
      modalButton.click()
    }

    if(this.$store.state.onGame) {
      this.startGame()
      this.$store.state.onGame = false
    }
  },
  
  mounted() {
    this.updateCurrentWidth()
    this.createBarrier(600, 250);
    const modalStartButton = this.$refs.buttonStartGame
    modalStartButton.click()

    window.addEventListener('resize', this.updateCurrentWidth)
  }
};
</script>

<style scoped>
@import '../../css/fontGame.css';

.font {
  font-family: 'supply-Center';
}

.background {
  position: relative;
  height: 100%;
  width: 100%;
  padding: 10px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.pipesClass {
  position: absolute;
  top: 0;
  height: 100%;
  width: 100%;
}

.background-sky {
  background-image: url('/background/sky.gif');
  background-size: cover;
  height: 600px;
  width: 100%;
  position: relative;
  padding: 0px;
  border: 2px solid blue;
  overflow: hidden;
}

.imageChar {
  position: absolute;
  width: 48px;
  height: 38px;
  left: calc(50% - 30px);
  bottom: 50%;
}

.pair-of-barriers {
  position: absolute;
  top: 0;
  height: 100%;
  display: flex;
  flex-direction: column;
}

.barrier {
  position: absolute;
  top: 0;
  display: flex;
  flex-direction: column;
  align-items: center;
  height: 100%;
  justify-content: space-between;
}

.barrier .bodyTop {
  width: 110px;
  background: linear-gradient(90deg, #639301, #a5e82e);
  border-left: 2px solid #000;
  border-right: 2px solid #000;
  border-bottom: 2px solid #000;
}

.barrier .bodyBottom {
  width: 110px;
  background: linear-gradient(90deg, #639301, #a5e82e);
  border-left: 2px solid #000;
  border-right: 2px solid #000;
  border-top: 2px solid #000;
}

.progress {
  position: absolute;
  top: 10px;
  right: 10px;
  height: 100%;
  font-size: 20px;
  background: transparent;
}
.container {
  display: flex;
  width: 100%;
  align-items: center;
  justify-content: center;
}
.font {
  font-size: 10px;
}
</style>