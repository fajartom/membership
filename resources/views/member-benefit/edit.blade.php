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
        <div class="col"><h3 class="mb-0 text-uppercase">Edit Benefit</h3></div>
        <div class="col text-right">
            
            <a class="btn btn-sm btn-primary" href="{{ route('member-benefit.index', $locale)}}">Back</a>
        
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
@if(count($member)>0)
{!! Form::model($member, ['method' => 'PATCH','route' => ['member-benefit.update', $locale, $member[0]->member_id]]) !!}
@else
{!! Form::open(array('route' => ['member-benefit.store', $locale],'method'=>'POST')) !!}
@endif 
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
          @if(count($member)>0)
            <strong>Member:</strong>
                   {!! Form::select('member_id', ['' => 'Please Select'] + $_member, $member[0]->member_id, array('class' => 'form-control','single', 'readonly')) !!}
          @else
          <strong>Member:</strong>
                   {!! Form::select('member_id', ['' => 'Please Select'] + $_member, $id, array('class' => 'form-control','single', 'readonly')) !!}
          @endif

        </div>
      </div>
     
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Benefit:<br></strong>
            @foreach($_benefit as $key => $v)
            <div class="custom-control custom-checkbox mb-3">
              <input class="custom-control-input" name="benefit_id[]" id="customCheck{{$key}}" type="checkbox" value="{{$v->id}}" @if (in_array ($v->id, $_mybenefit)) checked @endif }}>
              <label class="custom-control-label" for="customCheck{{$key}}">{{$v->benefit}}</label>
            </div>
            @endforeach
        </div>
    </div>
    <div class="col-sm-10 col-md-10"></div>

    <div class="col-xs-12 col-sm-12 col-md-12 text-left">
        <button type="submit" class="btn btn-sm btn-primary">Submit</button>        
    </div>
</div>
{!! Form::close() !!}
</div>
</div>
</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
  $("#btn1").click(function(){
    $("#benefit").append(
      $('<div>', {
        class:'form-group'
      }),
       $('<input>', {
        type: 'text',
        class:'form-control',
        name:'benefit[]',
        placeholder:'Benefit'
      })
    );
  });
});
</script>
@endsection