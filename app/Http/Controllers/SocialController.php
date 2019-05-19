<?php

namespace App\Http\Controllers;

use App\Http\Resources\SocialResources;
use App\Social;
use Illuminate\Http\Request;

class SocialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $socials = Social::paginate(5);

        return SocialResources::collection($socials);
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

        $social = $this->validate($request,[
            'amount'=>'required',
            'date'=>'required',
            'name'=>'required',
        ]);

        $social = Social::create($social);

        return new SocialResources($social);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Social  $social
     * @return \Illuminate\Http\Response
     */
    public function show(Social $social)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Social  $social
     * @return \Illuminate\Http\Response
     */
    public function edit(Social $social)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Social  $social
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Social $social)
    {
        $this->validate($request,[
            'amount'=>'required',
            'date'=>'required',
            'name'=>'required',
        ]);
        $social->update(['amount'=>$request->amount,'date'=>$request->date,'name'=>$request->name]);
        return response()->json(['category'=>new SocialResources($social),'message'=>'Successfully Updated'],200) ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Social  $social
     * @return \Illuminate\Http\Response
     */
    public function destroy(Social $social)
    {
        $social->delete();

        return response()->json(['message'=>'Social Successfully Deleted'],200);
    }
    public function getMoney(){

        $honey = Social::where('name','Honey')->sum('amount');
        $mom = Social::where('name','Mom')->sum('amount');

        return ['honey'=>$honey,'mom'=>$mom];

    }
}
