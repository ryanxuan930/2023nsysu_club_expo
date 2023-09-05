<script setup lang="ts">
import { useI18n } from 'vue-i18n';

const { t, locale } = useI18n();
</script>

<template>
  <div class="page-content-box">
    <div class="page-title">{{ t('theme') }}</div>
    <hr class="page-title-hr">
    <div>
      今年以本校的特色山海為主題，取名《山海奇航》，以從花果村來的小猴子傑克·吱派羅的尋寶故事，帶著同學們一起參與本次的社團聯展。在一路上傑克遇見了好多不一樣的社團，他看見同學們，用心的練舞、練唱，還調出繽紛的調酒請他喝，讓他好嚮往參與社團後的大學生活。
在逛社團聯展的途中，一直有一股食物的香氣吸引他往晚會的現場前進，原本冷清的長廊上陳列了各式各樣的市集攤位，舞臺上還有精彩的表演，讓學生都跟著舞動起來啦！
傑克在這次最喜歡的活動，肯定是靜態展的集點bingo啦！透過不同的小遊戲來更加認識社團，還可以藉機與不同社團的同學交流，完成bingo遊戲後，還可以換取學生會為這次社團聯展特別準備的小餐點來到用餐區與同學們聊聊，你在社團聯展看到了什麼？
還不心動嗎？趕快來參與這次的社團聯展吧！
    </div>
  </div>
</template>

<style scoped lang="scss"></style>

<i18n lang="yaml" src="@/assets/locales.yaml"></i18n>