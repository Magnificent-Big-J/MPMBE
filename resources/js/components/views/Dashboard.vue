<template>
    <div class="mt-5">
        <h1>Dashboard Here</h1>

        <div class="container fluid pa-0 grid-list-xl">
            <v-card>
                <v-card-title>
                    <div class="headline pa-0">Recent Overview</div>
                </v-card-title>
                <v-card-text>
                    <div class="layout wrap">

                        <div class="flex xs6 md4">
                            <div class="v-card v-sheet v-sheet--tile theme--light red">
                                <div class="v-card__text"><span class="title">Budget</span></div>
                            </div>
                            <div class="v-card v-sheet v-sheet--tile theme--light red base white--text">
                                <div class="v-card__text"><div class="layout">
                                    <div class="flex xs8 caption"><span>R40000&nbsp;</span><!----></div>
                                    <div class="flex xs4 text-xs-right"><span></span></div>
                                </div>
                                </div>
                            </div>

                        </div>
                        <div class="flex xs6 md4">
                            <div class="v-card v-sheet v-sheet--tile theme--light pink">
                                <div class="v-card__text"><span class="title">Completed Expenses</span></div>
                            </div>
                            <div class="v-card v-sheet v-sheet--tile theme--light pink base white--text">
                                <div class="v-card__text"><div class="layout">
                                    <div class="flex xs8 caption"><span>23&nbsp;</span><!----></div>
                                    <div class="flex xs4 text-xs-right"><span></span></div>
                                </div>
                                </div>
                            </div>

                        </div>
                        <div class="flex xs6 md4">
                            <div class="v-card v-sheet v-sheet--tile theme--light light-blue">
                                <div class="v-card__text"><span class="title">Not Completed Expenses</span></div>
                            </div>
                            <div class="v-card v-sheet v-sheet--tile theme--light light-blue base white--text">
                                <div class="v-card__text"><div class="layout">
                                    <div class="flex xs8 caption"><span>12&nbsp;</span><!----></div>
                                    <div class="flex xs4 text-xs-right"><span></span></div>
                                </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="layout wrap">

                        <div class="flex xs6 md4">
                            <div class="v-card v-sheet v-sheet--tile theme--light deep-orange">
                                <div class="v-card__text"><span class="title">Vacations</span> <v-spacer></v-spacer></div>
                            </div>
                            <div class="v-card v-sheet v-sheet--tile theme--light deep-orange base white--text">
                                <div class="v-card__text"><div class="layout">
                                    <div class="flex xs8 caption"><span>2&nbsp;</span><!----></div>
                                    <div class="flex xs4 text-xs-right">Cost: R35000<span></span></div>
                                </div>
                                </div>
                            </div>

                        </div>
                        <div class="flex xs6 md4">
                            <div class="v-card v-sheet v-sheet--tile theme--light amber ">
                                <div class="v-card__text"><span class="title">Unplanned Expenses</span></div>
                            </div>
                            <div class="v-card v-sheet v-sheet--tile theme--light amber  base white--text">
                                <div class="v-card__text"><div class="layout">
                                    <div class="flex xs8 caption"><span>14&nbsp;</span><!----></div>
                                    <div class="flex xs4 text-xs-right">Cost: R11000<span></span></div>
                                </div>
                                </div>
                            </div>

                        </div>
                        <div class="flex xs6 md4">
                            <div class="v-card v-sheet v-sheet--tile theme--light teal">
                                <div class="v-card__text"><span class="title">Savings</span></div>
                            </div>
                            <div class="v-card v-sheet v-sheet--tile theme--light teal base white--text">
                                <div class="v-card__text"><div class="layout">
                                    <div class="flex xs8 caption"><span>R2000&nbsp;</span><!----></div>
                                    <div class="flex xs4 text-xs-right"><span></span></div>
                                </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <v-card class="mt-2">
                        <v-card-title>
                            <div class="headline pa-0">Two Months Overview</div>
                        </v-card-title>
                        <v-card-text>
                            <chartjs-line :labels="labels" :datasets="datasets" :option="options"></chartjs-line>
                        </v-card-text>
                    </v-card>
                    <v-card class="mt-2 pa-3" >
                        <v-card-title>
                            <div class="headline pa-0">Recent Expenses</div>
                        </v-card-title>
                        <v-layout row wrap v-for="expense in expenses" :key="expense.name">
                            <v-flex xs12 md6>
                                <div class="caption grey--text">
                                    Expense
                                </div>
                                <div>{{expense.name}}</div>
                            </v-flex>
                            <v-flex xs6 sm4 md2>
                                <div class="caption grey--text">
                                    Category
                                </div>
                                <div>{{expense.category}}</div>
                            </v-flex>
                            <v-flex xs6 sm4 md2>
                                <div class="caption grey--text">
                                    Amount
                                </div>
                                <div>R {{expense.amount}}</div>
                            </v-flex>
                            <v-flex xs6 sm4 md2>
                                <div class="caption grey--text">
                                    Status
                                </div>
                                <div>
                                    <v-chip small>{{expense.status}}</v-chip>
                                </div>
                            </v-flex>
                            <v-divider></v-divider>
                        </v-layout>

                    </v-card>
                </v-card-text>
            </v-card>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Dashboard",
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
            labels:['Car Insurance','House Hold 1','House Hold 3','Food and Groceries','Helper','Car','Petrol','Medical Aid','Pension Fund'],
            datasets:[
                {
                    label:'March',
                    data:[1523,1000,1000,1523,800,4000,4000,2000,1523],
                    backgroundColor:'blue',
                    borderColor:'blue',
                    fill:false,
                    pointStyle:'line'
                },
                {
                    label:'April',
                    data:[1523,1000,1000,1523,800,5000,3000,1523,1200],
                    backgroundColor:'green',
                    borderColor:'green',
                    fill:false
                }
            ],
            options:{
                title:{
                    display:true,
                    position:"bottom",
                    text:'Expenses Overview'
                }
            }
        }},
        created() {
            if(!User.loggedIn()){
                this.$router.push("/")
            }
        }
    }
</script>

<style scoped>

</style>