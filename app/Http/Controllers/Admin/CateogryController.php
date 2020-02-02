<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\BlogCategory;


class CateogryController extends Controller
{
    public function __construct(){
      $this->middleware('author')->except('index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = [];
        if($request->status=='active'){
          $data['category'] = Category::status()->with('posts')->get();
        }elseif($request->status=='unactive'){
          $data['category'] = Category::where('status',0)->with('posts')->get();
        }elseif($request->status=='trash'){
          $data['category'] = Category::onlyTrashed()->with('posts')->get();
        }else{
          $data['category'] = Category::with('posts')->get();
        }
        return view('admin.category.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogCategory $request)
    {
        $data=[];
        $data['name'] = $request->name;
        $data['slug'] = str_slug($request->name);
        $create = Category::create($data);
        if($create){
          return redirect()->back()->with('success','Category Create Successful');
        }else{
          return redirect()->back()->with('error','Category Create Error !');
        }
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
        return view('admin.category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(BlogCategory $request, Category $category)
    {
        $data = [];
        $data['name'] = $request->name;
        $data['slug'] = str_slug($request->name);

        $update = $category->update($data);

        if($update){
          return redirect()->route('admin.category.edit',$data['slug'])->with('success','Category Update Successful');
        }else {
          return redirect()->back()->with('error','Category Update Error');

        }
    }

    // Category Active & UnActive
    public function status(Category $category){

      if($category->status == 1){
        $status = $category->update([
          'status' => 0,
        ]);
        if($status){
          return redirect()->back()->with('success','Category status Update Successful');
        }else {
          return redirect()->back()->with('error','Category status Update Error');
        }
      }else{
        $status = $category->update([
          'status' => 1,
        ]);
        if($status){
          return redirect()->back()->with('success','Category status Update Successful');
        }else {
          return redirect()->back()->with('error','Category status Update Error');
        }
      }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $delete = $category->delete();
        if($delete){
          return redirect()->back()->with('success','Move To Trash Successful');
        }else{
          return redirect()->back()->with('error','Move To Trash Successful');
        }
    }

    // Category Trash
    public function restore(Category $category){
      $restore = $category->restore();
      if($restore){
        return redirect()->back()->with('success','Category ReStore Successful');
      }else{
        return redirect()->back()->with('error','Category ReStore Error');
      }
    }

    // Category  Permanente delete in Database
    public function forceDelete(Category $category){
      $forceDelete = $category->forceDelete();
      $category->posts()->detach();
      if($forceDelete){
        return redirect()->back()->with('success','Category Delete Successful');
      }else{
        return redirect()->back()->with('error','Category Delete Error');
      }
    }




}
