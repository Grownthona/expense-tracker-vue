<template>
    <div>
        Dashboard {{ user_id }} 
        <nav>
            <router-link to="/budget">Budget</router-link>
            <router-link to="/expense">Expense</router-link>
        </nav>
        <h1>Monthly Budget : {{ monthlyBudget }}</h1>
        <h1>Total Estimated Budget : {{ total }}</h1>
        <h1>Total Expense : {{ totalExpense }}</h1>
        <h1>Remaining : {{ monthlyBudget - totalExpense }}</h1>
    </div>
 </template>


 <script>
 import axios from 'axios';
 import { RouterLink, RouterView } from 'vue-router';
 export default{
    name : 'Dashboard',
    created(){
        this.getData(),
        this.getBudget(),
        this.getExpense()
    },
     data() {
        return{
            user_id : '',
            budgets : [],
            expense : [],
            monthlyBudget : 0
        }
   },
   methods:{
    getData(){
        this.user_id = window.localStorage.getItem('id') 
    },
    async getBudget(){
            try{
           
            const userID = parseInt(window.localStorage.getItem('id'));
            let response = await axios.get(`http://127.0.0.1:8000/budget/${userID}`);
            
            if(response.status === 200){
                this.budgets =response.data;
                this.monthlyBudget = this.budgets[0].total;
            }
        }catch (error) {
            console.error('Error fetching budgets:', error);
        }
        },
        async getExpense(){
            try{
            
            const userID = parseInt(window.localStorage.getItem('id'));
            let response = await axios.get(`http://127.0.0.1:8000/expense/${userID}`);

            if(response.status === 200){
                this.expense =response.data;
            }
        }catch (error) {
            console.error('Error fetching budgets:', error);
        }
        }
   },
   computed :{
    total(){
        return this.budgets.reduce((total,cur)=>(total = total + cur.amount),0); 
    },
    totalExpense(){
        return this.expense.reduce((total,cur)=>(total = total + cur.expense),0); 
    },
   },
 }
 </script>
