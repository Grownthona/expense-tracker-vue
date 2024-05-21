<template>
    <div>
        <form @submit.prevent="submitForm">
            <div>
                <label for="category">Category</label>
                <select name="category" v-model="formValues.category" >
                    <option v-for="(data,index) in tempcategory" :key="index" :value="data.name">{{ data.name}}</option>
                </select>
            </div>
            <div>
                <label for="amount">Amount</label>
                <input type="text" id="amount" v-model="formValues.amount">
            </div>
            <div>
                <label for="total">Total Monthly Amount</label>
                <input type="text" id="total" v-model="formValues.total">
            </div>
            <div>
                <button type="submit">Sign In</button>
            </div>
        </form>
    </div>
 </template>


<script>
 import axios from 'axios';
export default{
    name : 'AddBudget',
    created(){
        this.getData()
    },
    data() {
        return {
            
            formValues: {
                category:'',
                amount :'',
                total :'',
                user_id : ''
            },
            tempcategory :[]
        }
    },
    methods:{
    getData(){
        this.formValues.user_id = window.localStorage.getItem('id') 
        axios.get('http://127.0.0.1:8000/category')
      .then((response) => this.tempcategory=response.data)
      .catch((error) => console.log(error));
    },
    submitForm(){
        
        axios.post('http://127.0.0.1:8000/addBudget',this.formValues)
        .then((response) => {
            console.log(response);
        })
        .catch((error) => console.log(error));
    },
   }
}
</script>