<template>
  <div class="container font">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card background">
          <div class="card-header">FlappyBird</div>

          <div class="card-body containerLink"  style="position: relative;">
            <img src="images/birdUp.png" alt="passaro com seta pra cima" class="background">
            <button-link-component link="/login">
              <template v-slot:content>Login</template>
            </button-link-component>
            <button-link-component link="/register">
              <template v-slot:content>Registrar</template>
            </button-link-component>
            <button-link-component link="/rank">
              <template v-slot:content>Rank Global</template>
            </button-link-component>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
}
</script>
<style scoped>
.font {
  font-family: 'supply-Center';
}
.containerLink {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  gap: 10px;
}

.background {
  position: absolute;
  left: 10px;
}
</style>
