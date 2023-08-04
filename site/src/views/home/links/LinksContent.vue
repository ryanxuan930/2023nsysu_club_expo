<script setup lang="ts">
import { useI18n } from 'vue-i18n';

const { t, locale } = useI18n();

const linkList: { title: string, url: string }[] = [
  {
    title: 'nsysu-osa-ag-website',
    url: 'https://ag-osa.nsysu.edu.tw/'
  },
  {
    title: 'nsysu-sa-facebook',
    url: 'https://www.facebook.com/nsysusa'
  },
  {
    title: 'nsysu-sa-website',
    url: 'https://nsysusa.org/'
  }
];
function openWindow(url: string) {
  window.open(url);
}
</script>

<template>
  <div class="page-content-box">
    <div class="page-title">{{ t('links') }}</div>
    <hr class="page-title-hr">
    <div class="page-button-box">
      <button v-for="(item, index) in linkList" :key="index" @click="openWindow(item.url)">{{ t(item.title) }}</button>
    </div>
  </div>
</template>

<style scoped lang="scss"></style>

<i18n lang="yaml" src="@/assets/locales.yaml"></i18n>

