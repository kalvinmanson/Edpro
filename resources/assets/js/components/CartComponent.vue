<template>
  <div>
    <a v-on:click="opened = !opened" class="cartIcon float-right py-3">
      <i class="fas fa-shopping-cart fa-3x"></i>
      <span class="badge badge-danger p-2 rounded">{{ carts.length }}</span>
    </a>
    <div class="miniCart" v-if="opened">
      <div class="text-right">
        <a href="/cart" class="btn btn-sm btn-outline-success">Ir a pagar</a>
      </div>
      <ul>
        <li v-for="cart in carts">
          {{ cart.book.name }}<br>
          <small>
            <strong class="text-primary float-right">$ {{ Intl.NumberFormat().format(cart.book.price) }}</strong>
            Cantidad: {{ cart.quantity }} |
            <s>$ {{ Intl.NumberFormat().format(cart.book.old_price) }}</s>
          </small>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>

export default {
  props: ['session'],
  data() {
    return {
      opened: false,
      carts: [],
      csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    };
  },
  mounted() {
    this.attachmentsList = this.attachments;
    this.load()
  },
  methods: {
    load() {
      window.axios.get('/cart/json?session='+this.session).then(({ data }) => {
        this.carts = data;
        console.log(data);
      });
    }
  }
};
</script>
<style scoped>
  .miniCart {
    display: block;
    position: absolute;
    background-color: #FFFFFF;
    padding: 10px;
    border: 4px solid #CCCCCC;
    right: 0;
    top: 80px;
    max-width: 300px;
    z-index: 30;
  }
  ul {
    list-style: none;
    margin: 0;
    padding: 0;
  }
  ul li {
    border-bottom: 1px dashed #CCCCCC;
  }
</style>
