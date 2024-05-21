<template>
    <div>
        Dashboard {{ user_id }} 
        <nav>
            <router-link to="/budget">Budget</router-link>
        </nav>
    </div>
 </template>


 <script>
 //import axios from 'axios';
 import { RouterLink, RouterView } from 'vue-router';
 export default{
    name : 'Dashboard',
    created(){
        this.getData()
    },
     data() {
        return{
            user_id : '',
        }
   },
   methods:{
    getData(){
        this.user_id = window.localStorage.getItem('id') 
    },
   }
 }
 </script>
