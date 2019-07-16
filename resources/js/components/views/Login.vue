<template>
    <!--div class="mt-5">

        <v-content>
            <v-container fluid fill-height>
                <v-layout align-center justify-center>
                    <v-flex xs12 sm8 md4>
                        <v-card class="elevation-12">
                            <v-toolbar dark color="primary">
                                <v-toolbar-title>Login</v-toolbar-title>
                                <v-spacer></v-spacer>

                            </v-toolbar>
                            <v-card-text>
                                <v-form >
                                    <v-alert v-if="error"
                                            :value="true"
                                            type="error"
                                    >
                                        Invalid Credentials
                                    </v-alert>

                                    <v-text-field  prepend-icon="person" required  v-model="form.email"  type="email" label="Email" ></v-text-field>
                                    <v-text-field prepend-icon="lock" required  v-model="form.password" label="Password" id="password" type="password"></v-text-field>
                                </v-form>
                            </v-card-text>
                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn color="primary" @click="login">Login</v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-flex>
                </v-layout>
            </v-container>
        </v-content>
    </div-->
    <v-app id="login" class="primary">
        <v-content>
            <v-container fluid fill-height>
                <v-layout align-center justify-center>
                    <v-flex xs12 sm8 md4 lg4>
                        <v-card class="elevation-1 pa-3">
                            <v-card-text>
                                <div class="layout column align-center">

                                    <h1 class="flex my-4 primary--text">MPMBE Log In</h1>
                                </div>

                                <v-form >
                                    <v-alert v-if="error"
                                             :value="true"
                                             type="error"
                                    >
                                        Invalid Credentials
                                    </v-alert>

                                    <v-text-field  prepend-icon="person" required  v-model="form.email"  type="email" label="Email" ></v-text-field>
                                    <v-text-field prepend-icon="lock" required  v-model="form.password" label="Password" id="password" type="password"></v-text-field>
                                </v-form>
                            </v-card-text>
                            <v-card-actions>
                                <v-btn color="primary" @click="login">Login</v-btn>
                                <v-spacer></v-spacer>

                            </v-card-actions>
                        </v-card>
                    </v-flex>
                </v-layout>
            </v-container>

        </v-content>
    </v-app>
</template>

<script>
    export default {
        name: "Login",
        data(){return{
            form:{email:null,password:null},
            error:null
        }},
        methods:{
            login(){
                axios.post('/api/auth/login',this.form)
                    .then((response)=>{
                        User.login(response)

                    })
                    .catch((error)=>{
                        this.error = error.response.data.error

                    })
                User.login(this.form)


            },

        },



    }
</script>

<style scoped>
    #login {
        height: 50%;
        width: 100%;
        position: absolute;
        top: 0;
        left: 0;
        content: "";
        z-index: 0;
    }
    .link-style {
        text-decoration: none;
    }
</style>