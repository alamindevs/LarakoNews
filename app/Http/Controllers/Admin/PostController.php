<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\BlogPosts;
use Image;
use Auth;
use App\Post;
use App\Category;
use App\Tag;
use Carbon\Carbon;

class PostController extends Controller
{
   public function __construct(){
     $this->middleware('admin')->only('destroy','approved','restore','forceDelete');
   }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data=[];

        if($request->status=='publish'){
          $data['post']=Post::publish()->status()->with('user','categorys')->latest()->get();
        }elseif($request->status=='schedule'){
          $data['post']=Post::schedule()->with('user','categorys')->latest()->get();
        }elseif($request->status=='panding'){
          $data['post']=Post::publish()->Panding()->with('user','categorys')->latest()->get();
        }else{
          $data['post']=Post::with('user','categorys')->latest()->get();
        }

        return view('admin.post.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data=[];
        $data['category']=Category::where('status',1)->get();
        $data['tags']=Tag::status()->get();
        return view('admin.post.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogPosts $request)
    {
        $data=[];
        $data['title']=$request->title;

        if($request->has('image')){
        $imageName=$this->imageHandle($request);

        $data['image']=$imageName;

        }

        $data['description']=$request->description;
        $data['short_description']=$request->short_description;
        $data['user_id']=Auth::user()->id;
        $data['slug']=str_slug($request->title);

        if($request->publish==2){
          $data['published_at']=$request->publist_time;
        }else{
          $data['published_at']=Carbon::now()->toDateTimeString();
        }

        $data['created_at']=Carbon::now()->toDateTimeString();

        $postId=Post::insertGetId($data);
        $post=Post::find($postId);

        $post->categorys()->attach($request->category);
        $post->tags()->attach($request->tag);

        if($postId){
          return redirect()->back()->with('success','Your Post Create Successful');
        }else {
          return redirect()->back()->with('error','Your Post Create Error');
        }

    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
      return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {

        $data=[];
        $data['post']=$post;
        $data['category']=Category::where('status',1)->get();
        $data['tags']=Tag::status()->get();
        return view('admin.post.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BlogPosts $request, Post $post)
    {
      $data=[];
      $data['title']=$request->title;
      $data['description']=$request->description;
      $data['short_description']=$request->short_description;
      $data['slug']=str_slug($request->title);

      if($request->has('image')){
      $this->imageRemove($post->image);
      $imageName=$this->imageHandle($request);
      $data['image']=$imageName;
      }

      if($request->publish==2){
        $date=str_replace('T',' ',$request->publist_time);
        $data['published_at']=$date.':00';
      }

      if($request->publish==1 && $post->published_at > Carbon::now()){
        $data['published_at']=Carbon::now()->toDateTimeString();
      }

      $update=$post->update($data);
      $post->categorys()->sync($request->category);
      $post->tags()->sync($request->tag);

      if($update){
        return redirect()->route('admin.post.edit',$data['slug'])->with('success','Your Post Create Successful');
      }else {
        return redirect()->back()->with('error','Your Post Create Error');
      }

      // return $request->publist_time;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Post $post)
    {
      $trush=$post->delete();
      if($trush){
        return redirect()->back()->with('success','This Post Move To  Trash successful');
      }else {
        return redirect()->back()->with('error','This post Trash Error');
      }
    }


    public function approved(Post $post){

      $data = [];
      $data['status']=1;
      $data['published_at'] = Carbon::now()->toDateTimeString();

      $approved = $post->update($data);

      if($approved){
        return redirect()->back()->with('success','This Post Approved Successful');
      }else {
        return redirect()->back()->with('error','This Post Approved Error');
      }

    }

    public function recycle(){
      $data=[];
      $data['post']=Post::onlyTrashed()->with('categorys')->with(['user'=> function($query){$query->withTrashed();}])->latest()->get();
      return view('admin.post.index',$data);
    }

    public function restore(Post $post){
      if($post->usertrash == 1){
        return redirect()->back()->with('error','This Post User Trashted');
      }else{
        $restore = $post->restore();
        if($restore){
          return redirect()->back()->with('success','Post has been ReStore Successful');
        }else{
          return redirect()->back()->with('error','Post has been ReStore Error');
        }
      }
    }

    public function forceDelete(Post $post){
      $delete = $post->forceDelete();
      $post->categorys()->detach();
      $post->tag()->detach();
      if($delete){
        return redirect()->back()->with('success','Post has been Deleted');
      }else{
        return redirect()->back()->with('error','This post Deleted Error');
      }
    }







    // custom function -------------------------

    private function imageHandle($request){
      $image=$request->file('image');
      $imageName='post'.time().str_random().'.'.$image->getclientOriginalExtension();
      Image::make($image)->resize(800,550)->save('uploads/post/'.$imageName);
      Image::make($image)->resize(100,100)->save('uploads/post/slider/'.$imageName);
      Image::make($image)->resize(83,83)->save('uploads/post/small/'.$imageName);
      return $imageName;

    }

    // post image remove function
    private function imageRemove($image){
      if(!empty($image)){
        $location = 'uploads/post/'.$image;
        $location_slider = 'uploads/post/slider/'.$image;
        $location_small = 'uploads/post/small/'.$image;

        if(file_exists($location)) unlink($location);
        if(file_exists($location_slider)) unlink($location_slider);
        if(file_exists($location_small)) unlink($location_small);
      }
    }




}
