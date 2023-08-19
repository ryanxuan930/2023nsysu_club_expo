<script setup lang="ts">
import { onMounted, onBeforeUnmount } from 'vue';
import { useAdminStore } from '@/stores/admin';
import VueRequest from '@/vue-request';
import { useRouter } from 'vue-router';
import { useAlarmStore } from '@/stores/alarm';

const admin = useAdminStore();
const router = useRouter();
const alarm = useAlarmStore();

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

let hasBroadcast = false;
async function refreshAlert() {
  const res = await vr.Get('auth/admin/alert', null, true, true);
  if (res.broadcast != null && !hasBroadcast) {
    hasBroadcast = true;
    alarm.playSound(1);
    alarm.setAlert(res.broadcast.title, res.broadcast.content);
    window.navigator.vibrate([1000, 500, 1000, 500, 1000]);
    setTimeout(() => {
      hasBroadcast = false;
    }, 10000);
  }
}
let invervalContext: any;
onMounted(() => {
  invervalContext = setInterval(refreshAlert, 6000);
});
onBeforeUnmount(() => {
  clearInterval(invervalContext);
});
</script>

<template>
  <div>
    <router-view></router-view>
  </div>
</template>

<style scoped lang="scss"></style>
