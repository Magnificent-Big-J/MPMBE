<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Budget;
use App\Expense;
use App\Category;
use App\Vacation;
use App\Http\Resources\ExpenseResource;
class DataController extends Controller
{
    public function __construct()
    {
        //$this->middleware('JWT');
    }

    public function getData(){

        $budget = Budget::Budget()->pluck('budget');
        $totalExpense = Expense::TotalExpense()->sum('amount');
        $balance = abs($budget[0] - $totalExpense);
        return ['budget'=>$budget[0], 'totalExpense'=> $totalExpense, 'balance'=>$balance];
    }
    public function graphData(){


        $date = \Carbon\Carbon::now();
        $currentMonth = $date->format('F');
        $previous = $date->startOfMonth()->subMonth()->format('F');
        $labels = Category::pluck('name');
        $categories = Category::pluck('id');
        $data1 = $this->getMonthlyData(1,$categories);
        $data2 = $this->getMonthlyData(2,$categories);

        return  ['labels'=>$labels, 'label1'=>$currentMonth, 'label2'=>$previous,'data1'=>$data1,'data2'=>$data2];
    }

    protected function getMonthlyData($val,$categories){

        $data = array();
        foreach ($categories as $category){

            if($val == 1){
                $sum = Expense::TotalExpense()->where('category_id',$category)->sum('amount');
            }
            else{
                $sum = Expense::PreviousMonth()->where('category_id',$category)->sum('amount');
            }
            $sum = $sum ? $sum : 0;
            $data[] = $sum;
        }

        return $data;

    }
    public function dashboard(){
        $budget = Budget::Budget()->pluck('budget','saving');
        foreach ($budget as $b=> $a){

            $savngs = $b;
            $amount = $a;
        }

        $noUnplanned = 0;
        $unplannedAmount = 0;
        $completedExpense = Expense::TotalExpense()->where('status','Paid')->count();
        $outstanding = Expense::TotalExpense()->where('status','Outstanding')->whereOr('status','Onprogress')->count();
        $noVacation = Vacation::where('status','Going')->count();
        $vacationAmount = Vacation::where('status','Going')->sum('cost');
        $unPlannedId = Category::where('name','Unplanned')->pluck('id');

        if(count($unPlannedId)){
            $unPlannedId = $unPlannedId[0];
            $noUnplanned = Expense::TotalExpense()->where('category_id',$unPlannedId)->count();
            $unplannedAmount = Expense::TotalExpense()->where('category_id',$unPlannedId)->sum('amount');
        }

        $expenses = Expense::TotalExpense()->get();


        return ['budget'=>$amount, 'savings'=>$savngs, 'completeExpense'=>$completedExpense,
                'outstanding'=>$outstanding, 'noVacation'=>$noVacation,'vacationAmount'=>$vacationAmount,
                'noUplanned'=>$noUnplanned, 'unplannedAmount'=>$unplannedAmount,'expenses'=> ExpenseResource::collection($expenses)
                ];
    }
}
