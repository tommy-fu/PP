export default class SectionQueryBuilder {

    constructor(props) {
        this.$page = props;
    }

    getParameters(page) {
        let params = {
            page: page,
        };

        // console.log(this.$page.search);
        // var foo = mapParameters(this.$page);
        //
        // console.log(foo);

        if (this.$page.category) {
            params.category = this.$page.category;
        }

        if (this.$page.section_collection) {
            params.section_collection = this.$page.section_collection;
        }

        if (this.$page.prod) {
            params.prod = this.$page.prod;
        }

        if (this.$page.draft) {
            params.draft = this.$page.draft;
        }

        if (this.$page.model) {
            params.model = this.$page.model;
        }

        if (this.$page.search) {
            params.search = this.$page.search;
        }



        // params.search = ['video', 'avatar'].reduce((value, current) => {
        //     return value + ',' + current;
        // });

        return params;
    }
}

function mapParameters(parameters) {
    const params = [
        'category',
        'section_collection',
        'prod',
        'draft',
        'model'
    ];

    const result = params.filter(value => Object.keys(parameters).includes(value));

    return result.map((param) => [param, ({param: parameters[param]})]);

}
