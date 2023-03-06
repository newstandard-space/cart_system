<template>
  <div id="overlay" @click="clickEvent">
    <div id="content" @click="stopEvent">
      <div class="modal-content-upper-box">
        <div class="pt-1">
          <p>
            <i class="bi bi-check-circle-fill text-success mr-2"></i
            >カートに追加済み
          </p>
        </div>
        <div>
          <button @click="clickEvent"><span class="batsu"></span></button>
        </div>
      </div>
      <div class="modal-content-middle-box">
        <div>
          <img :src="color_image_pairs[color]" alt="商品画像" />
        </div>
        <div class="modal-content-middle-info">
          <p>{{ item.name }}</p>
          <p class="text-muted">
            {{ item.description.substring(0, item.description.indexOf("(")) }}
          </p>
          <p class="text-muted">サイズ {{ size }}</p>
          <p class="mb-0">{{ item_price }}</p>
          <p class="text-muted">(税込)</p>
        </div>
      </div>
      <div class="modal-content-bottom-box">
        <a href="/cart">
          <button type="submit" class="go-to-cart-button">カートの確認</button>
        </a>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, defineProps } from "vue";

const props = defineProps({
  item: Object,
  item_price: String,
  size: String,
  color: String,
  color_image_pairs: Object,
});

const item = ref(props.item);

const emit = defineEmits(["eventEmit"]);

const clickEvent = () => {
  emit("from-child");
};

const stopEvent = (e) => {
  event.stopPropagation();
};

console.log(props.color_image_pairs);
</script>
