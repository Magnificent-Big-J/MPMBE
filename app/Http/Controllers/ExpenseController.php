<?php

namespace App\Http\Controllers;

use App\Expense;
use App\Http\Resources\ExpenseResource;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function __construct()
    {
        $this->middleware('JWT');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenses = Expense::paginate(10);

        return ExpenseResource::collection($expenses);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request,[
            'name'=>'required',
            'category_id'=>'required',
            'amount'=>'required',
            'status'=>'required',
            'expense_date'=>'required',
        ]);

        $expense = Expense::create([
                'expense'=> $request->name,
                'category_id'=> $request->category_id,
                'amount'=> $request->amount,
                'status'=> $request->status,
                'expense_date'=> $request->expense_date,
                'user_id'=>1
        ]);

        return response()->json(['expense'=>new ExpenseResource($expense),'message'=>'Successfully Created']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function show(Expense $expense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function edit(Expense $expense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expense $expense)
    {
        $this->validate($request,[
            'name'=>'required',
            'category_id'=>'required',
            'amount'=>'required',
            'status'=>'required',
            'expense_date'=>'required',
        ]);
        $expense->update([
            'expense'=>$request->name,
            'expense'=>$request->name,
            'category_id'=>$request->category_id,
            'expense_date'=>$request->expense_date,
            'status'=>$request->status,
        ]);
        return response()->json(['expense'=>new ExpenseResource($expense),'message'=>'Successfully Updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expense $expense)
    {
        $expense->delete();
        return response()->json(['message'=>'Successfully Deleted']);
    }
}
