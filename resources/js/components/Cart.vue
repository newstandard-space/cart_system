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
        <p>ご注文の確認</p>
      </div>
      <div class="checkout-step-separator">
        <i class="bi bi-chevron-right"></i>
      </div>
      <div class="checkout-step-area">
        <p class="checkout-step-num">03</p>
        <p>ご注文完了</p>
      </div>
    </div>

    <h3>カート</h3>
    <div class="mt-3">
      <div v-if="cart.length" class="cart-box-area">
        <div class="cart-all-box">
          <div v-for="(cart_item, index) in cart" :key="index" class="cart-box">
            <div class="cart-item-image">
              <a :href="/product/ + cart_item.id">
                <img
                  :src="
                    cart_item.path.substring(0, cart_item.path.indexOf(','))
                  "
                  alt=""
                />
              </a>
            </div>
            <div>
              <p>{{ cart_item.name }}</p>
              <p class="text-muted">{{ cart_item.description }}</p>
              <p class="text-muted mb-5">
                サイズ {{ cart_item.size }} cm　数量 {{ cart_item.amount }}
              </p>
              <form
                method="POST"
                :action="
                  'cart/deleteCartItem?product_id=' + cart_item.product_id
                "
              >
                <input type="hidden" name="_method" value="DELETE" />
                <input type="hidden" name="_token" :value="csrf_token" />
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
        <div class="cart-box-info">
          <h5>ご注文金額</h5>
          <div class="cart-box-info-item">
            <div>
              <div>小計</div>
              <div>{{ subtotal }}</div>
            </div>
            <div class="mt-1 mb-3">
              <div>配送手数料</div>
              <div>配送無料</div>
            </div>
            <div class="cart-box-info-item-3 pt-3 pb-3">
              <div>合計（税込）</div>
              <div>{{ subtotal }}</div>
            </div>
            <div class="cart-box-info-item-4 mt-4">
              <a href="/checkout">
                <button>ご購入手続きへ進む</button>
              </a>
            </div>
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
const subtotal = ref(null);

let saveCart = {};

csrf_token.value = document.querySelector('meta[name="csrf-token"]').content;

const getCartSubtotal = (cart) => {
  let subtotal = 0;
  for (let obj of cart) {
    subtotal += (obj.price * obj.amount) * 1.1;
  }
  return formatter.format(subtotal);
};

let formatter = new Intl.NumberFormat("ja-JP", {
  style: "currency",
  currency: "JPY",
});

const formatToNumber = (price, amount) => {
  return formatter.format((price * amount) * 1.1);
};

const getCartInfo = () => {
  axios
    .get("/cart/getCartInfo")
    .then((res) => {
      console.log(res.data.cart);
      cart.value = res.data.cart;
      saveCart = res.data.cart;

      subtotal.value = getCartSubtotal(saveCart);
    })
    .catch((err) => {
      console.log("失敗", err);
    });
};

getCartInfo();
</script>
