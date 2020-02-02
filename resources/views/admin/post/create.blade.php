@extends('layouts.admin')

@section('title','Post Create')

@push('css')
  <link rel="stylesheet" type="text/css" href="{{asset('content/admin')}}/assets/libs/summernote/dist/summernote-bs4.css">
  <link rel="stylesheet" href="{{asset('content/admin')}}/assets/libs/dropify/dist/css/dropify.min.css">
  <link rel="stylesheet" type="text/css" href="{{asset('content/admin')}}/assets/libs/select2/dist/css/select2.min.css">
@endpush


@section('content')

  @component('admin.component.breadcrumb')
    @slot('title')
      <h5 class="font-medium text-uppercase mb-0">Post Create</h5>
    @endslot

    @slot('list')
    <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item " aria-current="page"><a href="{{route('admin.post.index')}}">Post</a></li>
    <li class="breadcrumb-item active" aria-current="page">Create</li>
    @endslot

  @endcomponent

<div class="page-content container-fluid">

  <form action="{{route('admin.post.store')}}" method="post" enctype="multipart/form-data">
    <div class="row">
        @csrf
        <div class="col-9">
            <div class="material-card card">
              <div class="card-header">
                <div class="row">
                  <div class="col-md-6">
                    <div class="pull-left">
                      <a href="{{route('admin.post.index')}}" class="btn btn-sm btn-outline-success"> <i class="mdi mdi-arrow-left"></i> Back</a>
                    </div>
                  </div>
                </div>
              </div>
                <div class="card-body">
                      <div class="form-body">
                          <div class="card-body">
                              <div class="row pt-3">
                                  <div class="col-md-12">
                                      <div class="form-group {{$errors->has('title') ? 'has-danger' : ''}}">
                                          <label class="control-label">Title</label>
                                          <input type="text" id="lastName" name="title" class="form-control" style="color:#000;" placeholder="Title" value="{{old('title')}}">
                                          @if($errors->has('title'))
                                            <small class="form-control-feedback">{{$errors->first('title')}}</small>
                                          @endif
                                        </div>
                                  </div>
                                  <div class="col-md-12">
                                      <div class="form-group {{$errors->has('description') ? 'has-danger' : ''}}">
                                          <label class="control-label">Description</label>
                                          <textarea class="form-control summernote" name="description">{{old('description')}}</textarea>
                                          @if($errors->has('description'))
                                            <small class="form-control-feedback">{{$errors->first('description')}}</small>
                                          @endif
                                        </div>
                                  </div>
                                  <div class="col-md-12">
                                      <div class="form-group {{$errors->has('short_description') ? 'has-danger' : ''}}">
                                          <label class="control-label">Short Description</label>
                                          <textarea class="form-control" rows="6" name="short_description" style="color:#000;" placeholder="Text Here...">{{old('short_description')}}</textarea>
                                          @if($errors->has('short_description'))
                                            <small class="form-control-feedback">{{$errors->first('short_description')}}</small>
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
                  <div class="row">
                    <div class="col-md-12">
                        <div class="form-group {{$errors->has('publish') ? 'has-danger' : ''}}">
                            <div class="form-check form-check-inline">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="publish" id="publish_now"  checked  value="1" >
                                <label class="custom-control-label" for="publish_now">Now</label>
                            </div>
                        </div>
                        <div class="form-check form-check-inline">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="publish" id="publish_schedule" {{ $errors->has("publish") ? "checked" : ""}}   value="2">
                                <label class="custom-control-label" for="publish_schedule">Schedule</label>
                            </div>
                        </div>
                        </div>
                        @if($errors->has('publish'))
                          <small class="form-control-feedback">{{$errors->first('publish')}}</small>
                        @endif
                    </div>

                  </div>
                  <div class="row pt-3" id="schedule_time">
                    <div class="col-md-12">
                        <div class="form-group {{$errors->has('publist_time') ? 'has-danger' : ''}}">
                            <label class="control-label">Post Schedule Date & Time</label>
                            <input type="datetime-local" name="publist_time" class="form-control" value="2019-01-01T00:00:00">
                            @if($errors->has('publist_time'))
                              <small class="form-control-feedback">{{$errors->first('publist_time')}}</small>
                            @endif
                          </div>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Create</button>
                  <a href="{{route('admin.post.index')}}" class="btn btn-dark pull-right"><i class="fa fa-times"></i> Cancel</a>
                </div>
              </div>
            </div>

          </div>
          <div class="row">
            <div class="col-12">
              <div class="material-card card">
                <div class="card-header">
                    <div class="pull-left">
                      <h6 class="card-title mt-1">Categorys</h6>
                    </div>
                </div>
                <div class="card-body">
                  <div class="form-group {{$errors->has('category') ? 'has-danger' : ''}}">
                      <select class="select2 form-control" name="category[]" multiple="multiple" style="height: 36px;width: 100%;">
                        @foreach($category as $data)
                          <option value="{{$data->id}}">{{$data->name}}</option>
                        @endforeach
                      </select>
                      @if($errors->has('category'))
                        <small class="form-control-feedback">{{$errors->first('category')}}</small>
                      @endif
                    </div>
                </div>
              </div>
            </div>

          </div>
          <div class="row">
            <div class="col-12">
              <div class="material-card card">
                <div class="card-header">
                    <div class="pull-left">
                      <h6 class="card-title mt-1">Tags</h6>
                    </div>
                </div>
                <div class="card-body">
                  <div class="form-group {{$errors->has('tag') ? 'has-danger' : ''}}">
                      <select class="select2 form-control" name="tag[]" multiple="multiple" style="height: 36px;width: 100%;">
                        @foreach($tags as $tag)
                          <option value="{{$tag->id}}">{{$tag->name}}</option>
                        @endforeach
                      </select>
                      @if($errors->has('tag'))
                        <small class="form-control-feedback">{{$errors->first('tag')}}</small>
                      @endif
                    </div>
                </div>
              </div>
            </div>

          </div>
          <div class="row">
            <div class="col-12">
              <div class="material-card card">
                <div class="card-header">
                    <div class="pull-left">
                      <h6 class="card-title mt-1">Thamnail (800px x 550px)</h6>
                    </div>
                </div>
                <div class="card-body">
                  <div class="form-group {{$errors->has('image') ? 'has-danger' : ''}}">
                      <input name="image" type="file" id="input-file-now" class="dropify"/>
                      @if($errors->has('image'))
                        <small class="form-control-feedback">{{$errors->first('image')}}</small>
                      @endif
                  </div>
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
<script src="{{asset('content/admin')}}/assets/libs/summernote/dist/summernote-bs4.min.js"></script>
  <script>
  /************************************/
  //default editor
  /************************************/
  $('.summernote').summernote({
      height: 335, // set editor height
      minHeight: null, // set minimum height of editor
      maxHeight: null, // set maximum height of editor
      focus: false // set focus to editable area after initializing summernote
  });
  </script>

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
    <script src="{{asset('content/admin')}}/assets/libs/select2/dist/js/select2.full.min.js"></script>
    <script src="{{asset('content/admin')}}/assets/libs/select2/dist/js/select2.min.js"></script>
    <script src="{{asset('content/admin')}}/dist/js/pages/forms/select2/select2.init.js"></script>
    <!-- my custom script  -->
    <script>
        $(function(){
          $("#schedule_time").hide();

          $("#publish_now").on("click",function(){
            $("#schedule_time").hide();
          });
          $("#publish_schedule").on("click",function(){
            $("#schedule_time").show();
          });
        })
    </script>
@endpush
