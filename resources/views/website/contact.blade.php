@extends('layouts.website')

@section('content')
  @component('website.component.breadcrumb')
  <h1>Contact Us</h1>
    <ol class="breadcrumb">
        <li><a href="{{route('index')}}">Home</a></li>
        <li class="active">Contact Us</li>
    </ol>
  @endcomponent
  <section class="main-content">
     <div class="container">
        <div class="row">

           <div class="col-md-8 col-sm-8 col-xs-12  nopadding">
             @if(session()->has('success'))
             <div class="alert alert-primary" style="background:#cce5ff;" role="alert">
                {{session('success')}}
              </div>
              @endif
              @if(session()->has('error'))
              <div class="alert alert-primary" style="background:red;" role="alert">
                 {{session('error')}}
               </div>
               @endif
              <div class="contact-form">
                 <form  method="post" action="{{route('contact.submit')}}">
                   @csrf
                    <div class="col-md-6 col-sm-6 col-xs-12">
                       <div class="form-group">
                          <input placeholder="Name" id="name" name="name" class="form-control"  type="text" style="{{$errors->has('name') ? 'border-color:red;': '' }}">
                       </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                       <div class="form-group">
                          <input placeholder="Email" id="email" name="email" class="form-control"  type="email" style="{{$errors->has('email') ? 'border-color:red;': '' }}">
                       </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                       <div class="form-group">
                          <input placeholder="Phone" id="phone" name="phone" class="form-control"  type="text" style="{{$errors->has('phone') ? 'border-color:red;': '' }}">
                       </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                       <div class="form-group">
                          <input placeholder="Subject" id="subject" name="subject" class="form-control"  type="text" style="{{$errors->has('subject') ? 'border-color:red;': '' }}">
                       </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                       <div class="form-group">
                          <textarea cols="12" rows="5" placeholder="Message..." id="message" name="message" class="form-control"  style="{{$errors->has('message') ? 'border-color:red;': '' }}"></textarea>
                       </div>
                       <div class="form-group">
                          <button class="btn btn-colored-blog pull-right" type="submit">Send Message</button>
                       </div>
                    </div>
                 </form>
              </div>
           </div>
           <div class="col-md-4 col-sm-6 col-xs-12">
              <div class="contact-detail-box">
                 <div class="icon-box">
                    <i class="ti-book"></i>
                 </div>
                 <div class="content-area">
                    <h4>Physical Address</h4>
                    <p>{{$contact->address}}</p>
                 </div>
              </div>
              <div class="contact-detail-box">
                 <div class="icon-box">
                    <i class="ti-mobile"></i>
                 </div>
                 <div class="content-area">
                    <h4>Contact Number</h4>
                    <p><span>Phone:</span> {{$contact->phone}}</p>
                 </div>
              </div>
              <div class="contact-detail-box">
                 <div class="icon-box">
                    <i class="ti-email"></i>
                 </div>
                 <div class="content-area">
                    <h4>Email Address</h4>
                    <p><span>Email:</span>{{$contact->email}}</p>
                 </div>
              </div>
           </div>
        </div>
     </div>
  </section>

@endsection
