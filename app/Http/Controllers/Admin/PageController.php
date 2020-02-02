<?php

namespace App\Http\Controllers\Admin;

use App\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageController extends Controller
{

    public function __construct(){
      $this->middleware('admin')->except('index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $data['page'] = Page::all();

        return view('admin.page.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.page.create');
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
          'name'=>'required|max:30|unique:pages',
          'description'=>'required',
          'tag'=>'max:190',
        ]);

        $data = [];
        $data['name'] = $request->name;
        $data['description'] = $request->description;
        $data['page_tag'] = $request->tag;
        $data['slug'] = str_slug($request->name);

        $create = Page::create($data);

        if($create){
          return redirect()->back()->with('success','Page Create Successfull');
        }else {
          return redirect()->back()->with('Error','Page Create Error');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        $data = [];
        $data['page'] = $page;

        return view('admin.page.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page)
    {
      $this->validate($request,[
        'name'=>'required|max:30|unique:pages,name,'.$page->id,
        'description'=>'required',
        'tag'=>'max:190',
      ]);

      $data = [];
      $data['name'] = $request->name;
      $data['description'] = $request->description;
      $data['page_tag'] = $request->tag;
      $data['slug'] = str_slug($request->name);

      $update = $page->update($data);

      if($update){
        return redirect()->route('admin.page.edit',$data['slug'])->with('success','Page Update Successfull');
      }else {
        return redirect()->back()->with('Error','Page Update Error');
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        $delete = $page->delete();

        if($delete){
          return redirect()->back()->with('success','Page Delete Successfull');
        }else {
          return redirect()->back()->with('Error','Page Delete Error');
        }

    }
}
