<template>
  <div class="container font">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Rank Global</div>
          <div class="card-body">
            <div >
              <table class="table table-striped">
                <tr>
                  <th>#</th>
                  <th>Nome</th>
                  <th>Linguagem</th>
                  <th>Pontos</th>
                </tr>
                <tr v-for="(rank, index) in ranks" :key="rank.id">
                  <td v-if="index === 0" class="top1">{{ index + 1 }}</td>
                  <td v-else-if="index === 1" class="top2">{{ index + 1 }}</td>
                  <td v-else-if="index === 2" class="top3">{{ index + 1 }}</td>
                  <td v-else>{{ index + 1 }}</td>
                  <td>{{ rank.user.name }}</td>
                  <td >
                    <img :src="'images/' + rank.user.character + '.png'" alt="Linguagem do jogador" height="50">
                  </td>
                  <td>{{ rank.score }}</td>
                </tr>
              </table>
            </div>
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

.top1 {
  color: yellow;
  font-size: 24px;
  font-weight: bold;
}
.top2 {
  color: rgba(16, 139, 16, 0.679);
  font-size: 20px;
  font-weight: bold;
}

.top3 {
  color: rgba(29, 29, 162, 0.674);
  font-size: 16px;
  font-weight: bold;
}

</style>