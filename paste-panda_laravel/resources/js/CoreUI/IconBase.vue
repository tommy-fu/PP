<template>
	<svg xmlns="http://www.w3.org/2000/svg"
	     :viewBox="viewBox"
	     style="overflow: visible; display: block; margin: 0 auto; "
	     role="presentation"
	     :width="size"
	     :height="size"
	     @click="$emit('click')">
<!--		<keep-alive>-->
			<component
					ref="component"
					:is="icon"
					:size=size
					:fill="fill"
			></component>
<!--		</keep-alive>-->

<!--		<g :fill="'dodgerblue'">-->
<!--			<slot/>-->
<!--		</g>-->
	</svg>
</template>
<script>
    // import IconCode from "./IconCode";

    export default {
        data() {
            return {
                viewBoxWidth: 24,
                viewBoxHeight: 24,
            }
        },
        props: {
            width: {
                type: [Number, String],
                default: 16
            },
            height: {
                type: [Number, String],
                default: 16
            },
            size: {
                'type': Number,
                'required': false,
                'default': 24,
            },
            fill: {
                type: String,
                required: true
            },
            icon: {
                type: String,
                required: true
            }
        },
        computed: {
            // icon(){
            //     return 'IconCode';
            //   // return IconCode;
            // },
            // fill() {
            //     return this.active ? this.activeColor : this.iconColor;
            // },
	        viewBox(){
                // return '0 0 ' + this.width + ' ' + this.height;
                return '0 0 ' + this.viewBoxHeight + ' ' + this.viewBoxWidth;
                // return '0 0 29 24';
	        }
        },
	    mounted() {
            if(this.$refs.component){
                let data = this.$refs.component.$data;
                this.viewBoxWidth = data.width;
                this.viewBoxHeight = data.height;
            }
        }
    }
</script>
<style scoped lang="scss">
	//  .logo-fill:hover {
	//     path {
	//        fill: red;
	//     }
	//  }
</style>
