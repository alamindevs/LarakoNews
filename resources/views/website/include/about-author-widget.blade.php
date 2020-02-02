<div class="widget widget-bg">
    <div class="heading">
        <h2 class="main-heading">About Author</h2>
        <span class="heading-ping"></span>
    </div>
    <div class="author-widget">
        <div class="auth-pic">
            <img src="{{$user->user_image}}" class="img-responsive" alt="">
        </div>
        <div class="auth-meta">
            <h4>{{$user->name}}</h4>
            <strong>Total Posts: {{$user->posts()->where('status',1)->where('published_at','<=',Carbon\Carbon::now())->whereHas('categorys', function($query){ $query->where('status',1); })->count()}}</strong>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim minim veniam, quis nostrud exercitation .</p>
            <div class="social-media-icons">
                <ul>
                    <li> <a target="_blank" href="{{$user->facebook}}"><i class="ti-facebook"></i></a></li>
                    <li> <a target="_blank" href="{{$user->twitter}}"><i class="ti-twitter"></i></a></li>
                    <li> <a target="_blank" href="{{$user->instagram}}"><i class="ti-instagram"></i></a></li>
                    <li> <a target="_blank" href="{{$user->youtube}}"><i class="ti-youtube"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
