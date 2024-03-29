        @extends('admin.layout.index')

        @section('content')
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">User
                            <small>{{$user->full_name}}</small>
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
                        <form action="admin/user/sua/{{$user->id}}" method="POST">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="form-group">
                                <label>Họ tên</label>
                                <input class="form-control" name="name" value="{{$user->full_name}}" placeholder="Nhập tên người dùng..." />
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" value="{{$user->email}}" placeholder="Nhập địa chỉ email..." readonly="" />
                            </div>
                            <div class="form-group">
                                <input type="checkbox" id="changePassword" name="changePassword">
                                <label>Đổi mật khẩu</label>
                                <input class="form-control password" type="password" name="password" placeholder="Nhập mật khẩu.." 
                                disabled="" 
                                />
                            </div>
                            <div class="form-group">
                                <label>Nhập lại mật khẩu</label>
                                <input class="form-control password" type="password" name="passwordAgain" placeholder="Nhập lại mật khẩu.." 
                                disabled=""
                                />
                            </div>
                            <div class="form-group">
                                <label>Phone</label>
                                <input class="form-control" name="phone" value="{{$user->phone}}" placeholder="Nhập địa chỉ email..." />
                            </div>
                            <div class="form-group">
                                <label>Địa chỉ</label>
                                <input name="diachi" value="{{$user->address}}" class="form-control"/>
                            </div>

                            <div class="form-group">
                                <label>Quyền người dùng</label>
                                <label class="radio-inline">
                                    <input name="quyen" value="0" 
                                    @if($user->quyen == 0)
                                    {{"checked"}}
                                    @endif
                                     type="radio">Thường
                                </label>
                                <label class="radio-inline">
                                    <input name="quyen" value="1"
                                    @if($user->quyen == 1)
                                    {{"checked"}}
                                    @endif
                                      type="radio">Admin
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

        @section('script')

        <script>
            $(document).ready(function(){
                $("#changePassword").change(function(){
                    if($(this).is(":checked"))
                    {
                        $(".password").removeAttr('disabled');
                    }
                    else
                    {
                        $(".password").attr('disabled','');
                    }
                });
            });
        </script>

        @endsection