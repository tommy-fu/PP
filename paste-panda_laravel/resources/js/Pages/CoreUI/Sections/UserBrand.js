export default class UserBrand {

    get(){
        return axios.get('/user-brands');
    }
}
