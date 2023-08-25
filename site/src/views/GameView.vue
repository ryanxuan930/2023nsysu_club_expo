<script setup lang="ts">
import { onMounted, onBeforeUnmount } from 'vue';
import VueRequest from '@/vue-request';
import { useUserStore } from '@/stores/user';
import { useRouter } from 'vue-router';
import { useAlarmStore } from '@/stores/alarm';

const router = useRouter();
const user = useUserStore();
const alarm = useAlarmStore();

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

let hasBroadcast = false;
async function refreshStatus() {
  const res = await vr.Get('auth/user/status', null, true, true);
  user.userInfo.status = res.status;
  if (res.broadcast != null && !hasBroadcast) {
    hasBroadcast = true;
    alarm.playSound(1);
    alarm.setAlert(res.broadcast.title, res.broadcast.content);
    window.navigator.vibrate([1000, 500, 1000, 500, 1000]);
    setTimeout(() => {
      hasBroadcast = false;
    }, 6000);
  }
}
let invervalContext: any;
onMounted(() => {
  invervalContext = setInterval(refreshStatus, 6000);
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
