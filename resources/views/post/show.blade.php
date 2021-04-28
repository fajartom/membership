@extends('layouts.app')

@section('content')
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body mb-4">
          <!-- Card stats -->
          <div class="row">
             
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid mt--7">
      <!-- Table -->
      <div class="row">
        <div class="col">
            
             <div class="card shadow">
    <div class="card-header border-0">
        <div class="row align-items-center">
        <div class="col"><h3 class="mb-0 text-uppercase">{{ $cat->title }}</h3></div>
        <div class="col text-right">
            
            <a class="btn btn-sm btn-primary" href="{{ route('post.index', $locale)}}">Back</a>
        
        </div>
          
    </div>
    </div>
    
<div class="card-body">


<div class="row">
    <div class="col">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong><h6 class="heading-small text-muted mb-4">Detail Information</h6></strong>
            <hr class="my-2"></hr>
        </div>
        <div class="form-group">
        <strong>Name:</strong><br>
            {{ $cat->name }}
        </div>
        <div class="form-group">
        <strong>Image:</strong><br>
            <img src="{{asset('storage/artikel')}}/{{$cat->image }}" class="img-thumbnail" style="max-height: 400px;">
        </div>
        <div class="form-group">
            <strong>Short description:</strong>
        </div>
        <div class="form-group box">
            {!! $cat->excerpt !!}
        </div>
        <div class="form-group">
             <strong>Content:</strong>
        </div>
        <div class="form-group box">
            {!! $cat->body !!}
        </div>
        <div class="form-group">
             <strong>Category:</strong><br>
            {{ $cat->category }}
        </div>
        <div class="form-group">
            <strong>Hot news:</strong><br>
            {{ $cat->featured }}
        </div>
        <div class="form-group">
            <strong>Status:</strong><br>
            {{ $cat->status }}
        </div>
        <div class="form-group">
            <strong>Slug:</strong><br>
            {{ $cat->slug }}
        </div>
        <div class="form-group">
            <strong>Meta Description:</strong><br>
            {{ $cat->meta_description }}
        </div>
        <div class="form-group">
            <strong>Meta Keyword:</strong><br>
            {{ $cat->meta_keywords }}
        </div>
    </div>
</div>
</div>
</div>
</div>
@endsection