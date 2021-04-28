@extends('blog.layout.default')
@section('content')

<section id="page-title">
  <div class="container clearfix">
    <h1>Blog</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Blog</li>
    </ol>
  </div>
</section>

<div class="content">
  <div class="container clearfix">
    <!-- Posts
      ============================================= -->
      @if(isset($_blog))
      <div class="mt-5">
        <div class="container clearfix">
          <div class="heading-block bottommargin-sm nobottomborder">
            <ul class="entry-meta clearfix">
                <li><i class="icon-calendar3"></i>{{$_blog->created_at}}</li>
                <li><i class="icon-folder-open"></i> <a href="{{URL::to('/')}}/{{$locale}}/category/{{$_blog->slug}}">{{$_blog->category}}</a>
              </ul>
            <span class="before-heading color"></span>
          </div>
           <h2 class="center">{{$_blog->title}}</h2>
          <p class="justify">{!!$_blog->body!!}</p>
          <div class="tagcloud clearfix bottommargin">
            @foreach($_category as $key=>$value)
                  <a href="{{URL::to('/')}}/{{$locale}}/category/{{$value->slug}}">{{$value->name}}</a>
            @endforeach
          </div>
        </div>
      </div>
      @endif
      <!-- #posts end -->
    </div>
  </div>
  <!-- #content end -->
  @stop