@extends('layouts.admin')

@section('title','Cateogry Create')

@section('content')

  @component('admin.component.breadcrumb')
    @slot('title')
      <h5 class="font-medium text-uppercase mb-0">Category Create</h5>
    @endslot

    @slot('list')
    <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item " aria-current="page"><a href="{{route('admin.post.index')}}">Category</a></li>
    <li class="breadcrumb-item active" aria-current="page">Create</li>
    @endslot

  @endcomponent

<div class="page-content container-fluid">

    <div class="row">
        <div class="col-6 offset-3">
            <div class="material-card card">
              <div class="card-header">
                  <div class="pull-left">
                    <a href="{{route('admin.category.index')}}" class="btn btn-sm btn-outline-success"> <i class="mdi mdi-arrow-left"></i> Back</a>
                  </div>
              </div>
                <div class="card-body">
                  <form action="{{route('admin.category.store')}}" method="post">
                    @csrf
                      <div class="form-body">
                          <div class="card-body">
                              <div class="row pt-3">
                                  <div class="col-md-12">
                                      <div class="form-group {{$errors->has('name') ? 'has-danger' : ''}}">
                                          <label class="control-label">Category Name</label>
                                          <input type="text" id="lastName" name="name" class="form-control" placeholder="Category name">
                                          @if($errors->has('name'))
                                            <small class="form-control-feedback">{{$errors->first('name')}}</small>
                                          @endif
                                        </div>
                                  </div>
                          </div>
                      </div>
                          <div class="form-actions">
                              <div class="card-body">
                                  <button type="submit" class="btn btn-success">Create</button>
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
