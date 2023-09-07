<script setup lang="ts">
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import { useI18n } from 'vue-i18n';

const router = useRouter();
const { t, locale } = useI18n();
</script>

<template>
  <div>
    <div class="bg-gray-700 text-white p-5 flex flex-col sm:flex-row justify-center items-center gap-5 sm:gap-7 shadow">
      <div class="flex flex-col gap-3 sm:items-end">
        <div class="sm:flex items-end">
          <div class="text-xl font-semibold">{{ t('static-exhibition') }}：</div>
          <div>
            <span class="emphasized-text">09.06 - 09.07</span>
          </div>
        </div>
        <div class="sm:flex items-end">
          <div class="text-xl font-semibold">{{ t('show-and-market') }}：</div>
          <div>
            <span class="emphasized-text">09.08</span>
          </div>
        </div>
      </div>
      <div class="border w-full sm:w-0 sm:h-[100px]"></div>
      <div class="flex flex-col items-center sm:items-start">
        <div class="py-2 font-semibold sm:text-lg italic">{{ t('game') }}</div>
        <button @click="router.push('/login')" class="bg-sky-600 shadow-lg py-2 px-5 sm:py-3 sm:px-10 text-xl font-semibold hover:bg-sky-500 duration-200">{{ t('login-now') }}</button>
      </div>
    </div>
  </div>
</template>

<style scoped lang="scss">
.emphasized-text {
  @apply text-3xl sm:text-5xl font-medium italic;
}
.section {
  @apply w-full md:w-[768px] lg:w-[1024px];
}
</style>

<i18n lang="yaml" src="@/assets/locales.yaml"></i18n>
<i18n lang="yaml">
  en-US:
    login-now: 'Login Now'
    game: 'Collect points and redeem for gifts!'
  zh-TW:
    login-now: '馬上登入'
    game: '集點通關換好禮'
</i18n>