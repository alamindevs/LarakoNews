<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Category;
use App\User;
use App\Post;
use App\Tag;
use App\Seo;
use App\Page;
use App\OtherContact;
use App\LogoBreadcrumb;
use View;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
      View::composer('website.include.category-widget',function($view){
        $category=Category::status()
                            ->with(['posts'=>function($query){$query->publish()->status();} ])
                            ->whereHas('posts', function($query){ $query->where('status',1)->publish(); })
                            ->get();
          $view->with('category',$category);
        });

        View::composer('layouts.admin',function($view){
          $user = User::status()->get();
          $copuright = OtherContact::where('id',1)->first();
          $logo = LogoBreadcrumb::where('id',1)->first();
          $view->with('user',$user)->with('copuright',$copuright)->with('logo',$logo);
        });

        View::composer('layouts.website',function($view){
          $topnews = Post::publish()
                        ->status()
                        ->latestFirst()
                        ->with('user')
                        ->with([ 'categorys' => function($query){ $query->where('status',1); } ] )
                        ->whereHas('categorys', function($query){ $query->where('status',1); })
                        ->limit(8)
                        ->get();
          $category = Category::status()
                              ->with(['posts'=>function($query){$query->publish()->status();} ])
                              ->whereHas('posts', function($query){ $query->where('status',1); })
                              ->get();
          $contact = OtherContact::where('id',1)->first();
          $tags = Tag::status()
                      ->with(['posts' => function($query){ $query->publish()->status();}])
                      ->whereHas('posts', function($query){ $query->status()->publish(); })
                      ->get();
          $pages = Page::where('status',1)->get();
          $mostView = Post::publish()
                          ->status()
                          ->with('user')
                          ->with([ 'categorys' => function($query){ $query->where('status',1); } ] )
                          ->whereHas('categorys', function($query){ $query->where('status',1); })
                          ->limit(3)
                          ->orderByViews()
                          ->inRandomOrder()
                          ->get();
          $seo = Seo::where('id',1)->first();
          $logo = LogoBreadcrumb::where('id',1)->first();
          $view->with('topnews',$topnews)
                ->with('category',$category)
                ->with('contact',$contact)
                ->with('tags',$tags)
                ->with('pages',$pages)
                ->with('mostView',$mostView)
                ->with('seo',$seo)
                ->with('logo',$logo);
        });

        View::composer('website.include.tab-widget',function($view){

          $mostView = Post::publish()
                          ->status()
                          ->with('user')
                          ->with([ 'categorys' => function($query){ $query->where('status',1); } ] )
                          ->whereHas('categorys', function($query){ $query->where('status',1); })
                          ->limit(5)
                          ->orderByViews()
                          ->inRandomOrder()
                          ->get();
          $tags = Tag::status()
                      ->with(['posts' => function($query){ $query->publish()->status();}])
                      ->whereHas('posts', function($query){ $query->status()->publish(); })
                      ->get();
          $view->with('mostView',$mostView)->with('tags',$tags);
        });

        View::composer('website.include.slider-post-widget',function($view){
          $post = Post::publish()
                        ->status()
                        ->with('user')
                        ->with([ 'categorys' => function($query){ $query->where('status',1); } ] )
                        ->whereHas('categorys', function($query){ $query->where('status',1); })
                        ->limit(10)
                        ->inRandomOrder()
                        ->get();
          $view->with('post',$post);
        });

        View::composer('website.include.month-widget',function($view){
          $posts_by_date = Post::selectRaw('count(id) as post_count, year(published_at) year, month(published_at) month, monthname(published_at) month_name')
                                ->groupBy('year', 'month','month_name')
                                ->orderByRaw('min(published_at) desc')
                                ->publish()
                                ->status()
                                ->with('user')
                                ->with([ 'categorys' => function($query){ $query->where('status',1); } ] )
                                ->whereHas('categorys', function($query){ $query->where('status',1); })
                                ->get();

          $view->with('posts_by_date',$posts_by_date);
        });

        View::composer('website.component.breadcrumb',function($view){
            $logo = LogoBreadcrumb::where('id',1)->first();

            $view->with('logo',$logo);
        });

        View::composer('auth.login',function($view){
          $logo = LogoBreadcrumb::where('id',1)->first();
          $view->with('logo',$logo);
        });

        View::composer('auth.passwords.email',function($view){
          $logo = LogoBreadcrumb::where('id',1)->first();
          $view->with('logo',$logo);
        });

        View::composer('auth.passwords.reset',function($view){
          $logo = LogoBreadcrumb::where('id',1)->first();
          $view->with('logo',$logo);
        });
    }
}
