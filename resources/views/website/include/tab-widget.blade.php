<div class="widget widget-bg">
    <div class="tabs">
        <div role="tabpanel">
            <ul class="nav nav-tabs nav-justified" role="tablist">
                <li class="active" role="presentation"> <a aria-controls="popular" aria-expanded="true" data-toggle="tab" href="#popular" role="tab">POPULAR</a> </li>
                <li class="" role="presentation"> <a aria-controls="tags" aria-expanded="false" data-toggle="tab" href="#tags" role="tab">TAGS</a> </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="popular" role="tabpanel">
                    <ul class="tabs-posts">
                      @foreach($mostView as $data)
                        <li>
                            <div class="pic">
                                <a href="{{route('blog.show',$data->slug)}}"><img alt="{{$data->title}}" class="img-responsive" src="{{$data->image_small}}"></a>
                            </div>
                            <div class="caption"> <a href="{{route('blog.show',$data->slug)}}">{{$data->title}}</a> </div>
                            <ul class="post-tools">
                                <li> {{$data->publish_time}} </li>
                                <li title="Comments"> <i class="ti-eye"></i> {{views($data)->count()}} </li>
                            </ul>
                        </li>
                      @endforeach
                    </ul>
                </div>
                <div class="tab-pane" id="tags" role="tabpanel">
                    <div class="tag-list"> @foreach($tags as $tag) <a href="{{route('tag.posts',$tag->slug)}}">{{$tag->name}}</a> @endforeach  </div>
                </div>
            </div>
        </div>
    </div>
</div>
