<template>
    <div>
        <div>
            <div class="modal-overlay" v-if="visible" @click="close">
            <div class="modal-container" @click.stop>
                <button class="modal-close" @click="close">X</button>
                <div class="modal-content">
                    <form @submit.prevent="submitForm">
                        <div>
                            <label for="category">Category</label>
                            <select name="category" v-model="formValues.category" >
                                <option v-for="(data,index) in tempcategory" :key="index" :value="data.name">
                                    {{ data.name}}
                                </option>
                            </select>
                        </div>
                        <div>
                            <label for="amount">Amount</label>
                            <input type="text" id="amount" v-model="formValues.amount">
                        </div>
                        <div>
                            <label for="description">Description</label>
                            <input type="text" id="description" v-model="formValues.description">
                        </div>
                        <div>
                            <label for="payment">Payment</label>
                            <input type="text" id="payment" v-model="formValues.payment">
                        </div>
                        <div>
                            <button type="submit">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </div>
 </template>


 <script>
 import axios from 'axios';
 export default{
     name : 'AddExpense',
     props: {
        visible: {
            type: Boolean,
            required: true,
        },
    },
    created(){
        this.getBudget();
        this.getData();
    },
     data() {
        return{
            formValues: {
                category:'',
                amount :'',
                total :0,
                user_id : '',
                description : '',
                payment : ''
            },
            tempcategory : {},
            budget:{}
        }
   },
   methods:{
    getData(){
            //this.formValues.user_id = window.localStorage.getItem('id'); 
            axios.get('http://127.0.0.1:8000/category')
            .then((response) => this.tempcategory=response.data)
            .catch((error) => console.log(error));
        },

        async getBudget(){
            try{
            let budget = [];
            const userID = parseInt(window.localStorage.getItem('id'));
            let response = await axios.get(`http://127.0.0.1:8000/budget/${userID}`);

            if(response.status === 200){

                const budgetArray = response.data;
                const budgetObject = {};
              
                budgetArray.forEach(budget => {
                    budgetObject[budget.category] = budget.amount;

                });
                this.budget= budgetObject;
                

                console.log(this.budget);
                

            }else{
                //this.checkBudget = false;
            }
        }catch (error) {
            console.error('Error fetching budgets:', error);
        }
        },
    close() {
            this.$emit('close');
        },
        async submitForm(){

            try{
            
            const userID = parseInt(window.localStorage.getItem('id'));
            this.formValues.user_id = userID;

            let response = await  axios.post(`http://127.0.0.1:8000/addexpense/${userID}/${this.budget[this.formValues.category]}`,this.formValues);
            console.log(response);
            if(response.status === 200){
                alert(response.data.message);
                
            }else{
                alert("Expense couldn't been added !");
            }
        }catch (error) {
            console.error('Error adding expense:', error);
        }
        }
   },
   watch : {
    formValues:{
        handler(newValue){
            if(newValue.amount > this.budget[newValue.category]){
                alert("You're exceeding the category budget value");
            }
        },
        deep: true
    }
   }
 }
 </script>

<style scoped>
.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.5);
  display: flex;
  align-items: center;
  justify-content: center;
}

.modal-container {
  background: white;
  padding: 20px;
  border-radius: 8px;
  position: relative;
}

.modal-close {
  position: absolute;
  top: 10px;
  right: 10px;
  background: none;
  border: none;
  font-size: 1.2rem;
}
</style>

