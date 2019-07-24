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
                     @if(session('baocao'))
                        <span>Hiện tịa không có sản phẩm bán chạy</span>
                    @endif
                    <div class="col-lg-12">
                        <h1 class="page-header">Sản phẩm bán chạy
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
                               
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sanpham_banchay as $sp)
                            <tr class="odd gradeX" align="center">
                                <td>{{$sp->product->id}}</td>
                                <td>
                                    <p>{{$sp->product->name}}</p>
                                    <img width="100px" src="HinhBanh/{{$sp->product->image}}">
                                </td>
                                <td>{{$sp->product->product_type->name}}</td>
                                <td>{{number_format($sp->product->unit_price)}} đồng</td>
                                <td>{{number_format($sp->product->promotion_price)}} đồng</td>
                                <td>
                            		@if($sp->product->new == 1){{"Mới"}} @else {{"Khác"}} @endif
                                </td>
                                
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