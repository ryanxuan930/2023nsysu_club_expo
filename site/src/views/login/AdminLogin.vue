<script setup lang="ts"></script>

<template>
  <div class="flex bg-white">
    <div class="hidden sm:block flex-grow"></div>
    <div class="h-screen flex flex-col w-full sm:w-96 p-5 sm:p-0">
      <div class="flex-grow"></div>
      <div class="border rounded p-5">
        <div class="text-2xl font-semibold">集點平台管理系統</div>
        <hr class="my-5" />
        <label>
          <div>帳號</div>
          <input type="text" />
        </label>
        <label>
          <div>密碼</div>
          <input type="password" />
        </label>
        <button class="round-full-button blue">登入</button>
      </div>
      <div class="flex-grow"></div>
    </div>
    <div class="hidden sm:block flex-grow"></div>
  </div>
</template>

<style scoped lang="scss">
label {
  @apply text-lg flex gap-2 items-center my-3;
  div {
    @apply whitespace-nowrap;
  }
  input {
    @apply py-0.5 px-4 border rounded-full w-full;
  }
}
</style>
