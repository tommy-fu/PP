<template>
	<div>
		<apply-style-card :brand="brand" v-for="brand in getBrands" :active="getActiveBrandId === brand.id" :key="brand.id"></apply-style-card>
	</div>
</template>

<script>
    import {mapGetters} from "vuex";

    export default {
        name: "BrandsTab",
        computed: {
            ...mapGetters(['getBrands', 'getActiveBrandId'])
        },
    }
</script>

<style scoped>

</style>
