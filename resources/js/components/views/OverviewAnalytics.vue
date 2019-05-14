<template>
    <div class="mt-5">
        <h1>Overview Analytics</h1>
        <div class="container fluid pa-0 grid-list-xl">
            <v-card>
                <div class="layout wrap">
                    <div class="flex xs6 md4">
                        <div class="v-card v-sheet v-sheet--tile theme--light red">
                            <div class="v-card__text"><span class="title">Budget</span></div>
                        </div>
                        <div class="v-card v-sheet v-sheet--tile theme--light red base white--text">
                            <div class="v-card__text"><div class="layout">
                                <div class="flex xs8 caption"><span>R{{overview.budget}}&nbsp;&nbsp;</span><!----></div>
                                <div class="flex xs4 text-xs-right"><span></span></div>
                            </div>
                            </div>
                        </div>

                    </div>
                    <div class="flex xs6 md4">
                        <div class="v-card v-sheet v-sheet--tile theme--light pink">
                            <div class="v-card__text"><span class="title">Expenses</span></div>
                        </div>
                        <div class="v-card v-sheet v-sheet--tile theme--light pink base white--text">
                            <div class="v-card__text"><div class="layout">
                                <div class="flex xs8 caption"><span>R{{overview.totalExpense}}&nbsp;</span><!----></div>
                                <div class="flex xs4 text-xs-right"><span></span></div>
                            </div>
                            </div>
                        </div>

                    </div>
                    <div class="flex xs6 md4">
                        <div class="v-card v-sheet v-sheet--tile theme--light light-blue">
                            <div class="v-card__text"><span class="title">Balance</span></div>
                        </div>
                        <div class="v-card v-sheet v-sheet--tile theme--light light-blue base white--text">
                            <div class="v-card__text"><div class="layout">
                                <div class="flex xs8 caption"><span>R{{overview.balance}}&nbsp;</span><!----></div>
                                <div class="flex xs4 text-xs-right"><span></span></div>
                            </div>
                            </div>
                        </div>

                    </div>
                </div>
                <v-card class="mt-2 pa-3" >
                    <chartjs-line v-if="labels.length > 0" :labels="labels" :datasets="datasets" :option="options"></chartjs-line>
                    <chartjs-bar v-if="labels.length > 0" :labels="labels" :datasets="datasets" :option="options"></chartjs-bar>

                </v-card>
            </v-card>
        </div>
    </div>
</template>

<script>

    export default {

        name: "OverviewAnalytics",
        data(){return{
            overview:{}
            ,
            labels:[],
            datasets:[
                {
                    label:null,
                    data:[],
                    backgroundColor:'#3cba9f',
                    borderColor:'#3cba9f',
                    fill:false,
                    pointStyle:'bar'
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
                    text:'Expenses Overview'
                }
            }
        }},
        methods:{
            overViewData(){
                axios.get('/api/overview')
                    .then((response)=>{
                        this.overview = response.data
                    })
                    .catch((error)=>{

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

                    })
            }
        },
        created() {
            if(!User.loggedIn()){
                this.$router.push("/")
            }
            this.overViewData()
            this.get_graphData()
        },



    }
</script>

<style scoped>

</style>