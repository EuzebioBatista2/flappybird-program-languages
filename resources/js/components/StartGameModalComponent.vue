<template>
  <!-- Modal -->
  <div class="modal fade" id="startGame" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Inicio do game</h1>
        </div>
        <div class="modal-body">
          <div class="container">
            <img src="/images/mouse.png" alt="mouse com o botão esquerdo pressionado" height="150">
            <h5 class="font">Clique com o botão <b>ESQUERDO</b> do mouse para fazer o passaro subir e desviar dos obstaculos!</h5>
          </div>
        </div>
        <div class="container">
          <img src="/images/birdUp.png" alt="passaro inclinado para cima, seta ao lado indicado que ele deve subir" height="150">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-bs-dismiss="modal" @click="startGame">Iniciar o jogo</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  methods: {
    startGame() {
      this.$store.state.onGame = true
    }
  }
}
</script>
<style scoped>
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
