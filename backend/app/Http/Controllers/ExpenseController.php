<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Budget;
use App\Models\Category;
use App\Models\Expense;

class ExpenseController extends Controller
{
    public function addexpense(Request $request,$id,$budget){

    
        $findbudget = Budget :: where('user_id',$id)->where('category',$request['category'])->first();

        if($findbudget){

            if($request['amount'] > $budget){
                return response()->json([ 'message' => "Expense amount can't be greater than the budget!"], 500);
            }
            $expense = new Expense;
            $expense->user_id =  $request['user_id'];
            $expense->category = $request['category'];
          
            $expense->expense = $request['amount'];
            $expense->description = $request['description'];
            $expense->payment_method = $request['payment'];
            $expense->budget = $budget;
            
            $expense->date = date('Y-m-d H:i:s');
            $expense->save();
            return response()->json([ 'message' => "Expense Added Successfully!"], 200);
        }else{
            response()->json([ 'message' => "Expense couldn't been added!"], 404);
        }
    }
    public function expense(Request $request,$id){
            $expense = Expense :: where('user_id',$id)->get();
            if($expense){
                return response()->json($expense,200);
            }else{
                response()->json([ 'message' => "No Expense Added!"], 404);
            }
    }
}
