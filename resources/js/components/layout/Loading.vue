<template>
    <div id="loading">
        <pixel-spinner class="centerdiv"
        :animation-duration="2000"
        :size="65"
        color="#000000"
        />
    </div>
</template>
<script>

import { PixelSpinner } from 'epic-spinners'

export default {
    name: "loading",
    components: {
        PixelSpinner
    }
}
</script>

<style scoped>
    #loading {
        position: fixed;
        left: 0px;
        top: 0px;
        width: 100%;
        height: 100%;
        z-index: 9999;
        opacity: 0.5;
        background: #FFFFFF;
    }

    .centerdiv {
        position: relative;
        top: calc(50% - 60px);
        left: calc(50% - 60px);
        box-sizing: border-box;
    }
</style>
