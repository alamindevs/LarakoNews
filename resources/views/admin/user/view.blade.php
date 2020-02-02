@extends('layouts.admin')

@section('title','User Create')

@push('css')
  <link rel="stylesheet" type="text/css" href="{{asset('content/admin')}}/assets/libs/summernote/dist/summernote-bs4.css">
  <link rel="stylesheet" href="{{asset('content/admin')}}/assets/libs/dropify/dist/css/dropify.min.css">
  <link rel="stylesheet" type="text/css" href="{{asset('content/admin')}}/assets/libs/select2/dist/css/select2.min.css">
@endpush


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
        <div class="col-lg-4 col-xlg-3 col-md-5 offset-3">
            <div class="card">
                <div class="card-body">
                    <center class="mt-4"> <img src="{{$user->user_image}}" class="rounded-circle" width="150" />
                        <h4 class="card-title mt-2">{{$user->name}}</h4>
                        <h6 class="card-subtitle">{{$user->bio}}</h6>
                        <div class="row text-center justify-content-md-center">
                            <div class="col-6"><a href="javascript:void(0)" class="link">Total Posts: {{$user->posts->count()}}</a></div>
                        </div>
                    </center>
                </div>
                <div>
                    <hr> </div>
                <div class="card-body">
                  <small class="text-muted">UserName</small>
                  <h6>{{$user->username}}</h6>
                    <small class="text-muted">Email address </small>
                    <h6>{{$user->email}}</h6>
                    <small class="text-muted pt-4 db">Phone</small>
                    <h6>{{$user->phone}}</h6>
                    <small class="text-muted pt-4 db">Address</small>
                    <h6>{{$user->address}}</h6>
                    <small class="text-muted pt-4 db">Social Profile</small>
                    <br/>
                    <a href="{{$user->facebook}}" class="btn btn-circle btn-secondary"><i class="fab fa-facebook-f"></i></a>
                    <a href="{{$user->twitter}}" class="btn btn-circle btn-secondary"><i class="fab fa-twitter"></i></a>
                    <a href="{{$user->instagram}}" class="btn btn-circle btn-secondary"><i class="fab fa-instagram"></i></a>
                    <a href="{{$user->youtube}}" class="btn btn-circle btn-secondary"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->

    </div>
</div>

@endsection

@push('js')
  <script src="{{asset('content/admin')}}/assets/libs/dropify/dist/js/dropify.min.js"></script>
  <script>
    $(document).ready(function() {
        // Basic
        $('.dropify').dropify();

        // Translated
        $('.dropify-fr').dropify({
            messages: {
                default: 'Glissez-déposez un fichier ici ou cliquez',
                replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
                remove: 'Supprimer',
                error: 'Désolé, le fichier trop volumineux'
            }
        });

        // Used events
        var drEvent = $('#input-file-events').dropify();

        drEvent.on('dropify.beforeClear', function(event, element) {
            return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
        });

        drEvent.on('dropify.afterClear', function(event, element) {
            alert('File deleted');
        });

        drEvent.on('dropify.errors', function(event, element) {
            console.log('Has Errors');
        });

        var drDestroy = $('#input-file-to-destroy').dropify();
        drDestroy = drDestroy.data('dropify')
        $('#toggleDropify').on('click', function(e) {
            e.preventDefault();
            if (drDestroy.isDropified()) {
                drDestroy.destroy();
            } else {
                drDestroy.init();
            }
        })
    });
    </script>

@endpush
