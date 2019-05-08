<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;


class CategoryController extends Controller
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
        $categories = Category::paginate(5);

        return CategoryResource::collection($categories);
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
        $category = $this->validate($request,[
            'name'=>'required|min:3|unique:categories',
            'status'=>'required|min:3',
        ]);

        $category = Category::create($category);


        return new CategoryResource($category);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {


         $this->validate($request,[
            'name'=>'required|min:3|unique:categories,name,'. $category->id,
            'status'=>'required|min:3',
        ]);
        $category = Category::findOrFail($category->id);
        $category->name = $request->name;
        $category->status = $request->status;
        $category->save();


        return response()->json(['category'=>new CategoryResource($category),'message'=>'Successfully Updated'],200) ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {


        $category->delete();

        return response()->json(['message'=>'Category Successfully Deleted'],200);

    }
    public function get_categories(){

        return CategoryResource::collection(Category::latest()->get());
    }
}
