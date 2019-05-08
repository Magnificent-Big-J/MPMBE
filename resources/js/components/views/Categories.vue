<template>
    <div class="mt-5">
        <h1>Categories</h1>
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
                <v-card-title>
                    <h2>Manage Category</h2>
                </v-card-title>
                <v-card-text>
                    <v-form class="px-3">
                        <v-text-field label="Category" v-model="category.name"></v-text-field>
                        <v-select
                                :items="options"
                                label="Status"
                                v-model="category.status"
                        ></v-select>
                        <v-spacer></v-spacer>
                        <v-btn class="warning mx-0 mt-3" v-if="editable" @click="update">Update Category</v-btn>
                        <v-btn class="primary mx-0 mt-3" v-else @click="submit">Add Category</v-btn>
                    </v-form>

                   <v-card class="pa-4 mt-2">
                       <v-layout row wrap>
                           <v-flex xs6 md4>
                               <div class="subheadline">Category</div>

                           </v-flex>
                           <v-flex xs6 md4>
                               <div class="subheadline">Status</div>

                           </v-flex>
                           <v-flex xs6 md4>
                               <div class="subheadline">Actions</div>

                           </v-flex>
                       </v-layout>
                       <v-layout row wrap v-for="(category,index) in categories" :key="category.name">
                           <v-flex xs6 md4>

                               <div>{{category.name}}</div>
                           </v-flex>
                           <v-flex xs6 md4>

                               <div>{{category.status}}</div>
                           </v-flex>
                           <v-flex xs6 md4>

                               <v-card-actions>
                                   <v-btn small icon>
                                       <v-icon color="orange" @click="edit(index)">edit</v-icon>
                                   </v-btn>
                                   <!--v-btn-- small icon>
                                       <v-icon color="red" @click="destroy(index)">delete</v-icon>
                                   </v-btn-->
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
                </v-card-text>
            </v-card>
        </v-container>
    </div>
</template>

<script>
    export default {
        name: "Categories",
        data(){return{
            category:{name:null,status:null},
            options:['Active', 'Suspended','Not Active'],
            categories:[],
            editable:false,
            message:null,
            snackbar:false,
            pagination:{
                current:1,
                total:0
            },
            index:null
        }},
        methods:{
            edit(i){
                this.editable = true
                this.category = this.categories[i]
                this.index = i
            },
            update(){
               axios.put('/api/categories/'+ this.categories[this.index].id,this.category)
                   .then((response)=>{
                       this.editable = false
                       this.category = {name:null,status:null}
                       this.message = response.data.message
                       this.snackbar = true
                   })
            },
            submit(){
                axios.post('/api/categories',this.category)
                    .then((response)=>{
                        this.categories.push(response.data)
                        this.message = "Category Successfully Added"
                        this.snackbar = true
                    })
            },
            destroy(i){
                axios.delete('/api/categories/'+this.categories[i].id)
                    .then((response)=>{
                        this.message = response.data.message
                        this.categories.splice(i,1)
                        this.snackbar = true
                    })
            },
            get_categories(){
                axios.get('/api/categories?page='+this.pagination.current)
                    .then((response)=>{
                        this.categories = response.data.data
                        this.pagination.current = response.data.meta.current_page
                        this.pagination.total = response.data.meta.last_page
                    })
            },
            onPageChange(){
                this.get_categories()
            }
        },
        created() {
            if(!User.loggedIn()){
                this.$router.push("/")
            }
            this.get_categories()
        }
    }
</script>

<style scoped>

</style>