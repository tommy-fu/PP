<template>
	<div v-html="require(`!html-loader!../assets/svg/${icon}.svg`)" class="svg-container" :style="getStyle"></div>
	<!--	<div v-html="require(`!html-loader!${icon}.svg`)" class="svg-container"></div>-->
	<!--	<div v-html="require(`html-loader!${icon}.svg`)" class="svg-container"></div>-->
</template>

<script>
    function recursivelyRemoveFill(el) {
        if (!el) {
            return;
        }
        el.removeAttribute('fill');
        [].forEach.call(el.children, child => {
            recursivelyRemoveFill(child);
        });
    }

    export default {
        name: 'svg-icon',
        props: {
            icon: {
                type: String,
                default: null
            },
            hasFill: {
                type: Boolean,
                default: false
            },
            fill: {
                type: String,
                // required: true
            },
            stroke: {
                type: String,
                // required: true
            },
            growByHeight: {
                type: Boolean,
                default: false
            },
            size: {
                'type': Number,
                'required': false,
                // 'default': 24,
            },
        },
        watch: {
            fill(newValue) {
                // const svgElement = this.$el.firstElementChild;
                // svgElement.firstElementChild.setAttribute('fill', newValue);
            }
        },
        computed: {
            getStyle() {
                if (this.fill) {
                    return 'fill: ' + this.fill;
                }

                // if(this.stroke){
                //     return 'stroke: ' + this.fill;
                // }


            }
        },
        mounted() {
            if (this.$el.firstElementChild.nodeName === 'svg') {
                const svgElement = this.$el.firstElementChild;
                // use `viewBox` attribute to get the svg's inherent width and height
                const viewBox = svgElement.getAttribute('viewBox').split(' ').map(n => Number(n));
                const widthToHeight = (viewBox[2] / viewBox[3]).toFixed(2);


                // if (this.hasFill) {
                // recursively remove all fill attribute of element and its nested children
                if (this.fill) {
                    recursivelyRemoveFill(svgElement);
                }


                // set width and height relative to font size
                // if growByHeight is true, height set to 1em else width set to 1em and remaining is calculated based on widthToHeight ratio
                // if (this.growByHeight) {
                svgElement.setAttribute('height', '1em');
                svgElement.setAttribute('width', `${widthToHeight}em`);
                // } else {
                //     svgElement.setAttribute('width', '1em');
                //     svgElement.setAttribute('height', `${1 / widthToHeight}em`);
                // }
            }
        }
    }
</script>


<style lang="scss" scoped>
	.svg-container {
		display: inline-flex;
		transition: fill .4s ease;
		/*fill: blue;*/
	}
	
	/*.svg {*/
	/*	fill: red !important;*/
	/*}*/
	
	/*.svg > path {*/
	/*	fill: red;*/
	/*}*/
</style>
