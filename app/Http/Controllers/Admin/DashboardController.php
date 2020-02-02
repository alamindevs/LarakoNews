<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use App\Post;
use App\Category;
use App\Subscription;
use App\Advertizement;
use App\Contact;
use App\Comment;

class DashboardController extends Controller
{
    public function __construct(){

    }

    public function index(){
      $data = [];
      $data['publish_post']=Post::publish()->status()->with('user','categorys')->latest()->get();
      $data['pending_post']=Post::publish()->panding()->with('user','categorys')->latest()->get();
      $data['trush_post']=Post::onlyTrashed()->with('categorys')->with(['user'=> function($query){$query->withTrashed();}])->latest()->get();

      $data['active_category'] = Category::status()->with('posts')->get();
      $data['unactive_category'] = Category::where('status',0)->with('posts')->get();
      $data['trush_category'] = Category::onlyTrashed()->with('posts')->get();

      $data['users'] = User::with('role')->where('status',1)->get();

      $data['subscription'] = Subscription::count();
      $data['advertizement'] = Advertizement::count();
      $data['contact'] = Contact::count();
      $data['comments'] = Comment::count();


      return view('admin.index',$data);
    }
}
