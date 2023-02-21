<template>
	<div class="cardscontainerservice">
		
		<!--		<div class="columns is-multiline">-->
		<div class="masonry">
			<div class="" style="height: fit-content;" v-for="section in sections">
				<div class="item" style="height: auto;">
					<card-item :section="section" :requires-pro="section.requires_pro" :id="section.id"
					           :img-url="section.image_url"></card-item>
				</div>
			</div>
		</div>
		<!--		</div>-->
	
	</div>
</template>

<script>
    import CardItem from "./CardItem";

    export default {
        name: "section-container",
        components: {CardItem},
        props: ['sections'],
        data() {
            return {
                // sections: []
            }
        },
        computed: {
            // ...mapGetters(['getSections'])
        },
        mounted() {

        }
    }
</script>

<style scoped>
	.masonry { /* Masonry container */
		column-count: 2;
		column-gap: 1em;
	}
	
	.item { /* Masonry bricks or child elements */
		background-color: #eee;
		display: inline-block;
		margin: 0 0 1em;
		width: 100%;
	}
</style>
