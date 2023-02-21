export const CssStore = {
    state: {
        css: ''
    },

    getters: {
        getUserCss(state) {
            return state.css;
        }
    },

    mutations: {
        SET_CSS(state, css) {
            state.css = css;
        }
    },


    actions: {
        fetchUserCss(store) {
            axios.get('/user-brands').then(response => {
                    store.commit('SET_CSS', response.data);
                }
            );
        }

    }
}
