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
                        <h1 class="page-header">Hóa đơn
                            <small>Danh sách</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div>
                        <h3>Doanh thu trong ngày : 
                        <span>{{number_format($tongtien_trongngay)}} đồng</span>
                        </h3>
                        <!-- <span>{{number_format($tongtien_trongthang)}} đồng</span>
                        {{$carbon_thang}} -->
                    </div>
              <!--       <div>{{$tongtien_trongthang}}</div>
                     <div>{{$carbon_ngay}}</div> -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>Mã hóa đơn</th>
                                <th>Tên</th>
                                <th>Email</th>
                                <th>Ngày đặt</th>
                                <th>Tổng tiền</th>
                                <th>Hình thức thanh toán</th>
                                <th>Số điện thoại</th>
                                <th>Địa chỉ</th>
                                <th>Ghi chú</th>
                                <th>Trạng thái</th>
                                <th>Duyệt</th>
                                <th>Xóa</th>
                                <th>Xem chi tiết</th>
                               
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bill as $b)
                            <tr class="odd gradeX" align="center">
                                <td>{{$b->id}}</td>
                                <td>{{$b->customer->name}}</td>
                                <td>{{$b->customer->email}}</td>
                                <td>{{$b->date_order}}</td>
                                <td>{{number_format($b->total)}} đồng</td>
                                <td>@if($b->payment == 'COD') {{"Thanh toán khi nhận hàng"}}@else {{"Thanh toán qua ATM"}} @endif</td>
                                <td>{{$b->customer->phone_number}}</td>
                                <td>{{$b->customer->address}}</td>                           
                                <td>{{$b->note}}</td>
                                <td>@if($b->status == 1){{"Đang giao"}}@endif @if($b->status == 0) <span style="color:orange;">{{"Chưa giao"}}</span>@endif @if($b->status ==2) 
                                    <span style="color:blue;border: 5px solid orange;background-color: orange;">{{"Đã giao"}}</span> @endif @if($b->status == 3) <span style="color:red">{{"Hủy giao"}}</span> @endif 
                                </td>

                                <td>@if($b->status == 0)<a href="admin/bill/danhsach/{{$b->id}}"><input type="button" name="" value="Duyệt"></a>@endif @if($b->status ==1) <a href="admin/bill/danhsach/{{$b->id}}"><input type="button" name="" value="Đã giao"></a> @endif @if($b->status ==2) {{"Thành công"}} @endif @if($b->status == 3)<span style="color:red"> {{"Hủy giao"}}</span> @endif</td>

                                <td class="center"> @if($b->status ==0 || $b->status == 1 )<i class="fa fa-trash-o  fa-fw"></i> <a href="admin/bill/xoa/{{$b->id}}" onclick="return confirm('Bạn có chắc là xóa đơn hàng {{$b->customer->name}}')" > Xóa</a> @endif @if($b->status == 2) {{"Đơn hàng đã giao"}} @endif @if($b->status == 3) <span style="color:red">{{"Đã hủy"}} </span>@endif   </td>

                                <td class="center"><i class="fa fa-pencil fa-fw"></i><a href="admin/bill/xemchitiet/{{$b->id}}"> Xem chi tiết</a></td>
                                
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