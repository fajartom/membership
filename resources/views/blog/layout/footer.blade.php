    <!-- Footer
    ============================================= -->
    <footer id="footer" class="dark" style="background-color: #222;">

      <div class="container">

        <!-- Footer Widgets
        ============================================= -->
        <div class="footer-widgets-wrap clearfix">

          <div class="col_one_third">

            <div class="widget clear-bottommargin-sm clearfix">

              <div class="row">

                <div class="col-lg-12 bottommargin-sm">
                  <div class="footer-big-contacts">
                    <span>Call Us:</span>
                    {{isset($_contact->phone_number) ? $_contact->phone_number : '#'}}
                  </div>
                </div>

                <div class="col-lg-12 bottommargin-sm">
                  <div class="footer-big-contacts">
                    <span>Send an Enquiry:</span>
                    {{isset($_contact->email) ? $_contact->email : '#'}}
                  </div>
                </div>

              </div>

            </div>

            <div class="widget subscribe-widget clearfix">
              <div class="row">

                <div class="col-lg-6 clearfix bottommargin-sm">
                  <a href="#" class="social-icon si-dark si-colored si-facebook nobottommargin" style="margin-right: 10px;">
                    <i class="icon-facebook"></i>
                    <i class="icon-facebook"></i>
                  </a>
                  <a href="{{isset($_contact->facebook) ? $_contact->facebook : '#'}}"><small style="display: block; margin-top: 3px;"><strong>Like us</strong><br>on Facebook</small></a>
                </div>
                <div class="col-lg-6 clearfix">
                  <a href="#" class="social-icon si-dark si-colored si-facebook nobottommargin" style="margin-right: 10px;">
                    <i class="icon-instagram"></i>
                    <i class="icon-instagram"></i>
                  </a>
                 <a href="{{isset($_contact->instagram) ? $_contact->instagram : '#'}}"><small style="display: block; margin-top: 3px;"><strong>Follow Us</strong><br>on Instagram</small></a>
                </div>
                <div class="col-lg-6 clearfix">
                  <a href="#" class="social-icon si-dark si-colored si-spotify nobottommargin" style="margin-right: 10px;">
                    <i class="icon-spotify"></i>
                    <i class="icon-spotify"></i>
                  </a>
                 <a href="{{isset($_contact->spotify) ? $_contact->spotify : '#'}}"><small style="display: block; margin-top: 3px;"><strong>Listen Us</strong><br>on Spotify</small></a>
                </div>

              </div>
            </div>

          </div>

          <div class="col_one_third">


          </div>

          <div class="col_one_third col_last">

            <div class="widget widget_links clearfix">

              <h4>Site</h4>

              <div class="row clearfix">
                <div class="col-6">
                  <ul>
                    @if(isset($_other))
                      @foreach($_other as $key=>$value)
                        <li><a href="{{URL::to('/')}}/{{$locale}}/site/{{$value->slug}}">{{$value->name}}</a></li>
                      @endforeach
                    @endif
                    <li><a href="http://{{$domain}}/login">Login</a></li>
                  </ul>
                </div>
                <div class="col-6">
                  <ul>
                   @if(isset($_menu))
                      @foreach($_menu as $key=>$value)
                        <li><a href="{{URL::to('/')}}/{{$locale}}/site/{{$value->slug}}">{{ucwords($value->name)}}</a></li>
                      @endforeach
                    @endif
                  </ul>
                </div>
              </div>

            </div>

          </div>

        </div><!-- .footer-widgets-wrap end -->

      </div>

      <!-- Copyrights
      ============================================= -->
      <div id="copyrights">

        <div class="container clearfix">

          <div class="col_half">
            Copyrights &copy; 2019 All Rights Reserved by Ngefans.id <br>
            
          </div>

          <div class="col_half col_last tright">
            <div class="fright clearfix">
              <a href="{{isset($_contact->facebook) ? $_contact->facebook : '#'}}" class="social-icon si-small si-borderless si-facebook">
                <i class="icon-facebook"></i>
                <i class="icon-facebook"></i>
              </a>

              <a href="{{isset($_contact->twitter) ? $_contact->twitter : '#'}}" class="social-icon si-small si-borderless si-twitter">
                <i class="icon-twitter"></i>
                <i class="icon-twitter"></i>
              </a>

              <a href="{{isset($_contact->pinterest) ? $_contact->pinterest : '#'}}" class="social-icon si-small si-borderless si-pinterest">
                <i class="icon-pinterest"></i>
                <i class="icon-pinterest"></i>
              </a>
              <a href="{{isset($_contact->spotify) ? $_contact->spotify : '#'}}" class="social-icon si-small si-borderless si-spotify">
                <i class="icon-spotify"></i>
                <i class="icon-spotify"></i>
              </a>
              <a href="{{isset($_contact->youtube) ? $_contact->youtube : '#'}}" class="social-icon si-small si-borderless si-youtube">
                <i class="icon-youtube"></i>
                <i class="icon-youtube"></i>
              </a>
              <a href="{{isset($_contact->medium) ? $_contact->medium : '#'}}" class="social-icon si-small si-borderless si-medium">
                <i class="icon-medium"></i>
                <i class="icon-medium"></i>
              </a>
            </div>

            <div class="clear"></div>

            <i class="icon-envelope2"></i> {{isset($_contact->email) ? $_contact->email : '#'}} <span class="middot">&middot;</span> <i class="icon-headphones"></i> {{isset($_contact->phone_number) ? $_contact->phone_number : '#'}}
          </div>

        </div>

      </div><!-- #copyrights end -->

    </footer><!-- #footer end -->

  </div>
  <div id="gotoTop" class="icon-angle-up"></div>

  <!-- External JavaScripts
  ============================================= -->
  <script src="{{asset('artist/js/jquery.js')}}"></script>
  <script src="{{asset('artist/js/plugins.js')}}"></script>

  <!-- Footer Scripts
  ============================================= -->
  <script src="{{asset('artist/js/functions.js')}}"></script>

</body>
</html>