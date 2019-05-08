<template>
    <div class="mt-5">
        <h1>Overview Analytics Here</h1>
        <div class="container fluid pa-0 grid-list-xl">
            <v-card>
                <div class="layout wrap">
                    <div class="flex xs6 md4">
                        <div class="v-card v-sheet v-sheet--tile theme--light red">
                            <div class="v-card__text"><span class="title">Budget</span></div>
                        </div>
                        <div class="v-card v-sheet v-sheet--tile theme--light red base white--text">
                            <div class="v-card__text"><div class="layout">
                                <div class="flex xs8 caption"><span>R40000&nbsp;&nbsp;</span><!----></div>
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
                                <div class="flex xs8 caption"><span>R350000&nbsp;</span><!----></div>
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
                                <div class="flex xs8 caption"><span>R5000&nbsp;</span><!----></div>
                                <div class="flex xs4 text-xs-right"><span></span></div>
                            </div>
                            </div>
                        </div>

                    </div>
                </div>
                <v-card class="mt-2 pa-3" >
                    <chartjs-line :labels="labels" :datasets="datasets" :option="options"></chartjs-line>

                </v-card>
            </v-card>
        </div>
    </div>
</template>

<script>

    export default {

        name: "OverviewAnalytics",
        data(){return{
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