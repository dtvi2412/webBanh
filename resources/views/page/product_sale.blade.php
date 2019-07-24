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