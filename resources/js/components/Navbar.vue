<template>
    <nav>

        <v-toolbar app>
            <v-toolbar-side-icon class="grey--text" @click="toggle"></v-toolbar-side-icon>
            <v-toolbar-title class="text-uppercase grey--text">
                <span>MPMBE</span>
                <span class="caption">My Personal Monthly Budget Expenses</span>
            </v-toolbar-title>
            <v-spacer></v-spacer>

            <v-btn flat @click="logout">
                <v-icon>exit_to_app</v-icon>
            </v-btn>

        </v-toolbar>
        <v-navigation-drawer app v-if="drawer" class="primary">
            <v-layout column align-center>
                <v-flex class="mt-5">
                    <v-avatar size="100">
                        <img src="/images/avatar-1.png" alt="">
                    </v-avatar>
                    <p class="white--text subheading mt-1">
                        {{username}}
                    </p>
                </v-flex>

            </v-layout>
            <v-list>
                <v-list-tile v-for="link in links" :key="link.text" router :to="link.route">
                    <v-list-tile-action>
                        <v-icon class="white--text">{{link.icon}}</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-content>
                        <v-list-tile-title class="white--text">{{link.text}}</v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>
            </v-list>

        </v-navigation-drawer>
    </nav>
</template>

<script>
    export default {
        name: "Navbar",
        data(){return{
            drawer:true,
            links:[
                {icon:'dashboard',text:'Dashboard', route:'/dashboard'},
                {icon:'category',text:'Categories', route:'/categories'},
                {icon:'local_grocery_store',text:'Expenses', route:'/expenses'},
                {icon:'insert_chart',text:'Overview Analytics', route:'/overview-analytics'},
                {icon:'flight',text:'Vacations', route:'/vacations'},
                {icon:'money',text:'Budget', route:'/budget'},
                {icon:'assessment',text:'Expense Draft', route:'/draft'},
                {icon:'account_balance_wallet',text:'Social Saving Monthly', route:'/social'},

            ]
        }},
        methods:{
            toggle(){

                this.drawer = !this.drawer
            },
            logout(){
                User.logout()
            },
        },
        computed:{
            username(){
                return User.username()
            }
        },
        created() {

        }
    }
</script>

<style scoped>

</style>