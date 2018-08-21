<template>
  <div>
    <div class="row">
      <div class="col-md-5 mr-auto">
        <input v-model="filterValue" placeholder="Search..." class="form-control" v-on:keyup="searchAttachments()">
      </div>
      <form class="col-md-5 ml-auto" method="POST" action="/admin/attachments" enctype="multipart/form-data">
        <input type="hidden" name="responseHTML" value="1">
        <div class="input-group mb-3">
          <input type="file" name="upload" class="form-control">
          <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Upload</button>
          </div>
        </div>
      </form>
    </div>
    <div class="card-columns">
        <div class="card" v-for="attachment in attachmentsList">
          <a v-on:click="use(attachment)">
            <img :src="attachment.thumbnail" class="img-fluid">
          </a>
          <div class="card-footer">
            {{ attachment.name }}
            <form :action="'/admin/attachments/'+attachment.id" method="POST" class="float-right">
              <input type="hidden" name="_method" value="DELETE">
              <input type="hidden" name="_token" :value="csrf">
              <button type="submit" class="btn btn-link text-danger btn-sm"><i class="far fa-trash-alt"></i></button>
            </form>
          </div>
        </div>
    </div>
  </div>
</template>

<script>

export default {
  props: ['attachments', 'editor'],
  data() {
    return {
      attachmentsList: [],
      filterValue: '',
      csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
      isEditor: false
    };
  },
  mounted() {
    this.attachmentsList = this.attachments;
    this.isEditor = editor;
  },
  methods: {
    use(attachment) {
      if (this.editor == true) {
        window.opener.CKEDITOR.tools.callFunction( 1, attachment.path );
      } else {
        window.opener.Uploader.callFunction(attachment.path);
      }

      window.close();
    },
    searchAttachments: function(){
      let attachments = this.attachments
    	attachments = attachments.filter((p) => {
      	return p.name.indexOf(this.filterValue) !== -1
      })
      this.attachmentsList = attachments
    }
  }
};
</script>

<style scoped>
  a {
    cursor: pointer;
  }
  .card-columns {
    column-count: 5;
  }
</style>
