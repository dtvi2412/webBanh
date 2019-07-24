						<div class="row">	
							@foreach($sapxep_theogia as $sx)							
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
							<div class="row">{{$sapxep_theogia->links()}}</div>
						</div>