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

      <div class="row">
          <div class="col-6 offset-3">
              <div class="material-card card">
                  <div class="card-header">
                      <div class="pull-left">
                          <a href="{{route('admin.user.index')}}" class="btn btn-sm btn-outline-success"> <i class="mdi mdi-arrow-left"></i> Back</a>
                      </div>
                  </div>
                  <div class="card-body">
                      <form action="{{route('admin.user.store')}}" method="post">
                          @csrf
                          <div class="form-body">
                              <div class="card-body">
                                  <div class="row">
                                      <div class="col-md-12">
                                          <div class="form-group {{$errors->has('name') ? 'has-danger' : ''}}">
                                              <label>Name</label>
                                              <div class="input-group ">
                                                  <div class="input-group-prepend">
                                                      <span class="input-group-text"><i class="ti-user"></i></span>
                                                  </div>
                                                  <input type="text" class="form-control" name="name" placeholder="Enter User Name" value="{{old('name')}}">
                                              </div>
                                              @if($errors->has('name'))
                                              <small class="form-control-feedback">{{$errors->first('name')}}</small>
                                              @endif
                                          </div>
                                      </div>
                                  </div>
                                  <div class="row">
                                      <div class="col-md-12">
                                          <div class="form-group {{$errors->has('email') ? 'has-danger' : ''}}">
                                              <label>Email</label>
                                              <div class="input-group ">
                                                  <div class="input-group-prepend">
                                                      <span class="input-group-text"><i class="ti-email"></i></span>
                                                  </div>
                                                  <input type="text" class="form-control" name="email" placeholder="Enter User Email" value="{{old('email')}}">
                                              </div>
                                              @if($errors->has('email'))
                                             <small class="form-control-feedback">{{$errors->first('email')}}</small>
                                              @endif
                                          </div>
                                      </div>
                                  </div>
                                  <div class="row">
                                      <div class="col-md-12">
                                          <div class="form-group {{$errors->has('username') ? 'has-danger' : ''}}">
                                              <label>UserName</label>
                                              <div class="input-group ">
                                                  <div class="input-group-prepend">
                                                      <span class="input-group-text">@</span>
                                                  </div>
                                                  <input type="text" class="form-control" name="username" placeholder="Enter UserName" value="{{old('username')}}">
                                              </div>
                                              @if($errors->has('username'))
                                              <small class="form-control-feedback">{{$errors->first('username')}}</small>
                                               @endif
                                          </div>
                                      </div>
                                  </div>
                                  <div class="row">
                                      <div class="col-md-12">
                                          <div class="form-group {{$errors->has('phone') ? 'has-danger' : ''}}">
                                              <label>Phone Number</label>
                                              <div class="input-group ">
                                                  <div class="input-group-prepend">
                                                      <span class="input-group-text"><i class=" ti-mobile"></i></span>
                                                  </div>
                                                  <input type="text" class="form-control" name="phone" placeholder="Enter User Phone Number" value="{{old('phone')}}">
                                              </div>
                                              @if($errors->has('phone'))
                                              <small class="form-control-feedback">{{$errors->first('phone')}}</small>
                                              @endif
                                          </div>
                                      </div>
                                  </div>
                                  <div class="row">
                                      <div class="col-md-12">
                                          <div class="form-group {{$errors->has('role') ? 'has-danger' : ''}}">
                                              <label class="control-label">Role</label>
                                              <select class="form-control" name="role">
                                                <option value="">---Select UserRole Option---</option>
                                                  @foreach($roles as $role)
                                                  <option value="{{$role->id}}">{{$role->name}}</option>
                                                  @endforeach
                                              </select>
                                              @if($errors->has('role'))
                                              <small class="form-control-feedback">{{$errors->first('role')}}</small>
                                              @endif
                                          </div>
                                      </div>
                                  </div>
                                  <div class="row">
                                      <div class="col-md-12">
                                          <div class="form-group {{$errors->has('gender') ? 'has-danger' : ''}}">
                                              <label class="control-label">Gender</label>
                                              <select class="form-control" name="gender">
                                                <option value="" >---Select Gender Option---</option>
                                                  @foreach($genders as $gender)
                                                  <option value="{{$gender->id}}">{{$gender->name}}</option>
                                                  @endforeach
                                              </select>
                                              @if($errors->has('gender'))
                                              <small class="form-control-feedback">{{$errors->first('gender')}}</small>
                                              @endif
                                          </div>
                                      </div>
                                  </div>
                                  <div class="row">
                                      <div class="col-md-12">
                                          <div class="form-group {{$errors->has('password') ? 'has-danger' : ''}}">
                                              <label>Password</label>
                                              <div class="input-group ">
                                                  <div class="input-group-prepend">
                                                      <span class="input-group-text"><i class="ti-lock"></i></span>
                                                  </div>
                                                  <input type="password" class="form-control" name="password" placeholder="Enter User Password">
                                              </div>
                                              @if($errors->has('password'))
                                              <small class="form-control-feedback">{{$errors->first('password')}}</small>
                                              @endif
                                          </div>
                                      </div>
                                  </div>
                                  <div class="row">
                                      <div class="col-md-12">
                                          <div class="form-group {{$errors->has('password_confirmation') ? 'has-danger' : ''}}">
                                              <label>Confirm Password</label>
                                              <div class="input-group ">
                                                  <div class="input-group-prepend">
                                                      <span class="input-group-text"><i class="ti-lock"></i></span>
                                                  </div>
                                                  <input type="password" class="form-control" name="password_confirmation" placeholder="Enter User confirm Password">
                                              </div>
                                              @if($errors->has('password_confirmation'))
                                              <small class="form-control-feedback">{{$errors->first('password_confirmation')}}</small>
                                              @endif
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="form-actions">
                                  <div class="card-body">
                                      <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Create</button>
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
