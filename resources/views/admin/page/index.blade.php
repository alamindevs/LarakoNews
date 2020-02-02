@extends('layouts.admin')

@section('title','Web Pages')

@push('css')
<link href="{{asset('content/admin')}}/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">
@endpush


@section('content')

  @component('admin.component.breadcrumb')
    @slot('title')
      <h5 class="font-medium text-uppercase mb-0">Web Pages</h5>
    @endslot
    @slot('list')
      <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
      <li class="breadcrumb-item active" aria-current="page">Pages</li>
    @endslot
  @endcomponent

<div class="page-content container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="material-card card">
              <div class="card-header">
                  <div class="row">
                    <div class="col-6">
                      <div class="pull-left">
                        <!-- <h6 class="card-title mt-1">Posts</h6> -->
                        <a href="{{route('admin.page.create')}}" class="btn btn-sm btn-success"> <i class="mdi mdi-plus-box"></i> Create New Page</a>
                      </div>
                    </div>
                    <div class="col-6">
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
                                    <th>Name</th>
                                    <th>Create Date</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                              @foreach($page as $data)
                                <tr>
                                    <td>{{$data->name}}</td>
                                    <td>{{$data->created_at->format('d F Y')}}</td>

                                    <td class="text-center">
                                      <a href="{{route('admin.page.edit',$data->slug)}}"><button class="btn btn-circle btn-sm btn-success" title="Edit"><i class="mdi mdi-pencil"></i></button></a>
                                      <a href="#" class="button_trush" data-toggle="modal" data-target="#deleteModal" data-url="{{route('admin.page.destroy',$data->slug)}}"><button class="btn btn-circle btn-sm btn-danger" title="Delete"><i class="mdi mdi-delete"></i></button></a>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                            <tfoot>
                              <tr>
                                <th>Name</th>
                                <th>Create Date</th>
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
                            <h4 class="modal-title" id="exampleModalLabel1">Move To Trush</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                          <h3>Are You shure This Page Delete ?</h3>
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
