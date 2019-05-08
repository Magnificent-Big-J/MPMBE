<?php

namespace App\Http\Controllers;

use App\Budget;
use App\Http\Resources\BudgetResource;
use Illuminate\Http\Request;

class BudgetController extends Controller
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
        $budget = Budget::paginate(5);
        return BudgetResource::collection($budget);
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
            'amount'=>['required'],
            'date'=>['required'],
            'income'=>['required'],
            'savings'=>['required'],
        ]);

        $budget = Budget::create([
            'budget'=>$request->amount,
            'income'=>$request->income,
            'saving'=>$request->savings,
            'budget_date'=>$request->date,
            'user_id'=> 1,
        ]);

        return response()->json(['budget'=>$budget,'message'=>'Successfully Created'],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Budget  $budget
     * @return \Illuminate\Http\Response
     */
    public function show(Budget $budget)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Budget  $budget
     * @return \Illuminate\Http\Response
     */
    public function edit(Budget $budget)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Budget  $budget
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Budget $budget)
    {



        $budget = Budget::findOrFail($budget->id);

        $this->validate($request,[
            'amount'=>['required'],
            'date'=>['required'],
            'income'=>['required'],
            'savings'=>['required'],
        ]);

        $budget->budget = $request->amount;
        $budget->income = $request->income;
        $budget->saving = $request->savings;
        $budget->budget_date = $request->date;
        $budget->save();

        return response()->json(['budget'=> new BudgetResource($budget),'message'=>'Successfully Updated'],200);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Budget  $budget
     * @return \Illuminate\Http\Response
     */
    public function destroy(Budget $budget)
    {

        $budget->delete();

        return response()->json(['message'=>'Successfully Delete'],200);

    }
}
