<template>
	<div style="position: relative;" v-click-outside="hide">
		<div class="is-48x48" @click="isActive = !isActive">
			<img :src="selectedOption.iconSelected" alt="" class="is-24x24">
		</div>
		<div v-if="isActive" style="opacity: 1;
    transform: translate3d(0px, 0px, 0px) scale3d(1, 1, 1) rotateX(0deg) rotateY(0deg) rotateZ(0deg) skew(0deg, 0deg);
    display: block;
    transform-style: preserve-3d;
    position: absolute;
    top: 0;
  width: 240px;
background: #2D2D2D;
"
		     class="card ml-56 py-24">
			<a class="is-flex is-justify-content-space-between py-12" v-for="option in options" @click.prevent="select(option)">
				<div class="is-flex">
					<div class="is-24x24"><img :src="option.icon" alt="" class="is-24x24"></div>
					<div class="ml-16">{{option.name}}</div>
				</div>
				<img src="images/Check-18.svg" alt="" v-if="selected == option.value">
				<img src="/images/icons/lock.svg" alt="" v-if="option.locked">
			</a>
		</div>
	</div>
</template>
<script>

    import ClickOutside from 'vue-click-outside'

    export default {
        directives: {
            ClickOutside
        },
        name: 'sidebar-menu-item-html',
        data() {
            return {
                isActive: false,
                options: [
                    {
                        'name': 'HTML',
                        icon: '/images/HTML---Color.svg',
                        iconSelected: '/icons/HTML--white.svg',
                        value: 1,
                        locked: false,
                    },
                    {
                        'name': 'React',
                        icon: '/images/React---Color.svg',
                        iconSelected: '/icons/React--white.svg',
                        value: 2,
                        locked: true,
                    },
                ],
                selected: 1
            }
        },
        methods: {
            hide() {
                this.isActive = false;
            },
            select(option) {

                if (option.locked) return;

                this.selected = option.value;
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
