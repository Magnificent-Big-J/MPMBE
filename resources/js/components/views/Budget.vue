<template>
    <div class="mt-5">
        <h1>Budget </h1>
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
                <v-card>
                    <v-card-title>
                        <h1 class="headline">Budget</h1>
                    </v-card-title>
                    <v-card-text>
                       <v-form>
                           <v-layout row wrap class="pa-2">
                               <v-flex md6>
                                   <v-text-field label="Budget Amount" v-model="budget.amount"  prepend-icon="money"></v-text-field>
                                   <small class="text-danger" v-if="errors.amount">{{errors.amount[0]}}</small>
                                   <v-spacer></v-spacer>
                                   <v-menu>
                                       <v-text-field :value="budget.date"  slot="activator" label="Budget Date" prepend-icon="date_range"></v-text-field>
                                       <v-date-picker v-model="budget.date" ></v-date-picker>
                                   </v-menu>
                                   <v-spacer></v-spacer>
                                   <small class="text-danger" v-if="errors.date">{{errors.date[0]}}</small>
                               </v-flex>
                               <v-flex md6>
                                   <v-text-field label="Income" v-model="budget.income" prepend-icon="money"></v-text-field>
                                   <small class="text-danger" v-if="errors.income">{{errors.income[0]}}</small>
                                   <v-text-field label="Savings" v-model="budget.savings" prepend-icon="money"></v-text-field>
                                   <small class="text-danger" v-if="errors.savings">{{errors.savings[0]}}</small>
                               </v-flex>
                           </v-layout>
                           <v-btn color="warning" v-if="editable" @click="update">Update</v-btn>
                           <v-btn color="info" v-else @click="submit">Add</v-btn>

                       </v-form>
                        <v-card class="mt-2 pa-4" >
                            <v-layout row wrap>
                                <v-flex xs12 md4>
                                    <div class="caption grey--text">
                                        Budget
                                    </div>

                                </v-flex>
                                <v-flex xs6 sm4 md2>
                                    <div class="caption grey--text">
                                        Income
                                    </div>

                                </v-flex>
                                <v-flex xs6 sm4 md2>
                                    <div class="caption grey--text">
                                        Savings
                                    </div>

                                </v-flex>
                                <v-flex xs6 sm4 md2>
                                    <div class="caption grey--text">
                                        Date
                                    </div>

                                </v-flex>
                                <v-flex xs6 sm4 md2>
                                    <div class="caption grey--text">
                                        Actions
                                    </div>

                                </v-flex>
                                <v-divider></v-divider>
                            </v-layout>
                            <v-layout row wrap v-for="(budget,index) in budgets" :key="budget.date">
                                <v-flex xs12 md4>

                                    <div>R{{budget.amount}}</div>
                                </v-flex>
                                <v-flex xs6 sm4 md2>

                                    <div>R{{budget.income}}</div>
                                </v-flex>
                                <v-flex xs6 sm4 md2>

                                    <div>R {{budget.savings}}</div>
                                </v-flex>
                                <v-flex xs6 sm4 md2>

                                    <div>
                                       {{budget.date}}
                                    </div>
                                </v-flex>
                                <v-flex xs6 md2>
                                    <v-card-actions>
                                        <v-btn small icon>
                                            <v-icon color="orange" @click="edit(index)">edit</v-icon>
                                        </v-btn>
                                        <v-btn small icon>
                                            <v-icon color="red" @click=" destroy(index)">delete</v-icon>
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

    </div>
</template>

<script>
    export default {
        name: "Budget",
        data(){return{
            budget:{amount:null,date:null,income:null,savings:null},
            budgets:[],
            snackbar:false,
            message:null,
            editable:false,
            errors:{},
            index:null,
            pagination:{
                current:1,
                total:0
            }
        }},
        methods:{
            edit(i){
                this.editable = true
                this.budget = this.budgets[i]
                this.index = i
            },
            update(){
                axios.put('/api/budgets/'+this.budgets[this.index].id,this.budget)
                    .then((response)=>{
                        this.editable = false
                        this.budget = {amount:null,date:null,income:null,savings:null}
                        this.message = response.data.message
                        this.snackbar = true
                        this.budgets[this.index] = response.data.budget
                    })

            },
            submit(){

                axios.post('/api/budgets',this.budget)
                    .then((response)=>{
                        this.message = response.data.message
                        this.budgets.push(response.data.budget)
                        this.snackbar = true
                        this.budget = {amount:null,date:null,income:null,savings:null}
                    })
                    .catch((error)=>{
                        this.errors = error.response.data.errors
                    })

            },
            destroy(i){

                axios.delete('/api/budgets/'+this.budgets[i].id)
                    .then((response)=>{
                        this.budgets.splice(i,1)
                        this.message = response.data.message
                        this.snackbar = true
                    })

            },
            get_budgets(){
                axios.get('/api/budgets?page='+this.pagination.current)
                    .then((response)=>{
                        this.budgets = response.data.data
                        this.pagination.current = response.data.meta.current_page
                        this.pagination.total = response.data.meta.last_page
                    })
                    .catch((error)=>{

                        Exception.isExpired(error.response.data.error)
                    })
            },
            onPageChange(){
                this.get_budgets()
            }

        },
        created() {
            if(!User.loggedIn()){
                this.$router.push("/")
            }
            this.get_budgets()
        }
    }
</script>

<style scoped>

</style>