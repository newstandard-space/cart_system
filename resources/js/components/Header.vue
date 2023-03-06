<template>
  {{ counter }}
</template>

<script setup>
import { ref, computed } from "vue";

const counter = ref(null);

const countCartItem = () => {
  axios
    .get("/cart/countCartItem")
    .then((res) => {
      console.log(res.data.count);
      counter.value = res.data.count;
    })
    .catch((err) => {
      console.log("失敗", err);
    });
};

countCartItem();
</script>
