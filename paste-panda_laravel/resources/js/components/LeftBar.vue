<template>
	<div class="leftbar">
		<div class="leftbar-top">
			<CodePicker></CodePicker>
		</div>
		<div class="leftbar-bot" style="position: relative;">
			<button class="btn-outlined-square" @click="menuActive = !menuActive">
				<icon-base
						class="icon-profile"
						:active="false"
						icon-color="#A3A3A3"
						active-color="#fff">
					<icon-profile/>
				</icon-base>
			</button>
			
			<div class="menu" :class="{'menu-active': menuActive, 'menu-inactive' : !menuActive}"
			     style="position: absolute; top: -20px; left: 50px;">
				<!-- <div class="menu-item">
					<div class="body-sm color-a3a3a3 menu-item-text">Reset onboarding</div>
				</div>
				<div class="menu-divider bg-temp-color-divider-dark"></div> -->
				<div class="menu-item">
					<a href="/logout" class="body-sm color-a3a3a3 menu-item-text noselect" style="text-decoration: none;">Log out</a>
				</div>
			</div>
		</div>
	</div>
</template>


<script>
    import CodePicker from '../components/CodePicker.vue';

    export default {
        name: 'left-bar',
        components: {
            CodePicker,
        },
        data() {
            return {
                active: false,
                alertActive: false,
                alertActive2: false,
                menuActive: false,
                tooltipActive: false,
            }
        }
    }
</script>


<style lang="scss">
	
	.leftbar {
		display: flex;
		flex-direction: column;
		align-items: center;
		justify-content: space-between;
		/*padding: 20px 0px;*/
		height: 100%;
		width: 88px;
		background: #1C1C1C;
		border-right: 1px solid #2D2D2D;
		
		.btn-outlined-square {
			display: flex;
			justify-content: center;
			align-items: center;
			height: 32px;
			width: 32px;
			background: #1C1C1C;
			border-radius: 8px;
			border: 1px solid #383838;
			cursor: pointer;
		}
		
		.btn-outlined-square:focus {
			outline: none;
			box-shadow: none;
		}
		
		.btn-outlined-square:hover {
			background: #404040;
			border: 1px solid transparent;
		}
		
		.btn-outlined-square--active {
			background: #404040;
			border: 1px solid transparent;
			border-radius: 8px;
		}
		
		.leftbar-top {
			display: flex;
			flex-direction: column;
			align-items: center;
			margin-top: 20px;
			
			.code-display-container {
				margin-top: 12px;
				
				.code-display-item {
					height: 40px;
					/*width: 40px;*/
					margin: 12px 0px;
				}
			}
		}
		
		.leftbar-bot {
			margin-bottom: 20px;
		}
	}

</style>
