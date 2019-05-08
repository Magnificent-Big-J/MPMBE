<?php

namespace App\Http\Controllers;

use App\Http\Resources\VacationResource;
use App\Vacation;
use Illuminate\Http\Request;

class VacationController extends Controller
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
        $vacations = Vacation::paginate(4);

        return VacationResource::collection($vacations);
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
            'destination'=>'required',
            'start'=>'required',
            'end'=>'required',
            'cost'=>'required',
            'adults'=>'required',
            'children'=>'required',
            'activities'=>'required',
        ]);

      $vacation =  Vacation::create([
            'destination'=>$request->destination,
            'activities'=>serialize($request->activities),
            'start_date'=>$request->start,
            'end_date'=>$request->end,
            'cost'=>$request->cost,
            'status'=>$request->status,
            'adults'=>$request->adults,
            'childrens'=>$request->children,
            'user_id'=>1
        ]);

        return response()->json(['vacation'=>new VacationResource($vacation),'message'=>'Successfully Created'],200);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vacation  $vacation
     * @return \Illuminate\Http\Response
     */
    public function show(Vacation $vacation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vacation  $vacation
     * @return \Illuminate\Http\Response
     */
    public function edit(Vacation $vacation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vacation  $vacation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vacation $vacation)
    {
        $vacation = Vacation::findOrFail($vacation->id);
        $this->validate($request,[
            'destination'=>'required',
            'start'=>'required',
            'end'=>'required',
            'cost'=>'required',
            'adults'=>'required',
            'children'=>'required',
            'activities'=>'required',
        ]);
        $vacation->destination = $request->destination;
        $vacation->activities = serialize($request->activities);
        $vacation->start_date = $request->start;
        $vacation->end_date = $request->end;
        $vacation->cost = $request->cost;
        $vacation->status = $request->status;
        $vacation->adults = $request->adults;
        $vacation->childrens = $request->children;
        $vacation->user_id= 1;
        $vacation->save();

        return response()->json(['vacation'=> new VacationResource($vacation),'message'=>'Successfully Updated'],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vacation  $vacation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vacation $vacation)
    {

        $vacation->delete();

        return response()->json(['message'=>'Successfully Deleted'],200);
    }
}
