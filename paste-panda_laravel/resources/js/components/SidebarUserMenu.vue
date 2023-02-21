<template>
	<div class="sidebarservicenarrow">
		
		<user-dropdown></user-dropdown>
		<div class="sidebardividerservice"></div>
		<div class="outputsettingswrapperservice">
		
<!--			<a href="/projects" class="dropdownlinkblock dropdownlinkblockframework">-->
<!--				P-->
<!--&lt;!&ndash;				<div class="frameworkiconcontainer"><img :src="option.icon" alt="" class="icon24"></div>&ndash;&gt;-->
<!--&lt;!&ndash;				<div class="dropdownlinktext">{{option.name}}</div>&ndash;&gt;-->
<!--&lt;!&ndash;				<img src="images/Check-18.svg" alt="" class="frameworkcheckmark" v-if="selected == option.value">&ndash;&gt;-->
<!--			</a>-->
<!--			-->
<!--			-->
<!--			<sidebar-menu-brands></sidebar-menu-brands>-->
			<sidebar-menu-item-html></sidebar-menu-item-html>
			<sidebar-menu-item-css></sidebar-menu-item-css>
			<sidebar-menu-item-framework></sidebar-menu-item-framework>
		</div>
	</div>
</template>

<script>
    import SidebarMenuItemHtml from "./SidebarMenuItemHtml";
    import SidebarMenuItemCss from "./SidebarMenuItemCss";
    import SidebarMenuItemFramework from "./SidebarMenuItemFramework";
    export default {
        components: {SidebarMenuItemFramework, SidebarMenuItemCss, SidebarMenuItemHtml}
    }
</script>

<style scoped>

</style>
