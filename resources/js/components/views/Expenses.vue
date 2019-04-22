<template>
    <div class="mt-5">
        <h1>Expenses Here</h1>
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
                        <v-select
                                :items="categories"
                                label="Category"
                                v-model="expense.category"
                        ></v-select>
                        <v-select
                                :items="options"
                                label="Status"
                                v-model="expense.status"
                        ></v-select>
                        <v-text-field label="Amount" v-model="expense.amount"></v-text-field>
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
                                    <v-icon color="red">delete</v-icon>
                                </v-btn>
                            </v-card-actions>
                        </v-flex>
                        <v-divider></v-divider>
                    </v-layout>
                </v-card>

            </v-card>
        </v-container>
    </div>
</template>

<script>
    export default {
        name: "Expenses",
        data(){return{
            expenses:[
                {name:'Car Insurance',category:'Installment',amount:'1523',status:'paid'},
                {name:'House Hold 1',category:'Black Tax',amount:'1000',status:'paid'},
                {name:'House Hold 2',category:'Installment',amount:'1000',status:'paid'},
                {name:'Food and Groceries',category:'Installment',amount:'1523',status:'outstanding'},
                {name:'Helper',category:'Consumer Debt',amount:'800',status:'onprogress'},
                {name:'Car',category:'Consumer Debt',amount:'5000',status:'paid'},
                {name:'Petrol',category:'Consumer Debt',amount:'3000',status:'paid'},
                {name:'Medical Aid',category:'Health Care',amount:'1523',status:'paid'},
                {name:'Pension Fund',category:'Savings',amount:'1523',status:'paid'},
            ],
            expense:{name:null,category:null,amount:null,status:null},
            options:['Active', 'Suspended','Not Active'],
            categories:['Income','Emergency Fund','Housing','Installment','Black Tax','Savings','Health Care','Consumer Debt','Unplanned'],
            editable:false,
            snackbar:false,
            message:null
        }},
        methods:{
            edit(i){
                this.editable = true
                this.expense = this.expenses[i]
            },
            update(){
                this.editable = false
                this.expense = {name:null,status:null}
                this.message = "Expense Successfully updated"
                this.snackbar = true
            },
            submit(){
                this.message = "Expense Successfully Added"
                this.expenses.push(this.expense)
                this.snackbar = true
            }
        }
    }
</script>

<style scoped>

</style>