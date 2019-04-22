<template>
    <div class="mt-5">
        <h1>Vacations Here</h1>
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
            <v-card-text>
                <v-form>
                    <v-layout row wrap class="pa-3">
                        <v-flex md6>

                            <v-text-field label="Destination" v-model="vacation.destination"></v-text-field>
                        </v-flex>
                        <v-flex md5 class="ml-2">

                            <v-text-field label="Cost" v-model="vacation.cost"></v-text-field>
                        </v-flex>
                    </v-layout>
                    <v-layout row wrap class="pa-3">
                        <v-flex md6 >
                            <v-menu>
                                <v-text-field :value="vacation.start"  slot="activator" label="Start Date" prepend-icon="date_range"></v-text-field>
                                <v-date-picker v-model="vacation.start" ></v-date-picker>
                            </v-menu>

                        </v-flex>
                        <v-flex md5>
                            <v-menu>
                                <v-text-field :value="vacation.end"  slot="activator" label="End Date" prepend-icon="date_range"></v-text-field>
                                <v-date-picker v-model="vacation.end" ></v-date-picker>
                            </v-menu>

                        </v-flex>
                    </v-layout>
                    <v-layout row wrap class="pa-3">
                        <v-flex m6>
                            <v-select
                                    :items="options"
                                    label="Status"
                                    v-model="vacation.status"
                            ></v-select>
                        </v-flex>
                    </v-layout>
                    <v-layout row wrap class="pa-3">
                        <v-flex md6>

                            <v-text-field label="Adults" v-model="vacation.adults"></v-text-field>
                        </v-flex>
                        <v-flex md5 class="ml-2">

                            <v-text-field label="Children" v-model="vacation.children"></v-text-field>
                        </v-flex>
                    </v-layout>
                    <v-layout row wrap class="pa-3">
                        <v-flex xs12 sm4 md4>
                            <v-checkbox
                                    v-model="vacation.activies"
                                    label="Culture"
                                    value="Culture"
                                    hide-details
                            ></v-checkbox>
                            <v-checkbox
                                    v-model="vacation.activies"
                                    label="Outdours"
                                    value="Outdours"
                                    hide-details
                            ></v-checkbox>
                            <v-checkbox
                                    v-model="vacation.activies"
                                    label="Shopping"
                                    value="Shopping"
                                    hide-details
                            ></v-checkbox>
                        </v-flex>
                        <v-flex xs12 sm4 md4>
                            <v-checkbox
                                    v-model="vacation.activies"
                                    label="Relaxing"
                                    value="Relaxing"
                                    hide-details
                            ></v-checkbox>
                            <v-checkbox
                                    v-model="vacation.activies"
                                    label="Beaches"
                                    value="Beaches"
                                    hide-details
                            ></v-checkbox>
                            <v-checkbox
                                    v-model="vacation.activies"
                                    label="Wildlife"
                                    value="Wildlife"
                                    hide-details
                            ></v-checkbox>
                        </v-flex>
                        <v-flex xs12 sm4 md4>
                            <v-checkbox
                                    v-model="vacation.activies"
                                    label="Historic Sites"
                                    value="Historic Sites"
                                    hide-details
                            ></v-checkbox>

                            <v-checkbox
                                    v-model="vacation.activies"
                                    label="Museums"
                                    value="Museums"
                                    hide-details
                            ></v-checkbox>
                            <v-checkbox
                                    v-model="vacation.activies"
                                    label="Romantic"
                                    value="Romantic"
                                    hide-details
                            ></v-checkbox>
                        </v-flex>

                    </v-layout>
                    <v-card-actions>
                        <v-btn color="info" @click="submit">Add Vacation</v-btn>
                    </v-card-actions>

                </v-form>
            </v-card-text>
            <v-container grid-list-md>
                <v-layout row wrap>
                    <v-flex v-for="(vacation,index) in vacations" :key="vacation.destination" xs6>
                        <v-card>
                            <v-card-text>
                                <v-layout row wrap>
                                    <v-flex xs12>
                                        <div class="subheading">
                                            <v-icon left>flight_takeoff</v-icon> {{vacation.destination}}
                                        </div>
                                    </v-flex>
                                    <v-flex xs12>
                                        <div class="subheading">
                                            <v-icon left>date_range</v-icon> {{vacation.start}} - {{vacation.end}}
                                        </div>
                                    </v-flex>
                                    <v-flex xs12>
                                        <div class="subheading">
                                            <v-icon left>people</v-icon>
                                            Adults: {{vacation.adults}}  Children: {{vacation.children}}
                                        </div>
                                    </v-flex>
                                    <v-flex xs12>
                                        <div class="subheading">
                                            <v-icon left>replay_10</v-icon> {{vacation.duration}} Day(s)
                                        </div>
                                    </v-flex>
                                    <v-flex xs12>
                                        <div class="subheading">
                                            <v-icon left>money</v-icon> R{{vacation.cost}}
                                        </div>
                                    </v-flex>
                                    <v-flex xs12>
                                        <div class="subheading">
                                            <v-icon left>textsms</v-icon> {{vacation.status}}
                                        </div>
                                    </v-flex>
                                    <v-flex xs12>
                                        <div class="subheading">
                                            <v-icon left>waves</v-icon> <span v-for="activity in vacation.activies" :key="activity">{{activity}} |</span>
                                        </div>
                                    </v-flex>
                                </v-layout>

                            </v-card-text>
                            <v-card-actions>
                                <v-card-actions>
                                    <v-btn small icon>
                                        <v-icon color="orange" @click="edit(index)">edit</v-icon>
                                    </v-btn>
                                    <v-btn small icon>
                                        <v-icon color="red" @click="destroy(index)">delete</v-icon>
                                    </v-btn>

                                </v-card-actions>
                            </v-card-actions>
                        </v-card>
                        <v-divider></v-divider>
                    </v-flex>
                </v-layout>
            </v-container>


        </v-card>
    </div>
</template>

<script>
    export default {
        name: "Vacations",
        data(){return{
            vacations:[
                {destination:"Thailand",start:'2019-12-21',end:'2019-12-28',duration:6,adults:2,children:0,activies:['Culture', 'Outdours','Relaxing','Romantic','Beaches','Historic Sites','Museums','Shopping','Wildlife'],cost:30000,status:'Going'},
                {destination:"Mauritius",start:'2019-05-03',end:'2019-03-06',duration:3,adults:2,children:0,activies:['Culture', 'Outdours','Relaxing','Romantic','Beaches','Wildlife'],cost:20000,status:'New'},
                {destination:"Durban",start:'2019-11-04',end:'2019-11-06',duration:2,adults:2,children:1,activies:['Culture', 'Outdours','Relaxing','Romantic','Beaches','Wildlife','Museums'],cost:15000,status:'New'},
                {destination:"Cape Town",start:'2019-08-11',end:'2019-09-19',duration:8,adults:2,children:1,activies:['Culture', 'Outdours','Relaxing','Romantic','Beaches','Wildlife','Museums'],cost:20000,status:'New'},
                  ],
            vacation:{destination:null,start:null,end:null,adults:null,children:null,activies:[],cost:null,status:null},
            options:['Going', 'New','Cancelled'],
            editable:false,
            snackbar:false,
            message:null

        }},
        methods:{
            edit(i){
                this.editable = true
                this.vacation = this.vacations[i]
            },
            update(){
                this.editable = false
                this.vacation = {destination:null,start:null,end:null,adults:null,children:null,activies:['Culture', 'Outdours','Relaxing','Romantic','Beaches','Historic Sites','Museums','Shopping','Wildlife'],cost:null}
                this.message = "Expense Successfully updated"
                this.snackbar = true
            },
            submit(){
                this.message = "Expense Successfully Added"
                this.vacations.push(this.vacation)
                this.snackbar = true
            },
            destroy(i){
                this.vacations.splice(i,1)
            }
        }
    }
</script>

<style scoped>

</style>