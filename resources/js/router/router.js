import Vue from 'vue'
import VueRouter from 'vue-router'
import Dashboard from '../components/views/Dashboard.vue'
import Categories from '../components/views/Categories.vue'
import Expenses from '../components/views/Expenses.vue'
import OverView from '../components/views/OverviewAnalytics.vue'
import Vacations from '../components/views/Vacations.vue'
import Budget from '../components/views/Budget.vue'
import ExpenseDraft from '../components/views/ExpenseDraft.vue'
Vue.use(VueRouter)

const routes = [
    {path:'/categories',component:Categories},
    {path:'/dashboard',component:Dashboard},
    {path:'/expenses',component:Expenses},
    {path:'/overview-analytics',component:OverView},
    {path:'/vacations',component:Vacations},
    {path:'/budget',component:Budget},
    {path:'/draft',component:ExpenseDraft},
]

const router = new VueRouter({
    routes
})

export  default  router