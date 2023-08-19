<script setup lang="ts">
import { ref } from 'vue';
import { useAdminStore } from '@/stores/admin';
import VueRequest from '@/vue-request';

const admin = useAdminStore();
const vr = new VueRequest(admin?.token === undefined ? undefined : admin.token);
const broadcasts: any = ref([]);
const title = ref('');
const content = ref('');
function getData() {
  vr.Get('broadcasts', broadcasts, true, true);
}
getData();

async function submitAll() {
  const res = await vr.Post('broadcasts', { title: title.value, content: content.value }, null, true, true);
  if (res.message === 'OK') {
    getData();
    title.value = '';
    content.value = '';
  } else {
    alert('發送失敗');
  }
}
</script>

<template>
  <div class="p-10 flex flex-col gap-2 h-screen overflow-hidden">
    <router-link to="/admin">回上頁</router-link>
    <hr>
    <div class="text-2xl">警訊通知</div>
    <div class="p-2 flex items-center gap-5 border-2 text-lg">
      <label class="flex items-center gap-2">
        <div>標題</div>
        <input class="border-2 rounded p-1" type="text" v-model="title">
      </label>
      <label class="flex items-center gap-2 flex-grow">
        <div>內容</div>
        <input class="border-2 rounded p-1 flex-grow" type="text" v-model="content">
      </label>
      <button class="general-button black" @click="submitAll">送出</button>
    </div>
    <div class="flex-grow overflow-auto">
      <table>
        <tr>
          <th class="w-1/6">時間</th>
          <th class="w-2/6">標題</th>
          <th class="w-3/6">內文</th>
        </tr>
        <tr v-for="(item, index) in broadcasts" :key="index">
          <td>{{ item.created_at }}</td>
          <td>{{ item.title }}</td>
          <td>{{ item.content }}</td>
        </tr>
      </table>
    </div>
  </div>
</template>

<style scoped lang="scss">
table {
  @apply border-collapse w-full h-full;
  th, td {
    @apply px-2 py-1 border border-gray-300 text-left;
  }
}
</style>
