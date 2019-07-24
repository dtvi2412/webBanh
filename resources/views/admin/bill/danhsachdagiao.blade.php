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
                            <small>Danh sách đã giao</small>
                        </h1>
                    </div>
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>Mã hóa đơn</th>
                                <th>Tên</th>
                                <th>Gmail</th>
                                <th>Ngày đặt</th>
                                <th>Tổng tiền</th>
                                <th>Hình thức thanh toán</th>
                                <th>SDT</th>
                                <th>Địa chỉ</th>
                                <th>Ghi chú</th>
                                <th>Trạng thái</th>
                               
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
                                <td>@if($b->status == 2)<span style="color:blue;border: 5px solid orange;background-color: orange;"> {{"Đã giao"}}</span> @endif
                                </td>

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