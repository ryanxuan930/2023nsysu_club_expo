<script setup lang="ts">
import { useI18n } from 'vue-i18n';
import { useRouter } from 'vue-router';

const router = useRouter();

const { t, locale } = useI18n();

const linkList:string[] = [
  'schedule',
  'site-map',
  'stand-map',
  'program',
  'market-stand-map',
];
</script>

<template>
  <div class="page-content-box">
    <div class="page-title">{{ t('visitor') }}</div>
    <hr class="page-title-hr">
    <div class="page-button-box">
      <button v-for="(item, index) in linkList" :key="index" @click="router.push(`/visitor/${item}`)">{{ t(item) }}</button>
    </div>
  </div>
</template>

<style scoped lang="scss"></style>

<i18n lang="yaml" src="@/assets/locales.yaml"></i18n>
<i18n lang="yaml">
  en-US:
    content: ''
  zh-TW:
    content: ''
</i18n>

