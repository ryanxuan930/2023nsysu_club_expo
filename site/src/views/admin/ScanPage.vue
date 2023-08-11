<script setup lang="ts">
import { ref } from 'vue';
import { useAdminStore } from '@/stores/admin';
import VueRequest from '@/vue-request';
import { useRouter } from 'vue-router';
import { QrcodeStream, QrcodeDropZone, QrcodeCapture } from 'qrcode-reader-vue3';

const admin = useAdminStore();
const router = useRouter();
const vr = new VueRequest(admin?.token === undefined ? undefined : admin.token);
const isLoaded = ref(false);
const isPaused = ref(false);
const clubCode = ref('');
const schoolId = ref('');

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
async function codeHandler(code: string) {
  isPaused.value = true;
  await setTimeout(() => {
    alert(code);
    isPaused.value = false;
    console.log(isPaused.value);
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
    <div class="text-2xl">1. 選擇所屬關卡</div>
    <div>
      <label class="round-input-label">
        <select class="select" v-model="clubCode">
          <option value="">請選擇</option>
        </select>
      </label>
    </div>
    <div class="text-2xl">2. 掃描QR Code</div>
    <div>
      <QrcodeStream @init="initialize" @decode="codeHandler" :paused="isPaused" :track="paintOutline">
        <div class="h-full w-full flex flex-col bg-white bg-opacity-80" v-if="isPaused">
          <div class="flex-grow"></div>
          <div class="text-center text-2xl">讀取中...</div>
          <div class="flex-grow"></div>
        </div>
      </QrcodeStream>
    </div>
    <div class="text-2xl">或輸入學號進行驗證</div>
    <div>
      <label class="round-input-label">
        <input class="input" type="text" v-model="schoolId" />
      </label>
    </div>
    <button class="round-full-button black">查詢</button>
  </div>
</template>

<style scoped lang="scss"></style>
