<script setup lang="ts">
import { ref } from 'vue';
import { useUserStore } from '@/stores/user';
import VueRequest from '@/vue-request';
import QRCodeVue3 from 'qrcode-vue3';

const user = useUserStore();
const vr = new VueRequest(user.token);
</script>

<template>
  <div class="flex">
    <div class="flex-grow"></div>
    <QRCodeVue3
      :width="300"
      :height="300"
      value="https://scholtz.sk"
      :qrOptions="{ typeNumber: 10, mode: 'Byte', errorCorrectionLevel: 'H' }"
      :imageOptions="{ hideBackgroundDots: true, imageSize: 0.4, margin: 0 }"
      :dotsOptions="{
        type: 'extra-rounded',
        color: '#000',
      }"
      :backgroundOptions="{ color: '#ffffff' }"
      :cornersSquareOptions="{ type: 'extra-rounded', color: '#000000' }"
      :cornersDotOptions="{ type: 'dot', color: '#000000' }"
      fileExt="png"
      :image="'./src/assets/logo_only.svg'"
    />
    <div class="flex-grow"></div>
  </div>
</template>

<style scoped lang="scss"></style>
