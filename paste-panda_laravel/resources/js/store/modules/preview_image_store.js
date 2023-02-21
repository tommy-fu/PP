export const PreviewImageStore = {
    state: {
        imageUrl: '',
        show: false
    },

    getters: {
        getShowPreviewImage(state) { //take parameter state
            return state.show;
        },
        getPreviewImageUrl(state) { //take parameter state
            return state.imageUrl;
        },
    },

    mutations: {
        setShowPreviewImage(state, imageUrl) {
            // return state.show = show;
            state.show = imageUrl != null;
            state.imageUrl = imageUrl;
        },
        setPreviewImageUrl(state, url) {
            return state.imageUrl = url;
        },
    }
}
