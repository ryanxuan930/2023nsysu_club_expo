<script setup lang="ts">
import { useI18n } from 'vue-i18n';

const { t, locale } = useI18n();
</script>

<template>
  <div class="page-content-box">
    <div class="page-title">{{ t('program') }}</div>
    <hr class="page-title-hr">
    <div class="page-section-title">{{ t('content') }}</div>
    <img src="@/assets/club_night.png" alt="">
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

