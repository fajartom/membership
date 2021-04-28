@extends('layouts.app')


@section('content')

@if(count($_user)>0)

<div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center" style="min-height: 600px; background-image: url(/storage/setting/{{$_user->cover}}); background-size: cover; background-position: center top;">    
  @else
  <div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center" style="min-height: 600px; background-image: url(/storage/setting/{{null}}); background-size: cover; background-position: center top;">
    @endif
    <!-- Mask -->
    <span class="mask bg-gradient-default opacity-8"></span>
    <!-- Header container -->
    <div class="container-fluid d-flex align-items-center">
      <div class="row">
        <div class="col-lg-7 col-md-10">

          <h1 class="display-3 text-white">
           @if(count($_user)>0)
           {{$_user->name}}
           @endif
         </h1>
         <p class="text-white mt-0 mb-5">This is your profile page. You can update your profile any time.</p>
         <a href="{{ route('users.edit',[$locale, $_user->user_id]) }}" class="btn btn-info">Change Password ?</a>
       </div>
     </div>
   </div>
 </div>
 <div class="container-fluid mt--7">
  <div class="row">
    <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
      <div class="card card-profile shadow">
        <div class="row justify-content-center">
          <div class="col-lg-3 order-lg-2">
            <div class="card-profile-image">
              <a href="#">
                @if(count($_user)>0)
                <img src="{{URL::asset('storage/setting')}}/{{$_user->photo}}" class="rounded-circle">
                @else
                {{null}}
                @endif
              </a>
            </div>
          </div>
        </div>
        <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
          <div class="d-flex justify-content-between">
                <!--<a href="#" class="btn btn-sm btn-info mr-4">Connect</a>
                  <a href="#" class="btn btn-sm btn-default float-right">Message</a>-->
                </div>
              </div>
              @role('artist')
              <div class="card-body pt-0 pt-md-4">
                <div class="row">
                  <div class="col">
                    <div class="card-profile-stats d-flex justify-content-center mt-md-2">
                      <div>
                        <span class="heading">22</span>
                        <span class="description">Subscribe</span>
                      </div>
                      <div>
                        <span class="heading">10</span>
                        <span class="description">Post</span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="text-center">
                  <h3>
                    {{$_user->name}}<span class="font-weight-light">, 27</span>
                  </h3>
                  <div class="h5 font-weight-300">
                    <i class="ni location_pin mr-2"></i>{{$_user->province_name}}, {{$_user->city_name}}
                  </div>
                  <div class="h5 mt-4">
                    <i class="ni business_briefcase-24 mr-2"></i>
                  </div>
                  <div>
                    <i class="ni education_hat mr-2"></i>Artist
                  </div>
                </div>
              </div>
              @endrole
              @role('user')
              <div class="card-body pt-0 pt-md-4">
                <div class="text-center">
                  <h3 class="mt-4">
                    {{$_user->name}}<span class="font-weight-light">, 27</span>
                  </h3>
                  <div class="h5 font-weight-300 mt-4">
                    <i class="ni location_pin mr-2"></i>{{$_user->province_name}}, {{$_user->city_name}}
                  </div>
                  <div>
                    <i class="ni education_hat mr-2"></i> Member
                  </div>
                </div>
              </div>
              @endrole
              @role('superadmin')
              <div class="card-body pt-0 pt-md-4">
                <div class="text-center">
                  <h3>
                    {{$_user->name}}<span class="font-weight-light">, 27</span>
                  </h3>
                  <div class="h5 font-weight-300">
                    <i class="ni location_pin mr-2"></i>{{$_user->province_name}}, {{$_user->city_name}}
                  </div>
                  <div>
                    <i class="ni education_hat mr-2"></i>Super Admin
                  </div>
                </div>
              </div>
              @endrole
            </div>
          </div>
          <div class="col-xl-8 order-xl-1">
            <div class="card bg-secondary shadow">
              <div class="card-header bg-white border-0">
                <div class="row align-items-center">
                  <div class="col-8">
                    <h3 class="mb-0 text-capitalize">My Profile</h3>
                    @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                      <p>{{ $message }}</p>
                    </div>
                    @endif
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
                  </div>
                </div>
              </div>
              <div class="card-body">
                {!! Form::model($_user, ['method' => 'PATCH','route' => ['setting.update', $locale, Auth::user()->id], 'files' =>true,'enctype'=>'multipart/form-data']) !!}
                <h6 class="heading-small text-muted mb-4">User information</h6>
                <div class="pl-lg-4">
                  <div class="row">

                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">Email address</label>
                        {!! Form::text('email', null, array('placeholder' => 'E-mail','class' => 'form-control form-control-alternative', 'readonly' => 'yes')) !!}
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-first-name">Name</label>
                        {!! Form::text('name', null, array('placeholder' => 'E-mail','class' => 'form-control form-control-alternative')) !!}
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-dob">Date Of Birth</label>
                        @if(count($_user)>0)
                        {!! Form::input('date', 'dob', $_user->dob, array('placeholder' => 'Address','class' => 'form-control form-control-alternative')) !!}
                        @else
                        {!! Form::input('date', 'dob', null, array('placeholder' => 'Address','class' => 'form-control form-control-alternative')) !!}
                        @endif
                      </div>
                    </div>
                    @role('artist')
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-dob">Artist Category</label>
                        @if($_user->artist_type_id==null)
                        {!! Form::select('artist_type', ['' => 'Please Select'] + $_artist_type, $_user->artist_type_id, array('class' => 'form-control','single')) !!}
                        @else
                        {!! Form::select('artist_type', $_artist_type, $_user->artist_type_id, array('class' => 'form-control','single')) !!}

                        @endif


                      </div>
                    </div>
                    @endrole
                  </div>
                  <div class="row">
                    <div class="col-md-8">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-photo">Photo</label>
                        @if ($_user && $_user->photo)
                        {!! Form::input('file', 'photo', $_user->photo, array('placeholder' => 'Photo','class' => 'form-control form-control-alternative')) !!}
                        @else
                        {!! Form::input('file', 'photo', null, array('placeholder' => 'Photo','class' => 'form-control form-control-alternative')) !!}
                        @endif
                      </div>
                    </div>
                    @if ($_user && $_user->photo)
                    <div class="col-md-4 text-center">
                      <label class="form-control-label d-none d-md-block">&nbsp;</label>
                      <div class="card">
                        <img class="card-img-top" src="{{ asset("storage/setting/{$_user->photo}") }}" alt="{{ $_user->photo }}">
                        <div class="card-body p-1">
                          <p class="text-center mb-0">
                            <a href="{{ asset("storage/setting/{$_user->photo}") }}" target="_blank">
                              <small>
                                {{ $_user->photo }}
                              </small>
                            </a>
                          </p>
                        </div>
                      </div>
                    </div>
                    @endif
                  </div>
                  <div class="row">
                    <div class="col-md-8">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-cover">Cover</label>
                        @if ($_user && $_user->cover)
                        {!! Form::input('file', 'cover', $_user->cover, array('placeholder' => 'Cover','class' => 'form-control form-control-alternative')) !!}
                        @else
                        {!! Form::input('file', 'cover', null, array('placeholder' => 'Cover','class' => 'form-control form-control-alternative')) !!}
                        @endif
                      </div>
                    </div>
                    @if ($_user && $_user->cover)
                    <div class="col-md-4 text-center">
                      <label class="form-control-label d-none d-md-block">&nbsp;</label>
                      <div class="card">
                        <img class="card-img-top" src="{{ asset("storage/setting/{$_user->cover}") }}" alt="{{ $_user->cover }}">
                        <div class="card-body p-1">
                          <p class="text-center mb-0">
                            <a href="{{ asset("storage/setting/{$_user->cover}") }}" target="_blank">
                              <small>
                                {{ $_user->cover }}
                              </small>
                            </a>
                          </p>
                        </div>
                      </div>
                    </div>
                    @endif
                  </div>
                  <div class="row">
                    <div class="col-md-8">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-logo">Logo</label>
                        @if ($_user && $_user->logo)
                          {!! Form::input('file', 'logo', $_user->logo, array('placeholder' => 'Logo', 'class' => 'form-control form-control-alternative')) !!}
                        @else
                        {!! Form::input('file', 'logo', null, array('placeholder' => 'Logo', 'class' => 'form-control form-control-alternative')) !!}
                        @endif
                      </div>
                    </div>
                    @if ($_user && $_user->logo)
                    <div class="col-md-4 text-center">
                      <label class="form-control-label d-none d-md-block">&nbsp;</label>
                      <div class="card">
                        <img class="card-img-top" src="{{ asset("storage/setting/{$_user->logo}") }}" alt="{{ $_user->logo }}">
                        <div class="card-body p-1">
                          <p class="text-center mb-0">
                            <a href="{{ asset("storage/setting/{$_user->logo}") }}" target="_blank">
                              <small>
                                {{ $_user->logo }}
                              </small>
                            </a>
                          </p>
                        </div>
                      </div>
                    </div>
                    @endif
                  </div>

                </div>
                <hr class="my-4">
                <!-- Address -->
                <h6 class="heading-small text-muted mb-4">Contact information</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-address">Address</label>
                        @if(count($_user)>0)
                        {!! Form::text('address', $_user->address, array('placeholder' => 'Address','class' => 'form-control form-control-alternative')) !!}
                        @else
                        {!! Form::text('address', null, array('placeholder' => 'Address','class' => 'form-control form-control-alternative')) !!}
                        @endif
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    @if($_role=='artist')
                    <div class="col-lg-4">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-country">Artist Type</label>
                        {!! Form::select('artist_type', ['' => 'Please Select'] + $_artist_type, $_user->artist_type_id, array('class' => 'form-control','single')) !!}
                      </div>
                    </div>
                    @endif
                    <div class="col-lg-4">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-country">Province</label>

                        {!! Form::select('province', ['' => 'Please Select'] + $_province, $_user->province, array('class' => 'form-control','single')) !!}
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-city">City</label>
                        
                        {!! Form::select('city', ['' => 'Please Select'] + $_city, $_user->city, array('class' => 'form-control', 'id'=>'city','single')) !!}
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="input-country">Postal code</label>
                        @if(count($_user)>0)
                        {!! Form::text('zipcode', $_user->zipcode, array('placeholder' => 'Postal Code','class' => 'form-control form-control-alternative')) !!}
                        @else
                        {!! Form::text('zipcode', null, array('placeholder' => 'Postal Code','class' => 'form-control form-control-alternative')) !!}
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
                <hr class="my-4">
                <!-- Description -->
                <div class="text-right">
                 <button type="submit" class="btn btn-primary">Save</button>
               </div>
               {!! Form::close() !!}

             </div>
           </div>
         </div>
       </div>
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js">
       </script>
       <script type="text/javascript">
        $(document).ready(function() {
          $('select[name="province"]').on('change', function() {
            var stateID = $(this).val();
            if(stateID) {
              $.ajax({
                url: '/api/city/'+stateID,
                type: "GET",
                dataType: "json",
                success:function(data) {
                  $('select[name="city"]').empty();
                  $.each(data, function(key, value) {
                    $('select[name="city"]').append('<option value="'+ value.id_city +'">'+ value.name +'</option>');
                  });
                }
              });
            }else{
              $('select[name="city"]').empty();
            }
          });
        });
      </script>
      @endsection