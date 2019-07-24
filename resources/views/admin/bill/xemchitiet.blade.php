@extends('admin.layout.index')
@section('content')
<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Hóa đơn
                            <small>{{$bill->customer->name}}</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>Mã hóa đơn</th>
                                <th>Sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Đơn giá</th>
                            </tr>
                        </thead>
                        <tbody>
                         	 @foreach($bill_detail as $bdt)
                            <tr class="odd gradeX" align="center">
                               
                                <td>{{$bdt->id}}</td>
                                <td>{{$bdt->product->name}}
                                    <p><img src="HinhBanh/{{$bdt->product->image}}" style="width: 200px" height="100px"></p>
                                </td>
                                <td>{{$bdt->quantity}}</td>
                                <td>{{number_format($bdt->unit_price)}} đồng</td>
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