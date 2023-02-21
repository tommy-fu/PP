<template>
	<div>
		<div class="avatar-container">
			<div class="avatar-circle mr-12">
				<div class="body-sm color-fff">{{$page.props.auth.user.initials}}</div>
			</div>
			<div class="body-lg color-fff">{{$page.props.auth.user.first_name}}</div>
		</div>
	</div>
</template>

<script>
    import {mapGetters} from "vuex";

    export default {
        name: "Avatar",
    }
</script>

<style scoped>
	
	.body-sm {
		font-size: 12px;
		font-weight: 500;
	}
	
	.body-lg {
		font-size: 14px;
	}
	
	.avatar-container {
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		width: 100px;
		height: 100%;
		-webkit-box-align: center;
		-webkit-align-items: center;
		-ms-flex-align: center;
		align-items: center;
	}
	
	.avatar-circle {
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		width: 32px;
		height: 32px;
		min-height: 32px;
		min-width: 32px;
		-webkit-box-pack: center;
		-webkit-justify-content: center;
		-ms-flex-pack: center;
		justify-content: center;
		-webkit-box-align: center;
		-webkit-align-items: center;
		-ms-flex-align: center;
		align-items: center;
		border-radius: 16px;
		background-color: #1592ff;
	}
	
	.avatar-circle.mr-12 {
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
	}
	
	.mr-12 {
		margin-right: 12px;
	}
</style>
