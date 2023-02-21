export const PageStore = {
    state: {
        page: {
            sections: []
        },
        shouldShowSectionLibrary: false
    },

    getters: {
        getPage(state) { //take parameter state
            return state.page;
        },
        getPageSections(state) { //take parameter state
            return state.page.sections;
        },
        getShouldShowSectionLibrary(state) { //take parameter state
            return state.shouldShowSectionLibrary;
        },
    },

    mutations: {
        setPage(state, data) {
            return state.page = data;
        },
        setPageSections(state, data) {
            return state.page.sections = data;
        },
        setShouldShowSectionLibrary(state, data) {
            console.log("Setting..");
            return state.shouldShowSectionLibrary = data;
        },
    },


    actions: {
        getPageFromApi(context, id){
            axios.get('/api/pages/' + id)
                .then(response => {
                    context.commit('setPage', response.data);
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        deletePageSectionFromApi(context, pageSectionId){
            return axios.delete('/api/page-sections/' + pageSectionId);
        }
    }
}
