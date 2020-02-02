@extends('layouts.admin')



@push('css')
<!-- <link href="{{asset('content/admin')}}/assets/libs/chartist/dist/chartist.min.css" rel="stylesheet">
<link href="{{asset('content/admin')}}/assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.css" rel="stylesheet">
<link href="{{asset('content/admin')}}/assets/libs/morris.js/morris.css" rel="stylesheet">
<link href="{{asset('content/admin')}}/assets/extra-libs/c3/c3.min.css" rel="stylesheet">-->
<link href="{{asset('content/admin')}}/assets/libs/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet" />
<link href="{{asset('content/admin')}}/assets/extra-libs/calendar/calendar.css" rel="stylesheet" />
@endpush

@section('content')
  <!-- breadcrumb -->
  @component('admin.component.breadcrumb')

    @slot('title')
      <h5 class="font-medium text-uppercase mb-0">Dashboard</h5>
    @endslot

    @slot('list')
      <!-- <li class="breadcrumb-item"><a href="index.html">Home</a></li> -->
      <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
    @endslot

  @endcomponent

<div class="page-content container-fluid">
  <div class="card-group">
        <div class="card p-2 mr-2 p-lg-3">
            <div class="p-lg-3 p-2">
                <div class="d-flex align-items-center">
                    <button class="btn btn-circle btn-cyan text-white btn-lg" href="javascript:void(0)">
                        <i class="mdi mdi-check"></i>
                    </button>
                    <div class="ml-4" style="width: 38%;">
                        <h4 class="font-light">Publish Post</h4>
                        <div class="progress">
                            <div class="progress-bar bg-cyan" role="progressbar" style="width: {{$publish_post->count()}}%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="40"></div>
                        </div>
                    </div>
                    <div class="ml-auto">
                        <h2 class="display-7 mb-0">{{$publish_post->count()}}</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="card p-2 mr-2 p-lg-3">
            <div class="p-lg-3 p-2">
                <div class="d-flex align-items-center">
                    <button class="btn btn-circle btn-warning text-white btn-lg" href="javascript:void(0)">
                        <i class="mdi mdi-timer-sand"></i>
                    </button>
                    <div class="ml-4" style="width: 38%;">
                        <h4 class="font-light">Pending Post</h4>
                        <div class="progress">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: {{$pending_post->count()}}%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="40"></div>
                        </div>
                    </div>
                    <div class="ml-auto">
                        <h2 class="display-7 mb-0">{{$pending_post->count()}}</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="card p-2  p-lg-3">
            <div class="p-lg-3 p-2">
                <div class="d-flex align-items-center">
                    <button class="btn btn-circle btn-danger text-white btn-lg" href="javascript:void(0)">
                        <i class="icon-trash"></i>
                    </button>
                    <div class="ml-4" style="width: 38%;">
                        <h4 class="font-light">Trush Post</h4>
                        <div class="progress">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: {{$trush_post->count()}}%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="40"></div>
                        </div>
                    </div>
                    <div class="ml-auto">
                        <h2 class="display-7 mb-0">{{$trush_post->count()}}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
  <div class="card-group">
        <div class="card p-2 mr-2 p-lg-3">
            <div class="p-lg-3 p-2">
                <div class="d-flex align-items-center">
                    <button class="btn btn-circle btn-cyan text-white btn-lg" href="javascript:void(0)">
                        <i class="mdi mdi-check"></i>
                    </button>
                    <div class="ml-4" style="width: 44%;">
                        <h4 class="font-light">Active Cateogry</h4>
                        <div class="progress">
                            <div class="progress-bar bg-cyan" role="progressbar" style="width: {{$active_category->count()}}%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="40"></div>
                        </div>
                    </div>
                    <div class="ml-auto">
                        <h2 class="display-7 mb-0">{{$active_category->count()}}</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="card p-2 mr-2 p-lg-3">
            <div class="p-lg-3 p-2">
                <div class="d-flex align-items-center">
                    <button class="btn btn-circle btn-warning text-white btn-lg" href="javascript:void(0)">
                        <i class="mdi mdi-power-plug-off"></i>
                    </button>
                    <div class="ml-4" style="width: 51%;">
                        <h4 class="font-light">UnActive Category</h4>
                        <div class="progress">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: {{$unactive_category->count()}}%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="40"></div>
                        </div>
                    </div>
                    <div class="ml-auto">
                        <h2 class="display-7 mb-0">{{$unactive_category->count()}}</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="card p-2  p-lg-3">
            <div class="p-lg-3 p-2">
                <div class="d-flex align-items-center">
                    <button class="btn btn-circle btn-danger text-white btn-lg" href="javascript:void(0)">
                        <i class="icon-trash"></i>
                    </button>
                    <div class="ml-4" style="width: 41%;">
                        <h4 class="font-light">Trush Category</h4>
                        <div class="progress">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: {{$trush_category->count()}}%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="40"></div>
                        </div>
                    </div>
                    <div class="ml-auto">
                        <h2 class="display-7 mb-0">{{$trush_category->count()}}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
  <div class="row">
    <div class="col-md-6 col-lg-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-uppercase">Subscription</h5>
                <div class="d-flex align-items-center mb-2 mt-4">
                    <h2 class="mb-0 display-5"><i class="icon-people text-info"></i></h2>
                    <div class="ml-auto">
                        <h2 class="mb-0 display-6"><span class="font-normal">{{$subscription}}</span></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-uppercase">Advertizement</h5>
                <div class="d-flex align-items-center mb-2 mt-4">
                    <h2 class="mb-0 display-5"><i class="icon-graph text-primary"></i></h2>
                    <div class="ml-auto">
                        <h2 class="mb-0 display-6"><span class="font-normal">{{$advertizement}}</span></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-uppercase">Meassage</h5>
                <div class="d-flex align-items-center mb-2 mt-4">
                    <h2 class="mb-0 display-5"><i class="mdi mdi-comment-account text-danger"></i></h2>
                    <div class="ml-auto">
                        <h2 class="mb-0 display-6"><span class="font-normal">{{$contact}}</span></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-uppercase">Comment</h5>
                <div class="d-flex align-items-center mb-2 mt-4">
                    <h2 class="mb-0 display-5"><i class="fa fa-comment text-success"></i></h2>
                    <div class="ml-auto">
                        <h2 class="mb-0 display-6"><span class="font-normal">{{$comments}}</span></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
  <div class="row">
      <div class="col-md-12 col-lg-8">
          <div class="card">
              <div class="calender-sidebar">
                  <div id="calendar"></div>
              </div>
          </div>
      </div>
      <div class="col-md-12 col-lg-4">
        <div class="card">
                <div class="p-4">
                    <div class="d-flex flex-row">
                        <div class=""><img src="{{Auth::user()->user_image}}" alt="user" class="rounded-circle" width="100" /></div>
                        <div class="pl-4">
                            <h3>{{Auth::user()->name}}</h3>
                            <h5>{{Auth::user()->role->name}}</h5>
                            <a href="{{route('admin.user.edit',Auth::user()->slug)}}" class="btn btn-success btn-rounded text-white text-uppercase font-14"><i class="mdi mdi-pencil mr-2"></i> Edit Profile</a>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col border-right text-center">
                            <h2 class="font-light">{{Auth::user()->posts->count()}}</h2>
                            <h4 class="text-uppercase">Posts</h4></div>
                        <div class="col border-right text-center">
                            <h2 class="font-light">{{Auth::user()->posts()->panding()->count()}}</h2>
                            <h4 class="text-uppercase">Pending</h4></div>
                        <div class="col text-center">
                            <h2 class="font-light">{{Auth::user()->posts()->trash()->count()}}</h2>
                            <h4 class="text-uppercase">Trush</h4></div>
                    </div>
                </div>
                <div class="card-body border-top">
                    <p class="text-center aboutscroll">
                      {{Auth::user()->bio}}
                    </p>

                </div>
                <div class="card-body border-top">
                    <ul class="list-style-none list-icons d-flex flex-item text-center">
                      <li class="col"><a href="{{Auth::user()->facebook}}" class="text-muted" data-toggle="tooltip" title="Facebook"><i class="fab fa-facebook-square font-20"></i></a></li>
                      <li class="col"><a href="{{Auth::user()->twitter}}" class="text-muted" data-toggle="tooltip" title="twitter"><i class="fab fa-twitter font-20"></i></a></li>
                      <li class="col"><a href="{{Auth::user()->youtube}}" class="text-muted" data-toggle="tooltip" title="Youtube"><i class="fab fa-youtube font-20"></i></a></li>
                      <li class="col"><a href="{{Auth::user()->instagram}}" class="text-muted" data-toggle="tooltip" title="Linkdin"><i class="fab fa-instagram font-20"></i></a></li>
                    </ul>
                </div>
            </div>
      </div>
    </div>
  <div class="row">
    <div class="col-lg-6 col-md-12">
        <div class="card">
              <div id="carouselExampleIndicators" class="carousel slide primary-carousel" data-ride="carousel">
                  <ol class="carousel-indicators d-none">
                      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                      <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                  </ol>
                  <div class="carousel-inner">
                    @foreach($publish_post as $post)
                      <div class="carousel-item {{$loop->first ? 'active':''}}">
                          <img class="d-block w-100 p-img" src="{{$post->image_url}}" alt="First slide">
                          <div class="card-img-overlay text-white">
                            @foreach($post->categorys as $cat)
                              <span class="badge badge-danger badge-pill text-white font-medium">{{$cat->name}}</span>
                            @endforeach
                              <h2 class="mt-3"> <a href="{{route('admin.post.edit',$post->slug)}}" class="text-white">{{$post->title}}</a> </h2>
                              <!-- <div class="mt-5">
                                  <a href="#" class="text-muted read-more font-danger text-uppercase">Read More</a>
                              </div> -->
                          </div>
                      </div>
                    @endforeach
                  </div>
                  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="sr-only">Previous</span>
                  </a>
                  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="sr-only">Next</span>
                  </a>
              </div>
          </div>
      </div>
     
   </div>
</div>

@endsection


@push('js')
<!-- <script src="{{asset('content/admin')}}/assets/libs/chartist/dist/chartist.min.js"></script> -->
<!-- <script src="{{asset('content/admin')}}/dist/js/pages/chartist/chartist-plugin-tooltip.js"></script> -->
<!-- <script src="{{asset('content/admin')}}/assets/extra-libs/c3/d3.min.js"></script> -->
<!-- <script src="{{asset('content/admin')}}/assets/extra-libs/c3/c3.min.js"></script> -->
<!-- <script src="{{asset('content/admin')}}/assets/libs/raphael/raphael.min.js"></script> -->
<!-- <script src="{{asset('content/admin')}}/assets/libs/morris.js/morris.min.js"></script> -->
<!-- <script src="{{asset('content/admin')}}/dist/js/pages/dashboards/dashboard1.js"></script> -->
<script src="{{asset('content/admin')}}/assets/libs/moment/min/moment.min.js"></script>
<script src="{{asset('content/admin')}}/assets/libs/fullcalendar/dist/fullcalendar.min.js"></script>
<script src="{{asset('content/admin')}}/dist/js/pages/calendar/cal-init.js"></script>
<script>
    $('#calendar').fullCalendar('option', 'height', 650);
</script>
@endpush
