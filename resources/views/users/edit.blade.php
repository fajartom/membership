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
        <div class="col"><h3 class="mb-0 text-uppercase">Edit Users</h3></div>
        <div class="col text-right">
            
            <a class="btn btn-sm btn-primary" href="{{url()->previous()}}">Back</a>
        
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



{!! Form::model($user, ['method' => 'PATCH','route' => ['users.update', $locale, $user->id]]) !!}
<div class="row">
    <div class="col-xs-4 col-sm-4 col-md-4">
        <div class="form-group">
            <strong>Name:</strong>
            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-4 col-sm-4 col-md-4">
        <div class="form-group">
            <strong>Email:</strong>
            {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
        </div>
    </div>
     @role('superadmin')
    <div class="col-xs-4 col-sm-4 col-md-4">
        <div class="form-group">

            <strong>Domain:</strong>
            {!! Form::text('domain', $_user->domain, array('placeholder' => 'Domain','class' => 'form-control')) !!}
        </div>
    </div>
    @else
     <div class="col-xs-4 col-sm-4 col-md-4">
        <div class="form-group">

            <strong>Domain:</strong>
            {!! Form::text('domain', $_user->domain, array('placeholder' => 'Domain','class' => 'form-control', 'readonly')) !!}
        </div>
    </div>   
    @endrole
    <div class="col-sm-10 col-md-10"></div>
    <div class="col-xs-4 col-sm-4 col-md-4">
        <div class="form-group">
            <strong>Password:</strong>
            {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-4 col-sm-4 col-md-4">
        <div class="form-group">
            <strong>Confirm Password:</strong>
            {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
        </div>
    </div>
      <div class="col-sm-10 col-md-10"></div>
    @role('superadmin')
    <div class="col-xs-4 col-sm-4 col-md-4">
        <div class="form-group">
            <strong>Role:</strong>
            {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control','single')) !!}
        </div>
    </div>
    @else
    <div class="col-xs-4 col-sm-4 col-md-4">
        <div class="form-group">
            {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control','single', 'hidden')) !!}
        </div>
    </div>
    @endrole
    <div class="col-xs-12 col-sm-12 col-md-12 text-left">
        <button type="submit" class="btn btn-primary">Submit</button>
            <a class="btn btn-primary" href="{{ route('users.index', $locale) }}"> Back</a>
        
    </div>
</div>
{!! Form::close() !!}
</div>
</div>
</div>
</div>

@endsection