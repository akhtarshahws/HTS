<template>
    <div class="outerMostDiv-counter">
        <div class="outerDiv-counter">
            <p class="starterTxt">Click on start button to <span class="starterTxt-span">Start Test</span></p>
            <div class="cover-btn-counter">
                <button :style="{ background: countingDown ? 'rgba(75, 154, 250, 0.1)' : '' }" class="count-btn"
                    @click="startCountdown" :disabled="countingDown">
                    <span :style="{ fontSize: countingDown ? '80px' : '40px' }">{{ buttonText }}</span>
                    <WaveEffect v-if="countingDown" />
                </button>
            </div>

        </div>
        <!-- <div class="marquee-container">
            <div class="marquee-text ">
                <span class="hintSpan">Hint:</span> {{ currentMessage }}
            </div>
        </div> -->
    </div>
</template>
  
<script>
import WaveEffect from './helperComponents/WaveEffect.vue';
export default {
    components: {
        WaveEffect,
    },
    data() {
        return {
            countingDown: false,
            candidate_id:'',
            countdownValue: 5,
            // messages: [
            //     "Lorem, ipsum dolor sit amet consectetur adipisicing elit.",
            //     "Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.",
            //     "Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.",
            // ],
            // currentMessageIndex: 0,
        };
    },
   
    computed: {
        buttonText() {
            return this.countingDown ? `${this.countdownValue}` : 'Start';
        },
        currentMessage() {
            return this.messages[this.currentMessageIndex];
        },
        // questions() {
        // return this.$store.state.Questions;
        // },
        // candidateId() {
        // return this.$store.state.candidateId;
        // },
    },
    mounted() {

           this.candidate_id=this.$route.params.id;
        // console.log('Questions in TestScreen:', this.questions);
        // console.log('Candidate ID in TestScreen:', this.candidateId);
        
    
        },
    methods: {
        startCountdown() {
            if (!this.countingDown) {
                this.countingDown = true;

                const interval = setInterval(() => {
                    if (this.countdownValue > 0) {
                        this.countdownValue--;
                    } else {
                        clearInterval(interval);
                        this.countingDown = false;
                        this.countdownValue = 10;
                        // this.currentMessageIndex = (this.currentMessageIndex + 1) % this.messages.length;
                        this.$router.push('/test/'+this.candidate_id);
                    }
                }, 1000);
            }
        },
    },
};
</script>
  
<style scoped>
.outerDiv-counter {
    /* background-color: #00102C; */
    height: 100%;
    max-width: 500px;
    max-height: 500px;
    display: flex;
    flex-direction: column;
    justify-content: space-evenly;
    align-items: center;
    /* background-color: red; */
}

.outerMostDiv-counter {
    height: 100%;
    background-color: #00102C;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
}

.starterTxt {
    color: #F5F5F5;
    font-family: Open Sans;
    font-size: 24px;
    font-style: normal;
    font-weight: 400;
    line-height: normal;
}

.starterTxt-span {
    color: #4B9AFA;
    font-weight: 700;
}

.count-btn {
    width: 276px;
    height: 276px;
    border-radius: 276px;
    background: #4B9AFA;
    color: #FFF;
    font-family: Open Sans;
    font-size: 40px;
    font-style: normal;
    font-weight: 700;
    line-height: normal;
    text-transform: uppercase;
    z-index: 100;
    position: relative;
}

/* .hintSpan {
    font-weight: 700;
}

.marquee-container {
    width: 90%;
    overflow: hidden;
}

.marquee-text {
    white-space: nowrap;
    animation: marqueeAnimation 10s linear infinite;
    color: #F5F5F5;
    font-family: Open Sans;
    font-size: 24px;
    font-style: normal;
    font-weight: 400;
    line-height: normal;
} */

@keyframes marqueeAnimation {
    0% {
        transform: translateX(100%);
    }

    100% {
        transform: translateX(-100%);
    }
}

.cover-btn-counter {
    /* width: 320px;
    height: 320px;
    border-radius: 320px;
    opacity: 0.1;
    background: #4B9AFA; */
}
</style>
  