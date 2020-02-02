<?php

namespace App\Http\Controllers\Admin;

use App\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagController extends Controller
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
    {   $data = [];
      if($request->status == 'trash'){
        $data['tag'] = Tag::onlyTrashed()->with('posts')->get();
      }else {
        $data['tag'] = Tag::with('posts')->get();
      }

        return view('admin.tag.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tag.create');
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
          'name' => 'required|max:50|unique:tags',
        ]);

        $data = [];
        $data['name'] = $request->name;
        $data['slug'] = str_slug($request->name);

        $create = Tag::create($data);

        if($create){
          return redirect()->back()->with('success','Tag Create Successful');
        }else {
          return redirect()->back()->with('error','Tag Create Successful');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
      $data = [];
      $data['data'] = $tag;

      return view('admin.tag.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
      $this->validate($request,[
        'name' => 'required|max:50|unique:tags,name,'.$tag->id,
      ]);

      $data = [];
      $data['name'] = $request->name;
      $data['slug'] = str_slug($request->name);
      $update = $tag->update($data);

      if($update){
        return redirect()->back()->with('success','Tag Update Successful');
      }else {
        return redirect()->back()->with('error','Tag Update Error');
      }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        $delete = $tag->delete();
        if($delete){
          return redirect()->back()->with('success','Tag Move To Trash Successful');
        }else {
          return redirect()->back()->with('error','Tag Move To Trash Error');
        }
    }

    public function restore($tag){

      $restore = $tag->restore();

      if($restore){
        return redirect()->back()->with('success','Tag ReStore Successful');
      }else {
        return redirect()->back()->with('error','Tag ReStore Error');
      }
    }

    public function forceDelete(Tag $tag){
      $forceDelete = $tag->forceDelete();

      if($forceDelete){
        return redirect()->back()->with('success','Tag Delete Successful');
      }else {
        return redirect()->back()->with('error','Tag Delete Error');
      }
    }
}
