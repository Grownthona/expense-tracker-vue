<template>
    <div>
        <div>
            <button @click="showModal = true">Add Expense</button>
            <AddExpense :visible="showModal" @close="showModal = false"></AddExpense>
        </div>
        <div v-if="checkExpense === true">
            <table>
                <tr>
                    <th >Category</th>
                    <th >Budget</th>
                    <th >Expense</th>
                    <th >Description</th>
                    <th >Payment Method</th>
                    <th >Date</th>
                </tr>
                <tr v-for="(data,index) in expense" :key="index" class="table-rows">
                    <td>{{ data.category }}</td>
                    <td>{{ data.budget }}</td>
                    <td>{{ data.expense }}</td>
                    <td>{{ data.description }}</td>
                    <td>{{ data.payment_method }}</td>
                    <td>{{ data.date }}</td>
                </tr>
            </table>
           
        </div>
        <div v-else-if="checkExpense === false">
            <p> No Budget Added yet!</p>
        </div>
    </div>
 </template>


 <script>
 import axios from 'axios';

import AddExpense from './AddExpense.vue';
 export default{
    name : 'Expense',
    components: {
        AddExpense,
    },
    created(){
        this.getExpense();
    },
     data() {
        return{
            showModal : false,
            checkExpense : false,
            expense :[]
        }
   },
   methods :{
    openModel(){
        this.showModal = true;
    },
    async getExpense(){
            try{
            let budget = [];
            const userID = parseInt(window.localStorage.getItem('id'));
            let response = await axios.get(`http://127.0.0.1:8000/expense/${userID}`);

            if(response.status === 200){
                //this.userId = userID;
                this.checkExpense = true;
                this.expense =response.data;
            }else{
                this.checkExpense = false;
            }
        }catch (error) {
            console.error('Error fetching budgets:', error);
        }
        }
   }

 }
 </script>