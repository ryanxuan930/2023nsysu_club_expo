<script setup lang="ts">
import { ref } from 'vue';
import { useAdminStore } from '@/stores/admin';
import VueRequest from '@/vue-request';
import { useRouter } from 'vue-router';

const admin = useAdminStore();
const router = useRouter();

if (!admin.token) {
  const data = localStorage.getItem('adminDataStore');
  if (data) {
    admin.token = JSON.parse(data).token;
    admin.userInfo = JSON.parse(data).userInfo;
    admin.expire = JSON.parse(data).expire;
  } else {
    localStorage.removeItem('adminDataStore');
    router.push('/login/admin');
  }
  // check token is expire
  if (admin.expire < new Date()) {
    localStorage.removeItem('adminDataStore');
    router.push('/login/admin');
  }
}
const vr = new VueRequest(admin?.token === undefined ? undefined : admin.token);
vr.Get('auth/admin/info', null, true, true).then((res: any) => {
  if (res.message === 'OK') {
    admin.userInfo = res.user;
  } else {
    localStorage.removeItem('adminDataStore');
    router.push('/login/admin');
  }
});
</script>

<template>
  <div>
    <router-view></router-view>
  </div>
</template>

<style scoped lang="scss"></style>
