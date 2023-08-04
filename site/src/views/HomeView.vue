<script setup lang="ts">
import { ref } from 'vue';
import NavBar from '@/components/NavBar.vue';
import FooterBar from '@/components/FooterBar.vue';
</script>

<template>
  <div class="flex flex-col h-screen overflow-hidden">
    <div>
      <NavBar></NavBar>
    </div>
    <div class="flex-grow flex flex-col overflow-auto">
      <div class="flex-grow">
        <router-view></router-view>
      </div>
      <div>
        <FooterBar></FooterBar>
      </div>
    </div>
  </div>
</template>

<style scoped lang="scss"></style>
