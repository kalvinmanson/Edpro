<template>
  <div>
    <div class="form-group" v-if="content != 'New'">
      <select v-model="content" :name="fieldName" class="form-control" required>
        <option value="New">New field</option>
        <template v-for="item in nameList">
          <option :value="item.name">{{ item.name }}</option>
        </template>
      </select>
    </div>
    <div class="form-group" v-if="content == 'New'">
      <input type="text" :name="fieldName" class="form-control" required>
    </div>
  </div>
</template>

<script>

export default {
  props: ['name'],
  data() {
    return {
      content: '',
      nameList: [],
      fieldName: '',
      toText: false
    };
  },
  mounted() {
    this.fieldName = this.name;
    window.axios.get('/admin/fields').then(({ data }) => {
      this.nameList = data;
    });
  },
  methods: {
    new() {

    }
  }
};
</script>
