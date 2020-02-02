<?php

namespace App\Http\Controllers\Admin;

use App\Advertizement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;

class AdvertizementController extends Controller
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
      $data['advertizement'] = Advertizement::latest()->get();
      return view('admin.advertizement.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.advertizement.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   if($request->type==1){
          $this->validate($request,[
            'name'=>'required|max:190|unique:advertizements',
            'image'=>'required|image|dimensions:width=728,height=90',
            'url'=>'required|url',

          ]);
        }else{
          $this->validate($request,[
            'name'=>'required|max:190|unique:advertizements',
            'script'=>'required',
          ]);
        }

        $data = [];
        $data['name'] = $request->name;
        $data['type'] = $request->type;
        if($request->type ==1 && $request->has('image')){
          $data['add'] = $this->imageHandle($request);
          $data['url'] = $request->url;
        }
        if($request->type ==2){
          $data['add'] = $request->script;
        }
        $create = Advertizement::create($data);

        if($create){
          return redirect()->back()->with('success','Advertizement Create Successful');
        }else{
          return redirect()->back()->with('error','Advertizement Create Error');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Advertizement  $advertizement
     * @return \Illuminate\Http\Response
     */
    public function show(Advertizement $advertizement)
    {
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Advertizement  $advertizement
     * @return \Illuminate\Http\Response
     */
    public function edit(Advertizement $advertizement)
    {
        $data = [];
        $data['add'] = $advertizement;

        return view('admin.advertizement.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Advertizement  $advertizement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Advertizement $advertizement)
    {
      if($request->type==1){
        $this->validate($request,[
          'name'=>'required|max:190|unique:advertizements,name,'.$advertizement->id,
          'image'=>'image|dimensions:width=728,height=90',
          'url'=>'required|url',

        ]);
      }else{
        $this->validate($request,[
          'name'=>'required|max:190|unique:advertizements,name,'.$advertizement->id,
          'script'=>'required',
        ]);
      }
        $data = [];
        $data['name'] = $request->name;
        $data['type'] = $request->type;
        if($request->type == 1){
          if($request->has('image')){
            $location = 'uploads/advertizement/'.$advertizement->add;
            if(file_exists($location)) unlink($location);
            $data['add'] = $this->imageHandle($request);
          }
          $data['url'] = $request->url;
        }
        if($request->type ==2){
          $data['add'] = $request->script;
        }
        $update = $advertizement->update($data);

        if($update){
          return redirect()->back()->with('success','Advertizement Update Successful');
        }else{
          return redirect()->back()->with('error','Advertizement Update Error');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Advertizement  $advertizement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Advertizement $advertizement)
    {
      if($advertizement->type==1){
        $location = 'uploads/advertizement/'.$advertizement->add;
        if(file_exists($location)) unlink($location);
      }
      $delete = $advertizement->delete();
      if($delete){
        return redirect()->back()->with('success','Advertizement Delete Successful');
      }else{
        return redirect()->back()->with('error','Advertizement Delete Error');
      }
    }

    protected function imageHandle($request){
      $image = $request->file('image');
      $imageName = 'advertizement-'.time().'.'.$image->getclientOriginalExtension();
      Image::make($image)->resize(728,90)->save('uploads/advertizement/'.$imageName);
      return $imageName;
    }
}
