<template>
  <div class="card">
    <div class="card-header">
      <a v-on:click="search()" class="btn btn-info float-right">Buscar por ISBN: {{ isbn }}</a>
      ISBN Info
    </div>
    <div class="card-body" v-if="books.length > 0">
      <div class="row">
        <div class="col-md-6" v-for="book in books">
          <div class="card">
            <div class="card-header">{{ book.volumeInfo.title }}</div>
            <div class="card-body">
              <div v-for="(infoData, key) in book.volumeInfo">
                <strong>{{ key }}: </strong>
                {{ infoData }}
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
  props: ['isbn'],
  data() {
    return {
      books: [],
      localIsbn: ''
    };
  },
  mounted() {

  },
  methods: {
    search() {
      window.axios.get('https://www.googleapis.com/books/v1/volumes?q=isbn:'+ this.isbn+'&key=AIzaSyAVHb4sGYDwZdeFdaNIENSt6OFgeYtUMtE').then(({ data }) => {
        //console.log(data);
        if(data.totalItems < 1) {
          alert('no se encontraron coinsidencias.');
        } else {
          this.books = data.items;
        }
      });
    }
  }
};
</script>
