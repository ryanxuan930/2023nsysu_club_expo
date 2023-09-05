<script setup lang="ts">
import { useI18n } from 'vue-i18n';

const { t, locale } = useI18n();
</script>

<template>
  <div class="page-content-box">
    <div class="page-title">{{ t('intro') }}</div>
    <hr class="page-title-hr">
    <div>
      <div>
        社團聯展是國立中山大學在學期初由學生會主辦的社團推廣活動，邀請校內學生認識社團，鼓勵參與社團活動。<br><br>提供社團展演平台，推廣校內社團活動，協助社團藉由舉辦社團聯展招募新生，以此活動提供校內各社團招生管道，且讓新生以及舊生可以一覽校內所有社團，使社團活動風氣盛行於校園中，並培養學生自治組織（學生會、社團）間團隊合作，由學生會活動部、社團部擔任此次活動之策劃人，培養學生會成員團隊合作以及活動規劃等能力，並與校內各社團合作。<br><br>由於考量到社團有不同的特長，今年社團聯展營造動靜皆宜的展示環境，分成位於活動中心的靜態展和國父銅像中庭的晚會與市集，期待社團們於傍晚活動中群聚綻放。
      </div>
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

