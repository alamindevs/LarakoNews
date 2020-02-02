@extends('layouts.admin')

@section('title','Post Comment')




@section('content')

  @component('admin.component.breadcrumb')
    @slot('title')
      <h5 class="font-medium text-uppercase mb-0">Post Comment</h5>
    @endslot

    @slot('list')
    <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item " aria-current="page"><a href="{{route('admin.comment.index')}}">Comment</a></li>
    <li class="breadcrumb-item active" aria-current="page">View</li>
    @endslot

  @endcomponent

  <div class="page-content container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <!-- Row -->
    <div class="row">
        <!-- Column -->
        <div class="col-lg-4 col-xlg-3 col-md-5 offset-3">
            <div class="card">
                <div class="card-body">
                    <center class="mt-4"> <img src="{{$comment->post->image_url}}"  width="200" />
                        <h4 class="card-title mt-2">{{$comment->post->title}}</h4>
                        <div class="row text-center justify-content-md-center">
                            <div class="col-6"><a href="javascript:void(0)" class="link">Total Comments: {{$comment->post->comments->count()}}</a></div>
                        </div>
                    </center>
                </div>
                <div>
                    <hr> </div>
                    <div class="card-body">
                      <small class="text-muted">Date/Time</small>
                      <h6>{{$comment->created_at->format('d F Y')}}</h6>
                      <small class="text-muted">Name</small>
                      <h6>{{$comment->name}}</h6>
                        <small class="text-muted">Email address </small>
                        <h6>{{$comment->email}}</h6>
                        <small class="text-muted pt-4 db">Comment</small>
                        <h6>{{$comment->comment}}</h6>

                    </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->

    </div>
</div>

@endsection
