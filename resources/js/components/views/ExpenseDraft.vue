<template>
    <div class="mt-5">
        <h1>Expenses Drafts Here</h1>
        <v-container>

                <v-container fluid class="pa-2 grid-list-1">
                    <v-card>
                        <v-card-title class="headline">Process your draft</v-card-title>
                        <v-card-text>
                            <v-layout row wrap>
                                <v-flex class="ml-1" md5>
                                   <v-card>
                                       <v-card-title>
                                           <div class="heading">Budget</div>
                                       </v-card-title>
                                       <v-card-text>
                                           <v-form>
                                               <v-text-field label="Budget" v-model="budgetAmount"></v-text-field>
                                               <v-btn class="primary mx-0 mt-3"  @click="submit">Add Budget</v-btn>
                                           </v-form>
                                       </v-card-text>
                                   </v-card>
                                    <v-card class="mt-2">
                                        <v-card-title>
                                            <div class="heading">Expenses</div>
                                        </v-card-title>
                                        <v-card-text>
                                            <v-form ref="form">
                                                <v-text-field label="Expense" v-model="expense.name" :rules="inputRules"></v-text-field>
                                                <v-select
                                                        :items="categories"
                                                        label="Category"
                                                        v-model="expense.category"
                                                        :rules="inputRules"
                                                ></v-select>
                                                <v-text-field label="Amount" v-model="expense.amount" :rules="inputRules"></v-text-field>
                                                <v-btn class="primary mx-0 mt-3 " v-if="editable"  @click="update">Update Expense</v-btn>
                                                <v-btn class="primary mx-0 mt-3"  v-else @click="add">Add Expense</v-btn>
                                            </v-form>
                                        </v-card-text>
                                    </v-card>
                                </v-flex>
                                <v-flex class="ml-2" md6 >
                                   <v-card>
                                       <v-card-text>
                                           <v-layout row wrap>
                                               <v-flex class="ml-4" md3>
                                                   <v-card>
                                                       <v-card-title>
                                                           <div class="heading">Budget</div>
                                                       </v-card-title>
                                                       <v-card-text>
                                                           <div class="subheading">R {{budget}}</div>
                                                       </v-card-text>
                                                   </v-card>
                                               </v-flex>
                                               <v-flex class="ml-4" md3>
                                                   <v-card>
                                                       <v-card-title>
                                                           <div class="heading">Expenses</div>
                                                       </v-card-title>
                                                       <v-card-text>
                                                           <div class="subheading">R {{totalExpense}}</div>
                                                       </v-card-text>
                                                   </v-card>
                                               </v-flex>
                                               <v-flex class="ml-4" md3>
                                                   <v-card>
                                                       <v-card-title>
                                                           <div class="heading">Balance</div>
                                                       </v-card-title>
                                                       <v-card-text>
                                                           <div class="subheading">R {{balance}}</div>
                                                       </v-card-text>
                                                   </v-card>
                                               </v-flex>
                                           </v-layout>

                                       </v-card-text>
                                   </v-card>
                                    <v-card class="mt-2 pa-2">
                                        <v-card-title>
                                            <div class="subheading">Expenses Draft</div>
                                        </v-card-title>
                                        <v-card-text>
                                            <v-layout row wrap>
                                                <v-flex md4>
                                                    <div class="subheadline">Expense</div>
                                                </v-flex>
                                                <v-flex md2>
                                                    <div class="subheadline">Category</div>
                                                </v-flex>
                                                <v-flex md2>
                                                    <div class="subheadline">Amount</div>
                                                </v-flex>
                                                <v-flex m2>
                                                    <div class="subheadline">Actions</div>
                                                </v-flex>
                                            </v-layout>
                                            <v-layout row wrap class="mt-1" v-for="(expense,index) in expenses" :key="expense.name">
                                                <v-flex md4>
                                                    <div class="subheadline">{{expense.name}}</div>
                                                </v-flex>
                                                <v-flex md2>
                                                    <div class="subheadline">{{expense.category}}</div>
                                                </v-flex>
                                                <v-flex md2>
                                                    <div class="subheadline">{{expense.amount}}</div>
                                                </v-flex>
                                                <v-flex m2>
                                                    <v-card-actions>
                                                        <v-btn small icon>
                                                            <v-icon color="orange" @click="edit(index)">edit</v-icon>
                                                        </v-btn>
                                                        <v-btn small icon>
                                                            <v-icon color="red" @click="destroy(index)">delete</v-icon>
                                                        </v-btn>
                                                    </v-card-actions>
                                                </v-flex>
                                            </v-layout>
                                        </v-card-text>
                                    </v-card>
                                </v-flex>
                            </v-layout>
                        </v-card-text>
                    </v-card>
                </v-container>

        </v-container>
    </div>
</template>

<script>
    export default {
        name: "ExpenseDraft",
        data(){return{
            expense:{name:null,category:null,amount:null},
            expenses:[],
            categories:['Income','Emergency Fund','Housing','Installment','Black Tax','Savings','Health Care','Consumer Debt'],
            balance:0,
            budget:0,
            budgetAmount:0,
            totalExpense:0,
            editable:false,
            index:null,
            inputRules:[
                v => !!v || 'Field is required',
                v => (v && v.length >= 3) || 'Field must be at least than 3 characters'
            ]

        }},
        methods:{
            submit(){

                    this.budget = this.budgetAmount
                    this.budgetAmount = 0


            },
            edit(i){
                this.editable = true
                this.expense = this.expenses[i]
                this.index = i
            },
            update(){
                this.expenses[i] = this.expense
                this.expense = {name: null, category: null, amount: null}
                this.editable = false
            },
            destroy(i){

                this.expenses.splice(i,1)
                this.total()
            },
            add(){
                if(this.$refs.form.validate()) {
                    this.expenses.push(this.expense)
                    this.expense = {name: null, category: null, amount: null}
                    this.total()
                }
            },
            total(){
                let sum = 0
                for (var property in this.expenses){
                    sum += parseInt(this.expenses[property].amount)
                }
                this.totalExpense = sum
                this.balance = parseInt(this.budget) - parseInt(this.totalExpense)
            }

        },

    }
</script>

<style scoped>

</style>