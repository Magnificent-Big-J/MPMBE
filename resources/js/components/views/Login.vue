<template>
    <div class="mt-5">

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
                                    <v-alert
                                            :value="true"
                                            type="error"
                                    >
                                        Invalid Credentials
                                    </v-alert>
                                    <v-text-field  prepend-icon="person"  v-model="form.email"  type="email" label="Email" ></v-text-field>
                                    <v-text-field prepend-icon="lock"  v-model="form.password" label="Password" id="password" type="password"></v-text-field>
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
    </div>
</template>

<script>
    export default {
        name: "Login",
        data(){return{
            form:{email:null,password:null},
            errors:null
        }},
        methods:{
            login(){
                User.login(this.form)

            },

        },

    }
</script>

<style scoped>

</style>