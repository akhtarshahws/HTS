<template>
    <div class="outerMost-testingHead-holder">
        <div class="outer-testingHead-holder">
            <div v-motion :initial="{ opacity: 0 }"
                :enter="{ opacity: 1, transition: { duration: 300, delay: 200, ease: 'easeIn' } }">
                <img :src="topImageUrl" class="top" alt="TGI Logo" />
            </div>
            <div class="mainTxt" style="max-width: 800px;">
                <img class="tgiLogo" :src="tgiUrl" />
                <p>
                    Welcome to <span class="mainTxt-span" ref="typedText"></span>
                </p>
            </div>
            <div v-motion :initial="{ opacity: 0 }"
                :enter="{ opacity: 1, transition: { duration: 300, delay: 200, ease: 'easeIn' } }">
                <img :src="bottomImageUrl" class="bottom" alt="TGI Logo" />
            </div>
        </div>
    </div>
</template>
  
<script>
import topImage from '../assets/imgs/topp.png';
import bottomImage from '../assets/imgs/bottomm.png';
import tgi from '../assets/imgs/tgi.svg';

export default {
    data() {
        return {
            topImageUrl: topImage,
            bottomImageUrl: bottomImage,
            tgiUrl: tgi,
        };
    },
    mounted() {
        this.typeText("TGI Testing  System");
    },
    methods: {
        async typeText(text) {
            const typedTextElement = this.$refs.typedText;
            for (let i = 0; i < text.length; i++) {
                if (text[i] === ' ') {
                    typedTextElement.innerHTML += '&nbsp;';
                } else {
                    typedTextElement.innerText += text[i];
                }
                await this.sleep(100); // Adjust typing speed as needed
            }
        },
        sleep(ms) {
            return new Promise(resolve => setTimeout(resolve, ms));
        },
    },

};
</script>
  
<style scoped>
.outerMost-testingHead-holder {
    height: 100%;
    background: #00102C;
    overflow: hidden;
}

.outer-testingHead-holder {
    height: 100%;
    position: relative;
}

.bottom {
    position: absolute;
    bottom: 0;
    right: 0;
    width: 70vw;
    max-width: 40vw;
    max-height: 80vh;
}

.top {
    position: absolute;
    top: 0;
    left: 0;
    width: 70vw;
    max-width: 40vw;
    max-height: 80vh;
    z-index: 33;
}

.mainTxt {
    color: #F5F5F5;
    text-align: center;
    font-family: Open Sans;
    font-size: 45px;
    font-style: normal;
    font-weight: 400;
    line-height: normal;
    margin: auto;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100%;
    display: flex;
    flex-direction: column;
    z-index: 10;
    position: relative;
}

.tgiLogo {
    margin-bottom: 20px;
    width: 125px;
    height: 127px;
}

.mainTxt-span {
    color: #4B9AFA;
    font-family: Open Sans;
    font-size: 45px;
    font-style: normal;
    font-weight: 700;
    line-height: normal;
    margin-left: 10px;
}

@media (max-width:1024px) {
    .mainTxt {
        font-size: 40px;
    }

    .mainTxt-span {
        font-size: 40px;
    }
}

@media (max-width:704px) {
    .mainTxt {
        font-size: 30px;
    }

    .mainTxt-span {
        font-size: 30px;
    }
}
</style>
  
<!-- Add "scoped" attribute to limit CSS to this component only -->
<style lang="scss" scoped>
.container {
    width: 100%;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}

h1 {
    font-size: 6rem;
    font-weight: normal;

    span.typed-text {
        color: #d2b94b;
    }
}
</style>