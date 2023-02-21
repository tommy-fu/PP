<template>
	<div class="accordion-view-item-wrapper">
	<!-- STYLES -->
		<div :key="brand.id" v-for="brand in $page.props.brands" style="margin-top: 32px;">
			<div class="style-item style-item--active" v-if="$page.props.auth.user.brand_id === brand.id">
				<h4 class="h4 color-d1d1d1 mb-8 noselect">{{brand.name}}</h4>
				
				<div class="body-sm color-d1d1d1 mb-16 noselect">{{brand.description}}</div>
				<a href="#" class="btn-outlined btn-outlined--active body-sm noselect">Current Style</a>
			</div>
			<div class="style-item" v-else>
				<h4 class="h4 color-fff mb-8 noselect">{{brand.name}}</h4>
				<div class="body-sm color-a3a3a3 mb-16 noselect">{{brand.description}}</div>
				<a href="#" class="btn-outlined body-sm noselect" @click="applyStyle(brand.id)">Apply Style</a>
			</div>
		</div>
	</div>
</template>


<script>
    import {mapGetters} from "vuex";

    export default {
        name: 'style-item',
        data() {
            return {}
        },
        methods: {
            applyStyle(brandId) {
                this.$inertia.put('/user-brands/' + brandId);
            }
        },
        computed: {
            // ...mapGetters(['getBrands', 'getActiveBrandId'])
        },
    }
</script>

<style scoped lang="scss">
	
	* {
		box-sizing: border-box;
	}
	
	.accordion-view-item-wrapper {
		width: 100%;
		padding-left: 20px;
		padding-right: 20px;
	}
	
	.style-item {
		display: flex;
		margin: 16px 0px;
		padding: 16px;
		flex-direction: column;
		justify-content: center;
		align-items: flex-start;
		border: 1px solid #2d2d2d;
		border-radius: 6px;
	}
	
	.style-item.style-item--active {
		border-color: #1592ff;
		background: #212121;
	}
	
	.btn-outlined {
		display: flex;
		width: 100%;
		height: 40px;
		justify-content: center;
		align-items: center;
		border: 1px solid #383838;
		border-radius: 6px;
		background-color: #212121;
		transition: color 100ms ease-in, border-color 100ms ease-in;
		font-family: Inter, sans-serif;
		color: #a3a3a3;
		text-decoration: none;
	}
	
	.btn-outlined:hover {
		background-color: #2d2d2d;
		color: #fff;
	}
	
	.btn-outlined.btn-outlined--active {
		border-style: solid;
		border-color: #383838;
		background-color: #212121;
		font-family: Inter, sans-serif;
		color: #fff;
		cursor: default;
	}
	
	.btn-outlined.btn-outlined-light {
		border-color: #383838;
		background-color: #262626;
	}


</style>
