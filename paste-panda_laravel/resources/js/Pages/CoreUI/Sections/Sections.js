export default class Sections {

    constructor() {
    }

    setApiUrl(url){
        this.api_url = url;
    }

    get(params){
        return axios.get(this.api_url, {
            params: params,
        });
    }
}
