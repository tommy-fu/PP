<template>
	<div style="width: 100%; height: 100%; background: #F8F8F8;">
		<div style="height: 70px; width: 100%; background: #fff; margin-bottom: 16px; border-bottom: 1px solid #E6E6E5;">
		
		</div>
		<!--		<iframe style="width: 100%; height: 100%;" :src="iframeRoute" frameborder="0"></iframe>-->
		<div style="padding-left: 16px; padding-right: 16px; position: relative;">
			
			<div v-for="section in getPageSections" style="position: relative;">
				<div v-html="section.html_code" :id="'section-' + section.pivot.id"
				     :key="section.pivot.id"></div>
				
				<button class="button" style="position: absolute; right: 20px; top: 20px; z-index: 200;" @click="deleteSection(section.pivot.id)">Delete</button>
			</div>
		</div>
		<!--		</div>-->
		<!--		<div id="htmlContainer"></div>-->
	</div>
</template>

<script>
    import {mapActions, mapGetters} from "vuex";

    export default {
        name: "edit-page",
        props: ['pageId', 'ids', 'route'],
        data() {
            return {
                sections: []
            }
        },
        computed: {
            iframeRoute() {

                let ids = '';

                for (let i = 0; i < this.ids.length; i++) {
                    if (i === 0) {
                        ids = 'ids[]=' + this.ids[i];
                    }

                    else {
                        ids = ids + '&ids[]=' + this.ids[i];
                    }

                }

                return this.route + '?brandId=' + this.getBrandId + '&' + ids;
            },
            ...mapGetters(['getBrandId']),
            html() {
                var html = '';

                for (let i = 0; i < this.sections.length; i++) {
                    let htmlCode = this.sections[i].html_code;
                    // console.log(this.sections[i]);
                    if (htmlCode) {
                        html += htmlCode;
                    }
                }

                // console.log(html);

                return html;
            },

            ...mapGetters(['getPage', 'getPageSections'])
        },
        methods: {
            ...mapActions(['getPageFromApi', 'deletePageSectionFromApi']),
	        deleteSection(sectionId){
                this.deletePageSectionFromApi(sectionId).then(() => {
                    this.getPageFromApi(this.pageId);
                });
	        }
        },
        mounted() {
            let file = document.createElement('link');
            file.rel = 'stylesheet';
            // file.href = '/api/css/' + this.id + '/brands/' + this.sass_style_id;
            file.href = '/api/css/' + 11 + '/brands/' + 11;
            file.id = 'customStylesheet'
            document.head.appendChild(file);


            this.getPageFromApi(this.pageId);
            // document.getElementById("htmlContainer").innerHTML = this.html;


            // axios.get('/api/pages/' + this.pageId)
            //     .then(response => {
            //         this.sections = response.data.sections;
            //     })
            //     .catch(function (error) {
            //         console.log(error);
            //     })
        }
    }
</script>

<style scoped>

</style>
