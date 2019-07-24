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

									<!--SANPHAMKHUYENMAI-->


									<!--SANPHAMKHUYENMAI-->