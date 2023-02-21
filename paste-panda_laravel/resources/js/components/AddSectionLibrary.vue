<template>
	<div style="width: 100%; background: #fff; position: absolute; top: 0; left: 0; bottom: 0; right: 0; z-index: 100;">
		
		<div class="is-flex">
			<div style="width: 300px; height: 100vh; border-right: 1px solid #EAEAEA; padding: 30px;">
				<ul>
					<li style="margin-bottom: 12px;" v-for="category in categories" @click="getSections(category.id)">
						<div style="display: flex; justify-content: space-between;">
							<span>{{category.name}}</span>
							<span>{{category.section_count}}</span>
						</div>
					</li>
				</ul>
			</div>
			
			<div style="width: 100%;">
				<div class="container">
					<div class="columns is-multiline">
						<div class="column is-6" v-for="section in sections" @click="addSectionToPage(section.id)" style="max-height: 400px; overflow: hidden; border: 1px solid #EAEAEA; margin-bottom: 32px;">
							<div v-html="section.html" style="max-height: 400px;"></div>
							
							<h4 class="has-text-centered" style="margin-top: 16px;">{{section.name}}</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>

    import {mapActions, mapGetters, mapMutations} from "vuex";

    export default {
        name: 'add-section-library',
        data() {
            return {
                categories: [],
	            sections: []
            }
        },
        props: ['pageId'],
        methods: {
            ...mapMutations(['setShouldShowSectionLibrary']),
	        ...mapActions(['getPageFromApi']),
            getSections(id) {
                axios.get('/api/sections', {
                    params: {
                        'category_id': id
                    }
                })
                    .then(response => {
                        this.sections = response.data.data
                    })
                    .catch(function (error) {
                        console.log(error);
                    })
            },
            addSectionToPage(id) {

                this.setShouldShowSectionLibrary(true);
                axios.post('/api/pages/' + this.pageId + '/sections/' + id)
                    .then(response => {
                        // console.log(response);
                        this.getPageFromApi(this.pageId);
                        this.setShouldShowSectionLibrary(false);
                    })
                    .catch(function (error) {
                        console.log(error);
                    })

            },
        },
        computed: {
            ...mapGetters(['getPage'])
        },
        created() {
            axios.get('/api/categories')
                .then(response => {
                    this.categories = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
            
            this.getSections(0);
        }
    }
</script>

<style scoped>

</style>
