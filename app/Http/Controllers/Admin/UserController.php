<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Role;
use App\Cuntry;
use App\Gender;
use Image;
use Hash;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{

    public function __construct(){
      $this->middleware('admin')->except('index','show','edit');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = [];
        if($request->status=='admin'){
          $data['user'] = User::with('role')->where('role_id',2)->get();
        }elseif($request->status=='author'){
          $data['user'] = User::with('role')->where('role_id',3)->get();
        }elseif($request->status=='editor'){
          $data['user'] = User::with('role')->where('role_id',4)->get();
        }elseif($request->status=='active'){
          $data['user'] = User::with('role')->where('status',1)->get();
        }elseif($request->status=='unactive'){
          $data['user'] = User::with('role')->where('status',0)->get();
        }elseif($request->status=='trash'){
          $data['user'] = User::onlyTrashed()->with('role')->get();
        }else{
          $data['user'] = User::with('role')->get();
        }
        return view('admin.user.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $data = [];
      $data['roles'] = Role::all();
      $data['genders'] = Gender::all();
      return view('admin.user.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $data = [];
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['username'] = $request->username;
        $data['phone'] = $request->phone;
        $data['role_id'] = $request->role;
        $data['gender'] = $request->gender;
        $data['password'] = Hash::make($request->password);
        $data['slug'] = str_slug($request->username);

        $create = User::create($data);

        if($create){
          return redirect()->back()->with('success','User Create Successful');
        }else{
          return redirect()->back()->with('error','User Create Error');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
      $data = [];
      $data['user'] = $user;
      return view('admin.user.view',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {   $data = [];
        $data['roles'] = Role::all();
        $data['genders'] = Gender::all();
        $data['user'] = $user;
        return view('admin.user.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
       $data = [];
       $data['name'] = $request->name;
       $data['email'] = $request->email;
       $data['phone'] = $request->phone;
       $data['gender'] = $request->gender;
       $data['bio'] = $request->bio;
       $data['address'] = $request->address;
       $data['facebook'] = $request->facebook;
       $data['twitter'] = $request->twitter;
       $data['instagram'] = $request->instagram;
       $data['youtube'] = $request->youtube;

       if(Hash::check($request->oldpass,$user->password)){

         if($request->has('image')){
           $this->imageRemove($user->image);
           $data['image'] = $this->imageHandle($request);
         }
         $update = $user->update($data);

         if($request->password){
           $this->validate($request,[
             'password' =>'required|string|min:6|confirmed',
           ]);
          $change = $user->update([
             'password' => Hash::make($request->password),
           ]);
           if($change){
             Auth::logout();
            return redirect('/login')->with('success','Your Password Change Successful. Please Enter logIn your new password');
           }
         }
         if($update){
           return redirect()->back()->with('success','Update Successful');
         }else {
           return redirect()->back()->with('error','Update Error');
         }

      }else {
        return redirect()->back()->with('error','Your Password Dont Mace.');
      }

 }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {

      if($user->id == 1){
        return redirect()->back()->with('error','User Dont Move to Trash');
      }else {
        $trash = $user->delete();
        $trashPost = $user->posts()->delete();
        $trashPostupdate = $user->posts()->onlyTrashed()->update([
          'usertrash' => 1,
        ]);
        if($trash){
          return redirect()->back()->with('success','User Move to Trash Successful');
        }else{
          return redirect()->back()->with('error','User Move to Trash Error');
        }
      }


    }

    public function restore(User $user){

      $restore = $user->restore();
      $user->posts()->restore();
      $user->posts()->update([
        'usertrash' => NULL,
     ]);

      if($restore){
        return redirect()->back()->with('success','User ReStore Successful');
      }else{
        return redirect()->back()->with('error','User ReStore Error');
      }
    }

    public function status(User $user){
      if($user->id==1){
        return redirect()->back()->with('error','User Dont UnActive');
      }else{
        if($user->status == 1){
          $unactive = $user->update([
            'status' => 0,
          ]);
          if($unactive){
            return redirect()->back()->with('success','User UnActive Successful');
          }else {
            return redirect()->back()->with('error','User UnActive Error');
          }
        }else{
          $active = $user->update([
            'status' => 1,
          ]);
          if($active){
            return redirect()->back()->with('success','User UnActive Successful');
          }else {
            return redirect()->back()->with('error','User UnActive Error');
          }
        }
      }
    }

    public function forceDelete(User $user){
      $forceDelete = $user->forceDelete();

      // $user->posts()->forceDelete();
      // $user->posts()->categorys()->detach();

      $userrrr = $user->posts();

      foreach($userrrr as $data){
        $data->forceDelete();
        $data->categorys()->detach();
      }

      if($forceDelete){
        return redirect()->back()->with('success','User Delete Successful');
      }else{
        return redirect()->back()->with('error','User Delete Error');
      }
    }



    // image coustome function
    private function imageHandle($request){
      $image = $request->file('image');
      $imageName = 'user'.str_random().'.'.$image->getclientOriginalExtension();
      Image::make($image)->save('uploads/user/'.$imageName);
      return $imageName;
    }

    // image custome remove function
    private function imageRemove($image){
      if(!empty($image)){
        $location = 'uploads/user/'.$image;
        if(file_exists($location)) unlink($location);
      }
    }





}
