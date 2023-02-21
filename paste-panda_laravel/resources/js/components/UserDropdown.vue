<template>
	<div class="dropdownwrapperservice" v-click-outside="hide" style="position: relative;">
		<div data-w-id="01d9bb9c-b5bc-d925-5acf-c209f08d3fd0" class="dropdowntriggerwrapperservice" @click="isActive = !isActive">
			<div style="background-color:rgb(30,30,30)" class="dropdowntriggerservice">
				<div style="color:rgb(255,255,255)" class="dropdowntext">TG</div>
			</div>
		</div>
		<div style="opacity:1;-webkit-transform:translate3d(-5PX, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(-5PX, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(-5PX, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(-5PX, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);display:block; top:-70px;"
		     class="dropdowncontentservice" v-if="isActive">
			<a data-w-id="01d9bb9c-b5bc-d925-5acf-c209f08d3fd5" href="#"
			   class="dropdownlinkblock w-inline-block"><img
					src="images/Pro-Symbol.svg" alt="" class="image-5">
				<div class="dropdownlinktext">Go Pro</div>
			</a>
			<a href="#" class="dropdownlinkblock w-inline-block">
				<div class="dropdownlinktext">Keyboard shortcuts</div>
			</a>
			<a data-w-id="01d9bb9c-b5bc-d925-5acf-c209f08d3fdc" href="#"
			   class="dropdownlinkblock w-inline-block">
				<div class="dropdownlinktext">Restart onboarding</div>
			</a>
			<a href="#" class="dropdownlinkblock w-inline-block">
				<div class="dropdownlinktext">Log out</div>
			</a>
			<div class="tooltiparrow tooltiparrowregmenu"></div>
		</div>
	</div>
</template>

<script>
    import ClickOutside from 'vue-click-outside'

    export default {
        directives: {
            ClickOutside
        },
        data() {
            return {
                isActive: false
            }
        },
        methods: {
            hide() {
                this.isActive = false;
            },
        },
    }
</script>

<style scoped>

</style>
