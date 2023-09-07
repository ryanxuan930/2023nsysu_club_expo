<script setup lang="ts">
import { ref } from 'vue';
import type { Ref } from 'vue';
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
const clubs: Ref<{
  club_id: number;
  club_type: string;
  club_code: string;
  club_name_ch: string;
  club_name_en: string;
}[]> = ref([]);
async function getData() {
  await vr.Get('clubs', clubs);
}
getData();

function logout() {
  user.reset();
  localStorage.removeItem('userDataStore');
  router.push('/login');
}

</script>

<template>
  <div class="bg-white sm:bg-gray-50 h-screen overflow-x-hidden">
    <div class="m-auto w-full sm:w-96 h-full flex flex-col">
      <div class="flex-grow"></div>
      <div class="bg-white py-5 px-10 sm:p-5 sm:shadow">
        <img src="@/assets/logo.svg" class="h-10 mx-auto my-1" alt="">
        <div class="py-2 text-center relative">
          <button class="absolute top-0 right-0 h-8 w-8 cursor-pointer hover:bg-black hover:text-white rounded-full duration-150">
            <span class="material-symbols-outlined text-lg">edit</span>
          </button>
          <div class="text-2xl">{{ user.userInfo.name }}</div>
          <div class="text-xl">{{ user.userInfo.school_id }}</div>
        </div>
        <hr>
        <div class="flex flex-col gap-3 py-3">
          <button class="round-full-button black" @click="displayModal = 1">{{ t('show-qr-code') }}</button>
          <button class="round-full-button black" @click="router.push('/game/coupon')">{{ t('coupons') }}</button>
        </div>
        <hr>
        <div class="p-2 text-xl text-center">集點遊戲</div>
        <div>
          <table class="club-table">
            <tr v-for="(row, rowIndex) in user.userInfo.status.matrix" :key="rowIndex">
              <template v-for="(col, colIndex) in row" :key="colIndex">
                <td :class="{'bg-black text-white': col.checked}">
                  <div class="tooltip">
                    {{ col.club_code }}
                    <div class="tooltip-text">{{ locale == 'zh-TW' ? clubs.find(item => item.club_code === col.club_code)?.club_name_ch : clubs.find(item => item.club_code === col.club_code)?.club_name_en }}</div>
                  </div>
                </td>
              </template>
            </tr>
          </table>
          <div class="text-center flex items-center mt-2 gap-3 justify-center">
            <button class="hover:text-white hover:bg-black px-1 py-0.5 underline underline-offset-2" @click="displayModal = 2">{{ t('club-list') }}</button>
            <button class="hover:text-white hover:bg-black px-1 py-0.5 underline underline-offset-2" @click="displayModal = 3">{{ t('stand-map') }}</button>
            <div>{{ t('lines') }} : {{ user.userInfo.status.lines }}</div>
          </div>
          <button class="round-full-button black mt-2" @click="logout">{{ t('logout') }}</button>
        </div>
      </div>
      <div class="flex-grow"></div>
    </div>
  </div>
  <SmallModal v-show="displayModal > 0" @closeModal="displayModal = 0">
    <template v-slot:title>
      <div class="text-2xl">
        <div class="text-center" v-if="displayModal === 1">{{ user.userInfo.school_id }}</div>
        <div class="text-center" v-if="displayModal === 2">{{ t('club-list') }}</div>
        <div class="text-center" v-if="displayModal === 3">{{ t('stand-map') }}</div>
      </div>
    </template>
    <template v-slot:content>
      <div class="overflow-auto h-full">
        <QrcodeContent v-if="displayModal == 1"></QrcodeContent>
        <div v-if="displayModal == 2">
          <table class="club-list">
            <tr>
              <th>{{ t('club-code') }}</th>
              <th>{{ t('club-name-ch') }}</th>
              <th>{{ t('club-name-en') }}</th>
            </tr>
            <tr v-for="(item, index) in clubs" :key="index">
              <td>{{ item.club_code }}</td>
              <td>{{ item.club_name_ch }}</td>
              <td>{{ item.club_name_en }}</td>
            </tr>
          </table>
        </div>
        <div v-if="displayModal == 2">
          <img src="@/assets/layout.svg" alt="">
          <img src="@/assets/club_stand_list.jpg" alt="">
        </div>
      </div>
    </template>
  </SmallModal>
</template>

<style scoped lang="scss">
.club-table {
  @apply border border-collapse m-auto;
  td {
    @apply w-[50px] h-[50px] text-center border p-0.5;
  }
}
.tooltip-text {
  @apply invisible bg-black text-white text-center px-1 z-50 left-1/2 transform -translate-x-1/2 absolute top-full opacity-0 break-all w-28 bg-opacity-75;
  transition: opacity 0.5s;
}
.tooltip {
  @apply relative cursor-pointer max-w-[60px];
}
.tooltip:hover .tooltip-text {
  @apply visible opacity-100;
}
.tooltip .tooltip-text::after {
  @apply absolute bottom-full left-1/2 ml-[-5px] border-[5px] opacity-75;
  content: " ";
  border-color: transparent transparent black transparent;
}
.club-list {
  @apply w-full border-collapse;;
  th {
    @apply text-left;
  }
  th, td {
    @apply border px-3 py-1;
  }
  tr:nth-child(even) {
    @apply bg-gray-100;
  }
}
</style>

<i18n lang="yaml" src="@/assets/locales.yaml"></i18n>
<i18n lang="yaml">
  en-US:
    show-qr-code: 'Show QR Code'
    coupons: 'Coupons'
    club-list: 'Club List'
    club-code: 'Club Code'
    club-name-ch: 'Club Chinese Name'
    club-name-en: 'Club English Name'
    stand-map: 'Stand Map'
    lines: 'Lines'
  zh-TW:
    show-qr-code: '顯示 QR Code'
    coupons: '兌換券'
    club-list: '社團列表'
    club-code: '社團代碼'
    club-name-ch: '社團中文名稱'
    club-name-en: '社團英文名稱'
    stand-map: '攤位地圖'
    lines: '連線數'
</i18n>