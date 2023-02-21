<template>
	<div class="is-selectable" style="position: relative;" v-click-outside="hide">
		<div class="is-48x48 outputsettingstriggerservice" @click="isActive = !isActive"><img :src="selectedOption.iconSelected" alt="" class="frameworkhtmlimg"></div>
		<div v-if="isActive" style="opacity: 1;
    transform: translate3d(0px, 0px, 0px) scale3d(1, 1, 1) rotateX(0deg) rotateY(0deg) rotateZ(0deg) skew(0deg, 0deg);
    display: block;
    transform-style: preserve-3d;
    position: absolute;
    top: 0;
    width: 240px;"
		     class="card ml-56 dropdowncontentservice dropdowncontentframework">
			<a href="#" class="dropdownlinkblock dropdownlinkblockframework" v-for="option in options" @click="select(option.value)">
				<div class="frameworkiconcontainer"><img :src="option.icon" alt="" class="icon24"></div>
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
        name: 'sidebar-menu-item-css',
        data() {
            return {
                isActive: false,
                options: [
                    {
                        name: 'SCSS',
                        icon: '/icons/Sass--color.svg',
                        iconSelected: '/icons/Sass--white.svg',
                        value: 2,
                    },
                    {
                        name: 'CSS',
                        icon: '/icons/CSS--color.svg',
                        iconSelected: '/icons/CSS--white.svg',
                        value: 1
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
