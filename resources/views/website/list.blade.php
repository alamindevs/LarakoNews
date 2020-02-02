@extends('layouts.website')

@section('content')

@component('website.component.breadcrumb')
<h1>{{$breadcrumb->name ?? request('search')?? $montyYear ?? 'All'}}</h1>
  <ol class="breadcrumb">
      <li><a href="{{route('index')}}">Home</a></li>
      @if(request('search'))
      <li class="active">Search</li>
      @endif
      <li class="active">{{$breadcrumb->name ?? request('search') ?? $montyYear ?? 'All'}}</li>
  </ol>
@endcomponent


<section class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-sm-12 col-xs-12">
                    <div class="section listing">
                      @if(! $posts->count())
                      <div class="alert alert-danger" role="alert">
                        <strong>{{$breadcrumb->name ?? request('search') ?? $montyYear ?? 'All'}}</strong> - Post Not Found
                      </div>
                      @endif
                        <article class="col-md-12 col-sm-12 col-xs-12">
                            <div class="row">
                              @foreach($posts as $data)
                              @if($data->user && $data->categorys->count())
                                <div class="grid-1">
                                    <ul>
                                        <li class="col-md-5 col-sm-3 col-xs-12 nopadding">
                                            <div class="thumb"> <img src="{{$data->image_url}}" alt="">
                                            </div>
                                            <div class="hover-show-div">
                                                <a href="#" class="post-type">
                                                    <i class="ti-image"></i>
                                                </a>
                                            </div>
                                        </li>
                                        <li class="col-md-7 col-sm-9 col-xs-12">
                                            <div class="desc post-content">
                                                <h5><a href="{{route('blog.show',$data->slug)}}">{{$data->title}}</a></h5>
                                                <ul class="post-tools">
                                                    <li> by <a href="{{route('user.posts',$data->user->slug)}}"><strong> {{$data->user->name}}</strong> </a></li>
                                                    <li>{{$data->publish_time}}</li>
                                                    <li> <a href="#"><i class="ti-eye"></i> {{views($data)->count()}}</a> </li>
                                                </ul>
                                                <p>{{ $data->short_description}}<a href="{{route('blog.show',$data->slug)}}" class="readmore"><strong>Read More</strong></a> </p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                              @endif
                              @endforeach

                                <div class="pagination-holder">
                                    <nav>
                                        <ul class="pagination">

                                            {{$posts->links()}}
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12 col-xs-12" id="sidebar">

                    <aside>
                      @if(Route::currentRouteName('user.posts')=='user.posts')
                        @include('website.include.about-author-widget',['user'=>$breadcrumb])
                      @endif

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

@endsection
