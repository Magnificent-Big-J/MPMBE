<template>
    <div class="mt-5">
        <h1>Dashboard</h1>

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
                                    <div class="flex xs8 caption"><span>R{{dashData.budget}}</span><!----></div>
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
                                    <div class="flex xs8 caption"><span>{{dashData.completeExpense}}&nbsp;</span><!----></div>
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
                                    <div class="flex xs8 caption"><span>{{dashData.outstanding}}&nbsp;</span><!----></div>
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
                                    <div class="flex xs8 caption"><span>{{dashData.noVacation}}&nbsp;</span><!----></div>
                                    <div class="flex xs4 text-xs-right">Cost: R{{dashData.vacationAmount}}<span></span></div>
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
                                    <div class="flex xs8 caption"><span>{{dashData.noUplanned}}&nbsp;</span><!----></div>
                                    <div class="flex xs4 text-xs-right">Cost: R{{dashData.unplannedAmount}}<span></span></div>
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
                                    <div class="flex xs8 caption"><span>R{{dashData.savings}}&nbsp;</span><!----></div>
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
                            <chartjs-line v-if="labels.length > 0" :labels="labels" :datasets="datasets" :option="options"></chartjs-line>
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
            dashData:{},
            expenses:[],
            labels:[],
            datasets:[
                {
                    label:null,
                    data:[],
                    backgroundColor:'#3cba9f',
                    borderColor:'#3cba9f',
                    fill:false,
                    pointStyle:'line'
                },
                {
                    label:null,
                    data:[],
                    backgroundColor:'#3e95cd',
                    borderColor:'#3e95cd',
                    fill:false
                }
            ],
            options:{
                title:{
                    display:true,
                    position:"bottom",
                    text:'Two Months Expenses Overview'
                }
            },

        }},
        methods:{
            get_dashboardData(){
                axios.get('/api/dashboard')
                    .then((response)=>{
                        this.dashData = response.data
                        this.expenses = this.dashData.expenses
                    })
            },
            get_graphData(){
                axios.get('/api/graphData')
                    .then((response)=>{
                        this.labels = response.data.labels

                        this.datasets[0].data = response.data.data1
                        this.datasets[1].data = response.data.data2
                        this.datasets[0].label = response.data.label1
                        this.datasets[1].label = response.data.label2
                    })
                    .catch((error)=>{

                        Exception.isExpired(error.response.data.error)
                    })
            }
        },
        created() {
            if(!User.loggedIn()){
                this.$router.push("/")
            }
            this.get_dashboardData()
            this.get_graphData()
        }
    }
</script>

<style scoped>

</style>