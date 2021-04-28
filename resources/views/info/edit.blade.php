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
        <div class="col"><h3 class="mb-0 text-uppercase">Edit Info</h3></div>
        <div class="col text-right">
            
            <a class="btn btn-sm btn-primary" href="{{ route('info.index', $locale)}}">Back</a>
        
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



{!! Form::model($cat, ['method' => 'PATCH','route' => ['info.update', $locale, $cat->id]]) !!}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name:</strong>
            {!! Form::text('name', $cat->name, array('placeholder' => 'Name','class' => 'form-control')) !!}
        </div>
        <div class="form-group">
            <strong>Excerpt:</strong>
            @if(count($cat)>0)
                    {!! Form::textarea('excerpt', $cat->excerpt, ['class'=>'form-control', 'id'=>'summary-ckeditor-1']) !!}

                    @else
                    {!! Form::textarea('excerpt', null, ['class'=>'form-control']) !!}

                    @endif
        </div>
        <div class="form-group">
            <strong>Content:</strong>
            @if(count($cat)>0)
                    {!! Form::textarea('content', $cat->content, ['class'=>'form-control', 'id'=>'summary-ckeditor']) !!}

                    @else
                    {!! Form::textarea('content', null, ['class'=>'form-control']) !!}

                    @endif
        </div>
        <div class="form-group">
            <strong>Order:</strong>
            {!! Form::input('number', 'order', $cat->order, array('placeholder' => 'Order','class' => 'form-control')) !!}{!! Form::input('hidden','author', Auth::user()->id , array('placeholder' => 'Order','class' => 'form-control')) !!}
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
          CKEDITOR.replace( 'summary-ckeditor-1',
            {
            enterMode: CKEDITOR.ENTER_BR,
            
         
         });

</script>

@endsection