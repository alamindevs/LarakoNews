<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\OtherContact;
use App\Seo;
use App\LogoBreadcrumb;
use Image;


class SettingController extends Controller
{
    public function __construct(){
      $this->middleware('admin');
    }

    public function footerContent(){
      $data = [];
      $data['data'] = OtherContact::where('id',1)->first();

      return view('admin.settings.footercontent_contact',$data);
    }

    public function footerContent_submit(Request $request){

      $this->validate($request,[
        'email'=>'required|email|max:190',
        'phone'=>'required|max:20',
        'address'=>'required|max:190',
        'short_about'=>'required|max:190',
        'facebook'=>'required|max:190',
        'twitter'=>'required|max:190',
        'instagram'=>'required|max:190',
        'linkedin'=>'required|max:190',
        'google'=>'required|max:190',
        'pinterest'=>'required|max:190',
        'copyright'=>'required|max:190',
      ]);

      $data = [];
      $data['email']= $request->email;
      $data['phone']= $request->phone;
      $data['address']= $request->address;
      $data['short_about']= $request->short_about;
      $data['facebook']= $request->facebook;
      $data['twitter']= $request->twitter;
      $data['instagram']= $request->instagram;
      $data['linkedin']= $request->linkedin;
      $data['google']= $request->google;
      $data['pinterest']= $request->pinterest;
      $data['copyright']= $request->copyright;

      $update = OtherContact::where('id',1)->update($data);

      if($update){
        return redirect()->back()->with('success','Update Complete');
      }else{
        return redirect()->back()->with('success','Update Error');
      }

    }


    public function seo(){
      $data = Seo::where('id',1)->first();
      return view('admin.settings.seo',compact('data'));

    }

    public function seo_submit(Request $request){
      $this->validate($request,[
        'title'=>'required|max:190',
        'author'=>'required|max:50',
        'description'=>'required',
        'keywords'=>'required',
      ]);


      $update = Seo::where('id',1)->update([
        'title'=>$request->title,
        'author'=>$request->author,
        'description'=>$request->description,
        'keywords'=>$request->keywords,
      ]);
      if($update){
        return redirect()->back()->with('success','Update Complete');
      }else{
        return redirect()->back()->with('success','Update Error');
      }

    }

    public function image(){
        $image = LogoBreadcrumb::where('id',1)->first();
        return view('admin.settings.logo',compact('image'));
    }

    public function image_submit(Request $request){
      $this->validate($request,[
        'logo'=>'image|dimensions:width=265,height=60',
        'breadcrumb'=>'image|dimensions:width=1600,height=900',
      ]);

      $data = [];

      if($request->has('logo')){
        $image=$request->file('logo');
        $imagelogoName='logo'.time().'.'.$image->getclientOriginalExtension();
        Image::make($image)->resize(265,60)->save('uploads/logo/'.$imagelogoName);
        $data['log']= $imagelogoName;
      }
      if($request->has('breadcrumb')){
        $image=$request->file('breadcrumb');
        $imagebreadcrumbName='breadcrumb'.time().'.'.$image->getclientOriginalExtension();
        Image::make($image)->resize(1600,900)->save('uploads/logo/'.$imagebreadcrumbName);
        $data['breadcrumb']= $imagebreadcrumbName;
      }

      $update = LogoBreadcrumb::where('id',1)->update($data);

      if($update){
        return redirect()->back()->with('success','Update Complete');
      }else{
        return redirect()->back()->with('success','Update Error');
      }
    }
}
