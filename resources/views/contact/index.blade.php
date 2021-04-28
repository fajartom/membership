@extends('layouts.app')

@section('content')
<?php 
/*if(Auth::user()->id != Request::segment(3)){
echo "<script>document.getElementById('logout-form').submit()</script>";
}
*/
?>
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
        <div class="col"><h3 class="mb-0 text-uppercase"> Contact Site</h3></div>
        <div class="col text-right">
                    
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


@if(count($cat)<=0)

{!! Form::open(array('route' => ['contact.store', $locale],'method'=>'POST')) !!}
@else
{!! Form::model($cat, ['method' => 'PATCH','route' => ['contact.update', $locale, $cat[0]->author]]) !!}
@endif
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Title:</strong>
            @if(count($cat)>0)
            {!! Form::input('text', 'title', $cat[0]->title, array('placeholder' => 'Title','class' => 'form-control')) !!}
            @else
            {!! Form::input('text', 'title', null,array('placeholder' => 'Title','class' => 'form-control')) !!}
            @endif
        </div>
        <div class="form-group">
            <strong>Phone number:</strong>
            @if(count($cat)>0)
            {!! Form::input('text', 'phone_number', $cat[0]->phone_number, array('placeholder' => 'Phone Number','class' => 'form-control')) !!}
            @else
            {!! Form::input('text', 'phone_number', null,array('placeholder' => 'Phone Number','class' => 'form-control')) !!}
            @endif

            {!! Form::input('hidden', 'author', Auth::user()->id, array('placeholder' => 'Order','class' => 'form-control')) !!}
        </div>
        <div class="form-group">
            <strong>Email:</strong>
            @if(count($cat)>0)
            {!! Form::input('email', 'email', $cat[0]->email, array('placeholder' => 'Email Address','class' => 'form-control')) !!}
            @else
            {!! Form::input('email', 'email', null,array('placeholder' => 'Email Address','class' => 'form-control')) !!}
            @endif
        </div>
        <div class="form-group">
            <strong>Facebook:</strong>
            @if(count($cat)>0)
            {!! Form::text('facebook', $cat[0]->facebook, array('placeholder' => 'Facebook','class' => 'form-control')) !!}
            @else
            {!! Form::text('facebook', null, array('placeholder' => 'Facebook','class' => 'form-control')) !!}
            @endif
        </div>
         <div class="form-group">
            <strong>Instagram:</strong>
            @if(count($cat)>0)
            {!! Form::text('instagram', $cat[0]->instagram, array('placeholder' => 'Instagram','class' => 'form-control')) !!}
            @else
            {!! Form::text('instagram', null, array('placeholder' => 'Instagram','class' => 'form-control')) !!}
            @endif
        </div>
        <div class="form-group">
            <strong>Youtube:</strong>
            @if(count($cat)>0)
            {!! Form::text('youtube', $cat[0]->youtube, array('placeholder' => 'Youtube','class' => 'form-control')) !!}
            @else
            {!! Form::text('youtube', null, array('placeholder' => 'Youtube','class' => 'form-control')) !!}
            @endif
        </div>
        <div class="form-group">
            <strong>Twitter:</strong>
            @if(count($cat)>0)
            {!! Form::text('twitter', $cat[0]->twitter, array('placeholder' => 'Twitter','class' => 'form-control')) !!}
            @else
            {!! Form::text('twitter', null, array('placeholder' => 'Twitter','class' => 'form-control')) !!}
            @endif
        </div>
        <div class="form-group">
            <strong>Medium:</strong>
            @if(count($cat)>0)
            {!! Form::text('medium', $cat[0]->medium, array('placeholder' => 'Medium','class' => 'form-control')) !!}
            @else
            {!! Form::text('medium', null, array('placeholder' => 'Medium','class' => 'form-control')) !!}
            @endif
        </div>
        <div class="form-group">
            <strong>Spotify:</strong>
            @if(count($cat)>0)
            {!! Form::text('spotify', $cat[0]->spotify, array('placeholder' => 'Spotify','class' => 'form-control')) !!}
            @else
            {!! Form::text('spotify', null, array('placeholder' => 'Spotify','class' => 'form-control')) !!}
            @endif
        </div>
        <div class="form-group">
            <strong>Address:</strong>

            @if(count($cat)>0)
                    {!! Form::textarea('address', $cat[0]->address, ['class'=>'form-control', 'id'=>'summary-ckeditor']) !!}

                    @else
                    {!! Form::textarea('address', null, ['class'=>'form-control', 'id'=>'summary-ckeditor']) !!}

                    @endif
        </div>
        
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-left">
        <button type="submit" class="btn btn-sm btn-primary">Submit</button>
           
    </div>
</div>
{!! Form::close() !!}
</div>
</div>
</div>
</div>
<script src="https://cdn.ckeditor.com/4.5.6/standard/ckeditor.js">
</script>
<script>
     CKEDITOR.replace( 'summary-ckeditor',
            {
            enterMode: CKEDITOR.ENTER_BR,
            
         
         });

</script>

@endsection