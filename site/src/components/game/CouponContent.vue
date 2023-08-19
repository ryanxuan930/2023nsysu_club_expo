<script setup lang="ts">
import { ref } from 'vue';
import QRCodeVue3 from 'qrcode-vue3';

const props = defineProps(['couponData']);
const qrcode: any = ref(JSON.stringify(props.couponData));
</script>

<template>
  <div>
    <div class="flex">
      <div class="flex-grow"></div>
      <QRCodeVue3
        :width="300"
        :height="300"
        :value="qrcode"
        :qrOptions="{ typeNumber: 10, mode: 'Byte', errorCorrectionLevel: 'Q' }"
        :imageOptions="{ hideBackgroundDots: true, imageSize: 0.3, margin: 0 }"
        :dotsOptions="{
          type: 'extra-rounded',
          color: '#000',
        }"
        :backgroundOptions="{ color: '#ffffff' }"
        :cornersSquareOptions="{ type: 'extra-rounded', color: '#000000' }"
        :cornersDotOptions="{ type: 'dot', color: '#000000' }"
        fileExt="png"
      />
      <div class="flex-grow"></div>
    </div>
  </div>
</template>

<style scoped lang="scss"></style>
