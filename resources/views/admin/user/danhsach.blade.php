 	@extends('admin.layout.index')
 	@section('content')
 	<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    @if(session('thongbao'))
                    <div class="alert alert-success">
                        {{session('thongbao')}}
                    </div>
                    @endif
                    <div class="col-lg-12">
                        <h1 class="page-header">User
                            <small>Danh sách</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>Mã</th>
                                <th>Tên</th>
                                <th>Email</th>
                                <th>Quyền</th>
                                <th>Số điện thoại</th>
                                <th>Địa chỉ</th>
                                <th>Xóa</th>
                                <th>Sửa</th>
                               
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user as $u)
                            <tr class="odd gradeX" align="center">
                                <td>{{$u->id}}</td>
                                <td>{{$u->full_name}}</td>
                                <td>{{$u->email}}</td>
                                <td>
                                    @if($u->quyen == 1)
                                    {{"Admin"}}
                                    @else
                                    {{"Thường"}}
                                    @endif
                                </td>
                                <td>{{$u->phone}}</td>
                                <td>{{$u->address}}</td>
                                <td class="center">@if($u->quyen!=1)<i class="fa fa-trash-o  fa-fw"></i>@endif @if($u->quyen == 1)<span>Bạn không được xóa admin</span> @else<a href="admin/user/xoa/{{$u->id}}" onclick="return confirm('Bạn có thực sự muốn xóa {{$u->full_name}} ?')"> Xóa</a>@endif</td>
                                <td class="center">@if(Auth::user()->id == $u->id )<i class="fa fa-pencil fa-fw"></i> <a href="admin/user/sua/{{$u->id}}">Sửa</a>@else {{"Bạn không được sửa"}} @endif</td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
    @endsection