<script setup lang="ts">
import { ref } from 'vue';
import type { Ref } from 'vue';
import { useRouter } from 'vue-router';
import VueRequest from '@/vue-request';
import { useAdminStore } from '@/stores/admin';

const data: Ref<{
    account: string,
    password: string
  }> = ref({
    account: '',
    password: ''
  });

const router = useRouter();
const vr = new VueRequest();
const admin = useAdminStore();

function submitAll() {
  if (data.value.account === '') {
    alert('請輸入帳號');
    return;
  }
  if (data.value.password === '') {
    alert('請輸入密碼');
    return;
  }
  vr.Post('auth/admin/login', data.value).then((res) => {
    if (res.message === 'OK') {
      admin.token = res.token;
      admin.userInfo = res.user;
      // set date
      const date = new Date();
      // add 48 hours
      date.setTime(date.getTime() + 48 * 60 * 60 * 1000);
      admin.expire = date;
      const adminData = {
        token: admin.token,
        userInfo: admin.userInfo,
        expire: admin.expire
      };
      localStorage.setItem('adminDataStore', JSON.stringify(adminData));
      router.push('/admin');
    } else {
      alert(res.message);
    }
  });
}
</script>

<template>
  <div class="flex bg-white">
    <div class="hidden sm:block flex-grow"></div>
    <div class="h-screen flex flex-col w-full sm:w-96 p-5 sm:p-0">
      <div class="flex-grow"></div>
      <div class="border rounded p-5">
        <div class="text-2xl font-semibold">集點平台管理系統</div>
        <hr class="my-5" />
        <label>
          <div>帳號</div>
          <input type="text" v-model="data.account"/>
        </label>
        <label>
          <div>密碼</div>
          <input type="password" v-model="data.password"/>
        </label>
        <button class="round-full-button blue" @click="submitAll">登入</button>
      </div>
      <div class="flex-grow"></div>
    </div>
    <div class="hidden sm:block flex-grow"></div>
  </div>
</template>

<style scoped lang="scss">
label {
  @apply text-lg flex gap-2 items-center my-3;
  div {
    @apply whitespace-nowrap;
  }
  input {
    @apply py-0.5 px-4 border rounded-full w-full;
  }
}
</style>
