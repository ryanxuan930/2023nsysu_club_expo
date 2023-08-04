<script setup lang="ts">
import { useI18n } from 'vue-i18n';

const { t, locale } = useI18n();
</script>

<template>
  <div class="page-content-box">
    <div class="page-title">{{ t('contact') }}</div>
    <hr class="page-title-hr">
    <div class="page-section-title">{{ t('nsysusa') }}</div>
    <div class="page-section-box">
      <div>{{ t('nsysusa-address') }}</div>
      <div>
        Email
        <a class="hyperlink blue" href="mailto:nsysusa@g-mail.nsysu.edu.tw">nsysusa@g-mail.nsysu.edu.tw</a>
      </div>
      <div>
        Facebook
        <a class="hyperlink blue" href="https://www.facebook.com/nsysusa" target="_blank">國立中山大學學生會</a>
      </div>
      <div>
        Instagram
        <a class="hyperlink blue" href="https://www.instagram.com/nsysu.sa" target="_blank">@nsysu.sa</a>
      </div>
    </div>
    <div class="page-section-title">{{ t('nsysusa-club') }}</div>
    <div class="page-section-box">
      <div>
        Email
        <a class="hyperlink blue" href="mailto:nsysu.club@gmail.com">nsysu.club@gmail.com</a>
      </div>
    </div>
  </div>
</template>

<style scoped lang="scss">

</style>

<i18n lang="yaml">
  en-US:
    nsysusa: NSYSU Student Association
    nsysusa-address: 'Address : Rm. SUW4003, Student Activity Center W. Building, No.70, Lianhai Rd., Gushan Dist., Kaohsiung City 80424, Taiwan'
    nsysusa-club: Club Affairs (Club Affairs Department)
  zh-TW:
    nsysusa: 國立中山大學學生會
    nsysusa-address: 地址：高雄市鼓山區蓮海路70號中山大學活動中心西棟SUW4003室
    nsysusa-club: 社團事務相關(社團部)
</i18n>
<i18n lang="yaml" src="@/assets/locales.yaml"></i18n>
