<template>
  <Modal
    v-if="showContent"
    v-show="showContent"
    @from-child="closeModal"
    :item="item"
    :item_price="item_price"
    :size="now_size"
    :color="now_color"
    :color_image_pairs="color_image_pairs"
  />
  <div class="product-detail-container">
    <div v-if="Object.keys(color_images)" class="product-detail-image-box">
      <div
        v-for="(color_image, color) in color_images"
        :key="color"
        class="product-detail-image-area"
      >
        <div
          v-for="(path, index) in color_image"
          :key="index"
          class="product-detail-image"
        >
          <img :src="path" alt="商品画像" />
        </div>
      </div>
    </div>
    <div class="product-detail-info-box">
      <div v-if="Object.keys(item)" class="product-detail-info">
        <h3>{{ item.name }}</h3>
        <p v-if="item.description" class="text-muted">
          {{ item.description.substring(0, item.description.indexOf("\n")) }}
        </p>
        <p class="mb-0">{{ item_price }}</p>
        <p class="text-muted">(税込)</p>

        <!-- カラー -->
        <div v-if="Object.keys(color_image_pairs)" class="color-image-box">
          <div v-for="(image, color) in color_image_pairs" :key="color">
            <img
              :src="image"
              alt="カラー画像"
              :class="{ active: now_color == color }"
              @click="clickColor(color)"
            />
          </div>
        </div>

        <!-- サイズ -->
        <div v-if="Object.keys(color_sizes)" class="size-info">
          <p class="mb-2">サイズを選択</p>
          <div
            v-for="(sizes, color) in color_sizes"
            :key="color"
            class="size-box"
          >
            <div v-for="(size, index) in sizes" :key="index" class="size-area">
              <button
                :class="{ active: now_size == size }"
                @click="clickSize(size)"
              >
                {{ size }} cm
              </button>
            </div>
          </div>
        </div>
        <div class="cart-button-box">
          <button @click="openModal">カートに入れる</button>
        </div>
      </div>
    </div>
  </div>
  <input type="hidden" id="now_color" v-model="now_color" />
  <input type="hidden" id="now_size" v-model="now_size" />
</template>

<script setup>
import Modal from "./Modal.vue";
import { ref, computed } from "vue";

const item = ref({});
const color_images = ref({});
const color_sizes = ref({});
const color_image_pairs = ref({});
const now_color = ref(null);
const now_size = ref(null);

let save_color_images = {};
let save_item_sizes = {};

const item_id = document.getElementById("item_id").value;

const item_price = ref(null);

const formatter = new Intl.NumberFormat("ja-JP", {
  style: "currency",
  currency: "JPY",
});

const getProductDetailInfo = () => {
  axios
    .get("/getProductDetailInfo/" + item_id)
    .then((res) => {
      item.value = res.data.item;
      save_color_images = res.data.color_images;
      save_item_sizes = res.data.color_sizes;

      item_price.value = formatter.format(item.value.price);

      color_images.value = getFirstEntry(save_color_images);
      color_sizes.value = getFirstEntry(save_item_sizes);

      now_color.value = Object.entries(color_images.value)[0][0];

      color_image_pairs.value = getColorImagePair(save_color_images);
    })
    .catch((err) => {
      console.log("失敗", err);
    });
};

const getFirstEntry = (object) => {
  let color = Object.entries(object)[0][0];
  let images = Object.entries(object)[0][1];
  let firstObj = { [color]: images };
  return firstObj;
};

const getColorImagePair = (object) => {
  let obj = {};
  for (let color in object) {
    let image = Object.entries(object[color])[0][1];
    obj[color] = image;
  }
  return obj;
};

const clickColor = (color) => {
  color_images.value = { [color]: save_color_images[color] };
  now_color.value = color;
};

const clickSize = (size) => {
  now_size.value = size;
};

// モーダル
const showContent = ref(false);

const openModal = () => {
  if (now_size.value == null) {
    alert("サイズを選択してください。");
    return false;
  }

  axios
    .put("/addCart", {
      id: item_id.value,
      color: now_color.value,
      size: now_size.value
    })
    .then((res) => {
    })
    .catch((err) => {
      console.log("generate/失敗", err);
    });

  showContent.value = true;
};

const closeModal = () => {
  showContent.value = false;
};

getProductDetailInfo();
</script>
