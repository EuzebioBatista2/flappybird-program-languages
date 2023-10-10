<template>
  <div class="container font">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Rank Global</div>

          <div class="card-body">
            <div v-for="(rank, index) in ranks" :key="rank.id">
              <table class="table table-striped">
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Language</th>
                  <th>Score</th>
                </tr>
                <tr>
                  <td>{{ index + 1 }}</td>
                  <td>{{ rank.user.name }}</td>
                  <td>{{ rank.user.character }}</td>
                  <td>{{ rank.score }}</td>
                </tr>
              </table>
              <div class="containerButton">
                <a class="btn btn-secondary" href="/">
                  Página inicial
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      ranks: []
    }
  },
  props: ['data',],
  mounted() {
    this.ranks = JSON.parse(this.data)
  }
}
</script>
<style scoped>
.font {
  font-family: 'supply-Center';
}

.containerButton {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 100%;
}
</style>