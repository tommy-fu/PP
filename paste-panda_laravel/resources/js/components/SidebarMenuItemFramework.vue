<template>
	<div style="position: relative;" v-click-outside="hide">
		<div class="outputsettingstriggerservice" @click="isActive = !isActive"><img :src="selectedOption.iconSelected" alt="" class="frameworkhtmlimg"></div>
		<div v-if="isActive" style="opacity: 1;
    transform: translate3d(0px, 0px, 0px) scale3d(1, 1, 1) rotateX(0deg) rotateY(0deg) rotateZ(0deg) skew(0deg, 0deg);
    display: block;
    transform-style: preserve-3d;
    position: absolute;
    top: 0;
    width: 240px;"
		     class="card ml-56">
			<a href="#" class="" v-for="option in options" @click="select(option.value)">
				<div class="is-24x24"><img :src="option.icon" alt="" class="icon24"></div>
				<div class="dropdownlinktext">{{option.name}}</div>
				<img src="images/Check-18.svg" alt="" class="frameworkcheckmark" v-if="selected == option.value"></a>
		</div>
	</div>
</template>
<script>
    import ClickOutside from 'vue-click-outside'

    export default {
        directives: {
            ClickOutside
        },
        name: 'sidebar-menu-item-framework',
        data() {
            return {
                isActive: false,
                options: [
                    {
                        'name': 'Bootstrap',
                        icon: '/icons/Bootstrap--color.svg',
                        iconSelected: '/icons/Bootstrap--white.svg',
                        value: 1
                    },
                    {
                        'name': 'Bulma',
                        icon: '/icons/Bulma--color.svg',
                        iconSelected: '/icons/Bulma--white.svg',
                        value: 2,
                    },
                    {
                        name: 'Flex',
                        icon: '/icons/Flex--white.svg',
                        iconSelected: '/icons/Flex--white.svg',
                        value: 3
                    }
                ],
                selected: 1
            }
        },
        methods: {
            hide() {
                this.isActive = false;
            },
            select(value){
                this.selected = value
                this.hide();
            }
        },
        computed: {
            selectedOption() {
                return this.options.find(x => x.value === this.selected);
            }
        },
    }
</script>
