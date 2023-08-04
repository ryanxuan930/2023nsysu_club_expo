<script setup lang="ts">
import { ref } from 'vue';
import type { Ref } from 'vue';
import { useRouter } from 'vue-router';
import { useI18n } from 'vue-i18n';
import VueRequest from '@/vue-request';

const vr = new VueRequest();
const data: Ref<{
  school_id: string,
  name: string,
  birthday: string,
  email: string,
  phone: string
}> = ref({
  school_id: '',
  name: '',
  birthday: '',
  email: '',
  phone: ''
});
const router = useRouter();
const { t, locale } = useI18n();

function submitAll() {
  if (data.value.school_id === '') {
    alert(t('school-id') + t('is-required'));
    return;
  }
  if (!/^[A-Z][0-9]+$/.test(data.value.school_id)) {
    alert(t('wrong-format', { input: t('school-id') }));
    return;
  }
  if (data.value.name === '') {
    alert(t('name') + t('is-required'));
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
  if (data.value.phone !== '' && !/^[0-9]{10}$/.test(data.value.phone)) {
    alert(t('wrong-format', { input: t('phone') }));
    return;
  }
  vr.Post('auth/user/register', data.value).then((res) => {
    if (res.message === 'OK') {
      alert(t('register-success'));
      router.push('/login');
    } else {
      alert(t('register-failed'));
    }
  });
}
</script>

<template>
  <div class="h-screen bg-gray-50 overflow-auto">
    <div class="w-full h-full mx-auto sm:w-[32rem] sm:flex sm:flex-col sm:p-5 sm:p-auto">
      <div class="hidden sm:block flex-grow"></div>
      <div class="h-full sm:h-auto bg-white shadow p-10 sm:p-6">
        <div id="logo"></div>
        <div class="flex items-center px-5 text-xl py-0 gap-2 relative z-10">
          <div class="font-semibold">{{ t('register') }}</div>
          <div class="flex-grow"></div>
          <a @click="$i18n.locale = 'zh-TW'" :class="{ 'text-gray-800': locale === 'zh-TW', 'text-gray-400': locale === 'en-US', 'cursor-pointer': true }">中文</a>
          <div class="h-6 border-l-[1.5px] border-gray-500"></div>
          <a @click="$i18n.locale = 'en-US'" :class="{ 'text-gray-800': locale === 'en-US', 'text-gray-400': locale === 'zh-TW', 'cursor-pointer': true }">English</a>
        </div>
        <hr class="m-2">
        <div class="flex flex-col gap-3 z-10 relative">
          <label class="input-box">
            <div>{{ t('school-id') }}*</div>
            <input type="text" v-model="data.school_id">
          </label>
          <label class="input-box">
            <div>{{ t('name') }}*</div>
            <input type="text" v-model="data.name">
          </label>
          <label class="input-box">
            <div>{{ t('birthday') }}*</div>
            <input type="date" v-model="data.birthday">
          </label>
          <label class="input-box">
            <div>Email*：</div>
            <input type="email" v-model="data.email">
          </label>
          <label class="input-box">
            <div>{{ t('phone') }}</div>
            <input type="text" v-model="data.phone">
          </label>
          <div class="px-5 text-gray-500">
            <div class="text-xs">* {{ t('is-required') }}</div>
            <div class="text-sm">
              {{ t('by-clicking-register') }}
              <router-link class="text-gray-600 hover:bg-black hover:text-white duration-150 py-0.5 px-1" to="/terms-of-use">{{ t('terms-of-use') }}</router-link>
            </div>
          </div>
          <button @click="submitAll" class="round-full-button bg-black border-black">{{ t('register') }}</button>
          <div>
            <span class="inline-block py-0.5 px-1">{{ t('have-account') }}</span>
            <router-link class="text-gray-600 hover:bg-black hover:text-white duration-150 py-0.5 px-1" to="/login">{{ t('back-to-login') }}</router-link>
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
    name: 'Full Name'
    phone: 'Phone'
    have-account: 'Already have an account?'
    back-to-login: 'Click me to login'
    is-required: 'is required'
    by-clicking-register: 'By clicking register, you agree to our'
    terms-of-use: 'Terms of Use'
    wrong-format: 'Wrong {input} format'
    register-success: 'Register success, please login'
    register-failed: 'Register failed'
  zh-TW:
    school-id: '學號'
    birthday: '生日'
    name: '真實姓名'
    phone: '手機'
    have-account: '已經有帳號？'
    back-to-login: '點我登入'
    is-required: '為必填欄位'
    by-clicking-register: '點擊註冊，即表示您同意我們的'
    terms-of-use: '使用條款'
    wrong-format: '{input}格式錯誤'
    register-success: '註冊成功，請登入'
    register-failed: '註冊失敗'
</i18n>
```
