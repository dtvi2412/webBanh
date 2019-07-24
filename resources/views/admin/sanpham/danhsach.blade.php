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
                        <h1 class="page-header">Sản phẩm
                            <small>danh sách</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>Mã</th>
                                <th>Tên</th>
                                <th>Loại sản phẩm</th>
                                <th>Giá</th>
                                <th>Giá khuyến mãi</th>
                                <th>Sản phẩm</th>
                                <th>Xóa</th>
                                <th>Sửa</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sanpham as $sp)
                            <tr class="odd gradeX" align="center">
                                <td>{{$sp->id}}</td>
                                <td>
                                    <p>{{$sp->name}}</p>
                                    <img width="100px" src="HinhBanh/{{$sp->image}}">
                                </td>
                                <td>{{$sp->product_type->name}}</td>
                                <td>{{number_format($sp->unit_price)}} đồng</td>
                                <td>{{number_format($sp->promotion_price)}} đồng</td>
                                <td>
                                     @if($sp->new == 1)
                                    {{"Mới"}}
                                    @else
                                    {{"Khác"}}
                                    @endif
                                </td>
                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a onclick="return confirm('Bạn có muốn xóa {{$sp->name}} ?')" href="admin/sanpham/xoa/{{$sp->id}}"> Xóa</a></td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/sanpham/sua/{{$sp->id}}"> Sửa</a></td>
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
              <!-- Page Content -->
    @endsection