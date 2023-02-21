<template>
	<div class="" style="width: 100%;">
		<div style="width: 100%; height: 70px; background: #fff; margin-bottom: 24px; border-bottom: 1px solid #E6E6E5;">
			
			<div style="display: flex; justify-content: space-between; align-items: center; height: 100%; padding-left: 24px; padding-right: 24px;"
			     v-if="selectedSection">
				<div @click="selectedSection=false"><</div>
				<!--				<div>Back</div>-->
				<!--				<div>{{selectedSection.section_category.name}}</div>-->
				<div>{{selectedSection.name}}</div>
				<div></div>
				<!--				<div>asd</div>-->
			</div>
		</div>
		
		<!--		<div style="position: static; width: 300px; padding-left: 24px;">-->
		<div style="position: static; width: 100%;">
			<!--		<div style="position: fixed; width: 300px; border-right: 1px solid #EAEAEA;">-->
			<!--			<div v-if="selectedSection" style="height: 80px; background: #fff; margin-bottom: 24px;">-->
			<!--				-->
			<!--				<div style="display: flex; justify-content: space-between; align-items: center; height: 100%;">-->
			<!--					<div @click="selectedSection=false">Back</div>-->
			<!--					<div>{{selectedSection.section_category.name}}</div>-->
			<!--					<div>asd</div>-->
			<!--				</div>-->
			<!--			</div>-->
			
			<div style="background: #FFF; width: 100%; height: 64px; border-bottom: 1px solid #F0F0F0; cursor: pointer; margin-bottom: 32px;"
			     v-if="!selectedSection">
				<div style="display: flex; align-items: center; height: 100%; padding-left: 24px; padding-right: 24px;">
					<div style="margin-left: 8px;">
						Navbar
					</div>
				</div>
			</div>
			
			<draggable v-model="pageSections" group="people" @start="drag=true" @end="updateSectionsOrder">
				<div v-for="section in pageSections"
				     style="background: #fff; width: 100%; height: 64px; border-bottom: 1px solid #F0F0F0; cursor: pointer;"
				     :key="section.page_section_id"
				     @click="selectSection(section)" v-if="!selectedSection">
					<div style="display: flex; align-items: center; height: 100%; padding-left: 24px; padding-right: 24px;">
						<!--				<div>Icon</div>-->
						<!--						<div style="margin-left: 8px;">{{section.section_category.name}} {{section.page_section_id}}</div>-->
						<!--						<div style="margin-left: 8px;">{{section.name}} {{section.page_section_id}}</div>-->
						<div style="margin-left: 8px;">{{section.name}}</div>
					</div>
				</div>
			
			</draggable>
			<!--		<div v-for="section in sections" style="background: #888888; width: 100%; margin-bottom: 8px;"-->
			
			<div style="background: #fff; width: 100%; height: 64px; border-bottom: 1px solid #F0F0F0; cursor: pointer; margin-top: 32px; margin-bottom: 32px;"
			     v-if="!selectedSection">
				<div style="display: flex; align-items: center; height: 100%; padding-left: 24px; padding-right: 24px;">
					<div style="margin-left: 8px;">
						Footer
					</div>
				</div>
			</div>
			
			<div v-if="selectedSection" style="padding-left: 24px; padding-right: 24px;">
				<div v-for="field in selectedSection.fields" v-if="field">
					<label for="">{{field.label}}</label>
					<!--				<input type="text" v-model="field.value" class="input" v-if="field.type === 'text'" @blur="updateSectionFields"/>-->
					<!--				<input type="text" v-model="field.value" class="input" v-if="field.type === 'text'" @blur="updateSectionFields"/>-->
					<textarea type="text" v-model="field.value" class="input"
					          v-if="field.type === 'textarea' || field.type === 'text'" style="height: 100px;" rows="3"
					          @blur="updateSectionFields"></textarea>
					<!--				<textarea type="text" v-model="field.value" class="input" v-if="field.type === 'textarea'" style="height: 100px;" rows="3" @blur="updateSectionFields"></textarea>-->
					
					<div v-if="field.type === 'image'">
						<img :src="field.value" alt="" style="width: 100%;">
						
						<input type="file" @change="uploadSectionFile($event, field.key)">
					</div>
					
					<div v-if="field.type ==='repeater'">
						<div v-for="elements in field.value">
							<!--							<label for="">{{field.label}}</label>-->
							<!--				<input type="text" v-model="field.value" class="input" v-if="field.type === 'text'" @blur="updateSectionFields"/>-->
							<!--				<input type="text" v-model="field.value" class="input" v-if="field.type === 'text'" @blur="updateSectionFields"/>-->
							<div v-for="item in elements">
								<label for="">{{item.label}}</label>
								<textarea type="text" v-model="item.value" class="input"
								          v-if="item.type === 'textarea' || item.type === 'text'" style="height: 100px;"
								          rows="3"
								          @blur="updateSectionFields"></textarea>
							</div>
							
						</div>
						
						<div style="background: #fff; width: 100%; height: 64px; border-bottom: 1px solid #F0F0F0; cursor: pointer;">
							<div style="display: flex; justify-content: center; align-items: center; height:100%; border: 1px solid blue;"
							     @click="addRepeaterField(field)">
								Add field
							</div>
						
						</div>
					</div>
				</div>
			</div>
			
			
			<div style="background: #fff; width: 100%; height: 64px; border-bottom: 1px solid #F0F0F0; cursor: pointer; padding-left: 24px; padding-right: 24px;"
			     v-if="!selectedSection">
				<div style="display: flex; justify-content: center; align-items: center; height:100%; border: 1px solid blue;"
				     @click="addSectionToPage">
					Add block
				</div>
			
			</div>
			
			
			<div style="background: #fff; width: 100%; height: 64px; border-bottom: 1px solid #F0F0F0; cursor: pointer; padding-left: 24px; padding-right: 24px;"
			     v-if="selectedSection">
				<div style="display: flex; justify-content: center; align-items: center; height:100%; border: 1px solid blue;"
				     @click="deleteSection">
					Delete block
				</div>
			
			</div>
		
		</div>
	</div>
</template>

<script>
    import SidebarMenuItemHtml from "./SidebarMenuItemHtml";
    import SidebarMenuItemCss from "./SidebarMenuItemCss";
    import SidebarMenuItemFramework from "./SidebarMenuItemFramework";
    import {mapActions, mapGetters, mapMutations} from "vuex";
    import draggable from 'vuedraggable';

    export default {
        name: 'page-sections-sidebar',
        props: ['pageId'],
        components: {SidebarMenuItemFramework, SidebarMenuItemCss, SidebarMenuItemHtml, draggable,},
        data() {
            return {
                selectedSection: false,
                sections: []
            }
        },

        methods: {
            ...mapActions(['getPageFromApi', 'deletePageSectionFromApi']),
            ...mapMutations(['setPage', 'setPageSections', 'setShouldShowSectionLibrary']),
            updateSectionFields() {

                axios.post('/api/page-sections/' + this.selectedSection.page_section_id + '/fields', {
                    'fields': this.selectedSection.fields
                })
                    .then(response => {
                        console.log(response);
                        this.getPageFromApi(this.pageId);
                    })
                    .catch(function (error) {
                        console.log(error);
                    })

            },
            uploadSectionFile(event, key) {
                console.log("Upload section file...");
                let file = event.target.files[0];


                let formData = new FormData();
                formData.append('file', file);
                formData.append('key', key);

                axios.post('/api/page-sections/' + this.selectedSection.page_section_id + '/image', formData)
                    .then(response => {
                        console.log(response);
                        this.getPageFromApi(this.pageId);
                        // this.getPageFromApi(this.pageId);


                    })
                    .catch(function (error) {
                        console.log(error);
                    })
            },
            addSectionToPage() {
                console.log("Clicked..");

                this.setShouldShowSectionLibrary(true);
                // axios.post('/api/pages/' + this.pageId + '/sections/' + 43)
                //     .then(response => {
                //         // console.log(response);
                //         this.getPageFromApi(this.pageId);
                //     })
                //     .catch(function (error) {
                //         console.log(error);
                //     })

            },
            deleteSection() {

                this.deletePageSectionFromApi(this.selectedSection.page_section_id)
                    .then(response => {
                        this.selectedSection = false;
                        this.getPageFromApi(this.pageId);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
                // axios.delete('/api/page-sections/' + this.selectedSection.page_section_id)
                //     .then(response => {
                //         this.selectedSection = false;
                //         this.getPageFromApi(this.pageId);
                //     })
                //     .catch(function (error) {
                //         console.log(error);
                //     })
            },
            updateSectionsOrder() {
                axios.put('/api/page-sections/order', {
                    'ids': this.pageSections.map(x => x.page_section_id)
                })
                    .then(response => {

                    })
                    .catch(function (error) {
                        console.log(error);
                    })
            },
            selectSection(section) {
                this.selectedSection = section;
                let element = document.getElementById('section-' + section.pivot.id);
                // element.scrollIntoView();
                // console.log(element);
                // element.scrollTop;
            },
            addRepeaterField(field){
                field['value'].push(field['repeater_template']);

                axios.post('/api/page-sections/' + this.selectedSection.page_section_id + '/fields', {
                    'fields': this.selectedSection.fields
                })
                    .then(response => {
                        console.log(response);
                        this.getPageFromApi(this.pageId);
                    })
                    .catch(function (error) {
                        console.log(error);
                    })
            }
        },
        computed: {
            ...mapGetters(['getPageSections']),
            pageSections: {
                get() {
                    return this.getPageSections;
                },
                set(newValue) {
                    this.setPageSections(newValue);
                }

            }
        },
        created() {
            // console.log(this.sections);

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
