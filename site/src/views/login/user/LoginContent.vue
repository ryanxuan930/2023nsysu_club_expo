<script setup lang="ts">
import { ref } from 'vue';
import type { Ref } from 'vue';
import { useRouter } from 'vue-router';
import { useI18n } from 'vue-i18n';
import VueRequest from '@/vue-request';
import { useUserStore } from '@/stores/user';
import { useAlarmStore } from '@/stores/alarm';

const data: Ref<{
  school_id: string,
  birthday: string,
  email: string
}> = ref({
  school_id: '',
  birthday: '',
  email: ''
});
const router = useRouter();
const vr = new VueRequest();
const { t, locale } = useI18n();

const user = useUserStore();
const alarm = useAlarmStore();

function submitAll() {
  if (data.value.school_id === '') {
    alert(t('school-id') + t('is-required'));
    return;
  }
  if (!/^[A-Z][0-9]+$/.test(data.value.school_id)) {
    alert(t('wrong-format', { input: t('school-id') }));
    return;
  }
  if (data.value.birthday === '') {
    alert(t('birthday') + t('is-required'));
    return;
  }
  if (!/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/.test(data.value.birthday)) {
    alert(t('wrong-format', { input: t('birthday') }));
    return;
  }
  if (data.value.email === '') {
    alert('Email' + t('is-required'));
    return;
  }
  if (!/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(data.value.email)) {
    alert(t('wrong-format', { input: 'Email' }));
    return;
  }
  vr.Post('auth/user/login', data.value).then((res) => {
    if (res.message === 'OK') {
      user.token = res.token;
      user.userInfo = res.user;
      // set date
      const date = new Date();
      // add 48 hours
      date.setTime(date.getTime() + 48 * 60 * 60 * 1000);
      user.expire = date;
      const userData = {
        token: user.token,
        userInfo: user.userInfo,
        expire: user.expire,
      };
      alarm.playSound(0);
      // set userStore data to localStorage
      localStorage.setItem('userDataStore', JSON.stringify(userData));
      router.push('/game');
    } else if (res.message === 'wrong_credentials') {
      alert(t('wrong-credentials'));
    } else if (res.message === 'not_found') {
      alert(t('not-found'));
    } else {
      alert(t('login-failed'));
    }
  });
}
</script>

<template>
  <div class="h-screen bg-gray-50 overflow-auto">
    <div class="w-full h-full mx-auto sm:w-[32rem] sm:flex sm:flex-col sm:p-5 sm:p-auto text-gray-800">
      <div class="hidden sm:block flex-grow"></div>
      <div class="h-full sm:h-auto bg-white shadow p-10 sm:p-6">
        <div id="logo"></div>
        <div class="flex items-center px-5 text-xl py-0 gap-2 relative z-10">
          <div class="font-semibold">{{ t('login') }}</div>
          <div class="flex-grow"></div>
          <a @click="$i18n.locale = 'zh-TW'" :class="{ 'text-gray-800': locale === 'zh-TW', 'text-gray-400': locale === 'en-US', 'cursor-pointer': true }">中文</a>
          <div class="h-6 border-l-[1.5px] border-gray-500"></div>
          <a @click="$i18n.locale = 'en-US'" :class="{ 'text-gray-800': locale === 'en-US', 'text-gray-400': locale === 'zh-TW', 'cursor-pointer': true }">English</a>
        </div>
        <hr class="m-2">
        <div class="flex flex-col gap-3 z-10 relative py-1">
          <label class="input-box">
            <div>{{ t('school-id') }}</div>
            <input type="text" v-model="data.school_id">
          </label>
          <label class="input-box">
            <div>{{ t('birthday') }}</div>
            <input type="date" v-model="data.birthday">
          </label>
          <label class="input-box">
            <div>Email</div>
            <input type="email" v-model="data.email">
          </label>
          <button @click="submitAll" class="round-full-button bg-black border-black">{{ t('login') }}</button>
          <hr>
          <div>
            <span class="inline-block py-0.5 px-1">{{ t('no-account') }}</span>
            <router-link class="text-gray-600 hover:bg-black hover:text-white duration-150 py-0.5 px-1" to="/login/register">{{ t('click-register') }}</router-link>
          </div>
        </div>
      </div>
      <div class="hidden sm:block flex-grow"></div>
    </div>
  </div>
</template>

<style scoped lang="scss">
#logo {
  @apply w-60 h-60 mx-auto bg-center bg-no-repeat bg-cover sm:scale-150 z-0;
  background-image: url("@/assets/logo_square.svg");
}
.input-box {
  @apply flex items-center px-5 py-1.5 rounded-full border text-base sm:text-lg gap-2;
  div {
    @apply text-gray-500;
  }
  input {
    @apply flex-grow;
  }
}
.round-full-button {
  @apply px-5 py-1.5 text-base sm:text-lg cursor-pointer;
}
</style>

<i18n lang="yaml" src="@/assets/locales.yaml"></i18n>
<i18n lang="yaml">
  en-US:
    school-id: 'School ID'
    birthday: 'Birthday'
    no-account: "Don't have an account?"
    click-register: 'Click me to register'
    wrong-format: '{input} format is wrong'
    wrong-credentials: 'School ID, birthday or Email is wrong'
    not-found: 'User not found'
    login-failed: 'Login failed'
  zh-TW:
    school-id: '學號'
    birthday: '生日'
    no-account: '還沒有帳號？'
    click-register: '點我註冊'
    wrong-format: '{input}格式錯誤'
    wrong-credentials: '學號、生日或Email錯誤'
    not-found: '尚未註冊'
    login-failed: '登入失敗'
</i18n>
```
