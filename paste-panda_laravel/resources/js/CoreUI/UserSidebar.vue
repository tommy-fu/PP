<template>
	<div class="px-16 py-32 is-flex is-justify-content-space-between is-align-items-center"
	     style="background: #1C1C1C; width: 70px; height: 100vh; display: flex; flex-direction: column; align-items: center;">
		
		<div>
			<div class="is-flex mb-32 is-clickable">
				<div class="testKlass1" style="width: 40px; height: 40px; border-radius: 8px; background: #F7ECDB; display: flex; justify-content: center; align-items: center;">
					Soft
				</div>
			</div>
		</div>
		
		<div class="mb-32">
			<InertiaLink href="/settings">
				<div style="background-color:rgb(30,30,30)"
				     class="is-48x48 is-flex is-align-items-center is-justify-content-center">
					<div style="color:rgb(255,255,255)" class="dropdowntext">VM
					</div>
				</div>
			</InertiaLink>
		</div>
	</div>
</template>

<script>
    export default {
        name: "UserSidebar"
    }
</script>

<style lang="scss">
	.testKlass1 {
		border-radius: 0px !important;
	}
</style>
