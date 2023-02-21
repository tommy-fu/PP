export default class TagsService {

    get(query) {
        return axios.get("/api/tags", {
            params: {
                tag: query,
            },
        });
    }
}
