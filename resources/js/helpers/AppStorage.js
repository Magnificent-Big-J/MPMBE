
    class  AppStorage {
        storeToken(token){
            localStorage.setItem('token',token)
        }
        storeUser(user){
            localStorage.setItem('user',user)
        }
        store(user,token){
            this.storeToken(token)
            this.storeUser(user)
        }
        clear(){

            localStorage.removeItem('token')
            localStorage.removeItem('user')
            localStorage.removeItem('error')
        }
        loginError(error){
            localStorage.setItem('error',error)
        }
        getToken(){
            return localStorage.getItem('token')
        }
        getUser(){
            return localStorage.getItem('user')
        }
        getError(){
            return localStorage.getItem('error')
        }
    }
    export default AppStorage = new AppStorage();
