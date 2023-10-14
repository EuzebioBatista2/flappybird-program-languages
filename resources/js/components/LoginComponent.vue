<template>
  <div class="container font background-login">
    <div class="row justify-content-center" style="width: 100%;">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Login</div>
          <div class="card-body">
            <form method="POST" action="">
              <input type="hidden" name="_token" :value="csrfToken">

              <div class="row mb-3">
                <label for="name" class="col-md-4 col-form-label text-md-end">Nome</label>

                <div class="col-md-6">
                  <input id="name" type="text" :class="error.name ? 'is-invalid form-control' : 'form-control'"
                    name="name" value="" autocomplete="name" autofocus>
                  <span v-if="error.name" class="invalid-feedback" style="font-size: 10px;" role="alert">
                    <strong>{{ error.name[0] }}</strong>
                  </span>
                </div>
              </div>

              <div class="row mb-3">
                <label for="password" class="col-md-4 col-form-label text-md-end">Senha</label>

                <div class="col-md-6">
                  <input id="password" type="password" :class="error.name ? 'is-invalid form-control' : 'form-control'"
                    name="password" autocomplete="current-password">
                  <span v-if="error.password" class="invalid-feedback" style="font-size: 10px;" role="alert">
                    <strong>{{ error.password[0] }}</strong>
                  </span>
                </div>
              </div>

              <div class="row mb-0">
                <div class="col-md-6 offset-md-4">
                  <button type="submit" class="btn btn-primary font">
                    Login
                  </button>
                  <a class="btn btn-secondary ms-2 font" href="/">
                    Página inicial
                  </a>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ['error', 'csrfToken']

}
</script>

<style scoped>
@import '../../css/fontGame.css';

.font {
  font-family: 'supply-Center';
}

.background-login {
  height: 100%;
  width: 100%;
  min-height: 650px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.buttons {
  display: flex;
  gap: 10px;
}

.link {
  padding: 0px;
  margin-top: 6px;
}

@media (max-width: 480px) {
  .font {
    font-size: 8px;
  }
}
</style>
