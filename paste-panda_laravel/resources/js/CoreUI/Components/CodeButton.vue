<template>
	<div class="square-icon-btn _48x48 mr-12"
	     style="position: relative; cursor: pointer; display: flex; align-items: center; justify-content: center;"
	     @click="$emit('click')" :class="{'square-icon-btn--active-blue': active, 'square-icon-btn--disabled' : disabled}"
	
	     @mouseover="tooltipActive = true" @mouseleave="tooltipActive = false"
	>
		<!--		<a href="#" class="code-btn" :class="{'code-btn&#45;&#45;active' : active, 'code-btn&#45;&#45;disabled' : disabled}"-->
		<!--		   @mouseover="tooltipActive = true" @mouseleave="tooltipActive = false">-->
		<!--			&lt;!&ndash;			<img :src="img" alt="">&ndash;&gt;-->
		<!--			<div :style="getIconColor()">-->
		<!--				<slot></slot>-->
		<!--			</div>-->
		<!--		</a>-->
		<SvgIcon :icon="icon" :fill="getFill" :size="22" style="font-size: 22px;"></SvgIcon>
		<!--		<v-icon  :size="26" :fill="fill" :icon="icon"></v-icon>-->
<!--									<div class="tempdividerblock" style="height: 88px; width: 100%; background: transparent;"></div>-->
		<div class="tooltip"
		     v-if="disabled"
		     style="position: absolute; right: -96px; top: 0;"
		     :class="{'tooltip-active': tooltipActive, 'tooltip-inactive' : !tooltipActive}">
			<div class="tooltip-container">
				<div class="tooltip-arrow"></div>
				<div class="body-xs color-a3a3a3 noselect">Coming soon</div>
			</div>
		</div>
	</div>
</template>

<script>
    import VIcon from "./VIcon";
    import SvgIcon from "./SvgIcon";

    export default {
        name: "CodeButton",
        components: {SvgIcon, VIcon},
        data() {
            return {
                tooltipActive: false,
                hovered: false
            }
        },
        methods: {
            getIconColor() {
                return '#FFF';

                if (this.active) {
                    return '#FFF;'
                }

                if (this.disabled) {
                    return '#A3A3A3;';
                }

                return '#FFF;';
            }
        },
        computed: {
            getFill() {
                if (this.hovered) {
                    return '#A3A3A3';
                }

                return this.active ? '#FFF' : '#A3A3A3';
            }
        },
        props: {
            icon: {
                type: String,
                required: true
            },
            img: String,
            active: {
                type: Boolean,
                default: false
            },
            disabled: Boolean,
        },
    }
</script>

<style lang="scss" scoped>
	
	.code-btn {
		display: flex;
		width: 40px;
		height: 40px;
		margin-left: 12px;
		justify-content: center;
		align-items: center;
		border: 1px solid #535353;
		border-radius: 8px;
		background-color: #404040;
		transition: background-color 50ms ease-in;
	}
	
	.code-btn:hover {
		border-color: #fff;
	}
	
	.code-btn.code-btn--active {
		border-color: #1592ff;
		background-color: #2c3d4c;
		cursor: default;
	}
	
	.code-btn.code-btn--disabled {
		border-color: #383838;
		background-color: #2d2d2d;
		cursor: default;
	}
	
	
	.tooltip {
		display: inline-block;
		padding: 4px 8px;
		border-radius: 4px;
		border: 1px solid #404040;
		background-color: #383838;
		// box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.25);
		transition: all 0.05s ease-in;
		opacity: 0;
	}
	
	.tooltip-active {
		transition: all 0.05s ease-in;
		opacity: 1;
		z-index: 10;
	}
	
	.tooltip-inactive {
		z-index: -1;
		display: none;
	}
	
	
	.tooltip-container {
		position: relative;
	}
</style>
