@extends('layouts.admin')

@section('title','Advertizement')

@push('css')
  <link rel="stylesheet" href="{{asset('content/admin')}}/assets/libs/dropify/dist/css/dropify.min.css">
@endpush

@section('content')

  @component('admin.component.breadcrumb')
    @slot('title')
      <h5 class="font-medium text-uppercase mb-0">Web Advertizement</h5>
    @endslot

    @slot('list')
    <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item " aria-current="page"><a href="{{route('admin.advertizement.index')}}">Advertizement</a></li>
    <li class="breadcrumb-item active" aria-current="page">Create</li>
    @endslot

  @endcomponent

<div class="page-content container-fluid">

  <form action="{{route('admin.advertizement.store')}}" method="post" enctype="multipart/form-data">
    <div class="row">
        @csrf
        <div class="col-9">
            <div class="material-card card">
              <div class="card-header">
                  <div class="pull-left">
                    <a href="{{route('admin.advertizement.index')}}" class="btn btn-sm btn-outline-success"> <i class="mdi mdi-arrow-left"></i> Back</a>
                  </div>
              </div>
                <div class="card-body">
                      <div class="form-body">
                          <div class="card-body">
                              <div class="row pt-3">
                                  <div class="col-md-12">
                                      <div class="form-group {{$errors->has('name') ? 'has-danger' : ''}}">
                                          <label class="control-label">Name</label>
                                          <input type="text" id="lastName" name="name" class="form-control" style="color:#000;" placeholder="Page Name" value="{{old('name')}}">
                                          @if($errors->has('name'))
                                            <small class="form-control-feedback">{{$errors->first('name')}}</small>
                                          @endif
                                        </div>
                                  </div>
                                  <div class="col-md-12">
                                    <label class="control-label">Advertizement Type</label>
                                      <div class="form-group {{$errors->has('type') ? 'has-danger' : ''}}">
                                        <div class="form-check form-check-inline">
                                          <div class="custom-control custom-radio">
                                              <input type="radio" class="custom-control-input" name="type" id="image"  checked  value="1" >
                                              <label class="custom-control-label" for="image">Image</label>
                                          </div>
                                      </div>
                                      <div class="form-check form-check-inline">
                                          <div class="custom-control custom-radio">
                                              <input type="radio" class="custom-control-input" name="type" id="google" {{ $errors->has("script") ? "checked" : ""}}   value="2">
                                              <label class="custom-control-label" for="google">Google Addcence</label>
                                          </div>
                                      </div>
                                      </div>
                                      @if($errors->has('type'))
                                        <small class="form-control-feedback">{{$errors->first('type')}}</small>
                                      @endif
                                  </div>
                                  <div class="col-md-12" id="image_fild">
                                      <div class="form-group {{$errors->has('image') ? 'has-danger' : ''}}">
                                          <label class="control-label">Image</label>
                                          <input name="image" type="file" id="input-file-now" class="dropify"/>
                                          @if($errors->has('image'))
                                            <small class="form-control-feedback">{{$errors->first('image')}}</small>
                                          @endif
                                        </div>
                                        <div class="form-group {{$errors->has('url') ? 'has-danger' : ''}}">
                                            <label class="control-label">Image Url</label>
                                            <input type="text" id="lastName" name="url" class="form-control" style="color:#000;" placeholder="Page Name" value="{{old('url')}}">
                                            @if($errors->has('url'))
                                              <small class="form-control-feedback">{{$errors->first('url')}}</small>
                                            @endif
                                          </div>

                                  </div>
                                  <div class="col-md-12" id="google_fild">
                                      <div class="form-group {{$errors->has('script') ? 'has-danger' : ''}}">
                                          <label class="control-label">Google Addcence Script</label>
                                          <textarea class="form-control" rows="9" name="script">{{old('script')}}</textarea>
                                          @if($errors->has('script'))
                                            <small class="form-control-feedback">{{$errors->first('script')}}</small>
                                          @endif
                                        </div>
                                  </div>
                          </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3">
          <div class="row">
            <div class="col-12">
              <div class="material-card card">
                <div class="card-header">
                    <div class="pull-left">
                      <h6 class="card-title mt-1">Publish</h6>
                    </div>
                </div>
                <div class="card-body">
                  <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Create</button>
                  <a href="{{route('admin.page.index')}}" class="btn btn-dark pull-right"><i class="fa fa-times"></i> Cancel</a>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
  </form>

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

    <!-- my custom script  -->
    @if($errors->has("script"))
    <script>
      $(function(){
        $("#google_fild").show();
        $("#image_fild").hide();
      })
    </script>
    @else
    <script>
      $(function(){
        $("#google_fild").hide();
      })
    </script>
    @endif
    <script>
        $(function(){
          $("#image").on("click",function(){
            $("#google_fild").hide();
            $("#image_fild").show();
          });
          $("#google").on("click",function(){
            $("#google_fild").show();
            $("#image_fild").hide();
          });
        })
    </script>
@endpush
