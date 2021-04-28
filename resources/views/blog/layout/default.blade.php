<!DOCTYPE html>
<html lang="en">
<head>

   @include('blog.layout.meta')
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <!-- Font Awesome Icons -->
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700|Raleway:300,400,500,600,700|Crete+Round:400i" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{asset('artist/css/bootstrap.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('artist/css/style.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('artist/css/dark.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('artist/travel.css')}}" type="text/css" />

    <link rel="stylesheet" href="{{asset('artist/css/font-icons.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('artist/css/animate.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('artist/css/magnific-popup.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('artist/css/responsive.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('artist/css/colors.php?color=dc3545')}}" type="text/css" />
    <link href="{{URL::asset('admin/assets/vendor/nucleo/css/nucleo.css')}}" rel="stylesheet">

</head>
<body class="stretched">
<div id="wrapper" class="clearfix">

    <!-- Top Bar
    ============================================= -->
    <div id="top-bar" class="transparent-topbar">

      <div class="container clearfix">

        <div class="col_half nobottommargin clearfix">

          <!-- Top Links
          ============================================= -->
          <div class="top-links">
            <ul>
              <li><a href="{{URL::to('/')}}/{{$locale}}">Home</a></li>
              @if(isset($_other))
                @foreach($_other as $key=>$value)
                  <li><a href="{{URL::to('/')}}/{{$locale}}/site/{{$value->slug}}">{{$value->name}}</a></li>
                @endforeach
              @endif
            </ul>
          </div><!-- .top-links end -->

        </div>

        <div class="col_half fright col_last clearfix nobottommargin">

          <!-- Top Social
          ============================================= -->
          <div id="top-social">
            <ul>
                <li><a href="{{isset($_contact->facebook) ? $_contact->facebook : '#'}}" class="si-facebook"><span class="ts-icon"><i class="icon-facebook"></i></span><span class="ts-text">Facebook</span></a></li>
                <li><a href="{{isset($_contact->twitter) ? $_contact->twitter : '#'}}" class="si-twitter"><span class="ts-icon"><i class="icon-twitter"></i></span><span class="ts-text">Twitter</span></a></li>
                <li><a href="{{isset($_contact->pinterest) ? $_contact->pinterest : '#'}}" class="si-pinterest"><span class="ts-icon"><i class="icon-pinterest"></i></span><span class="ts-text">Pinterest</span></a></li>
                <li><a href="{{isset($_contact->instagram) ? $_contact->instagram : '#'}}" class="si-instagram"><span class="ts-icon"><i class="icon-instagram2"></i></span><span class="ts-text">Instagram</span></a></li>
                <li><a href="{{isset($_contact->spotify) ? $_contact->spotify : '#'}}" class="si-spotify"><span class="ts-icon"><i class="icon-spotify"></i></span><span class="ts-text">Spotify</span></a></li>
                <li><a href="{{isset($_contact->medium) ? $_contact->medium : '#'}}" class="si-medium"><span class="ts-icon"><i class="icon-medium"></i></span><span class="ts-text">medium</span></a></li>
                <li><a href="#" class="si-call"><span class="ts-icon"><i class="icon-call"></i></span><span class="ts-text">{{isset($_contact->phone_number) ? $_contact->phone_number : '#'}}</span></a></li>
                <li><a href="mailto:{{isset($_contact->email) ? $_contact->email : '#'}}" class="si-email3"><span class="ts-icon"><i class="icon-envelope-alt"></i></span><span class="ts-text">{{isset($_contact->email) ? $_contact->email : '#'}}</span></a>
                </li>
            </ul>
          </div><!-- #top-social end -->

        </div>

      </div>

    </div><!-- #top-bar end -->

    <!-- Header
    ============================================= -->
    <header id="header" class="transparent-header">

      <div id="header-wrap">

        <div class="container clearfix">

          <div id="primary-menu-trigger"><i class="icon-reorder"></i></div>

          <!-- Logo
          ============================================= -->
          <div id="logo">
            <a href="/{{$locale}}" class="standard-logo p-50" data-dark-logo="{{URL::asset('storage/blog')}}/ngefans-logo-bk.png"><img style="" src="{{URL::asset('storage/blog')}}/ngefans-logo-bk.png" alt="Canvas Logo"></a>
            <a href="/{{$locale}}" class="retina-logo p-50" data-dark-logo="{{URL::asset('storage/blog')}}/ngefans-logo-bk.png"><img style="max-height: 60px;margin-top: 20px;" src="{{URL::asset('storage/blog')}}/ngefans-logo-bk.png"  alt="Canvas Logo"></a>
          </div><!-- #logo end -->

          <!-- Primary Navigation
          ============================================= -->
          <nav id="primary-menu" class="style-4">

            <ul>
              @if(isset($_menu))
                @foreach($_menu as $key=>$value)
                  <li><a href="{{URL::to('/')}}/{{$locale}}/site/{{$value->slug}}">{{ucwords($value->name)}}</a></li>
                @endforeach
              @endif
              <li><a href=""><div><i class="icon-phone3"></i>{{isset($_contact->phone_number) ? $_contact->phone_number : '#'}}</div></a></li>
            </ul>

          </nav><!-- #primary-menu end -->

        </div>

      </div>

    </header><!-- #header end -->
@yield('content')
@include('blog.layout.footer')