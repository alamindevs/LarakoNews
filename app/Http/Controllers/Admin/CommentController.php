<?php

namespace App\Http\Controllers\Admin;

use App\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    public function __construct(){
      $this->middleware('author')->except('index','show');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = [];
        if($request->status == 'active'){
          $data['comments'] = Comment::where('status',1)->with('post')->get();
        }elseif($request->status == 'unactive'){
          $data['comments'] = Comment::where('status',2)->with('post')->get();
        }else{
          $data['comments'] = Comment::with('post')->get();
        }

        return view('admin.comment.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        $data = [];
        $data['comment'] = $comment;
        return view('admin.comment.view',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $delete = $comment->delete();

        if($delete){
          return redirect()->back()->with('success','Comment Delete Successful');
        }else {
          return redirect()->back()->with('error','Comment Delete Error');
        }
    }

    public function approve(Comment $comment){
      $approve = $comment->update([
        'status'=>1,
      ]);
      if($approve){
        return redirect()->back()->with('success','Comment Approve Successful');
      }else {
        return redirect()->back()->with('error','Comment Approve Error');
      }
    }

}
