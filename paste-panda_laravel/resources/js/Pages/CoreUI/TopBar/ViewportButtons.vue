<template>
    <div style="display: flex;">
        <SquaredButton
            @click="setViewportMode('mobile')"
            file="/icons/mobile.svg"
            class="mr-12"
            icon="mobile"
            :active="getViewportMode === 'mobile'"
        ></SquaredButton>
        <SquaredButton
            @click="setViewportMode('tablet')"
            file="/icons/tablet.svg"
            class="mr-12"
            icon="tablet"
            :active="getViewportMode === 'tablet'"
        ></SquaredButton>
        <SquaredButton
            @click="setViewportMode('desktop')"
            file="/icons/desktopo.svg"
            icon="desktopo"
            :active="getViewportMode === 'desktop'"
        ></SquaredButton>
    </div>
</template>

<script>
import SquaredButton from "../../../CoreUI/Components/SquaredButton";
import {mapGetters, mapMutations} from "vuex";
export default {
    name: "ViewportButtons",
    components: {SquaredButton},
    methods: {
        ...mapMutations(["setGridType", "setViewportMode"]),
    },
    computed: {
        ...mapGetters(['getViewportMode'])
    },
}
</script>
