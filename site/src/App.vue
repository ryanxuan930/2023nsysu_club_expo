<script setup lang="ts">
import { useAlarmStore } from '@/stores/alarm';

const alarmStore = useAlarmStore();
</script>

<template>
  <div class="relative">
    <div class="background duration-200" v-show="alarmStore.showAlert">
      <div class="content">
        <div class="py-2">
          <div class="text-xl">{{ alarmStore.alertTitle }}</div>
          <div>{{ alarmStore.alertMessage }}</div>
        </div>
        <button class="round-full-button red" @click="alarmStore.showAlert = false">OK</button>
      </div>
    </div>
    <router-view></router-view>
  </div>
</template>

<style lang="scss" scoped>
.background {
  @apply fixed h-screen w-screen bg-black bg-opacity-40 p-5;
  z-index: 100 !important;
  .content {
    @apply bg-white rounded p-5 mx-auto my-16 w-full sm:w-96;
  }
}
</style>
