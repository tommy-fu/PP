<template>
<!--	<div style="-webkit-transform:translate3d(0, 0, 0) scale3d(0.9, 0.9, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0, 0, 0) scale3d(0.9, 0.9, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0, 0, 0) scale3d(0.9, 0.9, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0, 0, 0) scale3d(0.9, 0.9, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0)"-->
<!--	     :class="[{'is-active': getShowToast}]"-->
<!--	     class="copytoastmessage"><img src="images/React-&#45;&#45;Color.svg" alt="" class="icon24">-->
<!--		&lt;!&ndash;	<div style="-webkit-transform:translate3d(0, 0, 0) scale3d(0.9, 0.9, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0, 0, 0) scale3d(0.9, 0.9, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0, 0, 0) scale3d(0.9, 0.9, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0, 0, 0) scale3d(0.9, 0.9, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0)" v-if="show"&ndash;&gt;-->
<!--		<div class="toastmessagetext">Code copied to clipboard!</div>-->
<!--	</div>-->
	<notifications group="toast"
	               position="top right">
		<template slot="body" slot-scope="props">
			
			<div style="width: 100%;"
			     class="copytoastmessage"><img src="images/React---Color.svg" alt="" class="icon24">
				<div class="toastmessagetext">{{props.item.text}}</div>
			</div>
		</template>
	</notifications>
</template>

<style scoped>
	
	.copytoastmessage {
	//position: absolute;
	//left: auto;
	//top: 0;
	//right: 0;
	//bottom: 0;
		z-index: 12;
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		height: 56px;
		margin-top: 24px;
		margin-right: 24px;
		padding: 24px;
		-webkit-box-pack: center;
		-webkit-justify-content: center;
		-ms-flex-pack: center;
		justify-content: center;
		-webkit-box-align: center;
		-webkit-align-items: center;
		-ms-flex-align: center;
		align-items: center;
		border-radius: 5px;
		background-color: #121212;
		box-shadow: 0 6px 15px 0 rgba(0, 0, 0, 0.5);
	//opacity: 0;
	}
	
	.toastmessagetext {
		margin-left: 12px;
		font-family: Inter, sans-serif;
		color: #fff;
		font-size: 16px;
		line-height: 24px;
		font-weight: 400;
		letter-spacing: 0px;
		text-decoration: none;
	}

</style>
