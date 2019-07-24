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
					<li>Thông tin chi tiết sản phẩm</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- //page -->

	<!-- Single Page -->
	<div class="banner-bootom-w3-agileits py-5">
		<div class="container py-xl-4 py-lg-2">
			<!-- tittle heading -->
			<h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
				<span>Sản phẩm {{$sanpham->name}}</span>
				</h3>
			<!-- //tittle heading -->
			<div class="row">
				<div class="col-lg-5 col-md-8 single-right-left ">
					<div class="grid images_3_of_2">
						<div class="flexslider">
							<ul class="slides">
								<li data-thumb="images/si1.jpg" style="list-style: none;">
									<div class="thumb-image">
										<img src="HinhBanh/{{$sanpham->image}}" data-imagezoom="true" class="img-fluid" alt=""> </div>
								</li>
							</ul>
							<div class="clearfix"></div>
						</div>
					</div>
					
					<div id="slickimg">
						@foreach($hinhlienquan as $hinhlq)
						<img src="nhieuhinh/{{$hinhlq->image}}" style="height:60px">
						@endforeach
					</div>

					
				</div>

				<div class="col-lg-7 single-right-left simpleCart_shelfItem">
					<h3 class="mb-3">{{$sanpham->name}}</h3>
					<p class="mb-3">
						@if($sanpham->promotion_price==0)
						<span class="item_price">{{number_format($sanpham->unit_price)}} đồng</span>
						@else
						<del class="mx-2 font-weight-light">{{number_format($sanpham->unit_price)}} đồng</del>
						<span class="item_price">{{number_format($sanpham->promotion_price)}} đồng</span>
						@endif
					</p>
					<div class="single-infoagile">
						<p>Mô tả</p>
						<span>{{$sanpham->description}}</span>
					</div><br>
			<!-- 		<p>Số lượng</p>
					<div class="single-item-options">
						<select class="wc-select">
							<option>Số lượng</option>
							<option>1</option>
							<option>2</option>
							<option>3</option>
							<option>4</option>
							<option>5</option>
						</select>
					</div><br> -->
					<p>Thêm vào giỏ hàng</p>
					<div class="single-item-caption">							
							<a class="add-to-cart pull-left" href="{{route('themgiohang',$sanpham->id)}}"><i class="fa fa-shopping-cart"></i></a>
							<div class="clearfix"></div>
					</div>
					
				</div>
			</div>
		</div>
	</div>
	<!--BO SUNG SAN PHAM TUONG TU-->
					<div class="ok sptuongtu" style="margin-left: 20px">
						<div class="sptrong">
						<h3>Sản phẩm tương tự</h3>
						<p>Tìm thấy {{$sp_tuongtu->total()}} sản phẩm</p>
						<div class="product-sec1 px-sm-4 px-3 py-sm-5  py-3 mb-4">
							<div class="content">
								<div class="row">
								@foreach($sp_tuongtu as $sptt)
									<div class="col-md-4 product-men mt-md-0 mt-5">
										<div class="men-pro-item simpleCart_shelfItem">
											<div class="men-thumb-item text-center">
												<img src="HinhBanh/{{$sptt->image}}" style="height: 150px" alt="" width="420px">
												<div class="men-cart-pro">
													<div class="inner-men-cart-pro">
														<a href="{{route('chitietsanpham',$sptt->id)}}" class="link-product-add-cart">Xem chi tiết</a>
													</div>
												</div>
												@if($sptt->promotion_price!=0)
												<span class="product-new-top">Khuyến mãi</span>
												@endif
											</div>
											<div class="item-info-product text-center border-top mt-4">
												<h4 class="pt-1">
													<a href="single.html">{{$sptt->name}}</a>
												</h4>
												<div class="info-product-price my-2">
													@if($sptt->promotion_price!=0)
													<span class="item_price">{{number_format($sptt->promotion_price)}} đồng</span>
													<del>{{number_format($sptt->unit_price)}} đồng</del>
													@else
													<span class="item_price">{{number_format($sptt->unit_price)}} đồng</span>
													@endif
												</div>
													<div class="single-item-caption">
													<a class="add-to-cart pull-left" href="{{route('themgiohang',$sptt->id)}}"><i class="fa fa-shopping-cart"></i></a>
													<a class="beta-btn primary" href="{{route('chitietsanpham',$sptt->id)}}">Chi tiết <i class="fa fa-chevron-right"></i></a>
													<div class="clearfix"></div>
												</div>
											</div>
										</div>
									</div>
								@endforeach
								</div></br>
								<div class="row">{{$sp_tuongtu->links()}}</div>
								</div>
							</div>
						</div>
					</div>
					</div>

	<!-- //Single Page -->
@endsection

@section('script')
<script>
	
		$(document).on('click','.pagination a' ,function(e){

			e.preventDefault();

			var page = $(this).attr('href').split('page=')[1];
			getProducts(page);
			
		});	

		function getProducts(page){
			console.log('getting products for page =' + page);

			$.ajax({
				url: '/ajax/chitiet_sanpham_ajax/{{$sanpham->id}}?page='+ page
			}).done(function(data){


				$('.content').html(data);

			});

		}
</script>
@endsection