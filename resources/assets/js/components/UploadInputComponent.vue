<template>
  <div>
    <div class="input-group">
      <input type="text" class="form-control" :name="name" v-model="field" readonly>
      <div class="input-group-append" v-on:click="openDialog()">
        <span class="input-group-text"><i class="fas fa-upload"></i></span>
      </div>
    </div>
  </div>
</template>

<script>

export default {
  props: ['name','value'],
  data() {
    return {
      field: '',
    };
  },
  mounted() {
    this.field = this.value;
  },
  methods: {
    openDialog() {
      window.Uploader = {
        callFunction: function(file) {
          this.field = file;
        }.bind(this)

        };
        window.open('/admin/attachments', 'kcfinder_textbox', 'status=0, toolbar=0, location=0, menubar=0, directories=0, ' +
          'resizable=1, scrollbars=0, width=800, height=600'
      );
    }
  }
};
</script>
