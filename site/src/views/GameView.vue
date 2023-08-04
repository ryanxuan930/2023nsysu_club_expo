<script setup lang="ts">
import VueRequest from '@/vue-request';
import { useUserStore } from '@/stores/user';
import { useRouter } from 'vue-router';

const router = useRouter();
const user = useUserStore();

if (!user.token) {
  const data = localStorage.getItem('userDataStore');
  if (data) {
    user.token = JSON.parse(data).token;
    user.userInfo = JSON.parse(data).userInfo;
    user.expire = JSON.parse(data).expire;
  } else {
    localStorage.removeItem('userDataStore');
    router.push('/login');
  }
  // check token is expire
  if (user.expire < new Date()) {
    localStorage.removeItem('userDataStore');
    router.push('/login');
  }
}
const vr = new VueRequest(user?.token === undefined ? undefined : user.token);
vr.Get('auth/user/info', null, true, true).then((res: any) => {
  if (res.message === 'OK') {
    user.userInfo = res.user;
  } else {
    localStorage.removeItem('userDataStore');
    router.push('/login');
  }
});
</script>

<template>
  <div>
    <router-view></router-view>
  </div>
</template>

<style scoped lang="scss"></style>
