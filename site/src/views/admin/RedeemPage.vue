<script setup lang="ts">
import { ref } from 'vue';
import { useAdminStore } from '@/stores/admin';
import VueRequest from '@/vue-request';
import { QrcodeStream } from 'vue-qrcode-reader';

const admin = useAdminStore();
const vr = new VueRequest(admin?.token === undefined ? undefined : admin.token);
const isPaused = ref(false);


async function initialize(promise: any) {
  try {
    const { capabilities } = await promise;
  } catch (error: any) {
    if (error.name === 'NotAllowedError') {
      alert('請允許使用鏡頭');
    } else if (error.name === 'NotFoundError') {
      alert('找不到鏡頭');
    } else if (error.name === 'NotSupportedError') {
      alert('不支援本功能');
    } else if (error.name === 'NotReadableError') {
      alert('無法讀取');
    } else if (error.name === 'OverconstrainedError') {
      alert('無法滿足需求');
    } else if (error.name === 'StreamApiNotSupportedError') {
      alert('不支援本功能');
    } else if (error.name === 'TrackStartError') {
      alert('無法啟動鏡頭');
    } else {
      alert('無法啟動鏡頭');
    }
  } finally {
    // hide loading indicator
  }
}
async function codeHandler(code: any) {
  isPaused.value = true;
  const r = confirm('確定進行驗證？');
  if (!r) {
    return;
  }
  const res = await vr.Post('auth/admin/redeem', { payload: code[0].rawValue }, null, true, true);
  if (res.message === 'OK') {
    alert('驗證成功');
  } else if (res.message === 'redeemed') {
    alert('已兌換過');
  } else if (res.message === 'coupon_not_found') {
    alert('找不到資料');
  } else if (res.message === 'error') {
    alert('QR Code 錯誤');
  } else {
    alert('驗證失敗');
  }
  setTimeout(() => {
    isPaused.value = false;
  }, 1000);
}

function paintOutline(detectedCodes: any, ctx: any) {
  for (const detectedCode of detectedCodes) {
    const [firstPoint, ...otherPoints] = detectedCode.cornerPoints;

    ctx.strokeStyle = 'red';

    ctx.beginPath();
    ctx.moveTo(firstPoint.x, firstPoint.y);
    for (const { x, y } of otherPoints) {
      ctx.lineTo(x, y);
    }
    ctx.lineTo(firstPoint.x, firstPoint.y);
    ctx.closePath();
    ctx.stroke();
  }
};
</script>

<template>
  <div class="w-full sm:m-auto sm:w-96 p-5 flex flex-col gap-5">
    <router-link to="/admin">回上頁</router-link>
    <hr>
    <div class="text-2xl">掃描QR Code</div>
    <div>
      <QrcodeStream @init="initialize" @detect="codeHandler" :paused="isPaused" :track="paintOutline">
        <div class="h-full w-full flex flex-col bg-white bg-opacity-80" v-if="isPaused">
          <div class="flex-grow"></div>
          <div class="text-center text-2xl">讀取中...</div>
          <div class="flex-grow"></div>
        </div>
      </QrcodeStream>
    </div>
  </div>
</template>

<style scoped lang="scss"></style>
