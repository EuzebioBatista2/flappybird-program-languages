<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">FlappyBird</div>

          <div class="card-body containerLink">
            <a href="http://127.0.0.1:8000/login">Login</a>
            <a href="http://127.0.0.1:8000/register">Registrar</a>
            <a href="http://127.0.0.1:8000/rank">Rank</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  mounted() {
    console.log('Component mounted.')
  }
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
</style>
