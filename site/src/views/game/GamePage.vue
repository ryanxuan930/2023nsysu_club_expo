<script setup lang="ts">
import { ref } from 'vue';
import { useI18n } from 'vue-i18n';
import { useRouter } from 'vue-router';
import { useUserStore } from '@/stores/user';
import VueRequest from '@/vue-request';
import QrcodeContent from '@/components/game/QrcodeContent.vue';
import SmallModal from '@/components/SmallModal.vue';

const { t, locale } = useI18n();
const router = useRouter();
const user = useUserStore();
const vr = new VueRequest(user.token);
const displayModal = ref(0);

</script>

<template>
  <div class="bg-white sm:bg-gray-50 h-screen">
    <div class="m-auto w-full sm:w-96 h-full flex flex-col">
      <div class="flex-grow"></div>
      <div class="bg-white p-10 sm:p-5 sm:shadow">
        <div class="py-5 text-center">
          <div class="text-3xl">{{ user.userInfo.name }}</div>
          <div class="text-xl">{{ user.userInfo.school_id }}</div>
        </div>
        <hr>
        <div></div>
        <hr>
        <div class="flex flex-col gap-3 py-5">
          <button class="round-full-button black" @click="displayModal = 1">{{ t('show-qr-code') }}</button>
          <button class="round-full-button black" @click="router.push('/game/coupon')">{{ t('coupons') }}</button>
        </div>
      </div>
      <div class="flex-grow"></div>
    </div>
  </div>
  <SmallModal v-show="displayModal > 0" @closeModal="displayModal = 0">
    <template v-slot:title>
      <div class="text-2xl">
        <div class="text-center" v-if="displayModal === 1">{{ user.userInfo.school_id }}</div>
      </div>
    </template>
    <template v-slot:content>
      <div class="overflow-auto h-full">
        <QrcodeContent v-if="displayModal == 1"></QrcodeContent>
      </div>
    </template>
  </SmallModal>
</template>

<style scoped lang="scss"></style>

<i18n lang="yaml" src="@/assets/locales.yaml"></i18n>
<i18n lang="yaml">
  en-US:
    show-qr-code: 'Show QR Code'
    coupons: 'Coupons'
  zh-TW:
    show-qr-code: '顯示 QR Code'
    coupons: '兌換券'
</i18n>