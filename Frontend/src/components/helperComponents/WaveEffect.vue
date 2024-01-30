<template>
    <div class="waves-block">
        <div class="waves wave-1"></div>
        <div class="waves wave-2"></div>
        <div class="waves wave-3"></div>
    </div>
</template>
  
<style scoped>
@keyframes waves {
    0% {
        transform: scale(0.2, 0.2);
        opacity: 0;
    }

    50% {
        opacity: 0.9;
    }

    100% {
        transform: scale(0.9, 0.9);
        opacity: 0;
    }
}

.waves {
    position: absolute;
    width: 356px;
    height: 356px;
    background: #4B9AFA;
    opacity: 0;
    border-radius: 100%;
    top: -40px;
    left: -40px;
    z-index: -1;
    animation: waves 3s ease-in-out infinite;
}

.wave-1 {
    animation-delay: 0s;
}

.wave-2 {
    animation-delay: 1s;
}

.wave-3 {
    animation-delay: 2s;
}
</style>
  