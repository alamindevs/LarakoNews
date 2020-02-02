@extends('layouts.admin')

@section('title')




@section('content')

  @component('admin.component.breadcrumb')
    @slot('title')
      <h5 class="font-medium text-uppercase mb-0">Footer Content & Contact</h5>
    @endslot

    @slot('list')
    <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page">Footer Content & Contact</li>
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
                      <form action="{{route('admin.footerContent.submit')}}" method="post">
                          @csrf
                          @method('PUT')
                          <div class="form-body">
                              <div class="card-body">
                                <h4 class="card-title">WebSite Contact Info</h4>
                                <hr>
                                  <div class="row pt-3">
                                      <div class="col-md-6">
                                        <div class="form-group {{$errors->has('email') ? 'has-danger' : ''}}">
                                            <label>Email</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon11"><i class="ti-email"></i></span>
                                                </div>
                                                <input type="text" class="form-control" name="email" placeholder="Enter Contact Email" value="{{$data->email}}">
                                            </div>
                                            @if($errors->has('email'))
                                            <small class="form-control-feedback">{{$errors->first('email')}}</small>
                                            @endif
                                        </div>
                                      </div>
                                      <div class="col-md-6">
                                        <div class="form-group {{$errors->has('phone') ? 'has-danger' : ''}}">
                                            <label>Phone</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon11"><i class="ti-mobile"></i></span>
                                                </div>
                                                <input type="text" class="form-control" name="phone" placeholder="Enter Contact Phone Number" value="{{$data->phone}}">
                                            </div>
                                            @if($errors->has('phone'))
                                            <small class="form-control-feedback">{{$errors->first('phone')}}</small>
                                            @endif
                                        </div>
                                      </div>
                                      <div class="col-md-6">
                                        <div class="form-group {{$errors->has('address') ? 'has-danger' : ''}}">
                                            <label>Address</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon11"><i class="ti-location-pin"></i></span>
                                                </div>
                                                <input type="text" class="form-control" name="address" placeholder="Enter Address"  value="{{$data->address}}">
                                            </div>
                                            @if($errors->has('address'))
                                            <small class="form-control-feedback">{{$errors->first('address')}}</small>
                                            @endif
                                        </div>
                                      </div>
                                      <div class="col-md-12">
                                        <div class="form-group {{$errors->has('short_about') ? 'has-danger' : ''}}">
                                            <label>Footer Short About</label>
                                            <div class="input-group mb-3">
                                              <textarea class="form-control" rows="3" name="short_about" placeholder="Text Here...">{{$data->short_about}}</textarea>
                                            </div>
                                            @if($errors->has('short_about'))
                                            <small class="form-control-feedback">{{$errors->first('short_about')}}</small>
                                            @endif
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
                                                <input type="text" class="form-control" name="facebook" placeholder="Enter Contact FaceBook Url" value="{{$data->facebook}}">
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
                                                <input type="text" class="form-control" name="twitter" placeholder="Enter Contact Twitter Url" value="{{$data->twitter}}">
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
                                                <input type="text" class="form-control" name="instagram" placeholder="Enter Contact Instagram Url" value="{{$data->instagram}}">
                                            </div>
                                            @if($errors->has('instagram'))
                                            <small class="form-control-feedback">{{$errors->first('instagram')}}</small>
                                            @endif
                                        </div>
                                      </div>
                                      <div class="col-md-6">
                                        <div class="form-group {{$errors->has('linkedin') ? 'has-danger' : ''}}">
                                            <label>YouTube</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon11"><i class="ti-linkedin"></i></span>
                                                </div>
                                                <input type="text" class="form-control" name="linkedin" placeholder="Enter Contact Linkedin Url" value="{{$data->linkedin}}">
                                            </div>
                                            @if($errors->has('linkedin'))
                                            <small class="form-control-feedback">{{$errors->first('linkedin')}}</small>
                                            @endif
                                        </div>
                                      </div>
                                      <div class="col-md-6">
                                        <div class="form-group {{$errors->has('google') ? 'has-danger' : ''}}">
                                            <label>Google</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon11"><i class="ti-google"></i></span>
                                                </div>
                                                <input type="text" class="form-control" name="google" placeholder="Enter Contact Google+ Url" value="{{$data->google}}">
                                            </div>
                                            @if($errors->has('google'))
                                            <small class="form-control-feedback">{{$errors->first('google')}}</small>
                                            @endif
                                        </div>
                                      </div>
                                      <div class="col-md-6">
                                        <div class="form-group {{$errors->has('pinterest') ? 'has-danger' : ''}}">
                                            <label>Pinterest</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon11"><i class="ti-pinterest"></i></span>
                                                </div>
                                                <input type="text" class="form-control" name="pinterest" placeholder="Enter Contact Pinterest Url" value="{{$data->pinterest}}">
                                            </div>
                                            @if($errors->has('pinterest'))
                                            <small class="form-control-feedback">{{$errors->first('pinterest')}}</small>
                                            @endif
                                        </div>
                                      </div>
                                  </div>
                                  <h4 class="card-title mt-3">Copyright</h4>
                                  <hr>
                                  <div class="row pt-3">
                                    <div class="col-md-6">
                                      <div class="form-group {{$errors->has('copyright') ? 'has-danger' : ''}}">
                                          <div class="input-group mb-3">
                                              <div class="input-group-prepend">
                                                  <span class="input-group-text" id="basic-addon11">&copy;</span>
                                              </div>
                                              <input type="text" class="form-control" name="copyright" placeholder="Enter Copyright" value="{{$data->copyright}}">
                                          </div>
                                          @if($errors->has('copyright'))
                                          <small class="form-control-feedback">{{$errors->first('copyright')}}</small>
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
