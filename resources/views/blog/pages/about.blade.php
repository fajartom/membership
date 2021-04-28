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
<section id="page-title">
  <div class="container clearfix">
    <h1>{{$_content->name}}</h1>
    <span></span>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">{{$_content->name}}</li>
    </ol>
  </div>
</section>
<section id="content">
       @if(isset($_content))
    <div class="section nomargin">
      <div class="container justify clearfix">
        <div class="heading-block bottommargin-sm nobottomborder">
          <span class="before-heading color"></span>
          <h2 class="center">{{$_content->name}}</h2>
        </div>
        <p class="">{!!$_content->content!!}</p>
      </div>
    </div>
    @endif
</section><!-- #content end -->
@stop