<script setup lang="ts">
import { ref } from 'vue';
import { useAdminStore } from '@/stores/admin';
import VueRequest from '@/vue-request';
import { useRouter } from 'vue-router';
import { QrcodeStream } from 'vue-qrcode-reader';

const admin = useAdminStore();
const vr = new VueRequest(admin?.token === undefined ? undefined : admin.token);
const isPaused = ref(false);
const clubCode = ref(admin.userInfo.club_code);
const schoolId = ref('');
const clubs: any = ref([]);

function getData() {
  vr.Get('clubs', clubs);
}
getData();

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
  if (clubCode.value === '') {
    alert('請先選擇所屬關卡');
    isPaused.value = false;
    return;
  }
  const r = confirm('確定進行驗證？');
  if (!r) {
    return;
  }
  const res = await vr.Post('auth/admin/decode', { club_code: clubCode.value, payload: code[0].rawValue}, null, true, true);
  if (res.message === 'OK') {
    alert('驗證成功');
  } else if (res.message === 'expired') {
    alert('QR Code 已過期');
  } else if (res.message === 'not_found') {
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

async function inputHandler() {
  if (clubCode.value === '') {
    alert('請先選擇所屬關卡');
    return;
  }
  if (schoolId.value === '') {
    alert('請輸入學號');
    return;
  }
  const r = confirm('確定驗證學號：' + schoolId.value + '？');
  if (!r) {
    return;
  }
  const res = await vr.Post('auth/admin/input', { club_code: clubCode.value, school_id: schoolId.value}, null, true, true);
  if (res.message === 'OK') {
    alert('驗證成功');
  } else if (res.message === 'not_found') {
    alert('找不到資料');
  } else {
    alert('驗證失敗');
  }
  schoolId.value = '';
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
    <div class="text-2xl">1. 選擇所屬關卡</div>
    <div>
      <label class="round-input-label">
        <select class="select" v-model="clubCode" :disabled="admin.userInfo.role < 1">
          <option value="">請選擇</option>
          <option :value="item.club_code" v-for="(item, index) in clubs" :key="index">{{ item.club_code }} {{ item.club_name_ch }}</option>
        </select>
      </label>
    </div>
    <div class="text-2xl">2. 掃描QR Code</div>
    <div>
      <QrcodeStream @init="initialize" @detect="codeHandler" :paused="isPaused" :track="paintOutline">
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
    <button class="round-full-button black" @click="inputHandler">驗證</button>
  </div>
</template>

<style scoped lang="scss"></style>
