<template>
	<div>
		<div class="card" style="width: 980px; min-height: 800px; position: fixed; left: 30%; top: 20%;">
			<div class="card-body">
				<slot></slot>
			</div>
		</div>
	</div>
</template>

<script>
    export default {
        name: "Modal"
    }
</script>

<style scoped>

</style>
