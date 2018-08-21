<template>
  <div>
    <vue-ckeditor v-model="content" :config="config" @blur="onBlur($event)" @focus="onFocus($event)" />
    <textarea :name="name" v-model="content" class="d-none"></textarea>
  </div>
</template>

<script>
import VueCkeditor from 'vue-ckeditor2';

export default {
  props: ['name', 'value'],
  components: { VueCkeditor },
  data() {
    return {
      content: '',
      config: {
        height: 300,
        filebrowserBrowseUrl: '/admin/attachments',
        filebrowserUploadUrl: '/admin/attachments'
      }
    };
  },
  mounted() {
    this.content = this.value;
  },
  methods: {
    onBlur(editor) {
      //console.log(editor);
    },
    onFocus(editor) {
      //console.log(editor);
    }
  }
};
</script>
