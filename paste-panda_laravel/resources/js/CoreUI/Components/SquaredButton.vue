<template>
	<!--	<a @click="setViewportMode('mobile')" href="#" class="square-icon-btn mr-12 w-inline-block">-->
	<div @click="$emit('click')" class="square-icon-btn" :class="{'square-icon-btn--active' : active}"
	     style="cursor: pointer;">
		<SvgIcon :icon="icon" :fill="active ?  '#ffffff' : '#808080'" :size="16" style="font-size: 16px;"></SvgIcon>
	</div>
	<!--		<img :src="file" width="14" alt="" class="icon-mobile"></div>-->
</template>

<script>
    import SvgIcon from "./SvgIcon";

    export default {
        name: "SquaredButton",
        components: {SvgIcon},
        props: {
            file: String,
            active: Boolean,
	        icon: String
        },
    }
</script>

<style scoped>

</style>
