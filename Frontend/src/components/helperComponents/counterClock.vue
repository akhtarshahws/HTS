<template>
  <div class="countdown-timer">
    <p class="timer-text">{{ formatTime(hours) }}:{{ formatTime(minutes) }}:{{ formatTime(seconds) }}</p>
  </div>
</template>

<script>
export default {
  data() {
    return {
      totalTimeInSeconds: 20 * 60, // 20 minutes in seconds
      hours: 0,
      minutes: 0,
      seconds: 0,
      timerInterval: null,
    };
  },
  methods: {
    startCountdown() {
      this.updateTime(); // Update time immediately before starting the interval
      this.timerInterval = setInterval(() => {
        if (this.totalTimeInSeconds > 0) {
          this.totalTimeInSeconds--;
          this.updateTime();
        } else {
          clearInterval(this.timerInterval);
        }
      }, 1000);
    },
    updateTime() {
      this.hours = Math.floor(this.totalTimeInSeconds / 3600);
      this.minutes = Math.floor((this.totalTimeInSeconds % 3600) / 60);
      this.seconds = this.totalTimeInSeconds % 60;
    },
    formatTime(time) {
      return time < 10 ? `0${time}` : time;
    },
  },
  created() {
    this.startCountdown();
  },
  beforeUnmount() {
    clearInterval(this.timerInterval);
  },
};
</script>

<style scoped>
.countdown-timer {
  text-align: center;
  font-size: 24px;
  color: #333;
}

.timer-text {
  color: #4B9AFA;
  font-family: Open Sans;
  font-size: 24px;
  font-style: normal;
  font-weight: 600;
  line-height: normal;
}
</style>
