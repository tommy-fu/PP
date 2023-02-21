<template>
    <Dropdown ref="userDropdown">
        <template v-slot:button>
            <div style="display: flex; align-items: center;">
                <div class="menu-btn">
                    <svg-icon icon="user" style="font-size: 16px"></svg-icon>
                </div>
                <svg-icon icon="chevron-down" style="font-size: 6px; margin-left: 8px;"></svg-icon>
            </div>
        </template>
        
        <div class="sections-alternatives">
            <div class="menu-item" @click.prevent="resetOnboarding">
                <svg-icon
                    icon="info"
                    style="font-size: 16px; margin-right: 8px"
                ></svg-icon>
                <div class="body-md color-a3a3a3">How it works</div>
            </div>
            <div class="menu-item" @click.prevent="logout">
                <div class="body-md color-a3a3a3">Log out</div>
            </div>
        </div>
    </Dropdown>
</template>

<script>
import SvgIcon from "../../../CoreUI/Components/SvgIcon";

export default {
    name: "user-dropdown",
    components: {SvgIcon},
    methods: {
        resetOnboarding() {
            this.$inertia.patch("/user-onboarding/", {
                show_onboarding: 1,
            }, {
                preserveState: true,
                // 'only': ['auth.user.show_onboarding']
            });
            
            this.$refs.userDropdown.hide();
            
            this.menuActive = false;
        },
        logout() {
            this.$inertia.visit("/logout");
            this.$refs.userDropdown.hide();
        },
    },
}
</script>
