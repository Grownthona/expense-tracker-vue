<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Budget;

use App\Models\Category;

class BudgetController extends Controller
{
    public function addBudget(Request $request){
        
        $findcategory = Category:: where('name',$request['category'])->first();

        $budget = new Budget;
        $budget->user_id =  $request['user_id'];
        $budget->category = $request['category'];
        $budget->category_id = $findcategory->id;
        $budget->amount = $request['amount'];
        $budget->total = $request['total'];
        $budget->month = date('F');
        $budget->year = date("Y");
        $budget->save();
        return response()->json([ 'message' => "Budget Added Successfully!",'id' => $finduser->id], 200);

    }
    public function category(){
      
        $category = Category :: all();
        return response()->json($category);
    }

    public function budget(){
        $user_id = session('id');
        $current_month = date('F');
        $current_year = date("Y");
        
        if(session()->has('id')){
            $budget = Budget :: where('user_id',$user_id)->where('month',$current_month)->where('year',$current_year)->get();
            return response()->json($budget);
        }else{
            return response()->json([ 'message' => "User has not added budget yet !"], 404);
        }
    }
}
