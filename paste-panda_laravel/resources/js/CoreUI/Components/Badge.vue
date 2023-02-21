<template>
	<div class="label-container" v-if="label">
		<div class="body-uppercase color-1592ff">New</div>
	</div>
</template>
<script>
    export default {
        name: 'Badge',
        props: {
            label: {}
        }
    }
</script>
<style lang="scss" scoped>
	
	body {
		background-color: #262626;
		font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;
		color: #333;
		font-size: 14px;
		line-height: 20px;
	}
	
	a {
		text-decoration: underline;
	}
	
	.label-container {
		padding: 4px 6px;
		border-radius: 3px;
		background-color: #1f2d45;
	}
	
	.body-uppercase {
		font-family: Inter, sans-serif;
		font-size: 8px;
		letter-spacing: 1px;
		text-transform: uppercase;
	}
	
	.body-uppercase.color-1592ff {
		color: #1592ff;
		font-size: 9px;
		font-weight: 500;
	}

</style>
