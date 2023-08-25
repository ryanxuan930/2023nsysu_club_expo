<script setup lang="ts">
import { ref } from 'vue';
import { useUserStore } from '@/stores/user';
import VueRequest from '@/vue-request';
import VueQrcode from '@chenfengyuan/vue-qrcode';
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
}
getData();
setInterval(() => {
  counter.value--;
  if (counter.value <= 0) {
    getData();
  }
}, 1000);
</script>

<template>
  <div v-if="isLoaded">
    <div class="flex">
      <div class="flex-grow"></div>
      <vue-qrcode :value="qrcode" tag="svg" :options="{ errorCorrectionLevel: 'H', width: 350 }"></vue-qrcode>
      <div class="flex-grow"></div>
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
