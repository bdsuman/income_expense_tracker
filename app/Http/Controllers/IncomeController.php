<?php

namespace App\Http\Controllers;

use App\Models\Income;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class IncomeController extends Controller
{
    function IncomePage(){
        $categories = Category::where('type', 'income')->select('id','name')->orderBy('name', 'asc')->get();
        return view('pages.dashboard.income-page',compact('categories'));
    }

    function IncomeList(Request $request){
        $user_id=auth()->id();
        return Income::with('category')->where('user_id',$user_id)->get();
    }

    function IncomeCreate(Request $request){
        $user_id=auth()->id();
        return Income::create([
            'date'=>$request->input('date'),
            'amount'=>$request->input('amount'),
            'description'=>$request->input('description'),
            'categorie_id'=>$request->input('categorie_id'),
            'user_id'=>$user_id
        ]);
    }

    function IncomeDelete(Request $request){
        $income_id=$request->input('id');
        $user_id=auth()->id();;
        return Income::where('id',$income_id)->where('user_id',$user_id)->delete();
    }


    function IncomeByID(Request $request){
        $income_id=$request->input('id');
        $user_id=auth()->id();;
        return Income::where('id',$income_id)->where('user_id',$user_id)->first();
    }



    function IncomeUpdate(Request $request){
        $Income_id=$request->input('id');
        $user_id=auth()->id();;
        return Income::where('id',$Income_id)->where('user_id',$user_id)->update([
            'date'=>$request->input('date'),
            'amount'=>$request->input('amount'),
            'description'=>$request->input('description'),
            'categorie_id'=>$request->input('categorie_id'),
            'user_id'=>$user_id
        ]);
    }
}
