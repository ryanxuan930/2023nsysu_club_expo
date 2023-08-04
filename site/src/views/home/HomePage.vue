<script setup lang="ts">
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import { useI18n } from 'vue-i18n';

const router = useRouter();
const { t, locale } = useI18n();
</script>

<template>
  <div>
    <div class="banner">
      <img src="https://scontent.fkhh1-1.fna.fbcdn.net/v/t1.6435-9/118950782_3521193707901861_8691128215478213857_n.jpg?_nc_cat=100&cb=99be929b-3346023f&ccb=1-7&_nc_sid=8bfeb9&_nc_ohc=zhC41XU5jY4AX81M6ot&_nc_ht=scontent.fkhh1-1.fna&oh=00_AfAoj-ZYVsoUBqNwjiNxdlvjBsNLEoY00o3RmkXN2Y2r2w&oe=64E9DC05" alt="">
    </div>
    <div class="bg-gray-700 text-white p-5 flex justify-center items-center gap-5 sm:gap-7 shadow">
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
      <div class="border h-[100px]"></div>
      <div>
        <button @click="router.push('/login')" class="bg-sky-600 shadow-lg py-2 px-5 sm:py-3 sm:px-10 text-xl font-semibold hover:bg-sky-500 duration-200">{{ t('login') }}</button>
      </div>
    </div>
    <div class="flex flex-col gap-5 p-5 items-center">
      <div class="news section">
        <div class="text-2xl font-semibold">{{ t('news') }}</div>
        <hr class="my-2">
        <table class="w-full">
          <tr>
            <td>2023-09-01</td>
            <td>演出名單</td>
            <td>最新消息</td>
          </tr>
        </table>
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