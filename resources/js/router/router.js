import Vue from 'vue'
import VueRouter from 'vue-router'
import Dashboard from '../components/views/Dashboard.vue'
import Categories from '../components/views/Categories.vue'
import Expenses from '../components/views/Expenses.vue'
import OverView from '../components/views/OverviewAnalytics.vue'
import Vacations from '../components/views/Vacations.vue'
import Budget from '../components/views/Budget.vue'
import ExpenseDraft from '../components/views/ExpenseDraft.vue'
import Login from '../components/views/Login.vue'
import Admin from  '../components/Admin.vue'
import Social from '../components/views/Social.vue'

Vue.use(VueRouter)

const routes = [
    {path:'/',component:Login},
    {
        path:'/admin',
        component:Admin,
        name:'admin',
        children:[
            {path:'/categories',component:Categories},
            {path:'/dashboard',component:Dashboard,name:'dashboard'},
            {path:'/expenses',component:Expenses},
            {path:'/overview-analytics',component:OverView},
            {path:'/vacations',component:Vacations},
            {path:'/budget',component:Budget},
            {path:'/draft',component:ExpenseDraft},
            {path:'/social',component:Social},
        ]
    }


]

const router = new VueRouter({
    routes,
    hasbang:false,
    mode:'history'
})

export  default  router