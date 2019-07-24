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