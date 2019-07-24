 	@extends('admin.layout.index')
 	@section('content')
 	<!-- Page Content -->
 		
        <div id="page-wrapper">
            <div class="container-fluid">
            	
                <div class="row">
                	<div>
		 			<h3>Tổng doanh thu:{{number_format($tongdoanhthu)}} đồng</h3>
		 			</div>
                    @if(session('thongbao'))
                    <div class="alert alert-success">
                        {{session('thongbao')}}
                    </div>
                    @endif
                    <div class="col-lg-12">
                        <h1 class="page-header">Doanh thu
                            <small>danh sách theo ngày</small>
                        </h1>
                    </div>
                    <form action="admin/doanhthu/danhsachcacngay" method="get">
                    	<input type="date" name="date_order" value="{{$carbon_now->toDateString()}}" class="form-control"><br>
                    	<button type="submit" class="btn btn-default">Xem</button>
                	</form>
                	<br>
                	@if(isset($doanhthu))
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>Mã hóa đơn</th>
                                <th>Khách hàng</th>
                                <th>Ngày đặt</th>
                                <th>Tổng tiền</th>
                                <th>Hình thức thanh toán</th>
                                                                                                                 
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($doanhthu as $dt)
                            <tr class="odd gradeX" align="center">
                                <td>{{$dt->id}}</td>
                                <td>{{$dt->customer->name}}</td>
                                <td>{{$dt->date_order}}</td>
                                <td>{{number_format($dt->total)}} đồng</td>
                                <td>
                                	@if($dt->payment == "COD")
                                	{{"Thanh toán khi nhận hàng"}}
                                	@else {{"Thanh toán qua ATM"}}
                                	@endif
                                </td>
                                                                              
                            </tr>  
                            @endforeach                   
                        </tbody>
                    </table>
                   @endif
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    @endsection