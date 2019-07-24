@extends('master')
@section('content')
	<!-- page -->
	<div class="services-breadcrumb">
		<div class="agile_inner_breadcrumb">
			<div class="container">
				<ul class="w3_short">
					<li>
						<a href="{{route('trang-chu')}}">Trang chủ</a>
						<i>|</i>
					</li>
					<li>Đặt hàng</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- //page -->
	<div class="container">
		<div id="content">
			@if(count($errors)>0)
						<div class="alert alert-danger">
							@foreach($errors->all() as $err)
							{{$err}}
							@endforeach
						</div>
					@endif
			<form action="{{route('dathang')}}" method="post" class="beta-form-checkout">
				<input type="hidden" name="_token" value="{{csrf_token()}}">@if(Session::has('thongbao'))
				<div class="alert alert-success">{{Session::get('thongbao')}}</div>
				@endif
				<div class="row">
					@if(Session::has('cart'))
					<div class="col-sm-6">
						<h4>Đặt hàng</h4>
						<div class="space20">&nbsp;</div>

						<div class="form-block">
							<label for="name">Họ tên*</label>
							<input type="text" id="name" name="name" placeholder="Họ tên" required>
						</div>
						<div class="form-block">
							<label>Giới tính </label>
							<input id="gender" type="radio" class="input-radio" name="gender" value="nam" checked="checked" style="width: 10%"><span style="margin-right: 10%">Nam</span>
							<input id="gender" type="radio" class="input-radio" name="gender" value="nữ" style="width: 10%"><span>Nữ</span>
										
						</div>

						<div class="form-block">
							<label for="email">Email*</label>
							<input type="email" id="email" name="email" required placeholder="expample@gmail.com">
						</div>

						<div class="form-block">
							<label for="adress">Địa chỉ*</label>
							<input type="text" id="address" name="address" placeholder="Street Address" required>
						</div>
						

						<div class="form-block">
							<label for="phone">Điện thoại*</label>
							<input type="text" id="phone" name="phone" required>
						</div>
						
						<div class="form-block">
							<label for="notes">Ghi chú</label>
							<textarea id="notes" name="notes"></textarea>
						</div>
					</div>
					@endif
					<div class="col-sm-6">
						<div class="your-order">
							@if(Session::has('cart'))
							<div class="your-order-head"><h5 style="text-align: center">Đơn hàng của bạn</h5></div>
							@else
							<div class="your-order-head"><h5 style="text-align: center">Giỏ hàng của bạn (0 sản phẩm)</h5></div>
							@endif
							<div class="your-order-body" style="padding: 0px 10px">
								<div class="your-order-item">
									<div>
									@if(Session::has('cart'))
									@foreach($product_cart as $cart)
									<!--  one item	 -->
										<div class="media">
											<img width="25%" src="HinhBanh/{{$cart['item']['image']}}" alt="" class="pull-left">
											<div class="media-body">
												<p class="font-large">{{$cart['item']['name']}}</p>
												<span class="color-gray your-order-info">Đơn giá: {{number_format($cart['price'])}} đồng</span>
												<span class="color-gray your-order-info">Số lượng: {{$cart['qty']}}</span>
											</div>
										</div>
									<!-- end one item -->
									@endforeach
									<!--NEU GIO HANG KO CO SAN PHAM THI SE KHONG CHO DUOC THANH TOAN-->
									@else
									<div style="margin:0 auto;">
										<img  style="margin-left:auto;margin-right: auto;display: block;" src="/images/hinhNhoGioHang.jpg">
										<div style="color:black;font-size:20px;text-align: center">Không có sản phẩm nào trong giỏ hàng của bạn</div><br>
										<a href="{{route('trang-chu')}}"><input style="background-color: #fdd835;color:black;margin-right: auto;margin-left: auto;display: block;" type="button" value="Tiếp tục mua hàng"></a>
									</div>
									@endif

									</div>
									<div class="clearfix"></div>
								</div>
								@if(Session::has('cart'))
								<div class="your-order-item">
									<div class="pull-left"><p class="your-order-f18">Tổng tiền:</p></div>
									<div class="pull-right"><h5 class="color-black">@if(Session::has('cart')) {{number_format(Session('cart')->totalPrice)}} @else 0 @endif đồng</h5></div>
									<div class="clearfix"></div>
								</div>
								@endif
							</div>
							@if(Session::has('cart'))
							<div class="your-order-head"><h5>Hình thức thanh toán</h5></div>
							@endif
							@if(Session::has('cart'))
							<div class="your-order-body">
								<ul class="payment_methods methods">
									<li class="payment_method_bacs">
										<input id="payment_method_bacs" type="radio" class="input-radio" name="payment_method" value="COD" checked="checked" data-order_button_text="" name="payment">
										<label for="payment_method_bacs">Thanh toán khi nhận hàng </label>
										<div class="payment_box payment_method_bacs" style="display: block;">
											Cửa hàng sẽ gửi hàng đến địa chỉ của bạn, bạn xem hàng rồi thanh toán tiền cho nhân viên giao hàng
										</div>						
									</li>

									<li class="payment_method_cheque">
										<input id="payment_method_cheque" type="radio" class="input-radio" name="payment_method" value="ATM" data-order_button_text="" name="payment">
										<label for="payment_method_cheque">Chuyển khoản </label>
										<div class="payment_box payment_method_cheque" style="display: none;">
											Chuyển tiền đến tài khoản sau:
											<br>- Số tài khoản: 123 456 789
											<br>- Chủ TK: Nguyễn A
											<br>- Ngân hàng ACB, Chi nhánh TPHCM
										</div>						
									</li>
									
								</ul>
							</div>
							@endif
							@if(Session::has('cart'))
							<div class="text-center"><button type="submit" class="beta-btn primary" href="#">Đặt hàng <i class="fa fa-chevron-right"></i></button></div>
							@endif
						</div> <!-- .your-order -->
					</div>
				</div>
			</form>
		</div> <!-- #content -->
	</div> <!-- .container -->
@endsection