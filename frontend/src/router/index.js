
import { createRouter, createWebHistory } from 'vue-router';
import App from '@/App.vue';
import SignUp from '@/components/User/SignUp.vue';
import SignIn from '@/components/User/SignIn.vue';
import Dashboard from '@/components/Home/Dashboard.vue';
import Budget from '@/components/Budget/Budget.vue';
import AddBudget from '@/components/Budget/AddBudget.vue';
import Expense from '@/components/Expense/Expense.vue';

const routes = [
  {
    path: '/',
    name: '',
    component: App,
  },
  {
    path: '/register',
    name: 'SignUp',
    component: SignUp,
  },
  {
    path: '/login',
    name: 'SignIn',
    component: SignIn,
  },
  {
    path: '/dashboard',
    name: 'Dashboard',
    component: Dashboard,
    props: true
  },
  {
    path: '/budget',
    name: 'Budget',
    component: Budget,
  },
  {
    path: '/addbudget',
    name: 'AddBudget',
    component: AddBudget,
  },
  {
    path: '/expense',
    name: 'Expense',
    component: Expense,
  },
]

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes
})

export default router
