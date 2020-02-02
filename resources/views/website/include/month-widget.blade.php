<div class="widget widget-bg">
    <div class="heading">
        <h2 class="main-heading">Archieve</h2>
        <span class="heading-ping"></span>
    </div>
    <ul class="cat-holder">
      @foreach($posts_by_date->take(12) as $data)
        <li> <a href="{{route('monthly.posts', ['month' => $data->month, 'year' => $data->year] ) }}">{{$data->month_name}} {{$data->year}}</a> <i class="count">( {{$data->post_count}} )</i> </li>
      @endforeach
    </ul>
</div>
