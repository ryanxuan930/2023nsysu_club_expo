import { ref } from 'vue';
import type { Ref } from 'vue';
import { defineStore } from 'pinia';

export const useUserStore: any = defineStore('user', () => {
  const expire: Ref<string> = ref('');
  const token: Ref<string> = ref('');
  const userInfo: Ref<any> = ref({});
  function reset() {
    expire.value = '';
    token.value = '';
    userInfo.value = {};
  }
  return { expire, token, userInfo, reset };
});
