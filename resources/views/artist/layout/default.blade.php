<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>

  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <meta name="author" content="SemiColonWeb" />

  <!-- Stylesheets
    ============================================= -->
    <link href="http://fonts.googleapis.com/css?family=Nunito:300,400,600,700" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{asset('artist/css/bootstrap.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('artist/css/style.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('artist/css/dark.css')}}" type="text/css" />

    <link rel="stylesheet" href="{{asset('artist/css/font-icons.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('artist/css/one-page/et-line.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('artist/css/animate.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('artist/css/magnific-popup.css')}}" type="text/css" />

    <link rel="stylesheet" href="{{asset('artist/css/responsive.css')}}" type="text/css" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
  @if (Route::currentRouteName() != 'store')
    <link rel="stylesheet" href="{{asset('artist/css/modern-blog/modern-blog.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('artist/css/modern-blog/css/fonts.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('artist/css/colors.php?color=dc3545')}}" type="text/css" />
  @endif

    <!-- Modern Blog Demo Specific Stylesheet -->

    <!-- / -->

  <!-- Document Title
    ============================================= -->
    @include('artist.layout.meta')

  <style>
    #content {
      background-color:#bcaaa4 !important;
    }

    #copyrights {
      background-color:#5d4037 !important;
    }
  </style>

</head>

<body class="stretched overlay-menu">
<script language="JavaScript">
/**
  * Disable mouse right-click on page
  * By Arthur Gareginyan (arthurgareginyan@gmail.com)
  * For full source code, visit http://www.mycyberuniverse.com
  */
document.addEventListener("contextmenu", function(e){
    e.preventDefault();
}, false);
</script>

  <!-- Document Wrapper
    ============================================= -->
    <div id="wrapper" class="clearfix">

    <!-- Header
      ============================================= -->
      <header id="header" class="transparent-header clearfix static-sticky">

        <div id="header-wrap">

          <div class="container-fluid clearfix">

            <div id="primary-menu-trigger"><i class="icon-reorder"></i></div>

          @if ($_about->logo)
          <div id="logo">
            <a 
              href="{{route('home', $locale)}}" 
              class="standard-logo" 
              data-mobile-logo="{{ asset("storage/setting/{$_about->logo}") }}">
              <img 
                src="{{ asset("storage/setting/{$_about->logo}") }}"
                alt="{{ $_about->logo }}">
            </a>
            <a 
              href="{{route('home', $locale)}}" 
              class="retina-logo" 
              data-mobile-logo="{{ asset("storage/setting/{$_about->logo}") }}">
              <img 
                src="{{ asset("storage/setting/{$_about->logo}") }}" 
                alt="{{ $_about->logo }}">
            </a>
          </div>
          @else
          <div class="heading-block nobottomborder pt-4 mb-3">
            <h3 class="mycolor @if (Route::currentRouteName() == 'detail' || Route::currentRouteName() == 'store') d-none @endif">
              @if(isset($_about))
                {{$_about->name}}
              @endif
            </h3>
          </div>
          @endif
        </div>
          <!-- Primary Navigation
            ============================================= -->
            <nav id="primary-menu" class="clearfix">
              <ul>
                <li><a href="{{route('home', $locale)}}"><div>{{($locale=='en') ? 'Home' : 'Beranda'}}</div></a></li>
                @foreach($_category as $value)
                <li><a href="{{route('category', [$locale, $value->slug])}}"><div>{{$value->name}}</div></a></li>
                @endforeach
                <li><a href="{{route('about', $locale)}}"><div>{{($locale=='en') ? 'Profile' : 'Profil'}}</div></a></li>
                 <li><a href="{{route('store', $locale)}}"><div>{{($locale=='en') ? 'Store' : 'Toko'}}</div></a></li>
                <li><a href="{{route('dashboard', $locale)}}"><div>Login</div></a></li>
              </ul>

              <a href="#" id="overlay-menu-close" class="d-none d-lg-block"><i class="icon-line-cross"></i></a>

            </nav><!-- #primary-menu end -->
          </div>
        </div>

      </header><!-- #header end -->

      @yield('content')
      @include('artist.layout.footer')