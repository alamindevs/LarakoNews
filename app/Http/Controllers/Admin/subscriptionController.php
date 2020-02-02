<?php

namespace App\Http\Controllers\Admin;

use App\subscription;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class subscriptionController extends Controller
{
    public function __construct(){
      $this->middleware('author')->except('index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $data['subscription'] = Subscription::latest()->get();
        return view('admin.subscription.index',$data);
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
     * @param  \App\subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function show(subscription $subscription)
    {
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function edit(subscription $subscription)
    {
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, subscription $subscription)
    {
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function destroy(subscription $subscription)
    {
        $delete = $subscription->delete();

        if($delete){
          return redirect()->back()->with('success','Subscription Delete Successful');
        }else {
          return redirect()->back()->with('error','Subscription Delete Error');
        }
    }
}
