<template>
  <div class="modal fade" :id="id" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Que pena, {{ username }}</h1>
        </div>
        <div class="modal-body">
          <slot name="content"></slot>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" @click="replay">Jogar novamente</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" @click.prevent="logout">Sair</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ['id', 'username', 'character'],
  methods: {
    replay() {
      window.location.href = "http://127.0.0.1:8000/home"
    },

    logout() {
      const url = "http://127.0.0.1:8000/logout"
      const config = {
        headers: {
          "Accept": "application/json"
        }
      }
      axios.post(url, "",config)
        .then(() => {
          window.location.href = "http://127.0.0.1:8000/"
        })
    }

  }
}
</script>
