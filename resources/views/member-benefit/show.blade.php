@extends('layouts.app')

@section('content')
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
  <div class="container-fluid">
    <div class="header-body mb-4">
      <div class="row">
      </div>
    </div>
  </div>
 </div>
<div class="container-fluid mt--7">
  <div class="row">
    <div class="col">
      <div class="card shadow">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col"><h3 class="mb-0 text-uppercase">{{ $member[0]->member_name }}</h3>
            </div>
              <div class="col text-right">
                    <a class="btn btn-sm btn-primary" href="{{ route('member-benefit.index', $locale)}}">Back</a>
              </div>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col">
              <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                  <strong><h6 class="heading-small text-muted mb-4">Benefit Detail Information</h6></strong>
                        <hr class="my-2"></hr>
                </div>
                    <div class="form-group">
                      <strong>Benefit:</strong>
                      @foreach($member as $key=>$value)
                      <br>
                        {{$value->benefit_name}}
                        <br>
                      @endforeach
                    </div>
                  </div>
                </div>
            </div>
        </div>
      </div>
    </div>
</div>
@endsection