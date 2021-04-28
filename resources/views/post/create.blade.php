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
          <div class="col"><h3 class="mb-0 text-uppercase">Create Content</h3></div>
          <div class="col text-right">

            <a class="btn btn-sm btn-primary" href="{{ route('post.index', $locale)}}">Back</a>

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


        {!! Form::open(array('route' => ['post.store', $locale],'method'=>'POST','files' =>true,'enctype'=>'multipart/form-data')) !!}
        <div class="row">
         <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="form-group">
            <strong>Title:</strong>
            {!! Form::text('title', null, array('placeholder' => 'Title','class' => 'form-control')) !!}
          </div>
        </div> 
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="form-group">
            <strong>Image:</strong>
            {!! Form::input('file', 'image', null, array('placeholder' => 'Image','class' => 'form-control')) !!}
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="form-group">
            <strong>Short Description:</strong>
            {!! Form::textarea('excerpt', null, ['class'=>'form-control', 'id'=>'summary-ckeditor']) !!}
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="form-group">
            <strong>Long Description:</strong>
            {!! Form::textarea('body', null, ['class'=>'form-control', 'id'=>'summary-ckeditor-2']) !!}
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="form-group">
            <strong>Category:</strong>
            {!! Form::select('category_id', ['' => 'Please Select'] + $_cat, null, array('class' => 'form-control','single')) !!}
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="form-group">
            <strong>Member:<br></strong>
            @foreach($_member as $key => $v)
            <div class="custom-control custom-checkbox mb-3">
              <input class="custom-control-input" name="member_allow[]" id="customCheck{{$key}}" type="checkbox" value="{{$v->id}}">
              <label class="custom-control-label" for="customCheck{{$key}}">{{$v->name}}</label>
            </div>
            @endforeach
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="form-group">
            <strong>Hot News:<br></strong>
            @foreach($_hotnews as $key => $h)
            <div class="custom-control custom-radio mb-3">
              <input class="custom-control-input" name="featured" id="customRadio{{$key}}" type="radio" value="{{$key}}">
              <label class="custom-control-label" for="customRadio{{$key}}">{{$h}}</label>
            </div>
            @endforeach
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="form-group">
            <strong>Meta Title:</strong>
            {!! Form::text('seo_title', null, array('placeholder' => 'Meta Title','class' => 'form-control')) !!}
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="form-group">
            <strong>Meta Descroption:</strong>
            {!! Form::text('meta_description', null, array('placeholder' => 'Meta Description','class' => 'form-control')) !!}
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="form-group">
            <strong>Meta Keyword:</strong>
            {!! Form::text('meta_keywords', null, array('placeholder' => 'Meta Keyword','class' => 'form-control')) !!}
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="form-group">
            <strong>Status:</strong>
            {!! Form::select('status', ['' => 'Please Select'] + $_status, null, array('class' => 'form-control','single')) !!}
          </div>
        </div>     
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="form-group">
            <strong>Add Album:</strong>
       {!! Form::select('album[]', $_album, null, array('class' => 'select-2 form-control', 'id'=>'album', 'multiple')) !!}

          </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
          {!! Form::input('hidden','author', Auth::user()->id , array('placeholder' => 'Order','class' => 'form-control')) !!}

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
<script src="https://cdn.ckeditor.com/4.5.6/standard/ckeditor.js"></script>
<script>
 CKEDITOR.replace( 'summary-ckeditor',
 {
  enterMode: CKEDITOR.ENTER_BR,


});
 CKEDITOR.replace( 'summary-ckeditor-2',
 {
  enterMode: CKEDITOR.ENTER_BR,


});

</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js">
</script>
<script type="text/javascript">
$(document).ready(function() {
    $('#album').select2();
});
</script>
@endsection