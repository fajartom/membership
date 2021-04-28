@extends('blog.layout.default')
@section('content')

<section id="page-title" class="page-title-center page-title-parallax" style="background-size: cover;background-image: url('{{URL::asset('storage/slider')}}/{{ $_slider->image }}'); background-position: center center; padding: 160px 0;" data-center="background-position: 0px -100px;" data-top-bottom="background-position:0px 200px;">
  <div class="container clearfix">
    <h1>{{$_slider->title}}</h1>
    <span>{{$_slider->subtitle}}</span>
  </div>
</section>
<section id="page-title">
  <div class="container clearfix">
    <h1>Blog</h1>
    <span>Our Latest News</span>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{URL::to('/')}}/{{$locale}}/blog">Blog</a></li>
      <li class="breadcrumb-item active" aria-current="page">{{$_blog[0]->category}}</li>
    </ol>
  </div>
</section>
<section id="content" style="margin-bottom: 0px;">

      <div class="content-wrap">

        <div class="container clearfix">

          <!-- Posts
          ============================================= -->
          <div id="posts" class="post-grid grid-container clearfix" data-layout="fitRows" style="position: relative; height: 1202px;">

            @foreach($_blog as $key => $value)
            <div class="entry clearfix" style="position: absolute; left: 0px; top: 0px;">
              <div class="entry-image">
                <a href="{{asset("storage/artikel/{$value->image}")}}" data-lightbox="image"><img class="image_fade" src="{{asset("storage/artikel/{$value->image}")}}" alt="Standard Post with Image" style="opacity: 0.999001;"></a>
              </div>
              <div class="entry-title">
                <h2><a href="{{URL::to('/')}}/{{$locale}}/read/{{$value->slugpost}}">{{$value->title}}</a></h2>
              </div>
              <ul class="entry-meta clearfix">
                <li><i class="icon-calendar3"></i>{{$value->created_at}}</li>
                <li><a href="{{URL::to('/')}}/{{$locale}}/category/{{$value->slug}}">{{$value->category}}</a></li>
              </ul>
              <div class="entry-content">
                <p>{!!$value->excerpt!!}</p>
                <a href="{{URL::to('/')}}/{{$locale}}/read/{{$value->slugpost}}" class="more-link">Read More</a>
              </div>
            </div>
            @endforeach

          </div><!-- #posts end -->

          <!-- Pagination
          ============================================= -->
        {!! $_blog->render() !!}

        </div>

      </div>

    </section>
<!-- #content end -->
@stop