@extends('layouts.admin')

@section('title','Page Create')

@push('css')
  <link rel="stylesheet" type="text/css" href="{{asset('content/admin')}}/assets/libs/summernote/dist/summernote-bs4.css">
@endpush


@section('content')

  @component('admin.component.breadcrumb')
    @slot('title')
      <h5 class="font-medium text-uppercase mb-0">Web Page</h5>
    @endslot

    @slot('list')
    <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item " aria-current="page"><a href="{{route('admin.page.index')}}">Page</a></li>
    <li class="breadcrumb-item active" aria-current="page">Create</li>
    @endslot

  @endcomponent

<div class="page-content container-fluid">

  <form action="{{route('admin.page.store')}}" method="post" enctype="multipart/form-data">
    <div class="row">
        @csrf
        <div class="col-9">
            <div class="material-card card">
              <div class="card-header">
                  <div class="pull-left">
                    <a href="{{route('admin.page.index')}}" class="btn btn-sm btn-outline-success"> <i class="mdi mdi-arrow-left"></i> Back</a>
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
                                      <div class="form-group {{$errors->has('description') ? 'has-danger' : ''}}">
                                          <label class="control-label">Description</label>
                                          <textarea class="form-control summernote" name="description">{{old('description')}}</textarea>
                                          @if($errors->has('description'))
                                            <small class="form-control-feedback">{{$errors->first('description')}}</small>
                                          @endif
                                        </div>
                                  </div>
                                  <div class="col-md-12">
                                      <div class="form-group {{$errors->has('tag') ? 'has-danger' : ''}}">
                                          <label class="control-label">Page Tage</label>
                                          <input type="text" id="lastName" name="tag" class="form-control" style="color:#000;" placeholder="Page Tag" value="{{old('tag')}}">
                                          @if($errors->has('tag'))
                                            <small class="form-control-feedback">{{$errors->first('tag')}}</small>
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

@endpush
