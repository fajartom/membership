@extends('layouts.app')
@section('content')
<div class="header bg-gradient-primary pb-8 pt-5 mb-5">
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
                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
                @endif
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col"><h3 class="mb-0 text-uppercase">Album Detail</h3></div>
                    </div>
                            <div class="col text-right">
            
            <a class="btn btn-sm btn-primary" href="{{ route('album.index', $locale)}}">Back</a>
        
        </div>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
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
                                <th>{!! Form::model(null, ['method' => 'PATCH','route' => ['media.update', $locale, $album],'files' =>true,'enctype'=>'multipart/form-data']) !!}
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Link:</strong>
                                            {!! Form::text('link', null, array('placeholder' => 'Link','class' => 'form-control')) !!}
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Media:</strong>
                                            {!! Form::input('file', 'media', null, array('placeholder' => 'Image','class' => 'form-control')) !!}
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Order:</strong>
                                            {!! Form::input('number','order', null, array('placeholder' => 'Order','class' => 'form-control')) !!}{!! Form::input('hidden','author', Auth::user()->id , array('placeholder' => 'Order','class' => 'form-control')) !!}
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12 text-left">
                                        <button type="upload" class="btn btn-sm btn-primary">Submit</button>
                                    </div>
                                    {!! Form::close() !!}
                                </th>
                            </tr>
                        </thead>
                        <tbody> 
                            <tr>
                            <td width="100%">
                            </td>
                            </tr>
                        </tbody>
                    </table> <div class="col-lg-12">
                                     <div class="row">
                                @foreach ($cat as $key => $v)
                               

                                <div class="col-md-2 col-lg-2">
                                @if($v->link==null)
                                @if(explode('.', $v->file)[1]=='mp4' or explode('.', $v->file)[1]=='webm')
                                <video width="320" controls>
                                  <source src="{{asset("storage/media/$v->file")}}" type="video/mp4">
                                  Your browser does not support the video tag.
                                </video>
                                @elseif(explode('.', $v->file)[1]=='mp3' or explode('.', $v->file)[1]=='wav')
                                <audio controls>
                                <source src="{{asset("storage/media/$v->file")}}" type="audio/mpeg">
                                Your browser does not support the audio element.
                                </audio>
                                @else
                                <img class="img-thumbnail mb-2" src="{{asset("storage/media/$v->file")}}" style="max-height: 100px">
                                @endif
                                @else
                                <img class="img-thumbnail mb-2" src="{{$v->link}}"> 
                                @endif
                                    {!! Form::open(['method' => 'DELETE','route' => ['media.destroy', $locale, $v->id],'style'=>'display:inline']) !!}
                                    {!! Form::submit('Delete', ['class' => 'btn btn-sm btn-danger mb-2  ']) !!}
                                    {!! Form::close() !!}
                              
                                </div>
                               
                            @endforeach
                             </div>
                                </div>
                </div>
            </div>
        </div>
    </div>
    @endsection