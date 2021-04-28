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
        <div class="col"><h3 class="mb-0 text-uppercase">{{ $member->name }}</h3></div>
        <div class="col text-right">
            
            <a class="btn btn-sm btn-primary" href="{{ route('post-category.index', $locale)}}">Back</a>
        
        </div>
          
    </div>
    </div>
    
<div class="card-body">


<div class="row">
    <div class="col">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong><h6 class="heading-small text-muted mb-4">Category Information</h6></strong>
            <hr class="my-2"></hr>
        </div>
        <div class="form-group">
            <strong>Name:</strong>
            {{ $member->name }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Seo Title:</strong>
            {{ $member->seo_title }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Meta Keyword:</strong>
            {{ $member->meta_keyword }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Meta Description:</strong>
            {{ $member->meta_description }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Order:</strong>
            {{ $member->order }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Slug:</strong>
            {{ $member->slug }}
        </div>
    </div>
    
</div>
</div>


</div>
</div>



</div>
</div>
@endsection