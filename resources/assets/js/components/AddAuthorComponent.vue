<template>
  <div>
    <div class="form-group">
      <input type="text" placeholder="Search by author's name..." class="form-control" v-model="q" v-on:input="onChange()">
      <ul class="list-group">
        <li class="list-group-item" v-for="author in results.slice(0, 5)" v-on:click="addAuthor(author)">
          {{ author.name }}
        </li>
      </ul>
    </div>
    <div class="btn btn-light" v-for="author in selectedAuthors">
      <input type="hidden" name="authors[]" :value="author.id">
      <i class="far fa-user"></i>
      {{ author.name }}
      <button type="button" class="btn btn-danger btn-sm" v-on:click="removeAuthor(author)"><i class="fas fa-minus"></i></button>
    </div>
  </div>
</template>

<script>

export default {
  props: ['authors', 'selected'],
  data() {
    return {
      selectedAuthors: [],
      results: [],
      q: ''
    };
  },
  mounted() {
    this.selected.forEach(function(author) {
      this.addAuthor(author);
    }.bind(this));
  },
  methods: {
    onChange() {
      if(this.q.length > 1) {
        this.results = this.authors.filter(author => author.name.includes(this.q));
      }
      if(this.q.length == 0) {
        this.results = [];
      }
    },
    addAuthor(author) {
      if(!this.selectedAuthors.includes(author)) {
        this.selectedAuthors.push(author);
        this.results = [];
        this.q = '';
      }
    },
    removeAuthor(author) {
      this.selectedAuthors = this.selectedAuthors.filter(function(el) { return el.id != author.id; });
    }
  }
};
</script>
