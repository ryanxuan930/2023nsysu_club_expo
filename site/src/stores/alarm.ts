import { defineStore } from 'pinia';
import { ref } from 'vue';

export const useAlarmStore = defineStore('alarm', () => {
  const showAlert = ref(false);
  const alertTitle = ref('');
  const alertMessage = ref('');
  function setAlert(title: string, message: string) {
    alertTitle.value = title;
    alertMessage.value = message;
    showAlert.value = true;
  }
  function playSound(volumn: number) {
    const audioSrc = new URL('@/assets/bell.mp3', import.meta.url);
    const audio = new Audio(String(audioSrc));
    audio.volume = volumn;
    audio.play();
  }
  return { showAlert, alertTitle, alertMessage, setAlert, playSound };
});
