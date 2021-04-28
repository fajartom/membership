@extends('artist.layout.default')
@section('content')

<!-- Content
	============================================= -->
	<section id="content" class="bg-light" style="width: 100%">

	

			<div class="container clearfix">

            <!-- Posts
            	============================================= -->
            	<div class="single-post nobottommargin">

                <!-- Single Post
                	============================================= -->
                	<div class="entry clearfix">


                    <!-- Entry Meta
                    	============================================= -->


                    <!-- Entry Image
                    	============================================= -->
                    	<div class="entry-image bottommargin">

                    	</div><!-- .entry-image end -->

                    <!-- Entry Content
                    	============================================= -->
                    	<div class="entry-content notopmargin text-justify">
                    		<section id="page-title">

                    			<div class="container clearfix">
                    				<h1>Shop</h1>
                    				<span>Start Buying your Favourite Merchandise</span>
                    				<ol class="breadcrumb">
                    					<li class="breadcrumb-item"><a href="/{{$locale}}">Home</a></li>
                    					<li class="breadcrumb-item active" aria-current="page">Shop</li>
                    				</ol>
                    			</div>

                    		</section><!-- #page-title end -->

		<!-- Content
			============================================= -->
			<section id="content">

				<div class="content-wrap">

					<div class="container clearfix">

					<!-- Shop
						============================================= -->
						<div id="shop" class="shop product-3 grid-container clearfix" data-layout="fitRows">

							<div class="product clearfix">
								<div class="product-image">
									<a href="#"><img src="{{asset("storage/shop/dress/1-1.jpg")}}" alt="Checked Short Dress"></a>
									<a href="#"><img src="{{asset("storage/shop/dress/1-1.jpg")}}" alt="Checked Short Dress"></a>
									<div class="sale-flash">50% Off*</div>
									<div class="product-overlay">
										<a href="#" class="add-to-cart"><i class="icon-shopping-cart"></i><span> Add to Cart</span></a>
										<a href="#" class="item-quick-view" data-lightbox="ajax"><i class="icon-zoom-in2"></i><span> Quick View</span></a>
									</div>
								</div>
								<div class="product-desc center">
									<div class="product-title"><h3><a href="#">Checked Short Dress</a></h3></div>
									<div class="product-price"><del>Rp.250.000</del> <ins>Rp.150.000</ins></div>
									<div class="product-rating">
										<i class="icon-star3"></i>
										<i class="icon-star3"></i>
										<i class="icon-star3"></i>
										<i class="icon-star3"></i>
										<i class="icon-star-half-full"></i>
									</div>
								</div>
							</div>

							<div class="product clearfix">
								<div class="product-image">
									<a href="#"><img src="{{asset("storage/shop/pants/1-1.jpg")}}" alt="Slim Fit Chinos"></a>
									<a href="#"><img src="{{asset("storage/shop/pants/1.jpg")}}" alt="Slim Fit Chinos"></a>
									<div class="product-overlay">
										<a href="#" class="add-to-cart"><i class="icon-shopping-cart"></i><span> Add to Cart</span></a>
										<a href="#" class="item-quick-view" data-lightbox="ajax"><i class="icon-zoom-in2"></i><span> Quick View</span></a>
									</div>
								</div>
								<div class="product-desc center">
									<div class="product-title"><h3><a href="#">Slim Fit Chinos</a></h3></div>
									<div class="product-price">Rp.120.000</div>
									<div class="product-rating">
										<i class="icon-star3"></i>
										<i class="icon-star3"></i>
										<i class="icon-star3"></i>
										<i class="icon-star-half-full"></i>
										<i class="icon-star-empty"></i>
									</div>
								</div>
							</div>

							<div class="product clearfix">
								<div class="product-image">
									<div class="fslider" data-arrows="false">
										<div class="flexslider">
											<div class="slider-wrap">
												<div class="slide"><a href="#"><img src="{{asset("storage/shop/shoes/1.jpg")}}" alt="Dark Brown Boots"></a></div>
												<div class="slide"><a href="#"><img src="{{asset("storage/shop/shoes/1-1.jpg")}}" alt="Dark Brown Boots"></a></div>
												<div class="slide"><a href="#"><img src="{{asset("storage/shop/shoes/1-2.jpg")}}" alt="Dark Brown Boots"></a></div>
											</div>
										</div>
									</div>
									<div class="product-overlay">
										<a href="#" class="add-to-cart"><i class="icon-shopping-cart"></i><span> Add to Cart</span></a>
										<a href="#" class="item-quick-view" data-lightbox="ajax"><i class="icon-zoom-in2"></i><span> Quick View</span></a>
									</div>
								</div>
								<div class="product-desc center">
									<div class="product-title"><h3><a href="#">Dark Brown Boots</a></h3></div>
									<div class="product-price">Rp.300.000</div>
									<div class="product-rating">
										<i class="icon-star3"></i>
										<i class="icon-star3"></i>
										<i class="icon-star3"></i>
										<i class="icon-star-empty"></i>
										<i class="icon-star-empty"></i>
									</div>
								</div>
							</div>

							<div class="product clearfix">
								<div class="product-image">
									<a href="#"><img src="{{asset("storage/shop/dress/1-1.jpg")}}"alt="Light Blue Denim Dress"></a>
									<a href="#"><img src="{{asset("storage/shop/dress/2-2.jpg")}}" alt="Light Blue Denim Dress"></a>
									<div class="product-overlay">
										<a href="#" class="add-to-cart"><i class="icon-shopping-cart"></i><span> Add to Cart</span></a>
										<a href="#" class="item-quick-view" data-lightbox="ajax"><i class="icon-zoom-in2"></i><span> Quick View</span></a>
									</div>
								</div>
								<div class="product-desc center">
									<div class="product-title"><h3><a href="#">Light Blue Denim Dress</a></h3></div>
									<div class="product-price">Rp.190.000</div>
									<div class="product-rating">
										<i class="icon-star3"></i>
										<i class="icon-star3"></i>
										<i class="icon-star3"></i>
										<i class="icon-star3"></i>
										<i class="icon-star-empty"></i>
									</div>
								</div>
							</div>

							<div class="product clearfix">
								<div class="product-image">
									<a href="#"><img src="{{asset("storage/shop/sunglasses/1.jpg")}}" alt="Unisex Sunglasses"></a>
									<a href="#"><img src="{{asset("storage/shop/sunglasses/1-1.jpg")}}" alt="Unisex Sunglasses"></a>
									<div class="sale-flash">Sale!</div>
									<div class="product-overlay">
										<a href="#" class="add-to-cart"><i class="icon-shopping-cart"></i><span> Add to Cart</span></a>
										<a href="#" class="item-quick-view" data-lightbox="ajax"><i class="icon-zoom-in2"></i><span> Quick View</span></a>
									</div>
								</div>
								<div class="product-desc center">
									<div class="product-title"><h3><a href="#">Unisex Sunglasses</a></h3></div>
									<div class="product-price"><del>Rp.70.000</del> <ins>Rp.70.000</ins></div>
									<div class="product-rating">
										<i class="icon-star3"></i>
										<i class="icon-star3"></i>
										<i class="icon-star3"></i>
										<i class="icon-star-empty"></i>
										<i class="icon-star-empty"></i>
									</div>
								</div>
							</div>

							<div class="product clearfix">
								<div class="product-image">
									<a href="#"><img src="{{asset("storage/shop/tshirts/1.jpg")}}" alt="Blue Round-Neck Tshirt"></a>
									<a href="#"><img src="{{asset("storage/shop/tshirts/1-1.jpg")}}" alt="Blue Round-Neck Tshirt"></a>
									<div class="product-overlay">
										<a href="#" class="add-to-cart"><i class="icon-shopping-cart"></i><span> Add to Cart</span></a>
										<a href="#" class="item-quick-view" data-lightbox="ajax"><i class="icon-zoom-in2"></i><span> Quick View</span></a>
									</div>
								</div>
								<div class="product-desc center">
									<div class="product-title"><h3><a href="#">Blue Round-Neck Tshirt</a></h3></div>
									<div class="product-price">Rp.190.000</div>
									<div class="product-rating">
										<i class="icon-star3"></i>
										<i class="icon-star3"></i>
										<i class="icon-star3"></i>
										<i class="icon-star-half-full"></i>
										<i class="icon-star-empty"></i>
									</div>
								</div>
							</div>

							<div class="product clearfix">
								<div class="product-image">
									<a href="#"><img src="{{asset("storage/shop/watches/1.jpg")}}" alt="Silver Chrome Watch"></a>
									<a href="#"><img src="{{asset("storage/shop/watches/1-1.jpg")}}" alt="Silver Chrome Watch"></a>
									<div class="product-overlay">
										<a href="#" class="add-to-cart"><i class="icon-shopping-cart"></i><span> Add to Cart</span></a>
										<a href="#" class="item-quick-view" data-lightbox="ajax"><i class="icon-zoom-in2"></i><span> Quick View</span></a>
									</div>
								</div>
								<div class="product-desc center">
									<div class="product-title"><h3><a href="#">Silver Chrome Watch</a></h3></div>
									<div class="product-price">Rp.430.000</div>
									<div class="product-rating">
										<i class="icon-star3"></i>
										<i class="icon-star3"></i>
										<i class="icon-star3"></i>
										<i class="icon-star3"></i>
										<i class="icon-star-half-full"></i>
									</div>
								</div>
							</div>

							<div class="product clearfix">
								<div class="product-image">
									<a href="#"><img src="../storage/shop/shoes/2.jpg" alt="Men Grey Casual Shoes"></a>
									<a href="#"><img src="../storage/shop/shoes/2-1.jpg" alt="Men Grey Casual Shoes"></a>
									<div class="sale-flash">Sale!</div>
									<div class="product-overlay">
										<a href="#" class="add-to-cart"><i class="icon-shopping-cart"></i><span> Add to Cart</span></a>
										<a href="#" class="item-quick-view" data-lightbox="ajax"><i class="icon-zoom-in2"></i><span> Quick View</span></a>
									</div>
								</div>
								<div class="product-desc center">
									<div class="product-title"><h3><a href="#">Men Grey Casual Shoes</a></h3></div>
									<div class="product-price"><del>Rp.450.999</del> <ins>Rp.339.490</ins></div>
									<div class="product-rating">
										<i class="icon-star3"></i>
										<i class="icon-star3"></i>
										<i class="icon-star-half-full"></i>
										<i class="icon-star-empty"></i>
										<i class="icon-star-empty"></i>
									</div>
								</div>
							</div>

							<div class="product clearfix">
								<div class="product-image">
									<div class="fslider" data-arrows="false">
										<div class="flexslider">
											<div class="slider-wrap">
												<div class="slide"><a href="#"><img src="{{asset("storage/shop/dress/3.jpg")}}" alt="Pink Printed Dress"></a></div>
												<div class="slide"><a href="#"><img src="{{asset("storage/shop/dress/3-1.jpg")}}" alt="Pink Printed Dress"></a></div>
												<div class="slide"><a href="#"><img src="{{asset("storage/shop/dress/3-2.jpg")}}" alt="Pink Printed Dress"></a></div>
											</div>
										</div>
									</div>
									<div class="product-overlay">
										<a href="#" class="add-to-cart"><i class="icon-shopping-cart"></i><span> Add to Cart</span></a>
										<a href="#" class="item-quick-view" data-lightbox="ajax"><i class="icon-zoom-in2"></i><span> Quick View</span></a>
									</div>
								</div>
								<div class="product-desc center">
									<div class="product-title"><h3><a href="#">Pink Printed Dress</a></h3></div>
									<div class="product-price">Rp.390.490</div>
									<div class="product-rating">
										<i class="icon-star3"></i>
										<i class="icon-star3"></i>
										<i class="icon-star3"></i>
										<i class="icon-star-empty"></i>
										<i class="icon-star-empty"></i>
									</div>
								</div>
							</div>

							<div class="product clearfix">
								<div class="product-image">
									<a href="#"><img src="{{asset("storage/shop/pants/5.jpg")}}" alt="Green Trousers"></a>
									<a href="#"><img src="{{asset("storage/shop/pants/5-1.jpg")}}" alt="Green Trousers"></a>
									<div class="sale-flash">Sale!</div>
									<div class="product-overlay">
										<a href="#" class="add-to-cart"><i class="icon-shopping-cart"></i><span> Add to Cart</span></a>
										<a href="#" class="item-quick-view" data-lightbox="ajax"><i class="icon-zoom-in2"></i><span> Quick View</span></a>
									</div>
								</div>
								<div class="product-desc center">
									<div class="product-title"><h3><a href="#">Green Trousers</a></h3></div>
									<div class="product-price"><del>Rp.240.999</del> <ins>Rp.210.990</ins></div>
									<div class="product-rating">
										<i class="icon-star3"></i>
										<i class="icon-star3"></i>
										<i class="icon-star3"></i>
										<i class="icon-star-half-full"></i>
										<i class="icon-star-empty"></i>
									</div>
								</div>
							</div>

							<div class="product clearfix">
								<div class="product-image">
									<a href="#"><img src="{{asset("storage/shop/sunglasses/2.jpg")}}" alt="Men Aviator Sunglasses"></a>
									<a href="#"><img src="{{asset("storage/shop/sunglasses/2-1.jpg")}}" alt="Men Aviator Sunglasses"></a>
									<div class="product-overlay">
										<a href="#" class="add-to-cart"><i class="icon-shopping-cart"></i><span> Add to Cart</span></a>
										<a href="#" class="item-quick-view" data-lightbox="ajax"><i class="icon-zoom-in2"></i><span> Quick View</span></a>
									</div>
								</div>
								<div class="product-desc center">
									<div class="product-title"><h3><a href="#">Men Aviator Sunglasses</a></h3></div>
									<div class="product-price">Rp.130.000</div>
									<div class="product-rating">
										<i class="icon-star3"></i>
										<i class="icon-star3"></i>
										<i class="icon-star3"></i>
										<i class="icon-star3"></i>
										<i class="icon-star-empty"></i>
									</div>
								</div>
							</div>

							<div class="product clearfix">
								<div class="product-image">
									<a href="#"><img src="{{asset("storage/shop/tshirts/4.jpg")}}" alt="Black Polo Tshirt"></a>
									<a href="#"><img src="{{asset("storage/shop/tshirts/4-1.jpg")}}" alt="Black Polo Tshirt"></a>
									<div class="product-overlay">
										<a href="#" class="add-to-cart"><i class="icon-shopping-cart"></i><span> Add to Cart</span></a>
										<a href="#" class="item-quick-view" data-lightbox="ajax"><i class="icon-zoom-in2"></i><span> Quick View</span></a>
									</div>
								</div>
								<div class="product-desc center">
									<div class="product-title"><h3><a href="#">Black Polo Tshirt</a></h3></div>
									<div class="product-price">Rp.111.490</div>
									<div class="product-rating">
										<i class="icon-star3"></i>
										<i class="icon-star3"></i>
										<i class="icon-star3"></i>
										<i class="icon-star3"></i>
										<i class="icon-star3"></i>
									</div>
								</div>
							</div>

						</div><!-- #shop end -->

					</div>

				</div>

			</section>


			<div class="clear"></div>

		</div>
	</div><!-- .entry end -->

                <!-- Post Navigation
                	============================================= -->
                	<!-- .post-navigation end -->



                <!-- Post Author Info
                	============================================= -->


                	<div class="line"></div>

                	<div class="clear"></div>



                </div><!-- #comments end -->

            </div>
       
    </div>


    <!-- Infinity Scroll Loader
    	============================================= -->

    </div>



</div>


@stop