<template>
	<div class="sidebarservice">
		<div class="categorieswrapperservice">
			<a href="#" class="categoriesitem w-inline-block" v-for="category in categories"
			   @click="setCategory(category.id)">
				<div class="categoriescategory">{{category.name}}</div>
				<div class="categoriesnumberlabel">{{category.section_count}}</div>
			</a>
			<!--            <a href="#" class="categoriesitem w-inline-block">-->
			<!--                <div class="categoriescategory">Hero</div>-->
			<!--                <div class="categoriesnumberlabel">29</div>-->
			<!--            </a>-->
			<!--            <a href="#" class="categoriesitem w-inline-block">-->
			<!--                <div class="categoriescategory">Features</div>-->
			<!--                <div class="categoriesnumberlabel">24</div>-->
			<!--            </a>-->
			<!--            <a href="#" class="categoriesitem w-inline-block">-->
			<!--                <div class="categoriescategory">Call To Action</div>-->
			<!--                <div class="categoriesnumberlabel">26</div>-->
			<!--            </a>-->
			<!--            <a href="#" class="categoriesitem w-inline-block">-->
			<!--                <div class="categoriescategory">Newsletter</div>-->
			<!--                <div class="categoriesnumberlabel">19</div>-->
			<!--            </a>-->
		</div>
	</div>
</template>

<script>
    import {mapActions, mapMutations} from "vuex";

    export default {
        data() {
            return {
                categories: []
            }
        },
        methods: {
            ...mapMutations(['setCategoryId']),
            setCategory(id) {

                let val = id != null ? id : 0;


                this.setCategoryId(val);
                this.getSectionsByCategoryId(val);
            },
            ...mapActions(['getSectionsByCategoryId'])
        },
        mounted() {
            axios.get('/api/categories')
                .then(response => {
                    this.categories = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                })

            this.getSectionsByCategoryId(0);
        }
    }
</script>
