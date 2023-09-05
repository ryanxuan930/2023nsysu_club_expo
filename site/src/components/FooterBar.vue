<script setup lang="ts">
import { ref } from 'vue';
import { useI18n } from 'vue-i18n';

const { t, locale } = useI18n();
</script>

<template>
  <div>
    <div class="footer-links">
      <div>
        <router-link class="link-title" to="/about">{{ t('about') }}</router-link>
        <router-link to="/about/intro">{{ t('intro') }}</router-link>
        <router-link to="/about/key-visual">{{ t('key-visual') }}</router-link>
        <router-link to="/about/theme">{{ t('theme') }}</router-link>
        <router-link to="/about/contact">{{ t('contact') }}</router-link>
      </div>
      <div>
        <router-link class="link-title" to="/news">{{ t('news') }}</router-link>
      </div>
      <div>
        <router-link class="link-title" to="/visitor">{{ t('visitor') }}</router-link>
        <router-link to="/visitor/schedule">{{ t('schedule') }}</router-link>
        <router-link to="/visitor/site-map">{{ t('site-map') }}</router-link>
        <router-link to="/visitor/stand-map">{{ t('stand-map') }}</router-link>
        <router-link to="/visitor/program">{{ t('program') }}</router-link>
        <router-link to="/visitor/market-stand-map">{{ t('market-stand-map') }}</router-link>
      </div>
      <div>
        <router-link class="link-title" to="">{{ t('links') }}</router-link>
        <a href="https://ag-osa.nsysu.edu.tw/">{{ t('nsysu-osa-ag-website') }}</a>
        <a href="https://www.facebook.com/nsysusa">{{ t('nsysu-sa-facebook') }}</a>
        <a href="https://nsysusa.org/">{{ t('nsysu-sa-website') }}</a>
      </div>
      <div>
        <router-link class="link-title" to="/login" target="_blank">{{ t('login') }}</router-link>
        <router-link to="/login/register" target="_blank">{{ t('register') }}</router-link>
      </div>
    </div>
    <div class="text-lg p-5 bg-gray-700 text-white flex flex-wrap gap-5 items-center justify-start sm:justify-center">
      <div>{{ t('advisor') }}</div>
      <div>{{ t('organizer') }}</div>
    </div>
    <div class="text-xs p-3 text-center bg-gray-700 text-white">
      <div>® 2023 NSYSU Student Association</div>
    </div>
  </div>
</template>

<style scoped lang="scss">
.link-title {
  @apply text-lg sm:text-xl font-bold text-gray-600 hover:text-gray-700 duration-150 cursor-pointer;
}
.footer-links {
  @apply text-base sm:text-lg py-10 px-5 bg-gray-100 flex flex-wrap justify-start sm:justify-between md:justify-evenly items-start gap-5;
  div {
    @apply flex flex-col gap-3 items-start justify-start;
  }
}
</style>

<i18n lang="yaml">
  en-US:
    advisor: 'Advisor : Student Life and Career Development Section, Office of Student Affairs, National Sun Yat-sen University'
    organizer: 'Organizer : National Sun Yat-sen University Student Association'
  zh-TW:
    advisor: '指導單位：國立中山大學學生事務處校園生活與職涯發展組'
    organizer: '主辦單位：國立中山大學學生會'
</i18n>
<i18n lang="yaml" src="@/assets/locales.yaml"></i18n>
    
