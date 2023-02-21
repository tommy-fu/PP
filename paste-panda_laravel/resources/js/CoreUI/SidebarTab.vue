<template>
	<div>
		<h4 class="heading-5" style="color: #FFF;">{{name}}</h4>
		
		<div class="mb-16 mt-16" style="width: 100%; height: 1px; background: #262626;"></div>
		
		<slot></slot>
	</div>
</template>

<script>
    export default {
        name: "SidebarTab",
        props: {
            name: {
                type: String,
	            required: true
            },
        },
    }
</script>

<style scoped>

</style>
