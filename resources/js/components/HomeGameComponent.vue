<template>
  <div class="container font">
    <!-- Audio content  -->
    <audio ref="backgroundAudio" loop="loop">
      <source src="audio/audioInGame.mp3" type="audio/mp3" />
      seu navegador não suporta este audio
    </audio>

    <audio ref="backgroundAudioGameOver">
      <source src="audio/audioGameOver.mp3" type="audio/mp3" />
      seu navegador não suporta este audio
    </audio>
    <!-- Audio content  -->

    <!-- Modal start game -->
    <start-game-modal-component></start-game-modal-component>
    <button
      type="button"
      class="btn btn-primary"
      data-bs-toggle="modal"
      data-bs-target="#startGame"
      style="display: none"
      ref="buttonStartGame"
    ></button>
    <!-- Modal start game -->

    <!-- Modal end of the game -->
    <div
      v-if="data.user"
      style="position: absolute; height: 300px; width: 300px"
    >
      <button
        type="button"
        class="btn btn-primary"
        data-bs-toggle="modal"
        data-bs-target="#endGame"
        ref="buttonGame"
        style="display: none"
      ></button>
      <end-modal-component
        :username="data.user.name"
        id="endGame"
        :character="data.user.character"
      >
        <template v-slot:content>
          <div class="container">
            <h5 class="font">Pontuação atual: {{ score }}</h5>
          </div>
          <div class="container">
            <h5 class="font">
              Recorde: {{ data.score > score ? data.score : score }}
            </h5>
          </div>
          <div class="container">
            <img src="images/birdDown.webp" alt="passaro caído" height="150" />
          </div>
        </template>
      </end-modal-component>
    </div>
    <!-- Modal end of the game -->

    <!-- Game page -->
    <div class="row">
      <div class="col-12 containerBackground" style="padding: 0px">
        <div
          class="col-12 backgroundGame"
          style="padding: 0px"
          ref="backgroundSky"
          @click="birdUp()"
        >
          <img
            :src="'gif/' + char + '.gif'"
            alt="passaro"
            class="imageChar"
            ref="bird"
            :style="'top: ' + birdTop + 'px;'"
          />
          <div
            v-for="(barrier, index) in barriers"
            :key="index"
            class="pair-of-barriers"
            :style="'left: ' + barrier.position + 'px;'"
          >
            <div class="barrier">
              <div
                class="bodyTop"
                :style="'height: ' + barrier.heightTop + 'px;'"
              ></div>
              <div
                class="bodyBottom"
                :style="'height: ' + barrier.heightBottom + 'px;'"
              ></div>
            </div>
          </div>
        </div>
        <div class="audioB">
          <button @click="invertButton()" class="buttonAudio">
            <img
              v-if="buttonAudio"
              src="audio/audio.webp"
              alt="audio aberto"
              height="30"
            />
            <img
              v-else
              src="audio/noAudio.webp"
              alt="audio aberto"
              height="30"
            />
          </button>
        </div>
        <div class="progress">{{ score }}</div>
      </div>
    </div>
  </div>
  <!-- Game page -->
</template>

<script>
import StartGameModalComponent from "./StartGameModalComponent.vue";
export default {
  components: { StartGameModalComponent },
  props: ["char", "id"],
  data() {
    return {
      barriers: [],
      url: "http://127.0.0.1:8000/score",
      currentWidth: "",
      spaceWidth: 350,
      middleWidth: "",
      score: 0,
      birdTop: 300,
      heightTop: -1,
      heightBottom: -1,
      onGame: true,
      barrierPosition: -1,
      data: [],
      buttonAudio: false,
      audioGame: "audioInGame",
    };
  },
  methods: {
    invertButton() {
      //Verify the click in audio button
      if (this.buttonAudio === false) {
        this.$refs.backgroundAudio.play();
      } else {
        this.$refs.backgroundAudio.pause();
      }
      this.buttonAudio = !this.buttonAudio;
    },

    handleSpaceKey(event) {
      //Verify if the space has been pressed
      if (event.keyCode === 32 && this.onGame) {
        this.invertButton();
      }
    },

    //Creater radom barrier
    createBarrier(height, space) {
      for (let i = 0; i <= 5; i++) {
        const heightTop = Math.random() * (height - space);
        const heightBottom = height - space - heightTop;
        const position = this.currentWidth + this.spaceWidth;
        this.barriers.push({ heightTop, heightBottom, position });
        this.spaceWidth += 350;
      }
    },

    //Remove the barrier that passed
    removeBarrier() {
      this.barriers.shift();
      this.barrierPosition -= 1;
    },

    //New barrier after tha old barrier
    updateBarriers() {
      this.removeBarrier();
      this.spaceWidth = 350;
      const heightTop = Math.random() * (600 - 250);
      const heightBottom = 600 - 250 - heightTop;
      const position = this.barriers[4].position + this.spaceWidth;
      this.barriers.push({ heightTop, heightBottom, position });
    },

    //Game logic in width
    updateCurrentWidth() {
      const backgroundSky = this.$refs.backgroundSky;
      if (backgroundSky.getBoundingClientRect().width <= 480) {
        this.currentWidth = 350;
      } else if (
        backgroundSky.getBoundingClientRect().width > 480 &&
        backgroundSky.getBoundingClientRect().width <= 767
      ) {
        this.currentWidth = 470;
      } else if (
        backgroundSky.getBoundingClientRect().width > 767 &&
        backgroundSky.getBoundingClientRect().width <= 991
      ) {
        this.currentWidth = 760;
      } else if (
        backgroundSky.getBoundingClientRect().width > 991 &&
        backgroundSky.getBoundingClientRect().width <= 1199
      ) {
        this.currentWidth = 980;
      } else if (
        backgroundSky.getBoundingClientRect().width > 1199 &&
        backgroundSky.getBoundingClientRect().width <= 1919
      ) {
        this.currentWidth = 1180;
      }
      this.middleWidth = this.currentWidth / 2;
    },

    //Moving the barriers
    loadPipes() {
      this.barriers[0].position -= 1;
      this.barriers[1].position -= 1;
      this.barriers[2].position -= 1;
      this.barriers[3].position -= 1;
      this.barriers[4].position -= 1;
      this.barriers[5].position -= 1;
    },

    //Up the bird
    birdUp() {
      if (this.onGame == true) {
        if (this.birdTop - 50 < -2) {
          this.birdTop = -2;
        } else {
          this.birdTop -= 50;
        }
      }
    },

    //Down the bird
    birdDown() {
      if (this.birdTop >= -2 && this.birdTop <= 558) {
        this.birdTop += 1;
      }
    },

    //Save the score in database
    async save() {
      let formData = new FormData();

      formData.append("userId", this.id);
      formData.append("score", this.score);

      let config = {
        Accept: "application/json",
      };

      await axios.post(this.url, formData, config);
    },

    // Update score
    async updateScore() {
      let formData = new FormData();

      formData.append("score", this.score);

      let config = {
        Accept: "application/json",
      };

      await axios.post(this.url + "/" + "update" + "/" + this.id, formData, config);
    },

    //Update the new score
    async searchScoreNew() {
      await axios
        .get(this.url + "/" + "user" + "/" + this.id)
        .then((response) => {
          this.data = response.data;
        })
        .then(() => {
          if (this.data.user) {
            const modalButton = this.$refs.buttonGame;
            modalButton.click();
          }
        });
    },

    clickButton() {
      axios
        .get(this.url + "/" + "user" + "/" + this.id)
        .then((response) => {
          this.data = response.data;
        })
        .then(() => {
          if (this.data.user) {
            const modalButton = this.$refs.buttonGame;
            modalButton.click();
          }
        });
    },

    //Verify if the score needs save or delete
    async checkScoreDB() {
      await axios
        .get(this.url + "/" + "user" + "/" + this.id)
        .then( async (response) => {
          this.data = response.data;
          if (this.score > response.data.score && response.data != null) {
            await this.updateScore();
          } else if (!response.data) {
            await this.save();
            await this.searchScoreNew();
          }
        })
        .then(() => {
          if (this.data.user) {
            const modalButton = this.$refs.buttonGame;
            modalButton.click();
          }
        });
    },

    //Game logic in gamestart
    startGame() {
      this.$refs.backgroundAudio.play();
      this.buttonAudio = true;

      let intervalGame = setInterval(() => {
        //Moving barriers
        this.loadPipes();
        if (this.barriers[0].position <= -130) {
          this.updateBarriers();
        }

        //After the barrier passes, increase one more point
        if (
          this.barriers.some(
            (barrier) => barrier.position === this.$refs.bird.offsetLeft - 82
          )
        ) {
          this.score += 1;
          this.heightBottom = -1;
          this.heightTop = -1;
        }

        //Verify if the bird is between the barriers
        if (
          this.barriers.some(
            (barrier) => barrier.position === this.$refs.bird.offsetLeft + 47
          )
        ) {
          const index = this.barriers.findIndex(
            (barrier) => barrier.position === this.$refs.bird.offsetLeft + 47
          );
          this.heightTop = this.barriers[index].heightTop;
          this.heightBottom = this.barriers[index].heightBottom;
          this.barrierPosition = index;
        }

        //In case, if the bird touches the barrier
        if (this.heightBottom != -1 && this.heightTop != -1) {
          if (
            this.birdTop < this.heightTop ||
            559 - this.birdTop < this.heightBottom
          ) {
            clearInterval(intervalGame);
            clearInterval(intervalBird);
            this.onGame = false;
            this.$refs.backgroundAudio.pause();
            this.$refs.backgroundAudioGameOver.play();
            if (
              this.birdTop < this.heightTop &&
              this.barriers[this.barrierPosition].position <
                this.$refs.bird.offsetLeft + 47
            ) {
              this.birdTop = this.heightTop;
            }
            this.checkScoreDB();
          }
        }
      }, 5);

      let intervalBird = setInterval(() => {
        this.birdDown();
      }, 7);
    },
  },
  updated() {
    //Verify the click to gamestart
    if (this.$store.state.onGame) {
      this.startGame();
      this.$store.state.onGame = false;
    }
  },

  mounted() {
    this.updateCurrentWidth();
    this.createBarrier(600, 250);
    const modalStartButton = this.$refs.buttonStartGame;
    modalStartButton.click();

    window.addEventListener("resize", this.updateCurrentWidth);
    window.addEventListener("keydown", this.handleSpaceKey);
  },
};
</script>

<style scoped>
@import "../../css/fontGame.css";

.font {
  font-family: "supply-Center";
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

.containerBackground {
  background-image: url("/background/sky.gif");
  background-size: cover;
  height: 600px;
  width: 100%;
  position: relative;
  padding: 0px;
  border: 2px solid blue;
  overflow: hidden;
}

.backgroundGame {
  height: 600px;
  min-width: 1200px;
}

.imageChar {
  position: absolute;
  width: 48px;
  height: 38px;
  left: calc(50% - 30px);
  bottom: 50%;
  user-select: none;
  pointer-events: none;
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

.audioB {
  position: absolute;
  top: 10px;
  left: 10px;
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

.buttonAudio {
  background: transparent;
  border: none;
}

@media (max-width: 480px) {
  .containerBackground {
    width: 370px;
  }
}

@media (min-width: 481px) and (max-width: 767px) {
  .containerBackground {
    width: 480px;
  }
}

@media (min-width: 768px) and (max-width: 991px) {
  .containerBackground {
    width: 768px;
  }
}

@media (min-width: 992px) and (max-width: 1199px) {
  .containerBackground {
    width: 992px;
  }
}

@media (min-width: 1200px) and (max-width: 1919px) {
  .containerBackground {
    width: 1200px;
  }
}

@media (min-width: 1920px) {
  .containerBackground {
    width: 1920px;
  }
}
</style>
