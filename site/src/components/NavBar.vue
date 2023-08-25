<script setup lang="ts">
import { ref } from 'vue';
import { useI18n } from 'vue-i18n';
import { onClickOutside } from '@vueuse/core';
import { useRouter } from 'vue-router';

const showMobileNav = ref(false);
const router = useRouter();
const navBar = ref<HTMLElement | null>(null);
onClickOutside(navBar, () => {
  showMobileNav.value = false;
});

const { t, locale } = useI18n();
</script>

<template>
  <div class="sm:flex sm:items-center sm:gap-2 sm:py-2 sm:px-10 bg-white shadow " ref="navBar">
    <div @click="router.push('/')" class="cursor-pointer py-2 sm:p-0">
      <img src="@/assets/logo_ch.svg" alt="" class="h-12 sm:h-16 m-auto" />
    </div>
    <div class="block flex-grow">
      <div v-show="!showMobileNav" @click="showMobileNav = true" class="block bg-gray-50 material-symbols-outlined text-gray-700 text-2xl font-bold sm:hidden w-full text-center">expand_more</div>
      <div v-show="showMobileNav" @click="showMobileNav = false" class="block bg-gray-50 material-symbols-outlined text-gray-700 text-2xl font-bold sm:hidden w-full text-center">expand_less</div>
    </div>
    <div :class="{'nav-links': true, 'hidden': !showMobileNav}">
      <router-link to="/about">{{ t('about') }}</router-link>
      <router-link to="/news">{{ t('news') }}</router-link>
      <router-link to="/visitor">{{ t('visitor') }}</router-link>
      <router-link to="/links">{{ t('links') }}</router-link>
      <router-link to="/login" target="_blank">{{ t('login') }}</router-link>
      <a @click="$i18n.locale = 'zh-TW'" v-show="locale === 'en-US'">中文</a>
      <a @click="$i18n.locale = 'en-US'" v-show="locale === 'zh-TW'">English</a>
    </div>
  </div>
</template>

<style scoped lang="scss">
.nav-links {
  @apply absolute shadow sm:shadow-none bg-opacity-90 bg-white top-24 left-0 w-full sm:w-auto sm:left-auto sm:top-0 sm:relative sm:flex items-center gap-2 text-center box-border;
  a {
    @apply block sm:inline-block w-full sm:w-auto text-base sm:text-sm md:text-base lg:text-lg xl:text-xl py-2 sm:py-1.5 sm:px-3 font-medium hover:bg-gray-700 hover:text-white duration-300 cursor-pointer box-border;
  }
}
</style>

<i18n lang="yaml">
  en-US:
    about: About
    news: News
    visitor: Visitor
    links: Links
    login: Login
  zh-TW:
    about: 關於聯展
    news: 最新消息
    visitor: 參觀資訊
    links: 相關連結
    login: 登入
</i18n>
