<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Category;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    function ExpensePage(){
        $categories = Category::where('type', 'Expense')->select('id','name')->orderBy('name', 'asc')->get();
        return view('pages.dashboard.expense-page',compact('categories'));
    }

    function ExpenseList(Request $request){
        $user_id=auth()->id();
        return Expense::with('category')->where('user_id',$user_id)->get();
    }

    function ExpenseCreate(Request $request){
        $user_id=auth()->id();
        return Expense::create([
            'date'=>$request->input('date'),
            'amount'=>$request->input('amount'),
            'description'=>$request->input('description'),
            'categorie_id'=>$request->input('categorie_id'),
            'user_id'=>$user_id
        ]);
    }

    function ExpenseDelete(Request $request){
        $expense_id=$request->input('id');
        $user_id=auth()->id();;
        return Expense::where('id',$expense_id)->where('user_id',$user_id)->delete();
    }


    function ExpenseByID(Request $request){
        $expense_id=$request->input('id');
        $user_id=auth()->id();;
        return Expense::where('id',$expense_id)->where('user_id',$user_id)->first();
    }



    function ExpenseUpdate(Request $request){
        $expense_id=$request->input('id');
        $user_id=auth()->id();;
        return Expense::where('id',$expense_id)->where('user_id',$user_id)->update([
            'date'=>$request->input('date'),
            'amount'=>$request->input('amount'),
            'description'=>$request->input('description'),
            'categorie_id'=>$request->input('categorie_id'),
            'user_id'=>$user_id
        ]);
    }
}
