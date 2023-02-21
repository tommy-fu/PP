<template>
	<div v-click-outside="hide">
		<div @click.prevent="show = !show" style="cursor: pointer;">
			<slot name="button"></slot>
		</div>
		<div style="position: relative;">
			<div class="dropdown-container" style="position: absolute; left: 0; top: 20px; z-index: 10000;"  v-if="show">
				<slot></slot>
			</div>
		</div>
	</div>
</template>

<script>
    import vClickOutside from "v-click-outside";

    export default {
        name: "Dropdown",
        data() {
            return {
                show: false
            }
        },
        directives: {
            clickOutside: vClickOutside.directive
        },
        methods: {
            hide() {
                if (this.show) {
                    this.show = false;
                }
            },
        },
    }
</script>

<style scoped>
	.dropdown-container {
		/*position: absolute;*/
		/*left: 0;*/
		/*top: 0;*/
		/*left: 497px;*/
		/*top: 60px;*/
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		width: 232px;
		height: auto;
		padding: 8px;
		border-style: solid;
		border-width: 1px;
		border-color: #2d2d2d;
		border-radius: 8px;
		background-color: #262626;
		box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.25), 0 8px 16px 0 rgba(0, 0, 0, 0.25);
	}
</style>
