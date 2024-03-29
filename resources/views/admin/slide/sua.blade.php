        @extends('admin.layout.index')

        @section('content')
        <!-- Page Content -->
         <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Slide
                            <small>{{$slide->name}}</small>
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
                        <form action="admin/slide/sua/{{$slide->id}}" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                             <div class="form-group">
                                <label>Tên</label>
                                <input class="form-control" name="Ten" placeholder="Nhập tên slide..." value="{{$slide->name}}" />
                            </div>
                            <div class="form-group">
                                <label>Hình ảnh</label>
                                <p>
                                    <img width="500px" src="hinhSlide/{{$slide->image}}">
                                </p>
                                <input type="file" name="Hinh"  class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>Đường dẫn</label>
                                <input class="form-control" name="link" placeholder="Nhập link slide..." value="{{$slide->link}}" />
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

     