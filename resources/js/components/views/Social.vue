<template>
    <div class="mt-5">
        <h1>Social Monthly Savings</h1>
        <v-snackbar v-model="snackbar" :timeout="4000" top color="success">
            <span>{{message}}</span>
            <v-btn
                    color="pink"
                    flat
                    @click="snackbar = false"
            >
                Close
            </v-btn>
        </v-snackbar>
        <v-container>
            <v-card>
                <v-card-title>
                    <h2>Manage Social</h2>
                </v-card-title>
                <v-card-text>
                    <v-form class="px-3">
                        <v-text-field label="Amount" v-model="social.amount">

                        </v-text-field>
                        <small class="text-danger" v-if="errors.amount">{{errors.amount[0]}}</small>

                        <v-select
                                :items="options"
                                label="Person"
                                v-model="social.name"
                        ></v-select>
                        <small class="text-danger" v-if="errors.name">{{errors.name[0]}}</small>
                        <v-spacer></v-spacer>
                        <v-menu>
                            <v-text-field :value="social.date"  slot="activator" label="Social Date" prepend-icon="date_range"></v-text-field>
                            <v-date-picker v-model="social.date" ></v-date-picker>
                        </v-menu>
                        <v-spacer></v-spacer>
                        <small class="text-danger" v-if="errors.date">{{errors.date[0]}}</small>
                        <v-spacer></v-spacer>
                        <v-btn class="warning mx-0 mt-3" v-if="editable" @click="update">Update Social</v-btn>
                        <v-btn class="primary mx-0 mt-3" v-else @click="submit">Add Social</v-btn>
                    </v-form>

                    <v-card class="pa-4 mt-2">
                        <v-layout row wrap>
                            <v-flex xs6 md3>
                                <div class="subheadline">Amount</div>

                            </v-flex>
                            <v-flex xs6 md3>
                                <div class="subheadline">Date</div>

                            </v-flex>
                            <v-flex xs6 md3>
                                <div class="subheadline">Person</div>

                            </v-flex>
                            <v-flex xs6 md3>
                                <div class="subheadline">Actions</div>

                            </v-flex>
                        </v-layout>
                        <v-layout row wrap v-for="(social,index) in socials" :key="social.id">
                            <v-flex xs6 md3>

                                <div>{{social.amount}}</div>
                            </v-flex>
                            <v-flex xs6 md3>

                                <div>{{social.date}}</div>
                            </v-flex>
                            <v-flex xs6 md3>

                                <div>{{social.name}}</div>
                            </v-flex>
                            <v-flex xs6 md3>

                                <v-card-actions>
                                    <v-btn small icon>
                                        <v-icon color="orange" @click="edit(index)">edit</v-icon>
                                    </v-btn>
                                    <v-btn small icon>
                                        <v-icon color="red" @click="destroy(index)">delete</v-icon>
                                    </v-btn>
                                </v-card-actions>
                            </v-flex>
                            <v-divider></v-divider>
                        </v-layout>
                        <v-card-actions>
                            <v-pagination
                                    v-model="pagination.current"
                                    :length="pagination.total"
                                    @input="onPageChange"
                            ></v-pagination>
                        </v-card-actions>
                    </v-card>
                </v-card-text>
            </v-card>
        </v-container>
    </div>
</template>

<script>
    export default {
        name: "Social",
        data(){return{
            social:{amount:null,date:null,name:null},
            options:['Honey', 'Mom'],
            socials:{},
            editable:false,
            message:null,
            snackbar:false,
            pagination:{
                current:1,
                total:0
            },
            index:null,
            errors:{}
        }},
        methods:{
            edit(i){
                this.editable = true
                this.social = this.socials[i]
                this.index = i
            },
            update(){
                axios.put('/api/socials/'+ this.socials[this.index].id,this.social)
                    .then((response)=>{
                        this.editable = false
                        this.social = {amount:null,date:null,name:null}
                        this.message = response.data.message
                        this.snackbar = true
                    })
            },
            submit(){
                axios.post('/api/socials',this.social)
                    .then((response)=>{
                        this.socials.push(response.data.data)
                        this.message = "Social Successfully Added"
                        this.snackbar = true
                        this.social = {amount:null,date:null,name:null}
                    })
                    .catch((error)=>{
                        this.errors = error.response.data.errors
                    })
            },
            destroy(i){
                axios.delete('/api/socials/'+this.socials[i].id)
                    .then((response)=>{
                        this.message = response.data.message
                        this.socials.splice(i,1)
                        this.snackbar = true
                    })
            },
            get_socials(){
                axios.get('/api/socials?page='+this.pagination.current)
                    .then((response)=>{
                        this.socials = response.data.data
                        this.pagination.current = response.data.meta.current_page
                        this.pagination.total = response.data.meta.last_page
                    })
                    .catch((error)=>{

                        Exception.isExpired(error.response.data.error)
                    })
            },
            onPageChange(){
                this.get_socials()
            }
        },
        created() {
            if(!User.loggedIn()){
                this.$router.push("/")
            }
            this.get_socials()
        }
    }
</script>

<style scoped>

</style>