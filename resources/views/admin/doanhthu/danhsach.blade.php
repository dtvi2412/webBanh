 	@extends('admin.layout.index')
 	@section('content')
 	<!-- Page Content -->
 		
        <div id="page-wrapper">
            <div class="container-fluid">
            	
                <div class="row">
                	<div>
		 			<h3>Tổng doanh thu:{{number_format($tongtien)}} đồng</h3>
		 			</div>
                    @if(session('thongbao'))
                    <div class="alert alert-success">
                        {{session('thongbao')}}
                    </div>
                    @endif
                    <div class="col-lg-12">
                        <h1 class="page-header">Doanh thu
                            <small>danh sách</small>
                        </h1>
                    </div>
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>Mã hóa đơn</th>
                                <th>Khách hàng</th>
                                <th>Ngày đặt</th>
                                <th>Tổng tiền</th>
                                <th>Hính thức thanh toán</th>
                              
                             
                               
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($danhsachdoanhthu as $tdt)
                            <tr class="odd gradeX" align="center">
                                <td>{{$tdt->id}}</td>
                                <td>{{$tdt->customer->name}}</td>
                                <td>{{$tdt->date_order}}</td>
                                <td>{{number_format($tdt->total)}} đồng</td>
                                <td>
                                	@if($tdt->payment == "COD")
                                	{{"Thanh toán khi nhận hàng"}}
                                	@else {{"Thanh toán qua ATM"}}
                                	@endif
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

    @endsection