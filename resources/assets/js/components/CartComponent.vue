<template>
  <div>
    <a v-on:click="opened = !opened" class="cartIcon float-right py-3">
      <i class="fas fa-shopping-cart fa-3x"></i>
      <span v-if="Object.keys(carts).length > 0" class="badge badge-danger p-2 rounded">{{ Object.keys(carts).length }}</span>
    </a>
    <div class="miniCart" v-if="opened">
      <div class="text-right" v-if="Object.keys(carts).length > 0">
        <a href="/cart" class="btn btn-sm btn-outline-success">Ir a pagar</a>
      </div>
      <ul v-if="Object.keys(carts).length > 0">
        <li v-for="cart in carts">
          {{ cart.name }}<br>
          <small>
            <strong class="text-primary float-right">$ {{ Intl.NumberFormat().format(cart.price) }}</strong>
            Cantidad: {{ cart.qty }}
          </small>
        </li>
      </ul>
      <p v-if="Object.keys(carts).length == 0" class="text-secondary">Tu carro de compras está vacio.</p>
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
      window.axios.get('/cart/json').then(({ data }) => {
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
