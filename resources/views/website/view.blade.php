@extends('layouts.website')

@section('title',$post->title)
@section('author',$post->user->name)
@section('keywords')@foreach($post->tags as $tag) {{$tag->name}}{{','}} @endforeach @stop
@section('description',$post->short_description)
@section('site_type','article')
@section('url',route('blog.show',$post->slug))
@section('image')<meta property="og:image" content="{{$post->image_url}}"/>@stop
@section('tag')
  @foreach($post->tags as $tag)
  <meta property="article:tag" content="{{$tag->name}}"/>
  @endforeach
@stop





@section('content')

@component('website.component.breadcrumb')
<h1>{{$post->title}}</h1>
<ol class="breadcrumb">
    <li><a href="{{route('index')}}">Home</a></li>
    <li class="active">{{$post->title}}</li>
</ol>
@endcomponent

<section class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-sm-8 col-xs-12">
                    <div class="post-entry">
                        <h2>{{$post->title}}</h2>
                        <div class="catname">
                          @foreach($post->categorys as $data)

                            <a class="btn btn-dark-red" href="#">
                                <div>{{$data->name}}</div>
                            </a>
                            @endforeach


                        </div>
                        <ul class="post-tools">
                            <li> by
                                <a href="#"> <strong> {{$post->user->name}}</strong> </a>
                            </li>

                            <li> {{$post->publish_time}} </li>
                            <!-- <li>
                                <a href="#"> <i class="ti-thought"></i> 157</a>
                            </li> -->
                            <li> <i class="ti-eye"></i> {{views($post)->count()}} </li>
                        </ul>
                        <ul class="social-share">
                            <li class="facebook"> <a href="#" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u={{route('blog.show',$post->slug)}}', 'Share This Post', 'width=640,height=450');return false"><i class="fa fa-facebook"></i> Facebook</a></li>
                            <li class="twitter">
                                <a href="#" onclick="window.open('https://twitter.com/share?url={{route('blog.show',$post->slug)}}&text={{$post->title}}', 'Share This Post', 'width=640,height=450');return false"> <i class="fa fa-twitter"></i> Twitter</a>
                            </li>
                            <li class="linkedin">
                                <a href="#" onclick="window.open('http://www.linkedin.com/shareArticle?mini=true&url={{route('blog.show',$post->slug)}}', 'Share This Post', 'width=640,height=450');return false"> <i class="fa fa-linkedin"></i> LinkedIn</a>
                            </li>
                            <li class="pinterest">
                                <a href="#" onclick="window.open('http://pinterest.com/pin/create/button/?url={{route('blog.show',$post->slug)}}&media={{$post->image_url}}', 'Share This Post', 'width=640,height=450');return false"> <i class="fa fa-pinterest"></i> Pinterest</a>
                            </li>
                        </ul>
                        <div class="picture"> <img alt="" class="img-responsive" src="{{$post->image_url}}"> </div>
                        <p>{!!$post->description!!}</p>

                        <div class="tag-list">
                          @if($post->tags->count())
                            <h3>Post Tags:</h3>
                            @foreach($post->tags as $tag)
                            <a href="{{route('tag.posts',$tag->slug)}}">{{$tag->name}}</a>
                            @endforeach
                          @endif
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                            <div class="next-n-prev">
                                <div class="col-md-6 col-sm-6 col-xs-12 nopadding">
                                  @if($previous)
                                    <div class="pre-post">
                                        <span><i class="ti-arrow-left"></i>  Previous Post</span>
                                        <h4><a href="{{route('blog.show',$previous->slug)}}">{{$previous->title}}</a></h4>
                                    </div>
                                    @endif
                                </div>
                                @if($next)
                                <div class="col-md-6 col-sm-6 col-xs-12 nopadding text-right">
                                    <div class="next-post">
                                        <span> Next Post<i class="ti-arrow-right"></i> </span>
                                        <h4><a href="{{route('blog.show',$next->slug)}}">{{$next->title}}</a></h4>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="author-box">
                            <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                                <div class="col-md-3 col-sm-3 col-xs-12 nopadding">
                                    <img src="{{$post->user->user_image}}" class="img-responsive" alt="">
                                </div>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <h3><a href="{{route('user.posts',$post->user->slug)}}">{{$post->user->name}}</a></h3>
                                    <strong>Total Posts: {{$post->user->posts()->publish()->status()->count()}}</strong>
                                    <p>Appropriately optimize interactive e-services for economically sound interfaces. Seamlessly integrate one-to-one platforms after one-to-one leadership. Professionally cultivate fully researched models after.</p>
                                    <div class="social-media-icons">
                                        <ul>
                                            <li> <a target="_blank" href="{{$post->user->facebook}}"><i class="ti-facebook"></i></a></li>
                                            <li> <a target="_blank" href="{{$post->user->twitter}}"><i class="ti-twitter"></i></a></li>
                                            <li> <a target="_blank" href="{{$post->user->instagram}}"><i class="ti-instagram"></i></a></li>
                                            <li> <a target="_blank" href="{{$post->user->youtube}}"><i class="ti-youtube"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="related-posts">
                            <div class="heading colored">
                                <h2 class="main-heading">Related Posts</h2>
                                <span class="heading-ping"></span>
                            </div>
                            <div class="row">
                              @foreach($post->categorys->shuffle()->take(1) as $data)
                              @foreach($data->posts->shuffle()->take(3) as $data)
                                <article class="col-md-4 col-sm-4 col-xs-12">
                                    <div class="grid-1">
                                        <div class="picture">
                                            <div class="category-image">
                                                <a href="standard-post.html">
                                                    <img alt="{{$data->title}}" class="img-responsive" src="{{$data->image_url}}">
                                                </a>
                                                <div class="catname">
                                                  @foreach($data->categorys->shuffle()->take(2) as $cat)
                                                    <a class="btn btn-green" style="margin-bottom: 5px; " href="{{route('category.posts',$cat->slug)}}">
                                                        <div>{{$cat->name}}</div>
                                                    </a>
                                                  @endforeach
                                                </div>
                                                <div class="hover-show-div">
                                                    <a href="#" class="post-type">
                                                        <i class="ti-image"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="detail">
                                            <div class="caption">
                                                <h5>
                                          <a href="{{route('blog.show',$data->slug)}}">{{str_limit($data->title,50)}}</a>
                                       </h5>
                                            </div>
                                            <ul class="post-tools">
                                                <li> by
                                                    <a href="{{route('user.posts',$data->user->slug)}}"> <strong> {{$data->user->name}} </strong> </a>
                                                </li>
                                                <li>
                                                  <a href="#"> <i class="ti-eye"></i> {{views($data)->count()}} </a>
                                                </li>
                                                <li> {{$data->publish_time}} </li>
                                            </ul>
                                        </div>
                                    </div>
                                </article>
                              @endforeach
                              @endforeach
                            </div>
                        </div>
                        @if($post->comments->count())
                        <div class="reviews">
                            <h3>Total Coments ({{$post->comments->count()}})</h3>
                            <ol class="comment-list">
                                <!-- <li class="comment">
                                    <div class="comment-info">
                                        <img class="pull-left hidden-xs" src="{{asset('content/website')}}/images/users/author4.jpg" alt="author">
                                        <div class="author-desc">
                                            <div class="author-title">
                                                <strong><a href="#">Rebbica Alex</a></strong>
                                                <ul class="list-inline pull-right">
                                                    <li>22 Feb 2016 </li>
                                                    <li><a href="#"><i class="fa fa-reply"></i> Reply</a> </li>
                                                </ul>
                                            </div>
                                            <p>You wanna be where everyboody knows Your name. And a we knooow Flipper lives in a world full of wonder flying there-under under the sea creepy and kooky</p>
                                        </div>
                                    </div>
                                    <ol class="children">
                                        <li class="comment">
                                            <div class="comment-info">
                                                <img class="pull-left hidden-xs" src="{{asset('content/website')}}/images/users/author8.jpg" alt="author">
                                                <div class="author-desc">
                                                    <div class="author-title">
                                                        <strong><a href="#">Morgan Waston</a></strong>
                                                        <ul class="list-inline pull-right">
                                                            <li>22 Feb 2016 </li>
                                                            <li><a href="#"><i class="fa fa-reply"></i> Reply</a> </li>
                                                        </ul>
                                                    </div>
                                                    <p>The first mate and his Skipper too this is will do their very best to make the most others comfortable in their tropic lives in a world of wonder.</p>
                                                </div>
                                            </div>
                                        </li>
                                    </ol>
                                </li> -->
                                @foreach($post->comments as $comment)
                                <li class="comment">
                                    <div class="comment-info">
                                        <img class="pull-left hidden-xs" src="{{asset('content/website')}}/images/users/author3.jpg" alt="author">
                                        <div class="author-desc">
                                            <div class="author-title">
                                                <strong><a href="#">{{$comment->name}}</a></strong>
                                                <ul class="list-inline pull-right">
                                                    <li>{{$comment->created_at->diffforhumans()}} </li>
                                                    <!-- <li><a href="#"><i class="fa fa-reply"></i> Reply</a> </li> -->
                                                </ul>
                                            </div>
                                            <p>{{$comment->comment}}</p>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ol>
                        </div>
                        @endif
                        <div class="commentform">
                            <form action="{{route('comment')}}" method="post" class="row">
                              @csrf
                              <input class="form-control" name="post_id" value="{{$post->id}}"  placeholder="" type="hidden">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Name <span class="required">*</span></label>
                                        <input class="form-control" name="name" placeholder="" type="text">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Email <span class="required">*</span></label>
                                        <input class="form-control" name="email" placeholder="" type="email">
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label>Comment <span class="required">*</span></label>
                                        <textarea class="form-control" name="comment" placeholder="" rows="8" cols="6"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <input value="Post Comment" class="btn btn-colored-blog" type="submit">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12 col-xs-12" id="side-bar-right">
                    <div class="theiaStickySidebar">
                        <aside>
                            @include('website.include.search-widget')
                            @include('website.include.category-widget')
                            @include('website.include.month-widget')
                            @include('website.include.tab-widget')
                            @include('website.include.slider-post-widget')
                            @include('website.include.subscription-widget')
                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
