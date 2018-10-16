<template>
  <div>
    <div class="form-group">
      <input type="text" placeholder="Search by topic's name..." class="form-control" v-model="q" v-on:input="onChange()">
      <ul class="list-group">
        <li class="list-group-item" v-for="topic in results.slice(0, 5)" v-on:click="addTopic(topic)">
          {{ topic.name }}
        </li>
      </ul>
    </div>
    <div class="btn btn-light" v-for="topic in selectedTopics">
      <input type="hidden" name="topics[]" :value="topic.id">
      <i class="far fa-folder"></i> {{ topic.name }}
      <button type="button" class="btn btn-danger btn-sm" v-on:click="removeTopic(topic)"><i class="fas fa-minus"></i></button>
    </div>
  </div>
</template>

<script>

export default {
  props: ['topics', 'selected'],
  data() {
    return {
      selectedTopics: [],
      results: [],
      q: ''
    };
  },
  mounted() {
    this.selected.forEach(function(topic) {
      this.addTopic(topic);
    }.bind(this));
  },
  methods: {
    onChange() {
      if(this.q.length > 1) {
        this.results = this.topics.filter(topic => topic.name.includes(this.q));
      }
      if(this.q.length == 0) {
        this.results = [];
      }
    },
    addTopic(topic) {
      if(!this.selectedTopics.includes(topic)) {
        this.selectedTopics.push(topic);
        this.results = [];
        this.q = '';
      }
    },
    removeTopic(topic) {
      this.selectedTopics = this.selectedTopics.filter(function(el) { return el.id != topic.id; });
    }
  }
};
</script>
