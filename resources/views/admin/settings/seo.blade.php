@extends('layouts.admin')

@section('title')




@section('content')

  @component('admin.component.breadcrumb')
    @slot('title')
      <h5 class="font-medium text-uppercase mb-0">Seo</h5>
    @endslot

    @slot('list')
    <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page">Seo</li>
    @endslot

  @endcomponent

  <div class="page-content container-fluid">

      <div class="row">
          <div class="col-12">
              <div class="material-card card">
                  <div class="card-header">
                    <div class="pull-left">
                      <a href="{{route('admin.index')}}" class="btn btn-sm btn-outline-success"> <i class="mdi mdi-arrow-left"></i> Back</a>
                    </div>
                  </div>
                  <div class="card-body">
                      <form action="{{route('admin.seo.submit')}}" method="post">
                          @csrf
                          @method('PUT')
                          <div class="form-body">
                              <div class="card-body">
                                <h4 class="card-title">Basic Seo</h4>
                                <hr>
                                  <div class="row pt-3">
                                      <div class="col-md-6">
                                        <div class="form-group {{$errors->has('title') ? 'has-danger' : ''}}">
                                            <label>Title</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon11">T</span>
                                                </div>
                                                <input type="text" class="form-control" name="title" placeholder="Enter Contact Email" value="{{$data->title}}">
                                            </div>
                                            @if($errors->has('title'))
                                            <small class="form-control-feedback">{{$errors->first('title')}}</small>
                                            @endif
                                        </div>
                                      </div>
                                      <div class="col-md-6">
                                        <div class="form-group {{$errors->has('author') ? 'has-danger' : ''}}">
                                            <label>Author Name</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon11"><i class="ti-user"></i></span>
                                                </div>
                                                <input type="text" class="form-control" name="author" placeholder="Enter Contact Phone Number" value="{{$data->author}}">
                                            </div>
                                            @if($errors->has('author'))
                                            <small class="form-control-feedback">{{$errors->first('author')}}</small>
                                            @endif
                                        </div>
                                      </div>
                                      <div class="col-md-12">
                                        <div class="form-group {{$errors->has('description') ? 'has-danger' : ''}}">
                                            <label>Meta Description</label>
                                            <div class="input-group mb-3">
                                              <textarea class="form-control" rows="4" name="description" placeholder="Text Here...">{{$data->description}}</textarea>
                                            </div>
                                            @if($errors->has('description'))
                                            <small class="form-control-feedback">{{$errors->first('description')}}</small>
                                            @endif
                                        </div>
                                      </div>
                                      <div class="col-md-12">
                                        <div class="form-group {{$errors->has('keywords') ? 'has-danger' : ''}}">
                                            <label>Meta Keywords</label>
                                            <div class="input-group mb-3">
                                              <textarea class="form-control" rows="4" name="keywords" placeholder="Text Here...">{{$data->keywords}}</textarea>
                                            </div>
                                            @if($errors->has('keywords'))
                                            <small class="form-control-feedback">{{$errors->first('keywords')}}</small>
                                            @endif
                                        </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="form-actions">
                                  <div class="card-body">
                                      <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                                  </div>
                              </div>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>
  </div>


@endsection
