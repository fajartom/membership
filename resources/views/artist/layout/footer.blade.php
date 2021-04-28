	      <!-- Copyrights
      ============================================= -->
      <div id="copyrights">

        <div class="container clearfix">

          <div class="col_half text-white">
            Copyrights &copy; 2018 All Rights Reserved by {{$_meta->domain}}<br>
          </div>
          @if(count($_contact)>0)
          <div class="col_half col_last">
            <div class="fright clearfix">
              <a href="{{$_contact->facebook}}" class="social-icon si-small si-rounded si-colored si-facebook">
                <i class="icon-facebook"></i>
                <i class="icon-facebook"></i>
              </a>
              <a href="{{$_contact->twitter}}" class="social-icon si-small si-rounded si-colored si-twitter">
                <i class="icon-twitter"></i>
                <i class="icon-twitter"></i>
              </a>
              <a href="{{$_contact->instagram}}" class="social-icon si-small si-rounded si-colored si-instagram">
                <i class="icon-instagram"></i>
                <i class="icon-instagram"></i>
              </a>
			  <a href="{{$_contact->youtube}}" class="social-icon si-small si-rounded si-colored si-youtube">
                <i class="icon-youtube"></i>
                <i class="icon-youtube"></i>
              </a>
			  <a href="{{$_contact->spotify}}" class="social-icon si-small si-rounded si-colored si-spotify">
                <i class="icon-spotify"></i>
                <i class="icon-spotify"></i>
              </a>
            </div>
          </div>
          @endif
        </div>

      </div><!-- #copyrights end -->

    </section><!-- #content end -->
	</div><!-- #wrapper end -->
	<!-- Go To Top
	============================================= -->
	<div id="gotoTop" class="icon-angle-up"></div>

	<audio autoplay="autoplay" loop="loop" preload="none">
		<source type="audio/mpeg" src="{{ asset('storage/media/sibad.id.mpeg') }}">
	</audio>

	<!-- External JavaScripts
	============================================= -->
	<script src="{{asset('artist/js/jquery.js')}}"></script>
	<script src="{{asset('artist/js/plugins.js')}}"></script>

	<!-- Footer Scripts
	============================================= -->
	<script src="{{asset('artist/js/functions.js')}}"></script>

	<!-- ADD-ONS JS FILES -->
	<script>

		// Infinity Scroll
		jQuery(window).on( 'load', function(){

			var $container = $('.infinity-wrapper');

			$container.infiniteScroll({
				path: '.load-next-posts',
				history: false,
				status: '.page-load-status',
			});

			$container.on( 'load.infiniteScroll', function( event, response, path ) {
				var $items = $( response ).find('.infinity-loader');
				// append items after images loaded
				$items.imagesLoaded( function() {
					$container.append( $items );
					$container.isotope( 'insert', $items );
					setTimeout( function(){
						SEMICOLON.initialize.resizeVideos();
						SEMICOLON.initialize.lightbox();
						SEMICOLON.widget.loadFlexSlider();
					}, 1000 );
				});
			});

		});

	</script>
</body>
</html>
