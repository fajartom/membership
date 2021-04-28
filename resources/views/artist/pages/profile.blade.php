@extends('artist.layout.default')
@section('content')
<section id="slider" class="slider-element clearfix" style="height: 100% !important;">
  <div class="fslider full-screen force-full-screen" data-speed="1800" data-pause="5000" data-animation="fade" data-arrows="true" data-pagi="false">
    <div class="flexslider full-screen force-full-screen">
      <div class="slider-wrap force-full-screen">
        <!-- Slide 1 -->
        @if(count($_slider)>0)
        @foreach ($_slider as $key => $slider)
        <div class="slide center full-screen force-full-screen" style="background: url({{ asset("storage/slider/{$slider->image}") }}) center center; background-size: cover;">
          <div class="flex-caption dark d-block">
            <h3 class="mb-2 h1"><a href="#" class="text-white">{{$slider->title}}</a></h3>
            <p class="h5">{{$slider->subtitle}}</p>
          </div>
        </div>
        @endforeach
        @else
        <div class="slide center full-screen force-full-screen" style="background: url('artist/images/slider/1560456047_5d02ab6fcf188.jpg') center center; background-size: cover;">
          <div class="flex-caption dark d-block">
            <h3 class="mb-2 h1"><a href="#" class="text-white">Thing That Make You Love</a></h3>
            <p class="h5">Credibly synthesize seamless</p>
          </div>
        </div>
        @endif
      </div>
    </div>
  </div>
</section><!-- #Slider end -->
    <!-- Content
      ============================================= -->
      <section id="content" class="bg-light">
        <div class="content-wrap pt-lg-0 pt-xl-0 pb-0">
          <div class="container clearfix">
            @if(count($_about)>0)
            <div class="heading-block nobottomborder center pt-4 mb-3">
              <h3>{{$_about->name}}</h3>
            </div>
          <!-- Posts
            ============================================= -->
            <div class="row grid-container infinity-wrapper clearfix">
              <!-- ARTICLE NO. 1 -->
          
              <div class="col-md-12 p-3">
                <div class="entry mb-1 clearfix">
                  <div class="entry-content">
                    <p>{{$_about->content}}</p>
                  </div>
                </div>
              </div>
                </div>
          </div>
        </div> 
                
        @else
        <div class="col-md-6 p-3">
          <div class="entry mb-1 clearfix">
            <h1>No Post</h1>
          </div>
        </div>

      </div>
    </div>
  </div>
  @endif
  @stop
