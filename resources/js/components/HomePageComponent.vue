<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card background">
          <div class="card-header">FlappyBird</div>

          <div class="card-body containerLink">
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
.containerLink {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  gap: 10px;
}
.background {
  background: url('images/birdUp.png');
  background-size: contain;
  background-repeat: no-repeat;
  background-color: azure;
}
</style>
