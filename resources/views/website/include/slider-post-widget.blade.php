<div class="widget widget-bg ">
    <div class="heading">
        <h2 class="main-heading">Posts</h2>
        <span class="heading-ping"></span>
    </div>
    <div class="featured-post-slider-single-post owl-carousel owl-theme">
      @foreach($post as $data)
        <div class="item">
            <div class="latest-news-grid grid-1">
                <div class="picture">
                    <div class="category-image">
                        <a href="{{route('blog.show',$data->slug)}}">
                            <img alt="{{$data->title}}" class="img-responsive" src="{{$data->image_url}}">
                        </a>
                        <div class="catname">
                          @foreach($data->categorys->shuffle()->take(2) as $cat)
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
                  <a href="{{route('blog.show',$data->slug)}}">{{$data->title}}</a>
               </h5>
                    </div>
                    <ul class="post-tools">
                        <li> by
                            <a href="{{route('user.posts',$data->user->slug)}}"> <strong> {{$data->user->name}}</strong> </a>
                        </li>
                        <li> {{$data->publish_time}} </li>
                        <li> <a href="#"><i class="ti-eye"></i> {{views($data)->count()}} </a></li>
                    </ul>
                </div>
            </div>
        </div>
      @endforeach
    </div>
</div>
