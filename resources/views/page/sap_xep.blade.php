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
					<li>Sắp xếp tăng dần</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- //page -->
<div class="ads-grid py-sm-5 py-4">
		<div class="container py-xl-4 py-lg-2">
			<!-- tittle heading -->
	
			<!-- //tittle heading -->
		
			<div class="row">
				<!-- product left -->
				<div class="agileinfo-ads-display col-lg-9">
					<div class="wrapper">
						<!-- first section -->
						<div class="product-sec1 px-sm-4 px-3 py-sm-5  py-3 mb-4">
							<h3 class="heading-tittle text-center font-italic">Sắp xếp theo tên</h3>
							<div class="content">
								<div class="row">	
								@foreach($sapxep_theoten as $sx)							
									<div class="col-md-4 product-men mt-5">
										<div class="men-pro-item simpleCart_shelfItem">
											<div class="men-thumb-item text-center">
												<img src="HinhBanh/{{$sx->image}}" style="height: 120px" alt="" width="300px">
												<div class="men-cart-pro">
													<div class="inner-men-cart-pro">
														<a href="{{route('chitietsanpham',$sx->id)}}" class="link-product-add-cart">Xem chi tiết</a>
													</div>
												</div>
												@if($sx->promotion_price!=0)
												<span class="product-new-top">Khuyến mãi</span>
												@endif

											</div>
											<div class="item-info-product text-center border-top mt-4">
												<h4 class="pt-1">
													<a href="single.html">{{$sx->name}}</a>
												</h4>
												<div class="info-product-price my-2">
													@if($sx->promotion_price==0)
													<span class="item_price">{{number_format($sx->unit_price)}} đồng</span>
													@else
													<span class="item_price">{{number_format($sx->promotion_price)}} đồng</span>
													<del>{{number_format($sx->unit_price)}} đồng</del>
													@endif
												</div>
												<div class="single-item-caption">
													<a class="add-to-cart pull-left" href="{{route('themgiohang',$sx->id)}}"><i class="fa fa-shopping-cart"></i></a>
													<a class="beta-btn primary" href="{{route('chitietsanpham',$sx->id)}}">Chi tiết <i class="fa fa-chevron-right"></i></a>
													<div class="clearfix"></div>
												</div>
										

											</div>
										</div>
									</div>
								@endforeach								
								</div></br>
								<div class="row">{{$sapxep_theoten->links()}}</div>
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
								<input type="search" placeholder="Product name..." name="key" required="">
								<input type="submit" value=" ">
							</form>
						</div>
						<!-- price -->
						<div class="range border-bottom py-2">
							<h3 class="agileits-sear-head mb-3">Sắp xếp tên</h3>
							<div class="w3l-range">
								<ul>
									<li>
										<a href="{{route('sapxeptangten')}}">Tăng dần</a>
									</li><br>
									<li>
										<a href="{{route('sapxepgiamten')}}">Giảm dần</a>
									</li>
								</ul>
							</div>
						</div>
						<div class="range border-bottom py-2">
							<h3 class="agileits-sear-head mb-3">Sắp xếp giá</h3>
							<div class="w3l-range">
								<ul>
									<li>
										<a href="{{route('sapxeptanggia')}}">Tăng dần</a>
									</li><br>
									<li>
										<a href="{{route('sapxepgiamgia')}}">Giảm dần</a>
									</li>
								</ul>
							</div>
						</div>

					</div>
					<!-- //product right -->
				</div>
			</div>
		</div>
</div>
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
				url: '/ajax/tangtheoten_ajax?page='+ page
			}).done(function(data){


				$('.content').html(data);

			});

		}
</script>
@endsection