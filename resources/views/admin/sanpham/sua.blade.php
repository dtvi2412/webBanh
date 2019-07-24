        @extends('admin.layout.index')

        @section('content')
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Sản phẩm
                            <small>{{$sanpham->name}}</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                        @if(count($errors) > 0)
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $err)
                                    {{$err}}<br>
                                @endforeach
                            </div>
                        @endif 
                        @if(session('thongbao'))
                            <div class="alert alert-success">
                                {{session('thongbao')}}
                            </div>
                        @endif
                        @if(session('nhapsai'))
                            <div class="alert alert-danger">
                                {{session('nhapsai')}}
                            </div>
                        @endif
                        @if(session('loi'))
                            <div class="alert alert-danger">
                                {{session('loi')}}
                            </div>
                        @endif
                        <form action="admin/sanpham/sua/{{$sanpham->id}}" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="form-group">
                                <label>Loại sản phẩm</label>
                                <select class="form-control" name="TheLoai">
                                    @foreach($theloai as $tl)
                                    <option 

                                    @if($sanpham->product_type->id == $tl->id)
                                    {{"selected"}}
                                    @endif

                                    value="{{$tl->id}}">{{$tl->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tên</label>
                                <input class="form-control" name="Ten" placeholder="Nhập tên sản phẩm..." value="{{$sanpham->name}}" />
                            </div>
                            <div class="form-group">
                                <label>Chi tiết</label>
                                <textarea name="ChiTiet" class="form-control" rows="3" placeholder="Nhập chi tiết sản phẩm...">
                                    {{$sanpham->description}}
                                </textarea>
                            </div>
                            <div class="form-group">
                                <label>Giá</label>
                                <input type="number" class="form-control" name="Gia" placeholder="Nhập giá..." value="{{$sanpham->unit_price}}" />
                            </div>
                            <div class="form-group">
                                <label>Giá khuyến mãi</label>
                                <input type="number" class="form-control" name="GiaKhuyenMai" placeholder="Nhập giá khuyến mãi..." value="{{$sanpham->promotion_price}}"/>
                            </div>
                            <div class="form-group">
                                <label>Hình ảnh</label>                               
                                <p>
                                    <img width="400px" src="HinhBanh/{{$sanpham->image}}">
                                </p>
                                <input type="file" name="Hinh"  class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>Sản phẩm</label>
                                <label class="radio-inline">
                                    <input name="Moi" value="1" 
                                    @if($sanpham->new == 1) 
                                        {{"checked"}}
                                    @endif
                                    type="radio">Mới
                                </label>
                                <label class="radio-inline">
                                    <input name="Moi" value="0" 
                                    @if($sanpham->new == 0) 
                                        {{"checked"}}
                                    @endif

                                    type="radio">Khác
                                </label>
                            </div>
                            <button type="submit" class="btn btn-default">Sửa</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
        @endsection