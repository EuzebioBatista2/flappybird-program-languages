<template>
  <div class="container font background">
    <div class="row background-sky">
      <div v-if="onGame == false" style="position: absolute;">
        <modal-component nick="nome" id="GameModal">
          <template v-slot:content>
            <div class="form-group">
              {{ data.userId }} - {{ data.score }} - {{  data.name }}
            </div>
          </template>
        </modal-component>
      </div>
      <div class="col-12 " style="padding: 0px;">
        <div class="col-12 background" style="padding: 0px;" ref="backgroundSky" @click="birdUp()">
          <img :src="'/images/' + char + '.png'" alt="linguagem do jogador" class="imageChar" ref="bird" :style="'top: ' + birdTop + 'px;'">
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
export default {
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
      if(this.onGame == true) {
        if(this.birdTop - 50 < -2) {
          this.birdTop = -2
        } else {
          this.birdTop -= 50
        }
      }
    },

    birdDown () {
      if(this.birdTop >= -2 && this.birdTop <= 548) {
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
        .then(response => console.log(response.data))
    },

    deleteUser() {
      axios.delete(this.url + '/' + 'user' + '/' + this.id)
    },

    checkScoreDB() {
      axios.get(this.url + '/' + 'user' + '/' + this.id)
        .then((response) => {
          this.data = response.data
          if(this.score >= response.data.score) {
            this.deleteUser()
            this.save()
          }
        })
        .catch(() => {
          this.save()
        })
    }

  },
  mounted() {
    this.updateCurrentWidth()
    this.createBarrier(600, 250);

    let intervalGame = setInterval(() => {
      this.loadPipes()
      if (this.barriers[0].position <= -130) {
        this.updateBarriers()
      }

      if(this.barriers.some(barrier => barrier.position === this.$refs.bird.offsetLeft - 82)) {
        this.score += 1
        this.heightBottom = -1
        this.heightTop = -1
      }

      if(this.barriers.some(barrier => barrier.position === this.$refs.bird.offsetLeft + 47)) {
        const index = this.barriers.findIndex(barrier => barrier.position === this.$refs.bird.offsetLeft + 47)
        this.heightTop = this.barriers[index].heightTop
        this.heightBottom = this.barriers[index].heightBottom
        this.barrierPosition = index
      }

      if(this.heightBottom != -1 && this.heightTop != -1) {
        
        
        if(this.birdTop < this.heightTop || 549 - this.birdTop < this.heightBottom) {
          clearInterval(intervalGame) 
          clearInterval(intervalBird)
          console.log('Posição do passaro topo', this.birdTop)
          console.log('Posição do barreira topo', this.barriers[this.barrierPosition].heightTop)
          console.log('Posição X do barreira', this.barriers[this.barrierPosition].position)
          console.log('Posição X do passaro', this.middleWidth)
          this.onGame = false
          if(this.barriers[this.barrierPosition].position < this.$refs.bird.offsetLeft + 47) {
            this.birdTop = this.heightTop - 1
          }
          this.checkScoreDB()
        }
      }

    }, 5)

    let intervalBird = setInterval(() => {
      this.birdDown()
    }, 7)

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
  height: 48px;
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
</style>