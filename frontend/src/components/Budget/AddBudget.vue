<template>
    <div>
        <div v-if="hastotal === true">
        <form @submit.prevent="submitForm">
            <div>
                <div>
                    {{ total }}
                </div>
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
                <button type="submit">Add Budget</button>
            </div>
        </form>
        </div>
        <div v-else-if="hastotal === false">
            <p>Add total Monthly Budget</p>
            <form @submit.prevent="submitForm">
                <div>
                    <label for="total">Total Monthly Amount</label>
                    <input type="text" id="total" v-model="formValues.total">
                </div>
                <div>
                    <button type="submit">Add Total</button>
                </div>
            </form>
        </div>
    </div>
 </template>


<script>
 import axios from 'axios';
export default{
    name : 'AddBudget',
    created(){
        this.getData();
        this.getMonthlyBudget();
       
    },
    data() {
        return {
            
            formValues: {
                category:'',
                amount :'',
                total :0,
                user_id : ''
            },
           
            hastotal : false,
            tempcategory :[],
            budgetData : [],
            monthTotal : 0
        
        }
    },
    methods:{
    getData(){
        this.formValues.user_id = window.localStorage.getItem('id'); 
        axios.get('http://127.0.0.1:8000/category')
      .then((response) => this.tempcategory=response.data)
      .catch((error) => console.log(error));
    },
    async getMonthlyBudget(){
        try{
            let budget = [];
            const userID = parseInt(window.localStorage.getItem('id'));
            let response = await axios.get(`http://127.0.0.1:8000/budget/${userID}`);

            if(response.status === 200){
                //let data = response.data;
                
                //const result = data.filter((x) => x.user_id===userID);
                //budget = result;
                this.budgetData =response.data;
                this.hastotal = true;
            }else{
                this.hastotal = false;
            }
        }catch (error) {
        console.error('Error fetching budgets:', error);
    }

    },
    
    submitForm(){
        
        if(!this.hastotal){
            this.hastotal = true;
        }else{
            const userID = parseInt(window.localStorage.getItem('id'));
            axios.post(`http://127.0.0.1:8000/addBudget/${userID}/${this.monthTotal}`,this.formValues)
            .then((response) => {
            alert(response.data.message);
        })
        .catch((error) => console.log(error));
        }
    },
   },
   computed :{
    total(){
        this.monthTotal = this.budgetData.reduce((total,cur)=>(total = total + cur.amount),0);
        return this.monthTotal;
    }
   },
   watch : {
    formValues:{
        handler(newValue,oldValue){
            if(newValue.amount > this.monthTotal){
                alert("You're exceeding the current month budget");
            }
        },
        deep: true
    }
   }
}
</script>