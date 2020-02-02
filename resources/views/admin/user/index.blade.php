@extends('layouts.admin')

@section('title','All User')

@push('css')
<link href="{{asset('content/admin')}}/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">
@endpush


@section('content')

  @component('admin.component.breadcrumb')
    @slot('title')
      <h5 class="font-medium text-uppercase mb-0">Users</h5>
    @endslot
    @slot('list')
      <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
      <li class="breadcrumb-item active" aria-current="page">All User</li>
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
                        <a href="{{route('admin.user.create')}}" class="btn btn-sm btn-success"> <i class="mdi mdi-account-plus"></i> Create New User</a>
                      </div>
                    </div>
                    <div class="col-8">
                      <div class="pull-right">
                        <a href="{{route('admin.user.index')}}?status=all" class="btn btn-sm btn-outline-dark {{Request::get('status')=='all' ? 'active' : ''}} " title="View"><i class="mdi mdi-check-all"></i> All</a>
                        <a href="{{route('admin.user.index')}}?status=admin" class="btn btn-sm btn-outline-dark {{Request::get('status')=='admin' ? 'active' : ''}}" title="View"><i class="mdi mdi-account-settings"></i> Admin</a>
                        <a href="{{route('admin.user.index')}}?status=author" class="btn btn-sm btn-outline-dark {{Request::get('status')=='author' ? 'active' : ''}}" title="View"><i class="mdi mdi-account-network"></i> Author</a>
                        <a href="{{route('admin.user.index')}}?status=editor" class="btn btn-sm btn-outline-dark {{Request::get('status')=='editor' ? 'active' : ''}}" title="View"><i class="mdi mdi-account-edit"></i> Editor</a>
                        <a href="{{route('admin.user.index')}}?status=active" class="btn btn-sm btn-outline-dark {{Request::get('status')=='active' ? 'active' : ''}}" title="View"><i class="mdi mdi-power"></i> Active</a>
                        <a href="{{route('admin.user.index')}}?status=unactive" class="btn btn-sm btn-outline-dark {{Request::get('status')=='unactive' ? 'active' : ''}}" title="View"><i class="mdi mdi-power-plug-off"></i> UnActive</a>
                        <a href="{{route('admin.user.index')}}?status=trash" class="btn btn-sm btn-outline-danger {{Request::get('status')=='trash' ? 'active' : ''}}"  title="View"><i class="mdi mdi-delete"></i> Trash</a>
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
                                    <th>UserName</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Total Posts</th>
                                    <th>Status</th>
                                    <th>Create Time</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                              @foreach($user as $data)
                                <tr>
                                    <td>{{$data->name}}</td>
                                    <td>{{$data->username}}</td>
                                    <td>{{$data->email}}</td>
                                    <td>{{$data->role->name}}</td>
                                    @if(Request::get('status')=='trash')
                                    <td>{{$data->posts()->onlyTrashed()->count()}}</td>
                                    @else
                                    <td>{{$data->posts()->count()}}</td>
                                    @endif
                                    <td>{!! $data->status_button !!}</td>
                                    <td>{{$data->created_at}}</td>
                                    <td>
                                      <a href="{{route('admin.user.show',$data->slug)}}"><button class="btn btn-circle btn-sm btn-info" title="View"><i class="mdi mdi-eye"></i></button></a>

                                      <a href="{{route('admin.user.edit',$data->slug)}}"><button class="btn btn-circle btn-sm btn-success" title="Edit"><i class="mdi mdi-pencil"></i></button></a>


                                      @if(Request::get('status')=='trash')
                                      <a href="{{route('admin.user.restore',$data->slug)}}"  onclick="return confirm('Are you sure this User ReStore ?')"><button class="btn btn-circle btn-sm btn-danger" title="ReStore"><i class="mdi mdi-backup-restore"></i></button></a>
                                      @endif
                                      <a href="#" class="button_trush" data-toggle="modal" data-target="#deleteModal" data-url="@if(Request::get('status')=='trash') {{route('admin.user.forceDelete',$data->slug)}} @else {{route('admin.user.destroy',$data->slug)}} @endif"><button class="btn btn-circle btn-sm btn-danger" title="Delete"><i class="mdi mdi-delete"></i></button></a>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                            <tfoot>
                              <tr>
                                  <th>Nmae</th>
                                  <th>UserName</th>
                                  <th>Email</th>
                                  <th>Role</th>
                                  <th>Total Posts</th>
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
                          <h3>{{Request::get('status')=='trash' ? 'Are You shure This User Permanent Delete And This User All  posts Permanent Delete ?' : 'Are You shure This User Move to Trush ?'}}</h3>
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
