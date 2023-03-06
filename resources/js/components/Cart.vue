<template>
  <div class="cart-container">
    <div class="checkout-step-box">
      <div class="checkout-step-area active">
        <p class="checkout-step-num">01</p>
        <p>カート</p>
      </div>
      <div class="checkout-step-separator">
        <i class="bi bi-chevron-right"></i>
      </div>
      <div class="checkout-step-area">
        <p class="checkout-step-num">02</p>
        <p>ご購入の手続き</p>
      </div>
      <div class="checkout-step-separator">
        <i class="bi bi-chevron-right"></i>
      </div>
      <div class="checkout-step-area">
        <p class="checkout-step-num">03</p>
        <p>ご注文の確認</p>
      </div>
      <div class="checkout-step-separator">
        <i class="bi bi-chevron-right"></i>
      </div>
      <div class="checkout-step-area">
        <p class="checkout-step-num">04</p>
        <p>ご注文完了</p>
      </div>
    </div>

    <h3>カート</h3>
    <div class="mt-3">
      <div v-if="Object.keys(cart)">
        <div v-for="(cart_item, index) in cart" :key="index" class="cart-box">
          <div class="cart-item-image">
            <img
              :src="cart_item.path.substring(0, cart_item.path.indexOf(','))"
              alt=""
            />
          </div>
          <div>
            <p>{{ cart_item.name }}</p>
            <p class="text-muted">{{ cart_item.description }}</p>
            <p class="text-muted mb-5">
              サイズ {{ cart_item.size }} cm　数量 {{ cart_item.amount }}
            </p>
            <form
              method="POST"
              :action="'cart/deleteCartItem?product_id=' + cart_item.product_id"
            >
              <input type="hidden" name="_method" value="DELETE" />
              <input
                type="hidden"
                name="_token"
                :value="csrf_token"
              />
              <button type="submit">
                <i class="bi bi-trash3 cart-trash-icon"></i>
              </button>
            </form>
          </div>
          <div>
            {{ formatToNumber(cart_item.price, cart_item.amount) }}
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from "vue";

const cart = ref({});
const csrf_token = ref(null);

csrf_token.value = document.querySelector('meta[name="csrf-token"]').content;

const getCartInfo = () => {
  axios
    .get("/cart/getCartInfo")
    .then((res) => {
      console.log(res.data);
      cart.value = res.data.cart;
    })
    .catch((err) => {
      console.log("失敗", err);
    });
};

let formatter = new Intl.NumberFormat("ja-JP", {
  style: "currency",
  currency: "JPY",
});

const formatToNumber = (price, amount) => {
  return formatter.format(price * amount);
};

getCartInfo();
</script>
