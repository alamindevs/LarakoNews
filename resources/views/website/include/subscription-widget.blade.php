<div class="widget widget-bg rss-widget">
    <div class="heading">
        <h2 class="main-heading">Subscribe here</h2>
        <span class="heading-ping"></span>
    </div>
    <div class="newsletter">
        <form action="{{route('subscription')}}" method="post" class="form-inline">
          @csrf
            <div class="form-group">
                <input type="email" name="email" class="form-control" id="exampleInputEmail2" placeholder="janedoe@example.com">
            </div>
            <button type="submit" class="btn btn-default"><i class="ti-angle-right"></i></button>
        </form>
    </div>
</div>
