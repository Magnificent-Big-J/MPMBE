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
                            <small class="text-danger" v-if="errors.destination">{{errors.destination[0]}}</small>
                        </v-flex>
                        <v-flex md5 class="ml-2">

                            <v-text-field label="Cost" v-model="vacation.cost"></v-text-field>
                            <small class="text-danger" v-if="errors.cost">{{errors.cost[0]}}</small>
                        </v-flex>
                    </v-layout>
                    <v-layout row wrap class="pa-3">
                        <v-flex md6 >
                            <v-menu>
                                <v-text-field :value="vacation.start"  slot="activator" label="Start Date" prepend-icon="date_range"></v-text-field>
                                <v-date-picker v-model="vacation.start" ></v-date-picker>
                            </v-menu>
                            <v-spacer></v-spacer>
                            <small class="text-danger" v-if="errors.start">{{errors.start[0]}}</small>
                        </v-flex>
                        <v-flex md5>
                            <v-menu>
                                <v-text-field :value="vacation.end"  slot="activator" label="End Date" prepend-icon="date_range"></v-text-field>
                                <v-date-picker v-model="vacation.end" ></v-date-picker>
                            </v-menu>
                            <v-spacer></v-spacer>
                            <small class="text-danger" v-if="errors.end">{{errors.end[0]}}</small>
                        </v-flex>
                    </v-layout>
                    <v-layout row wrap class="pa-3">
                        <v-flex m6>
                            <v-select
                                    :items="options"
                                    label="Status"
                                    v-model="vacation.status"
                            ></v-select>
                            <small class="text-danger" v-if="errors.status">{{errors.status[0]}}</small>
                        </v-flex>
                    </v-layout>
                    <v-layout row wrap class="pa-3">
                        <v-flex md6>

                            <v-text-field label="Adults" v-model="vacation.adults"></v-text-field>
                            <small class="text-danger" v-if="errors.adults">{{errors.adults[0]}}</small>
                        </v-flex>
                        <v-flex md5 class="ml-2">

                            <v-text-field label="Children" v-model="vacation.children"></v-text-field>
                            <small class="text-danger" v-if="errors.children">{{errors.children[0]}}</small>
                        </v-flex>
                    </v-layout>
                    <v-layout row wrap class="pa-3">
                        <v-flex xs12 sm4 md4>
                            <v-checkbox
                                    v-model="vacation.activities"
                                    label="Culture"
                                    value="Culture"
                                    hide-details
                            ></v-checkbox>
                            <v-checkbox
                                    v-model="vacation.activities"
                                    label="Outdours"
                                    value="Outdours"
                                    hide-details
                            ></v-checkbox>
                            <v-checkbox
                                    v-model="vacation.activities"
                                    label="Shopping"
                                    value="Shopping"
                                    hide-details
                            ></v-checkbox>
                        </v-flex>
                        <v-flex xs12 sm4 md4>
                            <v-checkbox
                                    v-model="vacation.activities"
                                    label="Relaxing"
                                    value="Relaxing"
                                    hide-details
                            ></v-checkbox>
                            <v-checkbox
                                    v-model="vacation.activities"
                                    label="Beaches"
                                    value="Beaches"
                                    hide-details
                            ></v-checkbox>
                            <v-checkbox
                                    v-model="vacation.activities"
                                    label="Wildlife"
                                    value="Wildlife"
                                    hide-details
                            ></v-checkbox>
                        </v-flex>
                        <v-flex xs12 sm4 md4>
                            <v-checkbox
                                    v-model="vacation.activities"
                                    label="Historic Sites"
                                    value="Historic Sites"
                                    hide-details
                            ></v-checkbox>

                            <v-checkbox
                                    v-model="vacation.activities"
                                    label="Museums"
                                    value="Museums"
                                    hide-details
                            ></v-checkbox>
                            <v-checkbox
                                    v-model="vacation.activities"
                                    label="Romantic"
                                    value="Romantic"
                                    hide-details
                            ></v-checkbox>
                            <small class="text-danger" v-if="errors.activities">{{errors.activities[0]}}</small>
                        </v-flex>

                    </v-layout>
                    <v-card-actions>
                        <v-btn color="info" v-if="editable" @click="update">Update</v-btn>
                        <v-btn color="info" v-else @click="submit">Add Vacation</v-btn>
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
                                            <v-icon left>waves</v-icon> <span v-for="(activity,i) in vacation.activities" >{{activity}} |</span>
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
                <v-card-actions>
                    <v-pagination
                            v-model="pagination.current"
                            :length="pagination.total"
                            @input="onPageChange"
                    ></v-pagination>
                </v-card-actions>
            </v-container>


        </v-card>
    </div>
</template>

<script>
    export default {
        name: "Vacations",
        data(){return{
            vacations:[
                   ],
            vacation:{destination:null,start:null,end:null,adults:null,children:null,activities:[],cost:null,status:null},
            options:['Going', 'New','Cancelled'],
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
                this.vacation = this.vacations[i]
                this.index = i
            },
            update(){

                axios.put('/api/vacations/'+this.vacation.id,this.vacation)
                    .then((response)=>{
                        this.editable = false
                        this.vacation = {destination:null,start:null,end:null,adults:null,children:null,activities:[],cost:null}
                        this.message = response.data.message
                        this.vacations[this.index] = response.data.vacation
                        this.snackbar = true
                    })

            },
            submit(){
                this.message = "Expense Successfully Added"
                axios.post('/api/vacations',this.vacation)
                    .then((response)=>{
                        this.vacations.push(response.data.vacation)
                        this.message = response.data.message
                        this.snackbar = true
                        this.vacation = {destination:null,start:null,end:null,adults:null,children:null,activities:[],cost:null}
                    })
                    .catch((errors)=>{
                        this.errors = errors.response.data.errors
                    })

            },
            destroy(i){
                axios.delete('/api/vacations/'+this.vacations[i].id)
                    .then((response)=>{
                        this.vacations.splice(i,1)
                        this.message = response.message
                    })

            },
            get_vacations(){
                axios.get('/api/vacations?page='+this.pagination.current)
                    .then((response)=>{
                        this.vacations = response.data.data
                        this.pagination.current = response.data.meta.current_page
                        this.pagination.total = response.data.meta.last_page
                    })
            },
            onPageChange(){
                this.get_vacations()
            }
        },
        created() {
            if(!User.loggedIn()){
                this.$router.push("/")
            }
            this.get_vacations()
        }
    }
</script>

<style scoped>

</style>