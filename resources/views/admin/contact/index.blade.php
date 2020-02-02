@extends('layouts.admin')

@section('title','All Meassage')

@push('css')
<link href="{{asset('content/admin')}}/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">
@endpush


@section('content')

  @component('admin.component.breadcrumb')
    @slot('title')
      <h5 class="font-medium text-uppercase mb-0">Meassage</h5>
    @endslot
    @slot('list')
      <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
      <li class="breadcrumb-item active" aria-current="page">All Meassage</li>
    @endslot
  @endcomponent

<div class="page-content container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="material-card card">
              <div class="card-header">
                  <div class="row">
                    <div class="col-4">
                      <div class="pull-left">
                        <!-- <h6 class="card-title mt-1">Posts</h6> -->

                      </div>
                    </div>
                    <div class="col-8">
                      <div class="pull-right">

                      </div>
                    </div>
                  </div>
              </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped border">
                            <thead>
                                <tr>
                                    <th>Nmae</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Subject</th>
                                    <th>Date/Time</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                              @foreach($contact as $data)
                                <tr>
                                    <td>{{$data->name}}</td>
                                    <td>{{$data->email}}</td>
                                    <td>{{$data->phone}}</td>
                                    <td>{{$data->subject}}</td>
                                    <td>{{$data->created_at}}</td>
                                    <td>
                                      <a href="{{route('admin.contact.show',$data->id)}}"><button class="btn btn-circle btn-sm btn-info" title="View"><i class="mdi mdi-eye"></i></button></a>

                                      <a href="#" class="button_trush" data-toggle="modal" data-target="#deleteModal" data-url="{{route('admin.contact.destroy',$data->id)}}"><button class="btn btn-circle btn-sm btn-danger" title="Delete"><i class="mdi mdi-delete"></i></button></a>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                            <tfoot>
                              <tr>
                                  <th>Nmae</th>
                                  <th>Email</th>
                                  <th>Phone</th>
                                  <th>Subject</th>
                                  <th>Date/Time</th>
                                  <th class="text-center">Action</th>
                              </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
            <div class="modal-dialog" role="document">
                <div class="modal-content">

                        <div class="modal-header">
                            <h4 class="modal-title" id="exampleModalLabel1">Delete</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                          <h3>Are You shure This Massage Delete ?</h3>
                        </div>
                        <div class="modal-footer">
                          <form  method="POST" id="postTrushForm">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancle</button>
                            <button type="submit" class="btn btn-danger">Delete</button>
                          </form>
                        </div>
                </div>
            </div>
        </div>

  <script type="text/javascript">

  $(document).on("click", ".button_trush", function(e) {
        e.preventDefault();
        var url = $(this).data("url");
        $("#postTrushForm").attr("action", url);
    });

  </script>

</div>

@endsection


@push('js')
<script src="{{asset('content/admin')}}/assets/extra-libs/DataTables/datatables.min.js"></script>
<script src="{{asset('content/admin')}}/dist/js/pages/datatable/datatable-basic.init.js"></script>
@endpush
