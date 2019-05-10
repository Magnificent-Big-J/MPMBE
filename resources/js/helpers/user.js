import AppStorage from './AppStorage'
import Token from './Token'
class User{

    login(form){
        axios.post('/api/auth/login',form)
            .then((response)=>{
                this.responseAfterLogin(response)

            })
            .catch((error)=>{
                this.errors = error.response
                AppStorage.loginError(error.response.data.error)

            })
    }
    responseAfterLogin(response){
        const access_token = response.data.access_token
        const username = response.data.user
        if(Token.isValid(access_token)){
            AppStorage.store(username,access_token)
            window.location = "/dashboard"
        }
    }
    hasToken(){
        const storedToken = AppStorage.getToken()

        if(storedToken){
            return Token.isValid(storedToken) ? true: false
        }
        return false
    }
    loggedIn(){
        return this.hasToken()
    }
    logout(){
        AppStorage.clear()
        window.location = '/'
    }
    username(){
        if(this.loggedIn()){
            return AppStorage.getUser()
        }
    }
    getLoginError(){
        return AppStorage.getError() ? true: false
    }
}

export default User = new User();