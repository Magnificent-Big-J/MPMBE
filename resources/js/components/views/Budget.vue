<template>
    <div class="mt-5">
        <h1>Budget Here</h1>
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
                                   <v-menu>
                                       <v-text-field :value="budget.date"  slot="activator" label="Budget Date" prepend-icon="date_range"></v-text-field>
                                       <v-date-picker v-model="budget.date" ></v-date-picker>
                                   </v-menu>

                               </v-flex>
                               <v-flex md6>
                                   <v-text-field label="Income" v-model="budget.income" prepend-icon="money"></v-text-field>
                                   <v-text-field label="Savings" v-model="budget.savings" prepend-icon="money"></v-text-field>
                               </v-flex>
                           </v-layout>
                           <v-btn color="warning" v-if="editable">Update</v-btn>
                           <v-btn color="info" v-else>Add</v-btn>

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
            budgets:[
                {amount:23000,date:'2019-01-30',income:40000,savings:10000},
                {amount:22000,date:'2019-02-28',income:40000,savings:11000},
                {amount:21000,date:'2019-03-30',income:40000,savings:12000},
                {amount:23000,date:'2019-04-30',income:40000,savings:10000},
            ],
            snackbar:false,
            message:null,
            editable:false
        }},
        methods:{
            edit(i){
                this.editable = true
                this.budget = this.budgets[i]
            },
            update(){
                this.editable = false
                this.budget = {amount:null,date:null,income:null,savings:null}
                this.message = "Budget Successfully updated"
                this.snackbar = true
            },
            submit(){
                this.message = "Budget Successfully Added"
                this.snackbar = true
            },
            destroy(i){
                this.budgets.splice(i,1)
                this.message = "Budget Successfully Deleted"
                this.snackbar = true
            }

        }
    }
</script>

<style scoped>

</style>