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
        <div class="col"><h3 class="mb-0 text-uppercase">Edit Payment</h3></div>
        <div class="col text-right">
            
            <a class="btn btn-sm btn-primary" href="{{ route('payment.index', $locale)}}">Back</a>
        
        </div>
          
    </div>
    </div>
    
        <div class="card-body">


@if (count($errors) > 0)
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
    </div>
@endif



{!! Form::model($cat, ['method' => 'PATCH','route' => ['payment.update', $locale, $cat->id]]) !!}
<div class="row">
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Name:</strong>
            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-sm-10 col-md-10"></div>

    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-left">
        <button type="submit" class="btn btn-sm btn-primary">Submit</button>
           
    </div>
</div>
{!! Form::close() !!}
</div>
</div>
</div>

@endsection