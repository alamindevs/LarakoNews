@extends('layouts.website')
@section('content')

<section class="zerogrid-section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-xs-12 col-sm-12">
                <div class="zerogrid">
                    <div class="row">
                      @foreach($posts as $data)
                      @if($loop->first)
                          <div class="col-2-4">
                              <div class="wrap-col">
                                  <div class="grid-item">
                                      <div class="post-content">
                                          <div class="catname">
                                            @foreach($data->categorys as $cat)
                                              <a class="btn btn-green" href="{{route('category.posts',$cat->slug)}}">
                                                  <div>{{$cat->name}}</div>
                                              </a>
                                            @endforeach
                                          </div>
                                          <h5> <a href="{{route('blog.show',$data->slug)}}">{{$data->title}}</a> </h5>
                                          <ul class="post-tools">
                                              <li> {{$data->publish_time }} </li>
                                              <li> <a href="#"><i class="ti-eye"></i> {{views($data)->count()}} </a></li>
                                          </ul>
                                      </div>
                                      <div class="post-thumb"> <img alt="" src="{{$data->image_url}}"> </div>
                                  </div>
                              </div>
                          </div>
                          @endif
                      @endforeach

                      @foreach($posts->shuffle()->take(4) as $data)
                        <div class="col-1-4">
                            <div class="wrap-col">
                                <div class="grid-item">
                                    <div class="post-content">
                                        <div class="catname">
                                          @foreach($data->categorys->shuffle()->take(1) as $cat)
                                            <a class="btn btn-green" href="{{route('category.posts',$cat->slug)}}">
                                                <div>{{$cat->name}}</div>
                                            </a>
                                          @endforeach
                                        </div>
                                        <h5> <a href="{{route('blog.show',$data->slug)}}">{{$data->title}}</a> </h5>
                                        <ul class="post-tools">
                                            <li> {{$data->publish_time}} </li>
                                            <li> <a href="#"><i class="ti-eye"></i> {{views($data)->count()}}</a> </li>
                                        </ul>
                                    </div>
                                    <div class="post-thumb"> <img alt="" src="{{$data->image_url}}"> </div>
                                </div>
                            </div>
                        </div>
                      @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-12 col-xs-12">

                <div class="section">
                    <div class="col-md-12 col-xs-12 col-sm-12 nopadding">
                        <div class="heading">
                            <h2 class="main-heading">New Posts</h2>
                            <span class="heading-ping"></span>
                            <span class="heading-read-more">
                       <a href="{{route('all.posts')}}" class="btn btn-black">all</a>
                       @foreach($category as $data)
                        @if($data->posts->count())
                        <a href="{{route('category.posts',$data->slug)}}" class="btn btn-green">{{$data->name}}</a>
                        @endif
                       @endforeach
                       </span>
                        </div>
                    </div>
                    <div class="row">
                      @foreach($posts->take(6) as $data)

                        <article class="col-md-6 col-sm-6 col-xs-12">
                            <div class="grid-1">
                                <div class="picture">
                                    <div class="category-image">
                                        <a href="{{route('blog.show',$data->slug)}}">
                                            <img alt="" class="img-responsive" src="{{$data->image_url}}">
                                        </a>
                                        <div class="catname">
                                          @foreach($data->categorys as $cat)
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
                                   <a href="{{route('blog.show',$data->slug)}}">{{str_limit($data->title,40)}}</a>
                                </h5>
                                    </div>
                                    <ul class="post-tools">
                                        <li> by
                                            <a href="{{route('user.posts',$data->user->slug)}}"> <strong>{{$data->user->name}}</strong> </a>
                                        </li>
                                        <li> {{$data->publish_time}} </li>
                                        <li>
                                            <a href="#"> <i class="ti-eye"></i> {{views($data)->count()}}</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </article>

                      @endforeach
                    </div>

                    <div class="show-more-btn">
                        <a href="{{route('all.posts')}}" class="btn btn-colored-blog"> <i class="fa fa-refresh"></i>Load More </a>
                    </div>
                </div>
                <!--ADVERTIZEMENT -->
                <div class="ad-div text-center">
                  @foreach($advertizement->shuffle()->take(1) as $add)
                  @if($add->type==1)
                    <a href="{{$add->url}}" target="_blank">
                      <img src="{{$add->image_url}}" class="img-responsive" alt="">
                    </a>
                  @endif
                  @if($add->type==2)
                  {!!$add->add!!}
                  @endif
                  @endforeach
                </div>


                @foreach($category->take(1) as $data)
                <div class="section">
                     <div class="col-md-12 col-xs-12 col-sm-12 nopadding">
                        <div class="heading">
                           <h2 class="main-heading">{{$data->name}}</h2>
                           <span class="heading-ping"></span>
                           <span class="heading-read-more">
                           <a href="{{route('category.posts',$data->slug)}}" class="btn btn-black">See all</a>
                           </span>
                        </div>
                     </div>
                     <div class="row">
                        <article class="col-md-6 col-sm-6 col-xs-12">
                          @foreach($data->posts as $post)
                            @if($loop->first)
                           <div class="latest-news-grid grid-1">
                              <div class="picture">
                                 <div class="category-image">
                                    <a href="{{route('blog.show',$post->slug)}}">
                                    <img alt="{{$post->title}}" class="img-responsive" src="{{$post->image_url}}">
                                    </a>
                                    <div class="catname">
                                      @foreach($post->categorys as $cat)
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
                                       <a href="{{route('blog.show',$post->slug)}}">{{$post->title}}</a>
                                    </h5>
                                 </div>
                                 <ul class="post-tools">
                                    <li> by <a href="{{route('user.posts',$post->user->slug)}}"><strong> {{$post->user->name}}</strong> </a></li>

                                    <li>  {{$post->publish_time}} </li>

                                    <li><a href="#"> <i class="ti-eye"></i> {{views($post)->count()}}</a> </li>
                                 </ul>
                                 <p> {{str_limit($post->short_description,80)}} <a href="{{route('blog.show',$post->slug)}}" class="readmore">Read More</a> </p>
                              </div>
                           </div>
                           @endif
                          @endforeach
                        </article>
                        <ul class="small-grid">
                          @foreach($data->posts->slice(1, 4) as $post)
                           <li class="col-md-6 col-sm-6 col-xs-12">
                              <div class="small-post">
                                 <div class="small-thumb"> <a href="{{route('blog.show',$post->slug)}}"><img class="" src="{{$post->image_small}}" alt=""></a> </div>
                                 <div class="post-content">
                                    <h3> <a href="{{route('blog.show',$post->slug)}}">{{$post->title}}</a> </h3>
                                    <ul class="post-tools">

                                       <li>  {{$post->publish_time}} </li>
                                       <li title="Comments"> <a href="#"><i class="ti-eye"></i> {{views($post)->count()}} </a></li>
                                    </ul>
                                 </div>
                              </div>
                           </li>
                          @endforeach
                        </ul>
                     </div>
                  </div>
                @endforeach
                <!--Ad Div -->
                <div class="ad-div text-center">
                  @foreach($advertizement->shuffle()->take(1) as $add)
                  @if($add->type==1)
                    <a href="{{$add->url}}" target="_blank">
                      <img src="{{$add->image_url}}" class="img-responsive" alt="">
                    </a>
                  @endif
                  @if($add->type==2)
                  {!!$add->add!!}
                  @endif
                  @endforeach
                </div>

                @foreach($category->slice(1,1) as $data)

                <div class="section">
                     <div class="col-md-12 col-xs-12 col-sm-12 nopadding">
                        <div class="heading">
                           <h2 class="main-heading">{{$data->name}}</h2>
                           <span class="heading-ping"></span>
                           <span class="heading-read-more">
                           </span>
                        </div>
                     </div>
                     <div class="col-md-12 col-xs-12 col-sm-12 nopadding">
                        <div class="row">
                           <div class="content-slider-2  owl-carousel owl-theme">
                             @foreach($data->posts->take(8) as $post)
                              <div class="item">
                                 <article class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="latest-news-grid grid-1">
                                       <div class="picture">
                                          <div class="category-image">
                                             <a href="{{route('blog.show',$post->slug)}}">
                                             <img alt="{{$post->title}}" class="img-responsive" src="{{$post->image_url}}">
                                             </a>
                                             <div class="catname">
                                               @foreach($post->categorys as $cat)
                                                <a class="btn btn-green" style="margin-bottom: 5px;" href="{{route('category.posts',$cat->slug)}}">
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
                                                <a href="{{route('blog.show',$post->slug)}}">{{$post->title}}</a>
                                             </h5>
                                          </div>
                                          <ul class="post-tools">
                                             <li> <strong> <a href="{{route('user.posts',$post->user->slug)}}">{{$post->user->name}}</a> </strong> </li>
                                             <li> {{$post->publish_time}} </li>
                                             <li> <i class="ti-eye"></i> {{views($post)->count()}} </li>
                                          </ul>
                                       </div>
                                    </div>
                                 </article>
                              </div>
                            @endforeach
                           </div>
                        </div>
                     </div>
                  </div>

                @endforeach

                <div class="ad-div text-center">
                  @foreach($advertizement->shuffle()->take(1) as $add)
                  @if($add->type==1)
                    <a href="{{$add->url}}" target="_blank">
                      <img src="{{$add->image_url}}" class="img-responsive" alt="">
                    </a>
                  @endif
                  @if($add->type==2)
                  {!!$add->add!!}
                  @endif
                  @endforeach
                </div>

                @foreach($category as $data)
                @if($loop->index==2)
                <div class="section listing">
                    <div class="col-md-12 col-xs-12 col-sm-12 nopadding">
                        <div class="heading">
                            <h2 class="main-heading">{{$data->name}}</h2>
                            <span class="heading-ping"></span>
                            <span class="heading-read-more">
                       <a href="{{route('category.posts',$data->slug)}}" class="btn btn-black">See all</a>
                       </span>
                        </div>
                    </div>
                    <article class="col-md-12 col-sm-12 col-xs-12">
                        <div class="row">
                          @foreach($data->posts->take(3) as $post)
                            <div class="grid-1">
                                <ul>
                                    <li class="col-md-5 col-sm-3 col-xs-12 nopadding">
                                        <div class="thumb"> <img src="{{$post->image_url}}" alt="{{$post->title}}">
                                        </div>
                                        <div class="hover-show-div">
                                            <a href="#" class="post-type">
                                                <i class="ti-image"></i>
                                            </a>
                                        </div>
                                    </li>
                                    <li class="col-md-7 col-sm-9 col-xs-12">
                                        <div class="desc post-content">
                                            <h5><a href="{{route('blog.show',$post->slug)}}">{{$post->title}}</a></h5>
                                            <ul class="post-tools">
                                                <li> by <a href="{{route('user.posts',$post->user->slug)}}"><strong>{{$post->user->name}}</strong> </a></li>

                                                <li> {{$post->publish_time}} </li>

                                                <li> <a href="#"><i class="ti-eye"></i> {{views($post)->count()}}</a> </li>
                                            </ul>
                                            <p>{{$post->short_description}}<a href="{{route('user.posts',$post->slug)}}" class="readmore"><strong>Read More</strong></a> </p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                          @endforeach
                        </div>
                    </article>
                </div>
                @endif
                @endforeach
            </div>
            <div class="col-md-4 col-sm-12 col-xs-12" id="sidebar">
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
</section>

<section class="full-width-slider">
    <div class="container">
      @foreach($category as $data)
      @if($loop->index==3)
        <div class="row">
            <div class="col-md-12 col-xs-12 col-sm-12">
                <div class="col-md-12 col-xs-12 col-sm-12 nopadding">
                    <div class="heading">
                        <h2 class="main-heading">{{$data->name}}</h2>
                        <span class="heading-ping"></span>
                    </div>
                </div>
                <div class="col-md-12 col-xs-12 col-sm-12 nopadding">
                    <div class="row">
                        <div class="content-slider-full-width  owl-carousel owl-theme">
                          @foreach($data->posts->take(8) as $post)
                            <div class="item">
                                <article class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="picture">
                                        <div class="category-image">
                                            <a href="{{route('blog.show',$post->slug)}}">
                                                <img alt="" class="img-responsive" src="{{$post->image_url}}">
                                            </a>
                                            <div class="catname">
                                              @foreach($post->categorys->take(3) as $cat)
                                                <a class="btn btn-green" href="{{route('category.posts',$cat->slug)}}">
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
                                      <a href="{{route('blog.show',$post->slug)}}">{{$post->title}}</a>
                                   </h5>
                                        </div>
                                        <ul class="post-tools">
                                            <li> by
                                                <a href="{{route('user.posts',$post->user->slug)}}"> <strong> {{$post->user->name}}</strong> </a>
                                            </li>
                                            <li> {{$post->publish_time}} </li>
                                            <li> <a href="#"><i class="ti-eye"></i> {{views($post)->count()}} </a></li>
                                        </ul>
                                    </div>
                                </article>
                            </div>
                          @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
      @endif
      @endforeach
    </div>
</section>

<section class="photo-gallery-section">
    <div class="container-flude">
        <div class="row">
            <div class="col-md-12 col-xs-12 col-sm-12">
                <div class="photo-gallery-slider owl-carousel owl-theme">
                    @foreach($posts->shuffle()->take(12) as $data)
                    <div class="item">
                        <a href="{{$data->image_url}}" class="tt-lightbox"> <img class="img-responsive center-block" alt="{{$data->title}}" src="{{$data->image_url}}"> </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
