<!DOCTYPE html>
<html>
<head>
    <title>Verify Email | Ngefans</title>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
  

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">


    <!-- Styles -->

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
     <link href="{{URL::asset('admin/assets/img/brand/favicon.png')}}" rel="icon" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href="{{URL::asset('admin/assets/vendor/nucleo/css/nucleo.css')}}" rel="stylesheet">
  <link href="{{URL::asset('admin/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
  <!-- Argon CSS -->
 <!-- <link rel="stylesheet" href="URL::asset('admin/assets/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="URL::asset('admin/assets/css/buttons.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="URL::asset('admin/assets/css/select.bootstrap4.min.css')}}">-->
  <link type="text/css" href="{{URL::asset('admin/assets/css/argon.css?v=1.0.0')}}" rel="stylesheet">
</head>
<body>
<div class="container pt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }}, <a href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>.
                </div>
            </div>
        </div>
    </div>
</div>
  <script src="{{URL::asset('admin/assets/vendor/jquery/dist/jquery.min.js')}}"></script>
  <script src="{{URL::asset('admin/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
  <!-- Optional JS -->
  <script src="{{URL::asset('admin/assets/vendor/chart.js/dist/Chart.min.js')}}"></script>
  <script src="{{URL::asset('admin/assets/vendor/chart.js/dist/Chart.extension.js')}}"></script>
  
 <!-- <script src="{{URL::asset('admin/assets/js/jquery.dataTables.min.js')}}"></script>
  <script src="{{URL::asset('admin/assets/js/dataTables.bootstrap4.min.js')}}"></script>
  <script src="{{URL::asset('admin/assets/js/dataTables.buttons.min.js')}}"></script>
  <script src="{{URL::asset('admin/assets/js/buttons.bootstrap4.min.js')}}"></script>
  <script src="{{URL::asset('admin/assets/js/buttons.html5.min.js')}}"></script>
  <script src="{{URL::asset('admin/assets/js/buttons.flash.min.js')}}"></script>
  <script src="{{URL::asset('admin/assets/js/buttons.print.min.js')}}"></script>
  <script src="{{URL::asset('admin/assets/js/dataTables.select.min.js')}}"></script>-->
  <!-- Argon JS -->
  <script src="{{URL::asset('admin/assets/js/argon.js?v=1.0.0')}}"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
</body>
</html>

