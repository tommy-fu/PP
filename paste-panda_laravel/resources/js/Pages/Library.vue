<template>
	<div class="px-32 py-32 is-relative"  style="background: #262626; min-height: 100vh;">
	
<!--		<notifications group="foo"-->
<!--		               position="top right">-->
<!--			<template slot="body" slot-scope="props">-->
<!--				<div class="card py-24 px-16" style="background: #000; border: none; border-radius: 8px;">-->
<!--					<div class="card-body">-->
<!--						<div class="is-flex is-align-items-center">-->
<!--							<img src="/icons/check.svg" alt="">-->
<!--							<p class="ml-12 mb-0" style="color: #FFF;">Markup copied to clipboard!</p>-->
<!--						</div>-->
<!--					</div>-->
<!--				</div>-->
<!--			-->
<!--			</template>-->
<!--		</notifications>-->
<!--		-->
		<div class="tempcontainer">
			<!--&lt;!&ndash;            <CodePicker></CodePicker>&ndash;&gt;-->
			<!--            <div class="tempdividerblock" style="height: 88px; width: 100%; background: transparent;"></div>-->
			<!--            <button @click="tooltipActive = !tooltipActive">Tooltip button</button>-->
			<!--            <div class="tooltip" :class="{'tooltip-active': tooltipActive, 'tooltip-inactive' : !tooltipActive}">-->
			<!--                <div class="tooltip-container">-->
			<!--                <div class="tooltip-arrow"></div>-->
			<!--                <div class="body-xs color-a3a3a3 noselect">Coming soon</div>-->
			<!--                </div>-->
			<!--            </div>-->
			<!--            <div class="tempdividerblock" style="height: 88px; width: 100%; background: transparent;"></div>-->
			<!--        -->
<!--			<div class="tempdividerblock" style="height: 88px; width: 100%; background: transparent;"></div>-->
<!--			<button @click="alertActive = true">Alert button</button>-->
<!--			<div class="alert" :class="{'alert-active': alertActive, 'alert-inactive' : !alertActive}" style="position: absolute; top: 0; right: 32px;">-->
			<div class="alert" :class="{'alert-active': alertActive, 'alert-inactive' : !alertActive}" style="position: absolute; top: 0; right: 32px;">
				<div class="alert-text-container">
					<div class="icon-check"></div>
					<div class="body-sm color-d1d1d1 noselect">Markup copied to clipboard!</div>
				</div>
				<div class="icon-exit">
					<icon-base
							class="icon-exit"
							:active="false"
							icon-color="#A3A3A3"
							active-color="#fff">
						<icon-exit/>
					</icon-base>
				</div>
			</div>
		</div>
		
		<div class="columns is-flex is-multiline">
<!--			<div v-masonry-tile class="item column is-12-tablet mt-16" v-for="section in sections">-->
			<div class="item column is-12-tablet mt-16" v-for="section in sections">
				<card-item :section="section"></card-item>
			</div>
		</div>
	</div>
</template>

<script>
    import {mapMutations} from "vuex";

    export default {
        name: "Library",
        data() {
            return {
                alertActive: false,
            }
        },
        props: {
            user: Object,
            sections: Array,
        },
        watch: {
            alertActive(newValue, oldValue) {
	            if(newValue == true){
	                this.hideAlert();
	            }
            }
        },
        // watch: {
        //     user: {
        //         handler: function (newValue) {
        //             this.setActiveBrandId(newValue.brandId);
        //             this.setUser(this.user);
        //             this.$refs.iframe.contentWindow.location.reload();
        //         },
        //         deep: true
        //     }
        // },
        methods: {
            ...mapMutations(['setUser']),
            hideAlert: _.debounce(function (){
                this.alertActive = false;
            }, 3000)
        },
        mounted() {
            this.setUser(this.user);
        }
    }
</script>

<style lang="scss">
	.alert {
		display: flex;
		justify-content: space-between;
		align-items: center;
		width: 344px;
		padding: 12px 16px;
		border: 1px solid #2d2d2d;
		border-radius: 6px;
		background-color: #1c1c1c;
		box-shadow: 0 4px 12px 0 rgba(0, 0, 0, 0.1);
	// Animation specific
	transition: all .15s ease-in-out;
		margin-top: 0px;
		opacity: 0;
		color: #d1d1d1;
	}
	
	.alert-active {
		display: flex;
		justify-content: space-between;
		align-items: center;
		width: 344px;
		padding: 12px 16px;
		border: 1px solid #2d2d2d;
		border-radius: 6px;
		background-color: #1c1c1c;
		box-shadow: 0 4px 12px 0 rgba(0, 0, 0, 0.1);
	// Animation specific
	// position: fixed;
		transition: all .15s ease-in-out;
		margin-top: 16px;
		opacity: 1;
	}
	
	.icon-check {
		width: 16px;
		height: 16px;
		margin-right: 12px;
		border-radius: 8px;
		background-color: #444;
	}
	
	.alert-text-container {
		display: flex;
		align-items: center;
	}
	
</style>
