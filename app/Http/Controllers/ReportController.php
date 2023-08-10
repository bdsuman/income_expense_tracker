<?php

namespace App\Http\Controllers;

use App\Models\Income;
use App\Models\Category;
use App\Models\Expense;
use Illuminate\Http\Request;
use App\Helper\Helper;
class ReportController extends Controller
{

    function index(Request $request){
      
        $status='';
        $from = $request->fromDate;
        $to = $request->toDate;
        $type = $request->type;
        $check=0;
           
        
        $user_id=auth()->id();
        $incomes=Income::with('category')->where('user_id',$user_id);
        $expenses=Expense::with('category')->where('user_id',$user_id);
        if(!empty($type)){
            $check=1;
            $catogory = Category::find($type);
            $incomes->where('categorie_id',$type);
            $expenses->where('categorie_id',$type);
            $status=$status.'Type : '. $catogory->name;
        }
            /**
             * Only To date search
             */
        if(!empty($to) && empty($from)){  
            $incomes->where('date',$to);
            $expenses->where('date',$to);
            $status=$status.' To Date: '.Helper::dateCheck($to);
        }
            /**
             * Only From date search
             */     
        if(empty($to) && !empty($from)){  
            $incomes->where('date',$from);
            $expenses->where('date',$from);
            $status=$status.' From Date: '.Helper::dateCheck($from);
        }
            /**
             * To & From date search
             */
            if(!empty($to) && !empty($from)){  
                $incomes->where('date','>=',$from)->where('date','<=',$to);
                $expenses->where('date','>=',$from)->where('date','<=',$to);
                    if($from==$to){
                        $status=$status.' Date: '.Helper::dateCheck($from);
                    }else{
                        $status=$status.' Date: '.Helper::dateCheck($from).' - '.Helper::dateCheck($to);
                    }
            }
            /**
             * All Blank Only Today Data
             */
            $date = date('Y-m-d');
            if(empty($to) && empty($from) && $check==0){  
                $incomes->where('date',$date);
                $expenses->where('date',$date);
                $status=$status.' Today : '.Helper::dateCheck($date);
            }
        $incomes=$incomes->get();
        $expenses=$expenses->get();
       
        $categories= Category::where('user_id',$user_id)->get();
        return view('pages.dashboard.report-page',compact('incomes','expenses','categories','status'));
    }

}
