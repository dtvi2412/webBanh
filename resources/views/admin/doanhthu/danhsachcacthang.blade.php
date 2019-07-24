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
                            <small>danh sách theo tháng</small>
                        </h1>
                    </div>


                	<form action="admin/doanhthu/danhsachcacthang" method="get">
                    	<select name="thang">
                    		<option value="0">--Chọn tháng--</option>
                    		<option value="2019-05">Tháng 5</option>
                    		<option value="2019-06">Tháng 6</option>
                    		<option value="2019-07">Tháng 7</option>
                    		<option value="2019-08">Tháng 8</option>
                    		<option value="2019-09">Tháng 9</option>
                    		<option value="2019-10">Tháng 10</option>
                    	</select>
                    	<button type="submit" class="btn btn-default">Xem</button>
                	</form>
                	<br>

                   @if(isset($tongdoanhthucuathang))
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
                            @foreach($tongdoanhthucuathang as $dt)
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