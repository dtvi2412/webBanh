
@extends('master')
@section('content')
	<!-- banner -->
	 <!-- Start of Primary Slider Section -->
        <section class="primary-slider-section mb0">
            <div id="primary_slider" class="swiper-container">
                <!-- Slides -->
                <div class="swiper-wrapper">
                	@foreach($slide as $sl)
                    <div class="swiper-slide bg-img-wrapper">
                        <div class="slide-inner image-placeholder">
                           <img src="hinhSlide/{{$sl->image}}" class="visually-hidden" alt="Slider Image"> 
                                            
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="slide-content layer-animation-1">
                                            <div class="slide-button">
                                                <a class="default-btn transparent" href="{{$sl->link}}" title="Shop Now">Mua ngay</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <!-- Slider Navigation -->
                <div class="swiper-arrow next slide"><i class="fa fa-angle-right"></i></div>
                <div class="swiper-arrow prev slide"><i class="fa fa-angle-left"></i></div>

                <!-- Slider Pagination -->
                <div class="swiper-pagination"></div>
            </div>
        </section>
        <!-- End of Primary Slider Section -->
	<!-- //banner -->

	<!-- top Products -->
	<div class="ads-grid py-sm-5 py-4">
		<div class="container py-xl-4 py-lg-2">
			<!-- tittle heading -->
			<h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
				<span>S</span>ản
				<span>P</span>hẩm
				<span>M</span>ới</h3>
			<!-- //tittle heading -->
			<div class="row">
				<!-- product left -->
				<div class="agileinfo-ads-display col-lg-9">
					<div class="wrapper">
						<!-- first section -->
						<!--Su dung ajax-->
						<!-- <div id="table_data">  -->
							<div class="product-sec1 px-sm-4 px-3 py-sm-5  py-3 mb-4">
								<!-- <h5>Tìm thấy {{count($new_product)}} sản phẩm</h5> -->
								<h5>Tìm thấy {{$new_product->total()}} sản phẩm</h5>
								<h3 class="heading-tittle text-center font-italic">Sản phẩm mới</h3>
								<!--AJAX-->
								<div class="content">
									
									<div class="row">	
									@foreach($new_product as $new)							
										<div class="col-md-4 product-men mt-5">
											<div class="men-pro-item simpleCart_shelfItem">
												<div class="men-thumb-item text-center">
													<img src="HinhBanh/{{$new->image}}"  style="height: 150px" alt="" width="300px">
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
														<a href="{{route('chitietsanpham',$new->id)}}">{{$new->name}}</a>
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
									<div class="row">{{$new_product->links()}}</div>
									
								</div>
								<!--AJAX-->
							</div>
						<!-- </div> -->
						<!--Su dung ajax-->
						<!-- //first section -->
						<!-- second section -->
						<div class="product-sec1 px-sm-4 px-3 py-sm-5  py-3 mb-4">
							<!-- <h5>Tìm thấy {{count($sanpham_khuyenmai)}} sản phẩm</h5> -->
							<h5>Tìm thấy {{$sanpham_khuyenmai->total()}} sản phẩm</h5>
							<h3 class="heading-tittle text-center font-italic">Sản phẩm khuyến mãi</h3>
							<div class="content_sale">
								<div class="row">
								@foreach($sanpham_khuyenmai as $spkm)
									<div class="col-md-4 product-men mt-5">
										<div class="men-pro-item simpleCart_shelfItem">
											<div class="men-thumb-item text-center">
												<img src="HinhBanh/{{$spkm->image}}" style="height: 120px" alt="" width="300px">
												<div class="men-cart-pro">
													<div class="inner-men-cart-pro">
														<a href="{{route('chitietsanpham',$spkm->id)}}" class="link-product-add-cart">Xem chi tiết</a>
													</div>
												</div>
												<span class="product-new-top">Khuyến mãi</span>

											</div>
											<div class="item-info-product text-center border-top mt-4">
												<h4 class="pt-1">
													<a href="{{route('chitietsanpham',$spkm->id)}}">{{$spkm->name}}</a>
												</h4>
												<div class="info-product-price my-2">
													<span class="item_price">{{number_format($spkm->promotion_price)}} đồng</span>
													<del>{{number_format($spkm->unit_price)}} đồng</del>
												</div>
												<div class="single-item-caption">
													<a class="add-to-cart pull-left" href="{{route('themgiohang',$spkm->id)}}"><i class="fa fa-shopping-cart"></i></a>
													<a class="beta-btn primary" href="{{route('chitietsanpham',$spkm->id)}}">Chi tiết <i class="fa fa-chevron-right"></i></a>
													<div class="clearfix"></div>
												</div>

											</div>
										</div>
									</div>
								@endforeach					
								</div></br>
								<div class="row">{{$sanpham_khuyenmai->links()}}</div>
							</div>	
						</div>
						<!-- //second section -->
						<!-- third section -->
						<!-- //third section -->
						<!-- fourth section -->
						<!-- //fourth section -->
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
						<!-- //price -->
						<!-- discounts -->
						
						<!-- //discounts -->
						<!-- reviews -->
					
						<!-- //reviews -->
						<!-- electronics -->
						
						<!-- //electronics -->
						<!-- delivery -->
					
						<!-- //delivery -->
						<!-- arrivals -->
						<div class="left-side border-bottom py-2">
							<h3 class="agileits-sear-head mb-3">Sản phẩm bán chạy</h3>
									@foreach($sanpham_banchay as $spbc)
									<div class="row">
										<div class="col-lg-3 col-sm-2 col-3 left-mar">
											<img src="HinhBanh/{{$spbc->product->image}}" alt="" class="img-fluid">
										</div>
										<div class="col-lg-9 col-sm-10 col-9 w3_mvd">
											<a href="{{route('chitietsanpham',$spbc->product->id)}}">{{$spbc->product->name}}</a>
											<a href="{{route('chitietsanpham',$spbc->product->id)}}" class="price-mar mt-2">{{number_format($spbc->product->unit_price)}} đồng</a>
										</div>
									</div>
									@endforeach
						</div>
						<!-- //arrivals -->
						<!-- best seller -->
	
						<!-- //best seller -->
					</div>
					<!-- //product right -->
				</div>
			</div>
		</div>
	</div>
	<!-- //top products -->

	<!-- middle section -->
	<!-- middle section -->


@endsection

@section('script')
<script>


		$(document).on('click','.pagination a' ,function(e){

			e.preventDefault();

			var page = $(this).attr('href').split('page=')[1];
			getProducts(page);
			var page2 = $(this).attr('href').split('page=')[1];
			getProducts_sale(page2);
		});	

		function getProducts(page){
			console.log('getting products for page =' + page);

			$.ajax({
				url: '/ajax/products?page='+ page
			}).done(function(data){


				$('.content').html(data);

			});

		}
	
	
		function getProducts_sale(page2){
			console.log('getting products_sale for page =' + page2);

			$.ajax({
				url: '/ajax/products_sale?page='+ page2
			}).done(function(data2){


				$('.content_sale').html(data2);

			});

		}
	


</script>

@endsection