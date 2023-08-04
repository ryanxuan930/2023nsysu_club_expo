<script setup lang="ts">
import { ref } from 'vue';
import { useI18n } from 'vue-i18n';
import { useRouter } from 'vue-router';
import { useUserStore } from '@/stores/user';
import VueRequest from '@/vue-request';
import QRCodeVue3 from 'qrcode-vue3';

const { t, locale } = useI18n();
const router = useRouter();
const user = useUserStore();
const vr = new VueRequest(user.token);

</script>

<template>
  <div class="bg-white sm:bg-gray-50 h-screen">
    <div class="m-auto w-full sm:w-96 h-full flex flex-col">
      <div class="flex-grow"></div>
      <div class="bg-white p-10 sm:p-5 sm:shadow">
        <div class="text-center">
          <QRCodeVue3
            :width="260"
            :height="260"
            value="https://scholtz.sk"
            :qrOptions="{ typeNumber: 5, mode: 'Byte', errorCorrectionLevel: 'H' }"
            :imageOptions="{ hideBackgroundDots: true, imageSize: 0.4, margin: 0 }"
            :dotsOptions="{
              type: 'extra-rounded',
              color: '#000',
            }"
            fileExt="png"
            :image="'./src/assets/logo_only.svg'"
          />
        </div>
        <div class="py-5">
          <div class="text-2xl">{{ user.userInfo.name }}</div>
          <div>{{ user.userInfo.school_id }}</div>
        </div>
      </div>
      <div class="flex-grow"></div>
    </div>
  </div>
</template>

<style scoped lang="scss"></style>
