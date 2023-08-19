import { ref } from 'vue';
import { defineStore } from 'pinia';

export const useStatusStore = defineStore('status', () => {
  const locale = ref('zh-TW');

  return { locale };
});
