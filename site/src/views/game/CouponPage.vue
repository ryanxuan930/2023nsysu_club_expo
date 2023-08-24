<script setup lang="ts">
import { ref, onMounted, onBeforeUnmount } from 'vue';
import type { Ref } from 'vue';
import { useI18n } from 'vue-i18n';
import { useRouter } from 'vue-router';
import { useUserStore } from '@/stores/user';
import VueRequest from '@/vue-request';
import SmallModal from '@/components/SmallModal.vue';
import CouponContent from '@/components/game/CouponContent.vue';

const { t, locale } = useI18n();
const user = useUserStore();
const vr = new VueRequest(user.token);
const displayModal = ref(0);
const coupons: any = ref([]);
const payload: any = ref({
  school_id: '',
  coupon_code: '',
  type: '',
});

async function refreshData() {
  await vr.Post('coupons/all', { payload: [user.userInfo.status.remarks.meal_issued, ...user.userInfo.status.remarks.lucky_draws]}, coupons, true, true);
  coupons.value.sort((a: any, b: any) => {
    if (a.valid && !b.valid) return -1;
    if (!a.valid && b.valid) return 1;
    if (a.valid && b.valid) {
      if (a.coupon_context.type == 'meal' && b.coupon_context.type == 'lucky_draw') return 1;
      if (a.coupon_context.type == 'lucky_draw' && b.coupon_context.type == 'meal') return -1;
    }
    return 0;
  });
}
refreshData();
let invervalContext: any = null;
onMounted(() => {
  invervalContext = setInterval(refreshData, 10000);
});
onBeforeUnmount(() => {
  clearInterval(invervalContext);
});

function open(item: any) {
  if (!item.valid) {
    alert(t('used'));
    return;
  };
  if (new Date(item.expired_at).getTime() / 1000 < new Date().getTime() / 1000) {
    alert(t('expired'));
    return;
  };
  payload.value = {
    school_id: user.userInfo.school_id,
    coupon_code: item.coupon_code,
    type: item.coupon_context.type,
  };
  displayModal.value = 1;
}

function validation(item: any): string {
  if (!item.valid) {
    return 'invalid';
  };
  if (new Date(item.expired_at).getTime() / 1000 < new Date().getTime() / 1000) {
    return 'invalid';
  };
  return 'valid';
}
</script>

<template>
  <div class="bg-white sm:bg-gray-50 h-screen overflow-x-hidden">
    <div class="m-auto w-full sm:w-96 h-full flex flex-col">
      <div class="flex-grow"></div>
      <div class="bg-white py-5 px-10 sm:p-5 sm:shadow">
        <div class="py-2 text-center">
          <img src="@/assets/logo.svg" class="h-10 mx-auto mb-3" alt="">
        </div>
        <hr>
        <div class="p-3 text-lg">
          <router-link to="/game">
            <div class="flex items-center gap-1">
              <div class="material-symbols-outlined text-2xl">arrow_back</div>
              <div>{{ t('back') }}</div>
            </div>
          </router-link>
        </div>
        <hr>
        <div class="p-3 text-xl text-center">{{ t('coupon') }}</div>
        <div class="flex flex-col gap-3" v-if="coupons.length > 0">
          <div :class="['coupon', item.coupon_context.type, validation(item)]" v-for="(item, index) in coupons" :key="index" @click="open(item)">
            <div v-if="item.coupon_context.type == 'meal'" class="coupon-icon material-symbols-outlined">restaurant</div>
            <div v-if="item.coupon_context.type == 'lucky_draw'" class="coupon-icon material-symbols-outlined">redeem</div>
            <div class="flex-grow">
              <div class="text-xl">{{ t(item.coupon_context.type) }}</div>
            </div>
            <div v-if="!item.valid">{{ t('used') }}</div>
            <div v-else-if="new Date(item.expired_at).getTime() / 1000 < new Date().getTime() / 1000">{{ t('expired') }}</div>
          </div>
        </div>
      </div>
      <div class="flex-grow"></div>
    </div>
  </div>
  <SmallModal v-show="displayModal > 0" @closeModal="() => { displayModal = 0, refreshData();}">
    <template v-slot:title>
      <div class="text-lg">
        <div class="text-center" v-if="displayModal === 1">{{ t('please-show-your-coupon') }}</div>
      </div>
    </template>
    <template v-slot:content>
      <div class="overflow-auto h-full">
        <div v-if="displayModal == 1">
          <CouponContent :couponData="payload"></CouponContent>
          <div class="text-center text-2xl text-blue-600" v-if="payload.type == 'meal'">餐券</div>
          <div class="text-center text-2xl" v-if="payload.type == 'lucky_draw'">抽獎券</div>
        </div>
      </div>
    </template>
  </SmallModal>
</template>

<style scoped lang="scss">
.coupon {
  @apply flex gap-3 justify-between items-end p-5 shadow text-white rounded font-semibold;
}
.coupon.meal {
  @apply bg-blue-600;
}
.coupon.lucky_draw {
  @apply bg-black;
}
.coupon.valid {
  @apply bg-opacity-100;
}
.coupon.invalid {
  @apply bg-opacity-50;
}
.coupon-icon {
  @apply text-2xl;
}
</style>

<i18n lang="yaml" src="@/assets/locales.yaml"></i18n>
<i18n lang="yaml">
  en-US:
    coupon: 'Coupons'
    meal: 'Meal Coupon'
    lucky_draw: 'Lucky Draw Coupon'
    expired: 'Expired'
    used: 'Used'
    unused: 'Unused'
    please-show-your-coupon: 'Please show your QR Code to the staff'
  zh-TW:
    coupon: '兌換券'
    meal: '餐券'
    lucky_draw: '抽獎券'
    expired: '已過期'
    used: '已使用'
    unused: '未使用'
    please-show-your-coupon: '請出示QR Code給工作人員'
</i18n>
