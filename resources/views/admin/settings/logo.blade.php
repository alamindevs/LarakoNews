@extends('layouts.admin')

@section('title','Logo & Breadcrumb Image')

@push('css')
  <link rel="stylesheet" href="{{asset('content/admin')}}/assets/libs/dropify/dist/css/dropify.min.css">
@endpush


@section('content')

  @component('admin.component.breadcrumb')
    @slot('title')
      <h5 class="font-medium text-uppercase mb-0">Logo & Breadcrumb Image</h5>
    @endslot

    @slot('list')
    <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page">Logo & Breadcrumb Image</li>
    @endslot

  @endcomponent

<div class="page-content container-fluid">

  <form action="{{route('admin.image.submit')}}" method="post" enctype="multipart/form-data">
    <div class="row">
        @csrf
        @method('PUT')
        <div class="col-9">
            <div class="material-card card">
              <div class="card-header">
                  <div class="pull-left">
                    <a href="{{route('admin.index')}}" class="btn btn-sm btn-outline-success"> <i class="mdi mdi-arrow-left"></i> Back</a>
                  </div>
              </div>
                <div class="card-body">
                      <div class="form-body">
                          <div class="card-body">
                              <div class="row pt-3">
                                  <div class="col-md-6">
                                      <div class="form-group {{$errors->has('logo') ? 'has-danger' : ''}}">
                                          <label class="control-label">Logo (265x60)</label>
                                          <input name="logo" type="file" id="input-file-now" class="dropify"/>

                                          @if($errors->has('logo'))
                                            <small class="form-control-feedback">{{$errors->first('logo')}}</small>
                                          @endif
                                        </div>
                                  </div>
                                  <div class="col-md-6">
                                      <div class="form-group">
                                        <img src="{{$image->logo}}" style="margin:100px auto;" alt="">
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                      <div class="form-group {{$errors->has('breadcrumb') ? 'has-danger' : ''}}">
                                          <label class="control-label">Breadcrumb(1600x900)</label>
                                          <input name="breadcrumb" type="file" id="input-file-now" class="dropify"/>
                                          @if($errors->has('breadcrumb'))
                                            <small class="form-control-feedback">{{$errors->first('breadcrumb')}}</small>
                                          @endif
                                        </div>
                                  </div>
                                  <div class="col-md-6 mt-5">
                                      <div class="form-group">
                                        <img src="{{$image->breadcrumbs}}" width="300" alt="">
                                      </div>
                                  </div>
                          </div>
                          <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Update </button>
                          <a href="{{route('admin.index')}}" class="btn btn-dark pull-right"><i class="fa fa-times"></i> Cancel</a>
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

@endpush
