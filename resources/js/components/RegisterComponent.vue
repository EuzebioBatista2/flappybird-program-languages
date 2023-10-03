<template>
  <div class="container font background-register">
    <div class="row justify-content-center" style="width: 100%;">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Cadastrar</div>

          <div class="card-body">
            <form method="POST" action="">
              <input type="hidden" name="_token" :value="csrfToken">

              <div class="row mb-3">
                <label for="name" class="col-md-4 col-form-label text-md-end">Nome</label>

                <div class="col-md-6">
                  <input id="name" type="text" class="form-control" name="name"
                    value="" required autocomplete="name" autofocus>
                </div>
              </div>

              <div class="row mb-3">
                <label for="email" class="col-md-4 col-form-label text-md-end">E-mail</label>

                <div class="col-md-6">
                  <input id="email" type="email" class="form-control" name="email"
                    value="" required autocomplete="email">
                </div>
              </div>

              <div class="row">
                <label for="character" class="col-md-4 col-form-label text-md-end">Linguagem</label>
                <div class="col-md-6">
                  <div class="row">
                    <div class="col-4 radioChoose"><input type="radio" name="character" value="python"><img src="/images/python.png" alt="logo do python" height="50" width="50"></div>
                    <div class="col-4 radioChoose"><input type="radio" name="character" value="java"><img src="/images/java.png" alt="logo do java" height="50" width="50"></div>
                    <div class="col-4 radioChoose"><input type="radio" name="character" value="C"><img src="/images/C.png" alt="logo do C" height="50" width="50"></div>
                    <div class="col-4 radioChoose"><input type="radio" name="character" value="javascript"><img src="/images/javascript.png" alt="logo do javascript" height="50" width="50"></div>
                    <div class="col-4 radioChoose"><input type="radio" name="character" value="Csharp"><img src="/images/Csharp.png" alt="logo do Csharp" height="50" width="50"></div>
                    <div class="col-4 radioChoose"><input type="radio" name="character" value="php"><img src="/images/php.png" alt="logo do php" height="50" width="50"></div>
                  </div>
                </div>
              </div>

              <div class="row mb-3">
                <label for="password" class="col-md-4 col-form-label text-md-end">Senha</label>

                <div class="col-md-6">
                  <input id="password" type="password" class="form-control"
                    name="password" required autocomplete="new-password">
                </div>
              </div>

              <div class="row mb-3">
                <label for="password-confirm"
                  class="col-md-4 col-form-label text-md-end">Confirme sua senha</label>

                <div class="col-md-6">
                  <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
                    autocomplete="new-password">
                </div>
              </div>

              <div class="row mb-0">
                <div class="col-md-6 offset-md-4">
                  <button type="submit" class="btn btn-primary">
                    Registrar
                  </button>
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
  props: ['csrfToken']
}
</script>
<style>
  @import '../../css/fontGame.css';
  .radioChoose {
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: center;
    padding: 5px;
    gap: 10px;
  }

  .font {
    font-family: 'supply-Center';
  }

  .background-register {
    height: 100%;
    width: 100%;
    min-height: 650px;
    display: flex;
    align-items: center;
    justify-content: center;
  }
</style>
