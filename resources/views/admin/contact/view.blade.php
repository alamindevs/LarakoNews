@extends('layouts.admin')

@section('title','User Create')

@section('content')

  @component('admin.component.breadcrumb')
    @slot('title')
      <h5 class="font-medium text-uppercase mb-0">User Create</h5>
    @endslot

    @slot('list')
    <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item " aria-current="page"><a href="{{route('admin.user.index')}}">User</a></li>
    <li class="breadcrumb-item active" aria-current="page">Create</li>
    @endslot

  @endcomponent

  <div class="page-content container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <!-- Row -->
    <div class="row">
        <!-- Column -->
        <div class="col-lg-6 col-xlg-3 col-md-5 offset-3">
            <div class="card">
                <div class="card-body">
                  <small class="text-muted">Name</small>
                  <h6>{{$contact->name}}</h6>
                    <small class="text-muted">Email address </small>
                    <h6>{{$contact->email}}</h6>
                    <small class="text-muted pt-4 db">Phone</small>
                    <h6>{{$contact->phone}}</h6>
                    <small class="text-muted pt-4 db">Subject</small>
                    <h6>{{$contact->subject}}</h6>
                    <small class="text-muted pt-4 db">Meassage</small>
                    <h6>{{$contact->meassage}}</h6>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->

    </div>
</div>

@endsection
