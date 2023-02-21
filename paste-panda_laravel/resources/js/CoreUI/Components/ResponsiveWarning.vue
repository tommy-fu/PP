<template>
	<div class="section">
		<div class="background">
			<div class="wrapper">
				<h3 class="h3">Switch to a larger screen</h3>
				<div class="body-lg color-a3a3a3 mt-12">Visit <a href="https://library.pastepanda.com" style="text-decoration: none; color: #1592ff;">library.pastepanda.com</a> on a device with a larger screen.</div>
			</div>
		</div>
	</div>
</template>

<script>
    export default {
        name: "ResponsiveWarning"
    }
</script>

<style scoped>
	.section {
		position: relative;
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		width: 100%;
		height: 100vh;
		-webkit-justify-content: space-around;
		-ms-flex-pack: distribute;
		justify-content: space-around;
	}
	
	.color-a3a3a3 {
		color: #a3a3a3;
	}
	
	.background {
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		width: 100%;
		height: 100%;
		-webkit-box-pack: center;
		-webkit-justify-content: center;
		-ms-flex-pack: center;
		justify-content: center;
		-webkit-box-align: center;
		-webkit-align-items: center;
		-ms-flex-align: center;
		align-items: center;
		background-color: #1c1c1c;
	}
	
	.wrapper {
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		width: 360px;
		padding-right: 32px;
		padding-left: 32px;
		-webkit-box-orient: vertical;
		-webkit-box-direction: normal;
		-webkit-flex-direction: column;
		-ms-flex-direction: column;
		flex-direction: column;
		-webkit-box-pack: center;
		-webkit-justify-content: center;
		-ms-flex-pack: center;
		justify-content: center;
		-webkit-box-align: center;
		-webkit-align-items: center;
		-ms-flex-align: center;
		align-items: center;
	}
	
	.h3 {
		margin-top: 0px;
		margin-bottom: 0px;
		font-family: Inter, sans-serif;
		color: #fff;
		font-size: 20px;
		font-weight: 400;
	}
	
	.mt-12 {
		margin-top: 12px;
	}
	
	.body-lg {
		font-family: Inter, sans-serif;
		font-size: 15px;
		line-height: 24px;
		text-align: center;
	}


</style>
