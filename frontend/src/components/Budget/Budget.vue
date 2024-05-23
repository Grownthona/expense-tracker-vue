<template>
    <div>
        <button @click="AddBudget">Add Budget</button>
        <div v-if="checkBudget === true">
            <table>
                <tr>
                    <th >Category</th>
                    <th >Amount</th>
                    <th >Monthly Total</th>
                    <th >Month</th>
                    <th >Update</th>
                </tr>
                <tr v-for="(data,index) in budgets" :key="index" class="table-rows">
                    <td>{{ data.category }}</td>
                    <td>{{ data.amount }}</td>
                    <td>{{ data.total }}</td>
                    <td>{{ data.month }}</td>
                    <td><button @click="openModal(data.id)">Update</button></td>
                </tr>
            </table>
            <UpdateBudget :visible="showModal" :id="userId" @close="showModal = false"></UpdateBudget>
        </div>
        <div v-else-if="checkBudget === false">
            <p> No Budget Added yet!</p>
        </div>
    </div>
 </template>


<script>
 import axios from 'axios';
import UpdateBudget from './UpdateBudget.vue';

export default{
    name : 'Budget',
    components: {
        UpdateBudget,
   },
    created(){
        this.getBudget();
    },
    data() {
        return {
            budgets:[],
            checkBudget : false,
            showModal : false,
            userId : 0
        }
    },
    methods:{
        openModal(id){
            this.userId = id;
            this.showModal = true;
        },
        AddBudget(){
            this.$router.push('AddBudget');
        },
        async getBudget(){
            try{
            let budget = [];
            const userID = parseInt(window.localStorage.getItem('id'));
            let response = await axios.get(`http://127.0.0.1:8000/budget/${userID}`);

            if(response.status === 200){
                this.userId = userID;
                this.checkBudget = true;
                this.budgets =response.data;
            }else{
                this.checkBudget = false;
            }
        }catch (error) {
            console.error('Error fetching budgets:', error);
        }
        }
    }
}
</script>