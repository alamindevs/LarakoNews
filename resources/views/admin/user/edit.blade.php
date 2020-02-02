@extends('layouts.admin')

@section('title','User Edit: '.$user->username)

@push('css')
  <link rel="stylesheet" href="{{asset('content/admin')}}/assets/libs/dropify/dist/css/dropify.min.css">
@endpush


@section('content')

  @component('admin.component.breadcrumb')
    @slot('title')
      <h5 class="font-medium text-uppercase mb-0">User</h5>
    @endslot

    @slot('list')
    <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item" aria-current="page">User</li>
    <li class="breadcrumb-item active" aria-current="page">Edit</li>
    @endslot

  @endcomponent

  <div class="page-content container-fluid">

      <div class="row">
          <div class="col-12">
              <div class="material-card card">
                  <div class="card-header">
                    <div class="pull-left">
                      <a href="{{route('admin.user.index')}}" class="btn btn-sm btn-outline-success"> <i class="mdi mdi-arrow-left"></i> Back</a>
                    </div>
                  </div>
                  <div class="card-body">
                      <form action="{{route('admin.user.update',$user->slug)}}" method="post" enctype="multipart/form-data">
                          @csrf
                          @method('PUT')
                          <div class="form-body">
                              <div class="card-body">
                                <h4 class="card-title">Person Info</h4>
                                <hr>
                                  <div class="row pt-3">
                                      <div class="col-md-6">
                                        <div class="form-group {{$errors->has('name') ? 'has-danger' : ''}}">
                                            <label>Name</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon11"><i class="ti-user"></i></span>
                                                </div>
                                                <input type="text" class="form-control" name="name" placeholder="Enter User Name" value="{{$user->name}}">
                                            </div>
                                            @if($errors->has('name'))
                                            <small class="form-control-feedback">{{$errors->first('name')}}</small>
                                            @endif
                                        </div>
                                      </div>
                                      <div class="col-md-6">
                                        <div class="form-group {{$errors->has('email') ? 'has-danger' : ''}}">
                                            <label>Email</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon11"><i class="ti-email"></i></span>
                                                </div>
                                                <input type="text" class="form-control" name="email" placeholder="Enter User Email" value="{{$user->email}}">
                                            </div>
                                            @if($errors->has('email'))
                                            <small class="form-control-feedback">{{$errors->first('email')}}</small>
                                            @endif
                                        </div>
                                      </div>
                                      <div class="col-md-6">
                                        <div class="form-group {{$errors->has('username') ? 'has-danger' : ''}}">
                                            <label>UserName</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon11">@</span>
                                                </div>
                                                <input type="text" class="form-control" name="username" placeholder="Enter UserName" disabled value="{{$user->username}}">
                                            </div>
                                            @if($errors->has('username'))
                                            <small class="form-control-feedback">{{$errors->first('username')}}</small>
                                            @endif
                                        </div>
                                      </div>
                                      <div class="col-md-6">
                                        <div class="form-group {{$errors->has('phone') ? 'has-danger' : ''}}">
                                            <label>Phone</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon11"><i class="ti-user"></i></span>
                                                </div>
                                                <input type="text" class="form-control" name="phone" placeholder="Enter User Phone Number" value="{{$user->phone}}">
                                            </div>
                                            @if($errors->has('phone'))
                                            <small class="form-control-feedback">{{$errors->first('phone')}}</small>
                                            @endif
                                        </div>
                                      </div>
                                      <div class="col-md-6">
                                        <div class="form-group {{$errors->has('role') ? 'has-danger' : ''}}">
                                            <label>UserRole</label>
                                            <div class="input-group mb-3">
                                              <select class="form-control" name="role">
                                                @foreach($roles as $role)
                                                  <option value="{{$role->id}}" {{$role->id==$user->role_id ? 'selected' : ''}}>{{$role->name}}</option>
                                                @endforeach
                                              </select>
                                            </div>
                                              @if($errors->has('role'))
                                              <small class="form-control-feedback">{{$errors->first('role')}}</small>
                                              @endif
                                        </div>
                                      </div>
                                      <div class="col-md-6">
                                        <div class="form-group {{$errors->has('gender') ? 'has-danger' : ''}}">
                                            <label>Gender</label>
                                            <div class="input-group mb-3">
                                              <select class="form-control" name="gender">
                                                @foreach($genders as $gender)
                                                  <option value="{{$gender->id}}" {{$gender->id==$user->gender ? 'selected' : ''}}>{{$gender->name}}</option>
                                                @endforeach
                                              </select>
                                            </div>
                                              @if($errors->has('gender'))
                                              <small class="form-control-feedback">{{$errors->first('gender')}}</small>
                                              @endif
                                        </div>
                                      </div>
                                      <div class="col-md-12">
                                        <div class="form-group {{$errors->has('bio') ? 'has-danger' : ''}}">
                                            <label>BIO</label>
                                            <div class="input-group mb-3">
                                              <textarea class="form-control" rows="3" name="bio" placeholder="Text Here..."></textarea>
                                            </div>
                                            @if($errors->has('bio'))
                                            <small class="form-control-feedback">{{$errors->first('bio')}}</small>
                                            @endif
                                        </div>
                                      </div>
                                  </div>

                                  <h4 class="card-title mt-3">Address Info</h4>
                                  <hr>
                                  <div class="row pt-3">

                                      <div class="col-md-6">
                                        <div class="form-group {{$errors->has('address') ? 'has-danger' : ''}}">
                                            <label>Location</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon11"><i class="ti-location-pin"></i></span>
                                                </div>
                                                <input type="text" class="form-control" name="address" placeholder="Enter User Location" value="{{$user->address}}">
                                            </div>
                                            @if($errors->has('address'))
                                            <small class="form-control-feedback">{{$errors->first('address')}}</small>
                                            @endif
                                        </div>
                                      </div>
                                  </div>

                                  <h4 class="card-title mt-3">User Photo</h4>
                                  <hr>
                                  <div class="row pt-3">
                                      <div class="col-md-3">
                                          <div class="form-group">
                                              <label class="control-label">Image</label>
                                              <input name="image" type="file" id="input-file-now" class="dropify" />
                                          </div>
                                      </div>
                                      <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Present Image</label>
                                            <img src="{{$user->user_image}}" width="225" alt="">
                                        </div>
                                      </div>
                                  </div>

                                  <h4 class="card-title mt-3">Social Media Info</h4>
                                  <hr>
                                  <div class="row pt-3">
                                      <div class="col-md-6">
                                        <div class="form-group {{$errors->has('facebook') ? 'has-danger' : ''}}">
                                            <label>FaceBook</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon11"><i class="ti-facebook"></i></span>
                                                </div>
                                                <input type="text" class="form-control" name="facebook" placeholder="Enter User FaceBook Url" value="{{$user->facebook}}">
                                            </div>
                                            @if($errors->has('facebook'))
                                            <small class="form-control-feedback">{{$errors->first('facebook')}}</small>
                                            @endif
                                        </div>
                                      </div>
                                      <div class="col-md-6">
                                        <div class="form-group {{$errors->has('twitter') ? 'has-danger' : ''}}">
                                            <label>Twitter</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon11"><i class="ti-twitter-alt"></i></span>
                                                </div>
                                                <input type="text" class="form-control" name="twitter" placeholder="Enter User Twitter Url" value="{{$user->twitter}}">
                                            </div>
                                            @if($errors->has('twitter'))
                                            <small class="form-control-feedback">{{$errors->first('twitter')}}</small>
                                            @endif
                                        </div>
                                      </div>
                                      <div class="col-md-6">
                                        <div class="form-group {{$errors->has('instagram') ? 'has-danger' : ''}}">
                                            <label>Instagram</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon11"><i class="ti-instagram"></i></span>
                                                </div>
                                                <input type="text" class="form-control" name="instagram" placeholder="Enter User Instagram Url" value="{{$user->instagram}}">
                                            </div>
                                            @if($errors->has('instagram'))
                                            <small class="form-control-feedback">{{$errors->first('instagram')}}</small>
                                            @endif
                                        </div>
                                      </div>
                                      <div class="col-md-6">
                                        <div class="form-group {{$errors->has('youtube') ? 'has-danger' : ''}}">
                                            <label>YouTube</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon11"><i class="ti-youtube"></i></span>
                                                </div>
                                                <input type="text" class="form-control" name="youtube" placeholder="Enter User YouTube Url" value="{{$user->youtube}}">
                                            </div>
                                            @if($errors->has('youtube'))
                                            <small class="form-control-feedback">{{$errors->first('youtube')}}</small>
                                            @endif
                                        </div>
                                      </div>
                                  </div>

                                  <h4 class="card-title mt-3">Password</h4>
                                  <hr>
                                  <div class="row pt-3">
                                      <div class="col-md-6">
                                        <div class="form-group {{$errors->has('oldpass') ? 'has-danger' : ''}}">
                                            <label>Old Password</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon11"><i class="ti-lock"></i></span>
                                                </div>
                                                <input type="password" class="form-control" name="oldpass" placeholder="Enter User Old Password">
                                            </div>
                                            @if($errors->has('oldpass'))
                                            <small class="form-control-feedback">{{$errors->first('oldpass')}}</small>
                                            @endif
                                        </div>
                                      </div>
                                      <div class="col-md-6">

                                      </div>
                                      <div class="col-md-6">
                                        <div class="form-group {{$errors->has('password') ? 'has-danger' : ''}}">
                                            <label>New Password</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon11"><i class="ti-lock"></i></span>
                                                </div>
                                                <input type="password" class="form-control" name="password" placeholder="Enter User New Password">
                                            </div>
                                            @if($errors->has('password'))
                                            <small class="form-control-feedback">{{$errors->first('password')}}</small>
                                            @endif
                                        </div>
                                      </div>

                                      <div class="col-md-6">
                                        <div class="form-group {{$errors->has('password_confirmation') ? 'has-danger' : ''}}">
                                            <label>Confirm Password</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon11"><i class="ti-lock"></i></span>
                                                </div>
                                                <input type="password" class="form-control" name="password_confirmation" placeholder="Enter User New Password">
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
                                      <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Update</button>
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
