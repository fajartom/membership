<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
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
  <link type="text/css" href="{{URL::asset('admin/assets/css/select2.min.css')}}" rel="stylesheet">
  <style>
    .box{
    border: solid 1px #e2e2e2;
    padding: 10px;
    background: #efefef3b;
  }
  td.box p{
    font-size: 11px !important;
  }
  .myIcon{
    font-size: 14px;
    margin-bottom: 5px;
  }
  </style>
</head>
<body>

    <div id="app">
             @guest

                @else
         <nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
      <!-- Toggler -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <!-- Brand -->
     <a class="navbar-brand pt-0" href="./index.html">
       <img src="{{URL::asset('admin/assets/img/brand/ngefans-logo.png')}}" class="navbar-brand-img" alt="ngefans">
      </a>
      <div>
        <a class="h4 mb-0 ml-1 mr-1 text-white text-uppercase d-none d-lg-inline-block" href="<?=url('/en/')?>/{{explode('.', Route::getCurrentRoute()->action['as'])[0]}}"> <img src="{{asset('storage/image/en.png')}}" height="16px"> </a>

        <a class="h4 mb-0 ml-1 mr-1 text-white text-uppercase d-none d-lg-inline-block" href="<?=url('/id/')?>/{{explode('.', Route::getCurrentRoute()->action['as'])[0]}}">
         <img src="{{asset('storage/image/id.png')}}" height="20px" class="ml-1 mr-1">
        </a>

      </div>

      <!-- User -->
      <ul class="nav align-items-center d-md-none">
        <li class="nav-item dropdown">
          <a class="nav-link nav-link-icon" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="ni ni-bell-55"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right" aria-labelledby="navbar-default_dropdown_1">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Something else here</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="media align-items-center">
              <span class="avatar avatar-sm rounded-circle">
                <img alt="Image placeholder" src="{{URL::asset('admin/assets/img/theme/team-1-800x800.jpg')}}">
              </span>
            </div>
          </a>
          <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
            <div class="dropdown-header noti-title">
              <h6 class="text-overflow m-0">Welcome!</h6>
            </div>
            <a class="dropdown-item"> 
              <a class="ml-3 mr-3" href="<?=url('/en/')?>/{{explode('.', Route::getCurrentRoute()->action['as'])[0]}}"> 
                <img src="{{asset('storage/image/en.png')}}" height="16px">
              </a>
              <a href="<?=url('/id/')?>/{{explode('.', Route::getCurrentRoute()->action['as'])[0]}}"> 
                <img src="{{asset('storage/image/id.png')}}" height="20px" class="ml-1 mr-1">
              </a>
              <br><br>
            </a>
    
            <a href="{{ route('setting.edit', [$locale, Auth::user()->id]) }}" class="dropdown-item">
              <i class="ni ni-single-02"></i>
              <span>My profile</span>
            </a>
            <a href="./examples/profile.html" class="dropdown-item">
              <i class="ni ni-settings-gear-65"></i>
              <span>Settings</span>
            </a>
            <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                       <i class="ni ni-user-run"></i> <span>{{ __('Logout') }}</span>
                </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
            </form>
            
          </div>
        </li>
      </ul>
      <!-- Collapse -->
      <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        <!-- Collapse header -->
        <div class="navbar-collapse-header d-md-none">
          <div class="row">
            <div class="col-6 collapse-brand">
              <a href="./index.html">
                <!--<img src="./assets/img/brand/blue.png">-->
                {{ config('app.name', 'Laravel') }}
                      <div>
        <a class="h4 mb-0 ml-1 mr-1 text-white text-uppercase d-none d-lg-inline-block" href="<?=url('/en/')?>/{{explode('.', Route::getCurrentRoute()->action['as'])[0]}}"> <img src="{{asset('storage/image/en.png')}}" height="16px"> </a>

        <a class="h4 mb-0 ml-1 mr-1 text-white text-uppercase d-none d-lg-inline-block" href="<?=url('/id/')?>/{{explode('.', Route::getCurrentRoute()->action['as'])[0]}}">
         <img src="{{asset('storage/image/id.png')}}" height="20px" class="ml-1 mr-1">
        </a>
      </div>
              </a>

            </div>
            <div class="col-6 collapse-close">
              <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                <span></span>
                <span></span>
              </button>
            </div>
          </div>
        </div>
        <!-- Form -->
        <form class="mt-4 mb-3 d-md-none">
          <div class="input-group input-group-rounded input-group-merge">
            <input type="search" class="form-control form-control-rounded form-control-prepended" placeholder="Search" aria-label="Search">
            <div class="input-group-prepend">
              <div class="input-group-text">
                <span class="fa fa-search"></span>
              </div>
            </div>
          </div>
        </form>


        <!-- Navigation -->

         <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard', $locale)}}">
              <i class="ni ni-tv-2 text-primary"></i> Dashboard
            </a>
          </li>
        </ul>
        @role('superadmin')
          @if(auth()->user()->can('user-list'))
        <hr class="my-2"></hr>
         <h6 class="navbar-heading text-muted">User Management</h6>
         <ul class="navbar-nav">
        
 
          <li class="nav-item">
            
            <a class="nav-link" href="{{ route('users.index', $locale)}}">
              <i class="ni ni-circle-08 text-blue"></i> User
            </a>
         
          </li>

          @endif
          @endrole
          @if(auth()->user()->can('role-list'))
 
          <li class="nav-item">
            <a class="nav-link" href="{{ route('roles.index', $locale)}}">
              <i class="ni ni-key-25 text-orange"></i> Roles
            </a>
          </li>
        
        </ul>
          @endif
        @if(auth()->user()->can('content-list') || auth()->user()->can('album-list') || auth()->user()->can('post-category-list'))
        <hr class="my-2"></hr>
         <h6 class="navbar-heading text-muted">Post Management</h6>
         <ul class="navbar-nav">
         @if(auth()->user()->can('post-category-list'))
         <li class="nav-item">
            <a class="nav-link" href="{{ route('post-category.index', $locale)}}">
              <i class="ni ni-tag text-info"></i> Post Category
            </a>
          </li>
        @endif
        @if(auth()->user()->can('content-list'))
          <li class="nav-item">
            <a class="nav-link" href="{{ route('post.index', $locale)}}">
              <i class="ni ni-archive-2 text-info"></i> Content
            </a>
          </li>      
        @endif
        @if(auth()->user()->can('album-list'))
          <li class="nav-item">
            <a class="nav-link" href="{{ route('album.index', $locale)}}">
              <i class="ni ni-archive-2 text-info"></i> Album
            </a>
          </li>      
        @endif
          </ul>
       @endif
  
        @if(auth()->user()->can('info-list') || auth()->user()->can('artist-list') || auth()->user()->can('fitur-list'))
           <hr class="my-2"></hr>
         <h6 class="navbar-heading text-muted">Site Content</h6>
         <ul class="navbar-nav">
        @if(auth()->user()->can('artist-list'))
          <li class="nav-item">
            <a class="nav-link" href="{{ route('artist-ngefans.index', $locale)}}">
              <i class="ni ni-circle-08 text-red"></i> Artist
            </a>
          </li>
        @endif
        @if(auth()->user()->can('fitur-list'))
          <li class="nav-item">
            <a class="nav-link" href="{{ route('fitur.index', $locale)}}">
              <i class="ni ni-bullet-list-67 text-info"></i> Fitur
            </a>
          </li>
        @endif 
        @if(auth()->user()->can('menu-list'))
          <li class="nav-item">
            <a class="nav-link" href="{{ route('menu.index', $locale)}}">
              <i class="ni ni-bullet-list-67 text-red"></i> Menu
            </a>
          </li>
        @endif  
        @if(auth()->user()->can('slider-list'))
 
          <li class="nav-item">
            <a class="nav-link" href="{{ route('slider.index', $locale)}}">
              <i class="ni ni-camera-compact text-orange"></i> Slider
            </a>
          </li>
        @endif    
        </ul>

        @endif
 
        @if(auth()->user()->can('info-list') || auth()->user()->can('email-list') || auth()->user()->can('contact-list') || auth()->user()->can('other-list'))
           <hr class="my-2"></hr>
         <h6 class="navbar-heading text-muted">Footer Content</h6>
         <ul class="navbar-nav">
        @if(auth()->user()->can('info-list'))
 
          <li class="nav-item">
            <a class="nav-link" href="{{ route('info.index', $locale)}}">
              <i class="ni ni-badge text-orange"></i> Info
            </a>
          </li>
        @endif
        @if(auth()->user()->can('email-list'))
 
          <li class="nav-item">
            <a class="nav-link" href="{{ route('email.index', $locale)}}">
              <i class="ni ni-archive-2 text-orange"></i> Email
            </a>
          </li>
        @endif
        @if(auth()->user()->can('contact-list'))
          <li class="nav-item">
            <a class="nav-link" href="{{ route('contact.index', $locale) }}">
              <i class="ni ni-collection text-info"></i> Contact
            </a>
          </li>
        @endif
          @if(auth()->user()->can('other-list'))
          <li class="nav-item">
            <a class="nav-link" href="{{ route('other.index', $locale)}}">
              <i class="ni ni-bullet-list-67 text-purple"></i> Other
            </a>
          </li>
        @endif
      
        </ul>

        @endif
         @if(auth()->user()->can('transaction-list') || auth()->user()->can('subscriber-list'))
        <hr class="my-2"></hr>
         <h6 class="navbar-heading text-muted">Transaction</h6>
         <ul class="navbar-nav">
         @if(auth()->user()->can('transaction-list'))
         <li class="nav-item">
            <a class="nav-link" href="{{ route('transaction.index', $locale)}}">
              <i class="ni ni-tag text-info"></i> Transaction History
            </a>
          </li>
        @endif
        @if(auth()->user()->can('subscriber-list'))
          <li class="nav-item">
            <a class="nav-link" href="{{ route('data-member.index', $locale)}}">
              <i class="ni ni-archive-2 text-info"></i> Subscriber
            </a>
          </li>      
        @endif
          </ul>
       @endif

        @if(auth()->user()->can('member-list') || auth()->user()->can('artist-list') || auth()->user()->can('benefit-list') || auth()->user()->can('member-benefit-list') || auth()->user()->can('payment-list') )
        <hr class="my-2"></hr>
         <h6 class="navbar-heading text-muted">Configuration</h6>
         <ul class="navbar-nav">
       
          @if(auth()->user()->can('artist-list'))
          <li class="nav-item">
            <a class="nav-link" href="{{ route('artist-category.index', $locale)}}">
              <i class="ni ni-badge text-danger"></i> Artist
            </a>
          </li>
          @endif
          @if(auth()->user()->can('member-list'))
          <li class="nav-item">
            <a class="nav-link" href="{{ route('members.index', $locale)}}">
              <i class="ni ni-tie-bow text-danger"></i> Member
            </a>
          </li>
          @endif
          @if(auth()->user()->can('member-list'))
          <li class="nav-item">
            <a class="nav-link" href="{{ route('member-periode.index', $locale)}}">
              <i class="ni ni-tie-bow text-danger"></i> Member Periode
            </a>
          </li>
          @endif
          @if(auth()->user()->can('benefit-list'))
          <li class="nav-item">
            <a class="nav-link" href="{{ route('benefit.index', $locale)}}">
              <i class="ni ni-tie-bow text-danger"></i> Benefit
            </a>
          </li>
          @endif
          @if(auth()->user()->can('member-benefit-list'))
          <li class="nav-item">
            <a class="nav-link" href="{{ route('member-benefit.index', $locale)}}">
              <i class="ni ni-tie-bow text-danger"></i> Member Benefit
            </a>
          </li>
          @endif
          @if(auth()->user()->can('payment-list'))
          <li class="nav-item">
            <a class="nav-link" href="{{ route('payment.index', $locale)}}">
              <i class="ni ni-money-coins text-danger"></i> Payment
            </a>
          </li>
          @endif


      
        </ul>
       
    @endif

      </div>
    </div>
  
  </nav>
    <div class="main-content">
    <!-- Top navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <div class="text-white"></div>

        <form class="navbar-search navbar-search-dark form-inline mr-3 d-none d-md-flex ml-lg-auto">
          <div class="form-group mb-0">
            <div class="input-group input-group-alternative">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-search"></i></span>
              </div>
              <input class="form-control" placeholder="Search" type="text">
            </div>
          </div>
        </form>
        <!-- User -->
        <ul class="navbar-nav align-items-center d-none d-md-flex">
          <li class="nav-item dropdown">
            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="media align-items-center">
                <span class="avatar avatar-sm rounded-circle">
                  <img alt="Image placeholder" src="{{URL::asset('admin/assets/img/theme/team-4-800x800.jpg')}}">
                </span>
                <div class="media-body ml-2 d-none d-lg-block">
                  <span class="mb-0 text-sm  font-weight-bold">{{ Auth::user()->name }}</span>
                </div>
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
              <div class=" dropdown-header noti-title">
                <h6 class="text-overflow m-0">Welcome! </h6>
              </div>

              <a href="{{ route('setting.edit', [$locale, Auth::user()->id]) }}" class="dropdown-item">
                <i class="ni ni-single-02"></i>
                <span>My profile</span>
              </a>
             <!-- <a href="./examples/profile.html" class="dropdown-item">
                <i class="ni ni-calendar-grid-58"></i>
                <span>Activity</span>
              </a>
              <a href="./examples/profile.html" class="dropdown-item">
                <i class="ni ni-support-16"></i>
                <span>Support</span>
              </a>-->
              <div class="dropdown-divider"></div>
 <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                       <i class="ni ni-user-run"></i> <span>{{ __('Logout') }}</span>
                </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
            </form>
            </div>
          </li>
        </ul>
        
      </div>
    </nav>
  @endguest
@yield('content')
@guest
@else
@include('footer')
    </div>
  </div>
@endguest
      <!-- Argon Scripts -->
  <!-- Core -->
  <script src="{{URL::asset('admin/assets/vendor/jquery/dist/jquery.min.js')}}"></script>
  <script src="{{URL::asset('admin/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
  <!-- Optional JS -->
  <script src="{{URL::asset('admin/assets/vendor/chart.js/dist/Chart.min.js')}}"></script>
  <script src="{{URL::asset('admin/assets/vendor/chart.js/dist/Chart.extension.js')}}"></script>
  <script src="{{URL::asset('admin/assets/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
  
  <script>
  $("#myMonth").datepicker( {
    format: "m-yyyy",
    startView: "months", 
    minViewMode: "months"
});
var week = ['Week 1', 'Week 2', 'Week 3', 'Week 4'];
var amount = ['0', '10', '20', '30', '40', '50'];
var chartdata = {
  
        labels: week,
            datasets: [{
            label: 'Amount',
            data: amount,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
      };

      var ctx = $("#myChart");
      var barGraph = new Chart(ctx, {
        type: 'line',
        data: chartdata,
        options: {
          scales: {
              yAxes: [{
                gridLines: {
                  display: false
                }
              }]
          },
        }
      });
  $.post("/api/chart/",
  {
    month:$("#myMonth").val(),
    id:$("#user").val(),
    role:$("#role").val()
  },
  function(data, status){
    if(data.status){
      var week = [];
      var amount = [];
      for(var i in data.data) {
        week.push('Week '+ data.data[i].week);
        amount.push(data.data[i].total);
      }
      barGraph.data.labels=week;
      barGraph.data.datasets[0].data=amount;
      barGraph.reset();
      barGraph.update();
    }else{
      alert('Server Timeout');
    }
  });



$("#myMonth").change(function(){
  $.post("/api/chart/",
  {
    month:$(this).val(),
    id:$("#user").val(),
    role:$("#role").val()
  },
  function(data, status){
    if(data.status){
      var week = [];
      var amount = [];
      for(var i in data.data) {
        week.push('Week '+ data.data[i].week);
        amount.push(data.data[i].total);
      }
      barGraph.data.labels=week;
      barGraph.data.datasets[0].data=amount;
      barGraph.reset();
      barGraph.update();
    }else{
      alert('Server Timeout');
    }
  });
});
</script>
  
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
  <script src="{{URL::asset('admin/assets/js/select2.min.js')}}"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
@include('sweet::alert')
@stack('scripts')
</body>
</html>
