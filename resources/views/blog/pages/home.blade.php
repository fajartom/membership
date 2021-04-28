@extends('blog.layout.default')
@section('content')
@if(isset($_slider))
<section id="page-title" class="page-title-center page-title-parallax" style="background-size: cover;background-image: url('{{URL::asset('storage/slider')}}/{{ $_slider->image }}'); background-position: center center; padding: 160px 0;" data-center="background-position: 0px -100px;" data-top-bottom="background-position:0px 200px;">
  <div class="container clearfix">
    <h1>{{$_slider->title}}</h1>
    <span>{{$_slider->subtitle}}</span>
  </div>
</section>
@endif
<section id="content">
  <div class="content-wrap">
    <div class="fancy-title title-border title-center">
      <h3>Artist</h3>
    </div>
    <div class="container clear-bottommargin clearfix">
      <div id="oc-fbox" class="owl-carousel fbox-carousel carousel-widget" data-margin="40" data-pagi="false" data-autoplay="5000" data-loop="true" data-items-xs="1" data-items-md="2" data-items-xl="2">
        @if(isset($_artist))
        @foreach($_artist as $key=>$value)
        <div class="oc-item">
          <div class="team team-list clearfix">
            <div class="team-image">
              <img src="{{URL::asset('storage/artist-ngefans')}}/{{ $value->image }}" alt="John Doe">
            </div>
            <div class="team-desc">
              <div class="team-title"><h4>{{$value->title}}</h4><span>{{$value->subtitle}}</span></div>

              <a href="{{$value->btn_link}}" class="button button-3d button-mini button-rounded button-red">{{$value->btn_name}}</a>
            </div>
          </div>
        </div>
        @endforeach
        @endif
      </div>
    </div>
    @if(isset($_about))
    <section id="section-about" class="page-section">
      <div class="section topmargin-lg">
        <div class="container center clearfix">
          <div class="heading-block bottommargin-sm nobottomborder">
            <span class="before-heading color"></span>
            <h2>{{$_about->name}}</h2>
          </div>
          <p class="lead">{!!$_about->excerpt!!}</p>
        </div>
      </div>
    </section>
    @endif
    <div class="fancy-title title-border title-center">
      <h3>Features</h3>
    </div>
    <div class="container clear-bottommargin clearfix mb-5">
      <div id="oc-fbox" class="owl-carousel fbox-carousel carousel-widget" data-margin="40" data-pagi="false" data-autoplay="5000" data-loop="true" data-items-xs="1" data-items-md="2" data-items-xl="3">
        @if(isset($_fitur))
        @foreach($_fitur as $key=>$value)
        <div class="oc-item">
          <div class="feature-box fbox-center fbox-effect nobottomborder fadeIn animated" data-animate="fadeIn">
            <div class="fbox-icon">
              <a href="#"><i class="ni ni-4x ni-{{$value->icon}} text-default mb-4"></i></a>
            </div>
            <h3>{{$value->name}}</h3>
            <p>{{$value->content}}</p>
          </div>
        </div>
        @endforeach
        @endif
      </div>
    </div>
    <div class="section" style="margin-bottom: -80px!important;padding-bottom: 60px!important;">
      <h2 class="center mb-5">Latest Blog</h2>
      <div class="row clearfix ml-5 mr-5">
        @if(isset($_blog))
          @foreach($_blog as $key=>$value)
        <div class="ipost col-md-6 clearfix">
          <div class="row">
            <div class="col-lg-6">
              <div class="entry-image nobottommargin">
                <a href="{{URL::to('/')}}/{{$locale}}/read/{{$value->slugpost}}"><img src="{{asset("storage/artikel/{$value->image}")}}" alt="Paris"></a>
              </div>
            </div>
            <div class="col-lg-6" style="margin-top: 20px;padding-bottom: 60px!important">
              <span class="before-heading">  <a href="{{URL::to('/')}}/{{$locale}}/category/{{$value->slug}}">{{$value->category}}</a></span>
              <div class="entry-title">
                <h3><a href="{{URL::to('/')}}/{{$locale}}/read/{{$value->slugpost}}">{{$value->title}}</a></h3>
              </div>
              <ul class="entry-meta clearfix">
                <li><i class="icon-calendar3"></i> {{$value->created}}</li>
              </ul>
              <div class="entry-content">
                <a href="{{URL::to('/')}}/{{$locale}}/read/{{$value->slugpost}}" class="more-link">Read more</a>
              </div>
            </div>
          </div>
        </div>
          @endforeach
        @endif
      </div>
    </div>
  </div>
</section><!-- #content end -->
@stop