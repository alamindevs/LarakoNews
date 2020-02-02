@extends('layouts.admin')

@section('title','Blog Posts')

@push('css')
<link href="{{asset('content/admin')}}/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">
@endpush


@section('content')

  @component('admin.component.breadcrumb')
    @slot('title')
      <h5 class="font-medium text-uppercase mb-0">Posts</h5>
    @endslot
    @slot('list')
      <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
      <li class="breadcrumb-item active" aria-current="page">Posts</li>
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
                        <a href="{{route('admin.post.create')}}" class="btn btn-sm btn-success"> <i class="mdi mdi-plus-box"></i> Create New Post</a>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="pull-right">
                        <a href="{{route('admin.post.index',['status'=>'all'])}}" class="btn btn-sm btn-outline-dark {{Request::get('status')=='all' ? 'active' : ''}} " title="View"><i class="mdi mdi-check-all"></i> All</a>
                        <a href="{{route('admin.post.index',['status'=>'publish'])}}" class="btn btn-sm btn-outline-dark {{Request::get('status')=='publish' ? 'active' : ''}}" title="View"><i class="mdi mdi-publish"></i> Publish</a>
                        <a href="{{route('admin.post.index')}}?status=schedule" class="btn btn-sm btn-outline-dark {{Request::get('status')=='schedule' ? 'active' : ''}}" title="View"><i class="mdi mdi-calendar-clock"></i> Schedule</a>
                        <a href="{{route('admin.post.index')}}?status=panding" class="btn btn-sm btn-outline-dark {{Request::get('status')=='panding' ? 'active' : ''}}" title="View"><i class="mdi mdi-timer-sand"></i> Panding</a>
                        <a href="{{route('admin.post.recycle')}}" class="btn btn-sm btn-outline-danger {{Route::currentRouteName('admin.post.recycle')=='admin.post.recycle' ? 'active' : ''}}"  title="View"><i class="mdi mdi-delete"></i> Trash</a>
                      </div>
                    </div>
                  </div>
              </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped border">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Creator</th>
                                    <th>View</th>
                                    <th>Status</th>
                                    <th>Create Time</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                              @foreach($post as $data)
                                <tr>
                                    <td>{{str_limit($data->title,25)}}</td>
                                    <td>
                                      @foreach($data->categorys as $cat)
                                      <button type="button" class="btn waves-effect waves-light btn-sm btn-success">{{$cat->name}}</button>

                                      @endforeach
                                    </td>
                                    <td>{{$data->user->name}}</td>
                                    <td>{{views($data)->count()}}</td>
                                    <td>{!! $data->statusButton() !!}</td>
                                    <td>{{$data->dateFormet()}}</td>
                                    <td>
                                      @if($data->status == 2)
                                      <a href="{{route('admin.post.approved',$data->slug)}}"><button class="btn btn-circle btn-sm btn-success" title="approved"><i class="mdi mdi-check"></i></button></a>
                                      @endif
                                      @if(Route::currentRouteName('admin.post.recycle')!='admin.post.recycle')
                                      <a href="{{route('admin.post.edit',$data->slug)}}"><button class="btn btn-circle btn-sm btn-success" title="Edit"><i class="mdi mdi-pencil"></i></button></a>
                                      @endif
                                      @if(Route::currentRouteName('admin.post.recycle')=='admin.post.recycle')
                                      <a href="{{route('admin.post.restore',$data->slug)}}"  onclick="return confirm('Are you sure this post ReStore ?')"><button class="btn btn-circle btn-sm btn-danger" title="ReSore"><i class="mdi mdi-backup-restore"></i></button></a>
                                      @endif
                                      <a href="#" class="button_trush" data-toggle="modal" data-target="#deleteModal" data-url="@if(Route::currentRouteName('admin.post.recycle')=='admin.post.recycle') {{route('admin.post.forceDelete',$data->slug)}}  @else {{route('admin.post.destroy',$data->slug)}} @endif"><button class="btn btn-circle btn-sm btn-danger" title="Delete"><i class="mdi mdi-delete"></i></button></a>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                            <tfoot>
                              <tr>
                                  <th>Title</th>
                                  <th>Category</th>
                                  <th>Creator</th>
                                  <th>View</th>
                                  <th>Status</th>
                                  <th>Create Time</th>
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
                          <h3>{{Route::currentRouteName('admin.post.recycle')=='admin.post.recycle' ? "Are You shure This Post Delete ?":"Are You shure This Post Move to Trush ?"}}</h3>
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
