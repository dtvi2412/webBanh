
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
					<li>Loại sản phẩm</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- //page -->

	<!-- top Products -->
	<div class="ads-grid py-sm-5 py-4">
		<div class="container py-xl-4 py-lg-2">
			<!-- tittle heading -->
			<h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
				<span>S</span><span>ản phẩm {{$loai_sp->name}}</span>
			</h3>
			<!-- //tittle heading -->
			<div class="row">
				<!-- product left -->
				<div class="agileinfo-ads-display col-lg-9">
					<div class="wrapper">
						<!-- first section -->
						
						<div class="product-sec1 px-sm-4 px-3 py-sm-5  py-3 mb-4">

							<div class="row">
							@foreach($sp_theoloai as $sp)
								<div class="col-md-4 product-men mt-md-0 mt-5">
									<div class="men-pro-item simpleCart_shelfItem">
										<div class="men-thumb-item text-center">
											<img src="HinhBanh/{{$sp->image}}" style="height: 120px" alt="" width="300px">
											<div class="men-cart-pro">
												<div class="inner-men-cart-pro">
													<a href="{{route('chitietsanpham',$sp->id)}}" class="link-product-add-cart">Xem chi tiết</a>
												</div>
											</div>
											@if($sp->promotion_price!=0)
											<span class="product-new-top">Khuyến mãi</span>
											@endif
										</div>
										<div class="item-info-product text-center border-top mt-4">
											<h4 class="pt-1">
												<a href="single.html">{{$sp->name}}</a>
											</h4>
											<div class="info-product-price my-2">
												@if($sp->promotion_price!=0)
												<span class="item_price">{{number_format($sp->promotion_price)}} đồng</span>
												<del>{{number_format($sp->unit_price)}} đồng</del>
												@else
												<span class="item_price">{{number_format($sp->unit_price)}} đồng</span>
												@endif
											</div>
											<div class="single-item-caption">
												<a class="add-to-cart pull-left" href="{{route('themgiohang',$sp->id)}}"><i class="fa fa-shopping-cart"></i></a>
												<a class="beta-btn primary" href="{{route('chitietsanpham',$sp->id)}}">Chi tiết <i class="fa fa-chevron-right"></i></a>
												<div class="clearfix"></div>
											</div>
										</div>
									</div>
								</div>
							@endforeach
							</div><br>
							
						</div>
						<!-- //first section -->
						<!-- second section -->
						<h3>Sản phẩm khác</h3>
						<p>Tìm thấy {{$sp_khac->total()}} sản phẩm</p>
						<div class="product-sec1 px-sm-4 px-3 py-sm-5  py-3 mb-4">
							<div class="content">
							<div class="row">
							@foreach($sp_khac as $sp_k)
								<div class="col-md-4 product-men mt-md-0 mt-5">
									<div class="men-pro-item simpleCart_shelfItem">
										<div class="men-thumb-item text-center">
											<img src="HinhBanh/{{$sp_k->image}}" style="height: 120px" alt="" width="300px">
											<div class="men-cart-pro">
												<div class="inner-men-cart-pro">
													<a href="{{route('chitietsanpham',$sp_k->id)}}" class="link-product-add-cart">Xem chi tiết</a>
												</div>
											</div>
											@if($sp_k->promotion_price!=0)
											<span class="product-new-top">Khuyến mãi</span>
											@endif
										</div>
										<div class="item-info-product text-center border-top mt-4">
											<h4 class="pt-1">
												<a href="single.html">{{$sp_k->name}}</a>
											</h4>
											<div class="info-product-price my-2">
												@if($sp_k->promotion_price!=0)
												<span class="item_price">{{number_format($sp_k->promotion_price)}} đồng</span>
												<del>{{number_format($sp_k->unit_price)}} đồng</del>
												@else
												<span class="item_price">{{number_format($sp_k->unit_price)}} đồng</span>
												@endif
											</div>
											<div class="single-item-caption">
												<a class="add-to-cart pull-left" href="{{route('themgiohang',$sp_k->id)}}"><i class="fa fa-shopping-cart"></i></a>
												<a class="beta-btn primary" href="{{route('chitietsanpham',$sp_k->id)}}">Chi tiết <i class="fa fa-chevron-right"></i></a>
												<div class="clearfix"></div>
											</div>
										</div>
									</div>
								</div>
							@endforeach
							</div></br>
							<div class="row">{{$sp_khac->links()}}</div>
						</div>
						</div>
					</div>
				</div>
				<!-- //product left -->
				<!-- product right -->
				<div class="col-lg-3 mt-lg-0 mt-4 p-lg-0">
					<div class="side-bar p-sm-4 p-3">
						<div class="search-hotel border-bottom py-2">
							<h3 class="agileits-sear-head mb-3">Tìm kiếm</h3>
							<form action="{{route('search')}}" method="get">
								<input type="search" placeholder="Tìm kiếm..." name="key" required="">
								<input type="submit" value=" ">
							</form><br>
							<div class="left-side py-2">
								<ul>
								@foreach($loai as $l)
									<li style="list-style: none;"><a href="{{route('loaisanpham',$l->id)}}">{{$l->name}}</a></li>
								</ul>
								@endforeach
							</div>
						</div>
						<!-- ram -->
						
						<!-- //ram -->
						<!-- price -->
		<!-- 				<div class="range border-bottom py-2">
							<h3 class="agileits-sear-head mb-3">Giá</h3>
							<div class="w3l-range">
								<ul>
									<li>
										<a href="#">Under $1,000</a>
									</li>
									<li class="my-1">
										<a href="#">$1,000 - $5,000</a>
									</li>
									<li>
										<a href="#">$5,000 - $10,000</a>
									</li>
									<li class="my-1">
										<a href="#">$10,000 - $20,000</a>
									</li>
									<li>
										<a href="#">$20,000 $30,000</a>
									</li>
									<li class="mt-1">
										<a href="#">Over $30,000</a>
									</li>
								</ul>
							</div>
						</div> -->
						<!-- //price -->

						<!-- //arrivals -->
					</div>
					<!-- //product right -->
				</div>
			</div>
		</div>
	</div>
	<!-- //top products -->
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
				url: '/ajax/loaisanphamAjax/{type}?page='+ page
			}).done(function(data){


				$('.content').html(data);

			});

		}
</script>
@endsection