<template>
    <div>
        <button @click="AddBudget">Add Budget</button>
        <div>

        </div>
    </div>
 </template>


<script>
 import axios from 'axios';
export default{
    name : 'Budget',
    created(){
        this.getBudget();
    },
    data() {
        return {
            budgets:[]
        }
    },
    methods:{
        AddBudget(){
            this.$router.push('AddBudget');
        },
        getBudget(){
            axios.get('http://127.0.0.1:8000/budget')
            .then((response) => console.log(response))
            .catch((error) => console.log(error));
        }
    }
}
</script>