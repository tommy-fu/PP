export const SectionStore = {
    state: {
        sections: [],
        page: 1,
        tags: [],
        query: '',
        shouldLoadSections: true,
        shouldResetSections: false,
    },

    getters: {
        getSections(state) {
            return state.sections;
        },
        getPage(state) {
            return page;
        },
        getTags(state) {
            return state.tags;
        },
        getQuery(state) {
            return state.query;
        },
        getShouldResetSections(state){
            return state.shouldResetSections;
        }
    },

    mutations: {
        SET_SECTIONS(state, sections) {
            state.sections.push(...sections);
        },
        EMPTY_SECTIONS(state) {
            state.sections = [];
        },
        SET_TAGS(state, tags) {
            state.tags = tags;
        },
        EMPTY_TAGS(state) {
            state.tags = [];
        },
        SET_QUERY(state, query) {
            state.query = query;
        },
        SET_SHOULD_RESET_SECTIONS(state, value){
            console.log(value);
            state.shouldResetSections = value;
        }
    },


    actions: {
        setShouldResetSections(store, value){
            store.commit('SET_SHOULD_RESET_SECTIONS', value);
        },
        emptySections(store) {
            store.commit('EMPTY_SECTIONS');
        },
        fetchSections(store, params) {
            return new Promise((resolve, reject) => {
                axios.get('/api/sections', {
                    params: params,
                }).then(response => {
                    store.commit('SET_SECTIONS', response.data.data);

                    if (response.data.data.length) {
                        return resolve();
                    }
                    else {
                        console.log("No more pages!");
                        return reject();
                    }
                });
            });
        },
        fetchTags(store, query) {
            return axios.get("/api/tags", {
                params: {
                    tag: query,
                },
            }).then(response => {
                store.commit('SET_TAGS', response.data);
            });

        },
    }
}
