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
					<li>Tìm kiếm sản phẩm</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- //page -->
	<div class="ads-grid py-sm-5 py-4">
		<div class="container py-xl-4 py-lg-2">
			<!-- tittle heading -->
			<h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
				<span>T</span>ìm
				<span>K</span>iếm
				</h3>
			<!-- //tittle heading -->
			<div class="row">
				<!-- product left -->
				<div class="agileinfo-ads-display col-lg-9">
					<div class="wrapper">
						<!-- first section -->
						<div class="product-sec1 px-sm-4 px-3 py-sm-5  py-3 mb-4">
							<h5>Tìm thấy {{$product->total()}} sản phẩm <span style="color: red"><i>{{$tu_khoa}}</i></span></h5>
							<div class="content">
								<div class="row">	
								@foreach($product as $new)							
									<div class="col-md-4 product-men mt-5">
										<div class="men-pro-item simpleCart_shelfItem">
											<div class="men-thumb-item text-center">
												<img src="HinhBanh/{{$new->image}}" style="height: 120px" alt="" width="300px">
												<div class="men-cart-pro">
													<div class="inner-men-cart-pro">
														<a href="{{route('chitietsanpham',$new->id)}}" class="link-product-add-cart">Xem chi tiết</a>
													</div>
												</div>
												@if($new->promotion_price!=0)
												<span class="product-new-top">Khuyến mãi</span>
												@endif

											</div>
											<div class="item-info-product text-center border-top mt-4">
												<h4 class="pt-1">
													<a href="single.html">{{$new->name}}</a>
												</h4>
												<div class="info-product-price my-2">
													@if($new->promotion_price==0)
													<span class="item_price">{{number_format($new->unit_price)}} đồng</span>
													@else
													<span class="item_price">{{number_format($new->promotion_price)}} đồng</span>
													<del>{{number_format($new->unit_price)}} đồng</del>
													@endif
												</div>
												<div class="single-item-caption">
													<a class="add-to-cart pull-left" href="{{route('themgiohang',$new->id)}}"><i class="fa fa-shopping-cart"></i></a>
													<a class="beta-btn primary" href="{{route('chitietsanpham',$new->id)}}">Chi tiết <i class="fa fa-chevron-right"></i></a>
													<div class="clearfix"></div>
												</div>
											</div>
										</div>
									</div>
								@endforeach		
										
								</div></br>
								<div class="row">{{$product->appends(Request::all())->links()}}	</div>	
							</div>
						</div>
	
					</div>
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
				url: '/ajax/search_ajax?page='+ page
			}).done(function(data){


				$('.content').html(data);

			});

		}
</script>
@endsection