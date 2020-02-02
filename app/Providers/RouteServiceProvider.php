<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

use App\User;
use App\Post;
use App\Category;
use App\Tag;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        // website single post model bindings condition
        Route::bind('post', function ($slug) {
          if(Route::currentRouteName('blog.show') =='blog.show'){  //website blog post show
            return Post::where('slug',$slug)->with('user')
                        ->with(['tags'=>function($query){$query->where('status',1);}])
                        ->with(['comments'=>function($query){$query->where('status',1);}])
                        ->with(['categorys'=>function($query){$query->where('status',1);}])
                        ->whereHas('categorys', function($query){ $query->where('status',1); })
                        ->publish()
                        ->status()
                        ->first() ?? abort(404);

          }elseif(Route::currentRouteName('admin.post.restore') =='admin.post.restore'){  //admin post resotre
            return Post::withTrashed()->where('slug',$slug)->with('user')->with(['categorys'=>function($query){$query->where('status',1);}])->first() ?? abort(404);

          }elseif(Route::currentRouteName('admin.post.forceDelete') =='admin.post.forceDelete'){ // admin post permanet delete
            return Post::withTrashed()->where('slug',$slug)->with('user')->with(['categorys'=>function($query){$query->where('status',1);}])->first() ?? abort(404);

          }else{
            return Post::where('slug',$slug)->with('user')->with(['categorys'=>function($query){$query->where('status',1);}])->first() ?? abort(404);
          }
        });


        // website single category model bindings condition
        Route::bind('category', function ($slug) {
          if(Route::currentRouteName('category.posts') == 'category.posts'){
            return Category::where('slug',$slug)->status()->first() ?? abort(404); // Web site category by Posts

          }elseif(Route::currentRouteName('admin.category.restore') =='admin.category.restore'){
            return Category::withTrashed()->where('slug',$slug)->first() ?? abort(404); // Admin restore category

          }elseif(Route::currentRouteName('admin.category.forceDelete') =='admin.category.forceDelete'){
            return Category::withTrashed()->where('slug',$slug)->first() ?? abort(404); // Admin delete category

          }else{
            return Category::where('slug',$slug)->first() ?? abort(404);
          }
        });

        // website single User model bindings condition
        Route::bind('user', function ($slug) {
        if(Route::currentRouteName('user.posts') =='user.posts'){
          return User::where('slug',$slug)->first() ?? abort(404); // Website User By Posts

        }elseif(Route::currentRouteName('admin.user.restore') =='admin.user.restore'){
          return User::withTrashed()->where('slug',$slug)->first() ?? abort(404); // Admin user Restore

        }elseif(Route::currentRouteName('admin.user.forceDelete') =='admin.user.forceDelete'){
          return User::withTrashed()->where('slug',$slug)->first() ?? abort(404); // Admin user Restore

        }else{
          return User::withTrashed()->where('slug',$slug)->first() ?? abort(404);
        }
        });

        Route::bind('tag',function($slug){
          if(Route::currentRouteName('tag.posts') =='tag.posts'){
            return Tag::where('slug',$slug)->status()->with('posts')->first() ?? abort(404); // Website Tag By Posts

          }else {
            return Tag::withTrashed()->where('slug',$slug)->first() ?? abort(404);
          }
        });


    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }
}
