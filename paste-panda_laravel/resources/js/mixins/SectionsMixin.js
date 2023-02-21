import {mapActions, mapGetters} from "vuex";

export default {
    data() {
        return {
            prod: true,
            draft: true,
            model: false,
        }
    },
    methods: {
        performSearch(data) {
            return this.$inertia.visit("/sections", {
                data: data,
                only: ["sections", "search", "category", "section_collection", "prod", "draft", "model"],
            }).then(() => {
                this.setShouldResetSections(true);
            });
        },
        getSearchParams() {
            let getParams = {
                prod: this.prod === true ? 1 : 0,
                draft: this.draft === true ? 1 : 0,
                model: this.model === true ? 1 : 0,
            }

            getParams.search = this.getQuery;

            if (this.$page.props.section_collection) {
                getParams.section_collection = this.$page.props.section_collection;
            }
            if (this.$page.props.category) {
                getParams.category = this.$page.props.category;
            }

            return getParams;
        },
        visitSection(params = []) {
            let data = this.getSearchParams();

            return this.$inertia.visit("/sections", {
                data: data,
                only: ["sections", "search", "category", "section_collection", "prod", "draft", "model"],
            })
        },
        ...mapActions(['setShouldResetSections'])
    },
    computed: {
        ...mapGetters(['getQuery']),
    },
}
