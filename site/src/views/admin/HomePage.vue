<script setup lang="ts">
import { ref } from 'vue';
import { useAdminStore } from '@/stores/admin';
import VueRequest from '@/vue-request';
import { useRouter } from 'vue-router';

const router = useRouter();
const admin = useAdminStore();
</script>

<template>
  <div class="m-auto w-96 p-5 flex flex-col gap-5">
    <div class="text-2xl">{{ admin.userInfo.name }}</div>
    <hr>
    <button class="round-full-button black" @click="router.push('/admin/scan')">掃碼通關</button>
    <button class="round-full-button black" @click="router.push('/admin/bulletin')">公告欄</button>
    <button class="round-full-button black" @click="router.push('/admin/announce')">警訊通知</button>
  </div>
</template>

<style scoped lang="scss"></style>
