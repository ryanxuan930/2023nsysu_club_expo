<script setup lang="ts">
import { useI18n } from 'vue-i18n';

const { t, locale } = useI18n();
</script>

<template>
  <div class="page-content-box">
    <div class="page-title">{{ t('key-visual') }}</div>
    <hr class="page-title-hr">
    <img src="@/assets/poster.png" alt="">
  </div>
</template>

<style scoped lang="scss"></style>

<i18n lang="yaml" src="@/assets/locales.yaml"></i18n>