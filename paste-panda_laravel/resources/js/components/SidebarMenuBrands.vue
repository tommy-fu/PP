<template>
	<div style="position: relative;" v-click-outside="hide">
		<div class="outputsettingstriggerservice" @click="isActive = !isActive" style="display: flex; align-items: center; justify-content: center;"><span class="">B</span></div>
<!--		<div class="outputsettingstriggerservice" @click="isActive = !isActive"><img :src="" alt="" class="frameworkhtmlimg"></div>-->
		<div v-if="isActive" style="opacity: 1;
    transform: translate3d(0px, 0px, 0px) scale3d(1, 1, 1) rotateX(0deg) rotateY(0deg) rotateZ(0deg) skew(0deg, 0deg);
    display: block;
    transform-style: preserve-3d;
    position: absolute;
    top: 0;
    width: 240px;"
		     class="dropdowncontentservice dropdowncontentframework">
			<a href="#" class="dropdownlinkblock dropdownlinkblockframework" v-for="option in brands" @click="select(option.id)">
				<div class="frameworkiconcontainer"><img :src="option.icon" alt="" class="icon24"></div>
				<div class="dropdownlinktext">{{option.name}}</div>
				<img src="images/Check-18.svg" alt="" class="frameworkcheckmark" v-if="selected == option.value"></a>
		</div>
	</div>
</template>
<script>
    import ClickOutside from 'vue-click-outside'
    import {mapGetters, mapMutations} from "vuex";

    export default {
        directives: {
            ClickOutside
        },
        name: 'sidebar-menu-brands',
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
                selected: 1,
                brands: []
            }
        },
        methods: {
            hide() {
                this.isActive = false;
            },
	        select(value){
                this.selected = value;
                this.setBrandId(value);
		        // this.hide();
	        },
            ...mapMutations(['setBrandId']),
        },
        computed: {
            selectedOption() {
                return this.options.find(x => x.value === this.selected);
            },
	        ...mapGetters(['getBrandId']),
        },
	    created() {
            axios.get('/api/brands').then(response => {
                this.brands = response.data;
            });
        }
    }
</script>
