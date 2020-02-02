<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

use App\Post;
use App\User;
use App\Category;
use App\Tag;
use App\Contact;
use App\Page;
use App\Subscription;
use App\Comment;
use App\OtherContact;
use App\Advertizement;

class WebsiteController extends Controller
{
    public function __construct(){

    }

    protected $limit=10;

    public function index(){
      // \DB::enableQueryLog();
      $data=[];
      $data['posts']=Post::publish()
                          ->status()
                          ->latestFirst()
                          ->with('user')
                          ->with([ 'categorys' => function($query){ $query->where('status',1); } ] )
                          ->whereHas('categorys', function($query){ $query->where('status',1); })
                          ->get();

      $data['category']=Category::status()
                                  ->with(['posts'=>function($query){ $query->publish()->status()->latestFirst(); } ])
                                  ->whereHas('posts', function($query){ $query->where('status',1); })
                                  ->limit(6)
                                  ->get();
      $data ['advertizement'] = Advertizement::all();
      return view('website.index',$data);
       // dd(\DB::getQueryLog());
    }

    public function page($page){
      $data = [];
      $data['page'] = Page::where('slug',$page)->first();
      return view('website.page',$data);
    }

    public function show(Post $post){

      views($post)->delayInSession(now()->addHours(24))->record();

      $data = [];
      $data['post']=$post;
      $data['next']=Post::where('id','>',$post->id)
                          ->publish()
                          ->status()
                          ->with('user')
                          ->with([ 'categorys' => function($query){ $query->where('status',1); } ] )
                          ->with([ 'tags' => function($query){ $query->where('status',1); } ] )
                          ->whereHas('categorys', function($query){ $query->where('status',1); })
                          ->first();
      $data['previous']=Post::where('id','<',$post->id)
                          ->publish()
                          ->status()
                          ->latestFirst()
                          ->with('user' )
                          ->with([ 'categorys' => function($query){ $query->where('status',1); } ] )
                          ->whereHas('categorys', function($query){ $query->where('status',1); })
                          ->first();
      return view('website.view',$data);

    }

    public function categoryByPost(Category $category){
      $data=[];
      $data['breadcrumb']=$category;
      $data['posts']=$category->posts()->status()->publish()->latestFirst()->with('user')->paginate($this->limit);
      return view('website.list',$data);

    }

    public function tagByPost(Tag $tag){
      $data=[];
      $data['breadcrumb']=$tag;
      $data['posts']=$tag->posts()->status()->publish()->latestFirst()->with('user')->paginate($this->limit);
      return view('website.list',$data);

    }

    public function postByUser(User $user){
      $data=[];
      $data['breadcrumb']=$user;
      $data['posts']=$user->posts()->status()->publish()->latestFirst()->with('categorys')->whereHas('categorys', function($query){ $query->where('status',1); })->paginate($this->limit);
      return view('website.list',$data);
    }

    public function postAll(){
      $data=[];
      $data['posts']=Post::publish()
                          ->status()
                          ->latestFirst()
                          ->with('user')
                          ->with([ 'categorys' => function($query){ $query->where('status',1); } ] )
                          ->whereHas('categorys', function($query){ $query->where('status',1); })
                          ->paginate($this->limit);

      return view('website.list',$data);
    }

    public function web_search(Request $request){
      $search = $request->search;
      $posts = Post::publish()
                    ->status()
                    ->latestFirst()
                    ->with('user')
                    ->with([ 'categorys' => function($query){ $query->where('status',1); } ] )
                    ->with([ 'tags' => function($query){ $query->where('status',1); } ] )

                    ->where('title','LIKE',"%{$search}%")

                    ->orWhere('short_description','LIKE',"%{$search}%")
                    ->orWhere('description','LIKE',"%{$search}%")

                    ->orWhereHas('user',function($query) use ($search){ $query->where('name','LIKE',"{$search}");})
                    ->orWhereHas('categorys',function($query) use ($search){ $query->where('name','LIKE',"{$search}")->where('status',1);})
                    ->orWhereHas('tags',function($query) use ($search){ $query->where('name','LIKE',"{$search}")->where('status',1);})

                    ->paginate($this->limit);
                    $posts->appends(['search' => $search]);
                    return view('website.list',compact('posts'));

    }

    public function monthlyposts(Request $request){
      $data = [];
      $data['montyYear'] = date('F',mktime(0, 0, 0, $request->month, 1)) .' '.$request->year;
      $month = [
        'month' =>$request->month,
        'year' =>$request->year,
      ];
      $data['posts']=Post::whereMonth('published_at',$request->month)->whereYear('published_at',$request->year)
                          ->publish()
                          ->status()
                          ->latestFirst()
                          ->with('user')
                          ->with([ 'categorys' => function($query){ $query->where('status',1); } ] )
                          ->whereHas('categorys', function($query){ $query->where('status',1); })
                          ->paginate($this->limit)
                          ->appends($month);

      return view('website.list',$data);

    }

    public function contact(){
      $data = [];
      $data['contact'] = OtherContact::where('id',1)->first();
      return view('website.contact',$data);
    }

    public function contact_submit(Request $request){
      $this->validate($request,[
          // 'name'=>'required|',
          // 'email'=>'required|email',
          // 'phone'=>'required',
          // 'subject'=>'required',
        // 'message'=>'required',
      ]);
      $data = [];
      $data['name'] = $request->name;
      $data['email'] = $request->email;
      $data['phone'] = $request->phone;
      $data['subject'] = $request->subject;
      $data['message'] = $request->message;
      $contact = Contact::create($data);

      if($contact){
        return redirect()->back()->with('success','Contact Message Send Successful');
      }else{
        return redirect()->back()->with('error','Contact Message Send Error');
      }
    }


    public function subscription(Request $request){
      $this->validate($request,[
        'email'=>'required|email|unique:subscriptions',
      ]);
      $data = [];
      $data['email'] = $request->email;
      $create = Subscription::create($data);

      if($create){
        return redirect()->back()->with('success','Subscription Send Successful');
      }else{
        return redirect()->back()->with('error','Subscription Send Error');
      }
    }


    public function comment(Request $request){
      $this->validate($request,[
        'name'=>'required|max:50',
        'email'=>'required|max:50|email',
        'comment'=>'required',
      ]);

      $data = [];
      $data['name'] = $request->name;
      $data['email'] = $request->email;
      $data['comment'] = $request->comment;
      $data['post_id'] = $request->post_id;

      $comment = Comment::create($data);
      if($comment){
        return redirect()->back();
      }else {
        return redirect()->back();
      }
    }

}
