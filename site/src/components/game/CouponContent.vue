<script setup lang="ts">
import { ref } from 'vue';
import VueQrcode from '@chenfengyuan/vue-qrcode';

const props = defineProps(['couponData']);
const qrcode: any = ref(JSON.stringify(props.couponData));
</script>

<template>
  <div>
    <div class="flex">
      <div class="flex-grow"></div>
      <vue-qrcode :value="qrcode" tag="svg" :options="{ errorCorrectionLevel: 'H', width: 350 }"></vue-qrcode>
      <div class="flex-grow"></div>
    </div>
  </div>
</template>

<style scoped lang="scss"></style>
