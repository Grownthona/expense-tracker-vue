<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Budget;
use App\Models\Category;
use App\Models\Monthlybudget;
use Illuminate\Support\Facades\Session;

class BudgetController extends Controller
{
    public function addBudget(Request $request,$id,$monthtotal){

        /*$validator = Validator::make($request->all(), [
            'category' => 'required|string',
            'amount' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }*/


        
        $findcategory = Category:: where('name',$request['category'])->first();

        $findbudget = Budget :: where('user_id',$id)->first();

        if(!$findbudget){
            if($monthtotal+$request['amount']> $request['total']){
                return response()->json([ 'message' => "Budget Can not exceed monthly budget Successfully!"], 500);
            }
            $budget = new Budget;
            $budget->user_id =  $request['user_id'];
            $budget->category = $request['category'];
            $budget->category_id = $findcategory->id;
            $budget->amount = $request['amount'];
            $budget->total = $request['total'];
            $budget->month = date('F');
            $budget->year = date("Y");
            $budget->save();
            return response()->json([ 'message' => "Budget Added Successfully!"], 200);
        }else{
            if($monthtotal+$request['amount']> $findbudget->total){
                return response()->json([ 'message' => "Budget Can not exceed monthly budget Successfully!"], 500);
            }

            $budget = new Budget;
            $budget->user_id =  $request['user_id'];
            $budget->category = $request['category'];
            $budget->category_id = $findcategory->id;
            $budget->amount = $request['amount'];
            $budget->total = $findbudget->total;
            $budget->month = date('F');
            $budget->year = date("Y");
            $budget->save();
            return response()->json([ 'message' => "Budget Added Successfully!"], 200);
        }

    }
    public function category(){
      
        $category = Category :: all();
        return response()->json($category);
    }

    public function budget($id){

        $current_month = date('F');
        $current_year = date("Y");
        
        try{
            $budget = Budget :: where('user_id',$id)->where('month',$current_month)->where('year',$current_year)->get();
            
            if($budget){
                return response()->json($budget,200);
            }else{
                return response()->json([ 'message' => "User has not added budget yet !"], 404);
           }
        }catch (\Exception $e) {
            return  response()->json(["Error" => $e->getMessage()]);
        }
    }

    public function monthlyBudget(){
        $user_id = Session::get('id');
        $current_month = date('F');
        $current_year = date("Y");
        try{
            $total = Monthlybudget:: where('month',$current_month)->where('year',$current_year)->first();
            if($total === null){
                return response()->json(["message" => "Data doesn't exists!"],404);
            }
            return response()->json($total,200);
        }catch (\Exception $e) {
            return  response()->json(["Error" => $e->getMessage()]);
        }
    }

    public function updateBudget(Request $request,$id){
        $current_month = date('F');
        $current_year = date("Y");
        
        /*$validator =   $request->validate([
            'category' => 'required',
            'amount' => 'required']);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }*/
        try{
            $budget = Budget :: where('id',$id)->where('month',$current_month)->where('year',$current_year)->first();
            $findcategory = Category:: where('name',$request['category'])->first();
            $findbudget = Budget :: find($id);

            if($budget){
                $budget->user_id =  $request['user_id'];
                $budget->category = $request['category'];
                $budget->category_id = $findcategory->id;
                $budget->amount = $request['amount'];
                $budget->total = $findbudget->total;
                $budget->month = $current_month;
                $budget->year = $current_year;
                $budget->save();
                return response()->json(["message" => "Budget Updated Successfully!"],200);
            }else{
                return response()->json([ 'message' => "User has not added budget yet !"], 404);
           }
        }catch (\Exception $e) {
            return  response()->json(["Error" => $e->getMessage()]);
        }
    }
}
