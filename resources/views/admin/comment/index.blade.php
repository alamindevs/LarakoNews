  @extends('layouts.admin')

@section('title','Comments')

@push('css')
<link href="{{asset('content/admin')}}/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">
@endpush


@section('content')

  @component('admin.component.breadcrumb')
    @slot('title')
      <h5 class="font-medium text-uppercase mb-0">Comments</h5>
    @endslot
    @slot('list')
      <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
      <li class="breadcrumb-item active" aria-current="page">Comments</li>
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
                      </div>
                    </div>
                    <div class="col-8">
                      <div class="pull-right">
                        <a href="{{route('admin.comment.index')}}?status=all" class="btn btn-sm btn-outline-dark {{Request::get('status')=='all' ? 'active' : ''}} " title="View"><i class="mdi mdi-check-all"></i> All</a>
                        <a href="{{route('admin.comment.index')}}?status=active" class="btn btn-sm btn-outline-dark {{Request::get('status')=='active' ? 'active' : ''}}" title="View"><i class="mdi mdi-power"></i> Approve</a>
                        <a href="{{route('admin.comment.index')}}?status=unactive" class="btn btn-sm btn-outline-dark {{Request::get('status')=='unactive' ? 'active' : ''}}" title="View"><i class="mdi mdi-power-plug-off"></i> UnApprove</a>
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
                                    <th>Email</th>
                                    <th>Comment</th>
                                    <th>Posts</th>
                                    <th>Status</th>
                                    <th>Create Time</th>
                                </tr>
                            </thead>
                            <tbody>
                              @foreach($comments as $data)
                                <tr>
                                    <td>{{$data->name}}</td>
                                    <td>{{$data->email}}</td>
                                    <td>{{str_limit($data->comment,15)}}</td>

                                    <td>{{str_limit($data->post->title,20)}}</td>
                                    <td>{{$data->created_at}}</td>
                                    <td>
                                      <a href="{{route('admin.comment.show',$data->id)}}"><button class="btn btn-circle btn-sm btn-info" title="View"><i class="mdi mdi-eye"></i></button></a>
                                      @if($data->status !=1)
                                      <a href="{{route('admin.comment.approve',$data->id)}}"><button class="btn btn-circle btn-sm btn-info" title="Approve"><i class="mdi mdi-check"></i></button></a>
                                      @endif
                                      <a href="#" class="button_trush" data-toggle="modal" data-target="#deleteModal" data-url="{{route('admin.comment.destroy',$data->id)}}"><button class="btn btn-circle btn-sm btn-danger" title="Delete"><i class="mdi mdi-delete"></i></button></a>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                            <tfoot>
                              <tr>
                                  <th>Name</th>
                                  <th>Email</th>
                                  <th>Comment</th>
                                  <th>Posts</th>
                                  <th>Status</th>
                                  <th>Create Time</th>
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
                          <h3>Are You shure This Comment Delete ?</h3>
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
