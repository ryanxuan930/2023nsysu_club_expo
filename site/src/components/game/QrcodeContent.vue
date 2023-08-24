<script setup lang="ts">
import { ref } from 'vue';
import { useUserStore } from '@/stores/user';
import VueRequest from '@/vue-request';
import QRCodeVue3 from 'qrcode-vue3';
import { useI18n } from 'vue-i18n';

const user = useUserStore();
const vr = new VueRequest(user.token);
const qrcode: any = ref('');
const isLoaded = ref(false);
const { t, locale } = useI18n();
const counter = ref(0);
async function getData() {
  await vr.Get('auth/user/qrcode', qrcode, true, true);
  isLoaded.value = true;
  counter.value = 120;
  console.log(isLoaded.value);
  console.log(qrcode.value);
}
console.log(QRCodeVue3);
getData();
setInterval(() => {
  counter.value--;
  if (counter.value <= 0) {
    getData();
  }
}, 1000);
</script>

<template>
  <div>
    <div class="flex">
      <!--<div class="flex-grow"></div>-->
      <QRCodeVue3
        :width="350"
        :height="350"
        :value="qrcode"
        :qrOptions="{ typeNumber: 15, mode: 'Byte', errorCorrectionLevel: 'Q' }"
        :imageOptions="{ hideBackgroundDots: true, imageSize: 0.3, margin: 0 }"
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
      <!--<div class="flex-grow"></div>-->
    </div>
    <div class="text-center text-lg">{{ t('valid-in') }} {{ counter }} {{ t('seconds', counter) }}</div>
  </div>
</template>

<style scoped lang="scss"></style>

<i18n lang="yaml">
  en-US:
    valid-in: 'Valid in'
    seconds: 'second | seconds'
  zh-TW:
    valid-in: '有效時間'
    seconds: '秒'
</i18n>
