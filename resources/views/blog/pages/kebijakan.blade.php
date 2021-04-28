@extends('blog.layout.default')
@section('content')
  <section class="page-section bg-dark" id="about">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-10">
            @if(count($_content)>0)
          <h2 class="text-white mt-0 text-center">{{ $_content->name }}</h2>
          <hr class="divider light my-4">
          <div class="text-white mb-4">
          
              {!! $_content->content !!}
            
            @endif
          </div>
        </div>
      </div>
    </div>
  </section>
@stop
