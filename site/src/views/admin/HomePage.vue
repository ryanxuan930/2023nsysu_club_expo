<script setup lang="ts">
import { ref } from 'vue';
import { useAdminStore } from '@/stores/admin';
import VueRequest from '@/vue-request';
import { useRouter } from 'vue-router';

const router = useRouter();
const admin = useAdminStore();
function logout() {
  admin.reset();
  localStorage.removeItem('adminDataStore');
  router.push('/admin/login');
}
</script>

<template>
  <div class="m-auto w-96 p-5 flex flex-col gap-5">
    <div class="text-2xl">{{ admin.userInfo.name }}</div>
    <hr>
    <button class="round-full-button black" @click="router.push('/admin/scan')">掃碼通關</button>
    <button v-if="admin.userInfo.role > 0" class="round-full-button black" @click="router.push('/admin/redeem')">掃碼兌換</button>
    <button v-if="admin.userInfo.role > 8" class="round-full-button black" @click="router.push('/admin/bulletin')">公告欄</button>
    <button v-if="admin.userInfo.role > 2" class="round-full-button black" @click="router.push('/admin/broadcast')">警訊通知</button>
    <button v-if="admin.userInfo.role > 2" class="round-full-button black" @click="logout">登出ｚ</button>
  </div>
</template>

<style scoped lang="scss"></style>
