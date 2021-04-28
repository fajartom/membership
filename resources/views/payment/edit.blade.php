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



{!! Form::model($cat, ['method' => 'PATCH','route' => ['payment.update', $locale, $cat->id], 'files' =>true, 'enctype'=>'multipart/form-data']) !!}
<div class="row">
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Name:</strong>
            {!! Form::text('name', $cat->name, array('placeholder' => 'Name', 'class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Description:</strong>
            {!! Form::text('description', $cat->description, array('placeholder' => 'Description', 'class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-control-label" for="input-photo">Logo</label>
            @if ($cat->logo)
            {!! Form::input('file', 'logo', $cat->logo, array('placeholder' => 'Logo', 'class' => 'form-control
            form-control-alternative')) !!}
            @else
            {!! Form::input('file', 'logo', null, array('placeholder' => 'Logo', 'class' => 'form-control
            form-control-alternative')) !!}
            @endif
        </div>
    </div>
    @if ($cat->logo)
    <div class="col-md-6 text-center">
        <label class="form-control-label d-none d-md-block">&nbsp;</label>
        <div class="card">
            <img class="card-img-top" src="{{ asset("storage/setting/{$cat->logo}") }}" alt="{{ $cat->logo }}">
            <div class="card-body p-1">
                <p class="text-center mb-0">
                    <a href="{{ asset("storage/setting/{$cat->logo}") }}" target="_blank">
                        <small>
                            {{ $cat->logo }}
                        </small>
                    </a>
                </p>
            </div>
        </div>
        <label class="form-control-label d-block d-md-none">&nbsp;</label>
    </div>
    @endif
    <div class="col-xs-12 col-sm-12 col-md-12 text-left">
        <button type="submit" class="btn btn-sm btn-primary">Submit</button>
    </div>
</div>
{!! Form::close() !!}
</div>
</div>
</div>
</div>

@endsection