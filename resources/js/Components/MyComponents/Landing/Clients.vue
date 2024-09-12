<template>
    <img v-for="client in clients" :key="client" :src="client" :alt="client">
</template>

<script>
import LogoPadColor from '@/../../public/assets/images/LogoPadColor.png';
import LogoADTI from '@/../../public/assets/images/LogoADTI.png';
import LogoEmblems from '@/../../public/assets/images/LogoEmblems.png';
import LogoConstrumax from '@/../../public/assets/images/LogoConstrumax.png';
import LogoNala from '@/../../public/assets/images/LogoNala.png';
import LogoPuroChurro from '@/../../public/assets/images/LogoPuroChurro.png';
import LogoZafiro from '@/../../public/assets/images/LogoZafiro.png';
import LogoSemillas from '@/../../public/assets/images/LogoSemillas.png';
import LogoSuitesMazatlan from '@/../../public/assets/images/LogoSuitesMazatlan.png';

export default {
data() {
    return {
        clients: [
            LogoPadColor,
            LogoADTI,
            LogoEmblems,
            LogoConstrumax,
            LogoNala,
            LogoPuroChurro,
            LogoZafiro,
            LogoSemillas,
            LogoSuitesMazatlan,
        ]
    }
}
}
</script>