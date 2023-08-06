<script setup lang="ts">
import { ref } from 'vue';
import { useI18n } from 'vue-i18n';
import { useRouter } from 'vue-router';
import { useUserStore } from '@/stores/user';
import VueRequest from '@/vue-request';
import QrcodeContent from '@/components/game/QrcodeContent.vue';

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
        <QrcodeContent></QrcodeContent>
      </div>
      <div class="flex-grow"></div>
    </div>
  </div>
</template>

<style scoped lang="scss"></style>
