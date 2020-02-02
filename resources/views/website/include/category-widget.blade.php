<div class="widget widget-bg">
    <div class="heading">
        <h2 class="main-heading">Categorys</h2>
        <span class="heading-ping"></span>
    </div>
    <ul class="cat-holder">
      @foreach($category as $data)
        <li> <a href="{{route('category.posts',$data->slug)}}">{{$data->name}}</a> <i class="count">({{$data->posts->count()}})</i></li>
      @endforeach
    </ul>
</div>
