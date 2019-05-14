<template>
    <div class="mt-5">
        <h1>Expenses </h1>
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
                <v-card-title>Manage Expenses</v-card-title>
                <v-card-text>
                    <v-form>
                        <v-text-field label="Expense" v-model="expense.name"></v-text-field>
                        <small class="text-danger" v-if="errors.name">{{errors.name[0]}}</small>
                        <v-select
                                :items="categories"
                                label="Category"
                                v-model="expense.category_id"
                                item-text="name"
                                item-value="id"
                                autocimplete
                        ></v-select>
                        <small class="text-danger" v-if="errors.category_id">{{errors.category_id[0]}}</small>
                        <v-select
                                :items="options"
                                label="Status"
                                v-model="expense.status"
                        ></v-select>
                        <small class="text-danger" v-if="errors.status">{{errors.status[0]}}</small>
                        <v-text-field label="Amount" v-model="expense.amount"></v-text-field>
                        <small class="text-danger" v-if="errors.amount">{{errors.amount[0]}}</small>
                        <v-spacer></v-spacer>
                        <v-menu>
                            <v-text-field :value="expense.expense_date"  slot="activator" label="Expense Date" prepend-icon="date_range"></v-text-field>
                            <v-date-picker v-model="expense.expense_date" ></v-date-picker>
                        </v-menu>
                        <v-spacer></v-spacer>
                        <small class="text-danger" v-if="errors.expense_date">{{errors.expense_date[0]}}</small>
                        <v-spacer></v-spacer>
                        <v-btn class="info mx-0 mt-3" v-if="editable" @click="update">Update Expense</v-btn>
                        <v-btn class="primary mx-0 mt-3" v-else @click="submit">Add Expense</v-btn>
                    </v-form>
                </v-card-text>

                <v-card class="mt-2 pa-4" >
                    <v-layout row wrap>
                        <v-flex xs12 md4>
                            <div class="caption grey--text">
                                Expense
                            </div>

                        </v-flex>
                        <v-flex xs6 sm4 md2>
                            <div class="caption grey--text">
                                Category
                            </div>

                        </v-flex>
                        <v-flex xs6 sm4 md2>
                            <div class="caption grey--text">
                                Amount
                            </div>

                        </v-flex>
                        <v-flex xs6 sm4 md2>
                            <div class="caption grey--text">
                                Status
                            </div>

                        </v-flex>
                        <v-flex xs6 sm4 md2>
                            <div class="caption grey--text">
                                Actions
                            </div>

                        </v-flex>
                        <v-divider></v-divider>
                    </v-layout>
                    <v-layout row wrap v-for="(expense,index) in expenses" :key="expense.name">
                        <v-flex xs12 md4>

                            <div>{{expense.name}}</div>
                        </v-flex>
                        <v-flex xs6 sm4 md2>

                            <div>{{expense.category}}</div>
                        </v-flex>
                        <v-flex xs6 sm4 md2>

                            <div>R {{expense.amount}}</div>
                        </v-flex>
                        <v-flex xs6 sm4 md2>

                            <div>
                                <v-chip small>{{expense.status}}</v-chip>
                            </div>
                        </v-flex>
                        <v-flex xs6 md2>
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

            </v-card>
        </v-container>
    </div>
</template>

<script>
    export default {
        name: "Expenses",
        data(){return{
            expenses:[],
            expense:{name:null,category_id:null,amount:null,status:null,expense_date:null},
            options:['Paid', 'Onprogress','Outstanding'],
            categories:{},
            editable:false,
            snackbar:false,
            message:null,
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
                this.expense = this.expenses[i]
            },
            update(){

                axios.put('/api/expenses/'+this.expense.id,this.expense)
                    .then((response)=>{
                        this.editable = false
                        this.message = response.data.message
                        this.expenses[this.index] = response.data.expense
                        this.index = null
                        this.snackbar = true
                    })

            },
            destroy(i){
                axios.delete('/api/categories/'+this.expenses[i].id)
                    .then((response)=>{
                        this.snackbar = true
                        this.message = response.data.message
                        this.expenses.splice(i,1)
                        this.expense = {name:null,id:null,amount:null,status:null,expense_date:null}
                    })
            }
            ,
            submit(){


                axios.post('/api/expenses',this.expense)
                    .then((response)=>{
                        this.message = response.data.message
                        this.expenses.push(response.data.expense)
                        this.snackbar = true
                        this.expense = {name:null,id:null,amount:null,status:null,expense_date:null}
                    })
                    .catch((error)=>{
                        this.errors = error.response.data.errors
                    })

            },
            get_expenses(){
                axios.get('/api/expenses?page='+this.pagination.current)
                    .then((response)=>{
                        this.expenses = response.data.data
                        this.pagination.current = response.data.meta.current_page
                        this.pagination.total = response.data.meta.last_page
                    })
            },
            get_categories(){
                axios.get('/api/getList ')
                    .then((response)=>{
                        this.categories = response.data.data

                    })
            }            ,
            onPageChange(){
                this.get_expenses()
            }
        },
        created(){
            if(!User.loggedIn()){
                this.$router.push("/")
            }
            this.get_expenses()
            this.get_categories()
        }
    }
</script>

<style scoped>

</style>