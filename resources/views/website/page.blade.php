@extends('layouts.website')

@section('content')
  @component('website.component.breadcrumb')
  <h1>{{$page->name}}</h1>
    <ol class="breadcrumb">
        <li><a href="{{route('index')}}">Home</a></li>
        <li class="active">{{$page->name}}</li>
    </ol>
  @endcomponent
  <section class="main-content">
     <div class="container">
        <div class="row">
           <!-- <div class="col-md-12 col-sm-2 col-xs-12">
              <div class="contact-detail">
                 <h3> Keep In Touch</h3>
                 <p>Lorem ipsum dolor sit amet, elit, sed do eiusmod tempor But for many emerging designers like ScriptsBundle. </p>
              </div>
           </div> -->
           <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
             {!!$page->description!!}
           </div>

        </div>
     </div>
  </section>

@endsection
