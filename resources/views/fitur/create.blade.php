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
        <div class="col"><h3 class="mb-0 text-uppercase">Create</h3></div>
        <div class="col text-right">
            
            <a class="btn btn-sm btn-primary" href="{{ route('fitur.index', $locale)}}">Back</a>
        
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


{!! Form::open(array('route' => ['fitur.store', $locale],'method'=>'POST')) !!}
<div class="row">
     <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name:</strong>
            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
        </div>
      </div> 
      <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Selected Icon :</strong>
            <span id="icons" style="font-size: 36px;"></span>
            {!! Form::input('hidden', 'icon', null, array('placeholder' => 'Select Icon Bellow','class' => 'form-control', 'id'=>'icon')) !!}
        </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Select One</strong>
            <div class="row icon-examples mb-4">
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="active-40" title="Select this icon">
              <div>
                <i class="ni ni-active-40"></i>
                <span>active-40</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="air-baloon" title="Select this icon">
              <div>
                <i class="ni ni-air-baloon"></i>
                <span>air-baloon</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="album-2" title="Select this icon">
              <div>
                <i class="ni ni-album-2"></i>
                <span>album-2</span>
              </div>
            </button>
          </div>
                    <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="align-center" title="Select this icon">
              <div>
                <i class="ni ni-align-center"></i>
                <span>align-center</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="align-left-2" title="Select this icon">
              <div>
                <i class="ni ni-align-left-2"></i>
                <span>align-left-2</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="ambulance" title="Select this icon">
              <div>
                <i class="ni ni-ambulance"></i>
                <span>ambulance</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="app" title="Select this icon">
              <div>
                <i class="ni ni-app"></i>
                <span>app</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="archive-2" title="Select this icon">
              <div>
                <i class="ni ni-archive-2"></i>
                <span>archive-2</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="atom" title="Select this icon">
              <div>
                <i class="ni ni-atom"></i>
                <span>atom</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="badge" title="Select this icon">
              <div>
                <i class="ni ni-badge"></i>
                <span>badge</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="bag-17" title="Select this icon">
              <div>
                <i class="ni ni-bag-17"></i>
                <span>bag-17</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="basket" title="Select this icon">
              <div>
                <i class="ni ni-basket"></i>
                <span>basket</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="bell-55" title="Select this icon">
              <div>
                <i class="ni ni-bell-55"></i>
                <span>bell-55</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="bold-down" title="Select this icon">
              <div>
                <i class="ni ni-bold-down"></i>
                <span>bold-down</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="bold-left" title="Select this icon">
              <div>
                <i class="ni ni-bold-left"></i>
                <span>bold-left</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="bold-right" title="Select this icon">
              <div>
                <i class="ni ni-bold-right"></i>
                <span>bold-right</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="bold-up" title="Select this icon">
              <div>
                <i class="ni ni-bold-up"></i>
                <span>bold-up</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="bold" title="Select this icon">
              <div>
                <i class="ni ni-bold"></i>
                <span>bold</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="book-bookmark" title="Select this icon">
              <div>
                <i class="ni ni-book-bookmark"></i>
                <span>book-bookmark</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="books" title="Select this icon">
              <div>
                <i class="ni ni-books"></i>
                <span>books</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="box-2" title="Select this icon">
              <div>
                <i class="ni ni-box-2"></i>
                <span>box-2</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="briefcase-24" title="Select this icon">
              <div>
                <i class="ni ni-briefcase-24"></i>
                <span>briefcase-24</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="building" title="Select this icon">
              <div>
                <i class="ni ni-building"></i>
                <span>building</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="bulb-61" title="Select this icon">
              <div>
                <i class="ni ni-bulb-61"></i>
                <span>bulb-61</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="bullet-list-67" title="Select this icon">
              <div>
                <i class="ni ni-bullet-list-67"></i>
                <span>bullet-list-67</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="bus-front-12" title="Select this icon">
              <div>
                <i class="ni ni-bus-front-12"></i>
                <span>bus-front-12</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="button-pause" title="Select this icon">
              <div>
                <i class="ni ni-button-pause"></i>
                <span>button-pause</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="button-play" title="Select this icon">
              <div>
                <i class="ni ni-button-play"></i>
                <span>button-play</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="button-power" title="Select this icon">
              <div>
                <i class="ni ni-button-power"></i>
                <span>button-power</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="calendar-grid-58" title="Select this icon">
              <div>
                <i class="ni ni-calendar-grid-58"></i>
                <span>calendar-grid-58</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="camera-compact" title="Select this icon">
              <div>
                <i class="ni ni-camera-compact"></i>
                <span>camera-compact</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="caps-small" title="Select this icon">
              <div>
                <i class="ni ni-caps-small"></i>
                <span>caps-small</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="cart" title="Select this icon">
              <div>
                <i class="ni ni-cart"></i>
                <span>cart</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="chart-bar-32" title="Select this icon">
              <div>
                <i class="ni ni-chart-bar-32"></i>
                <span>chart-bar-32</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="chart-pie-35" title="Select this icon">
              <div>
                <i class="ni ni-chart-pie-35"></i>
                <span>chart-pie-35</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="chat-round" title="Select this icon">
              <div>
                <i class="ni ni-chat-round"></i>
                <span>chat-round</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="check-bold" title="Select this icon">
              <div>
                <i class="ni ni-check-bold"></i>
                <span>check-bold</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="circle-08" title="Select this icon">
              <div>
                <i class="ni ni-circle-08"></i>
                <span>circle-08</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="cloud-download-95" title="Select this icon">
              <div>
                <i class="ni ni-cloud-download-95"></i>
                <span>cloud-download-95</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="cloud-upload-96" title="Select this icon">
              <div>
                <i class="ni ni-cloud-upload-96"></i>
                <span>cloud-upload-96</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="compass-04" title="Select this icon">
              <div>
                <i class="ni ni-compass-04"></i>
                <span>compass-04</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="controller" title="Select this icon">
              <div>
                <i class="ni ni-controller"></i>
                <span>controller</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="credit-card" title="Select this icon">
              <div>
                <i class="ni ni-credit-card"></i>
                <span>credit-card</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="curved-next" title="Select this icon">
              <div>
                <i class="ni ni-curved-next"></i>
                <span>curved-next</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="delivery-fast" title="Select this icon">
              <div>
                <i class="ni ni-delivery-fast"></i>
                <span>delivery-fast</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="diamond" title="Select this icon">
              <div>
                <i class="ni ni-diamond"></i>
                <span>diamond</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="email-83" title="Select this icon">
              <div>
                <i class="ni ni-email-83"></i>
                <span>email-83</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="fat-add" title="Select this icon">
              <div>
                <i class="ni ni-fat-add"></i>
                <span>fat-add</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="fat-delete" title="Select this icon">
              <div>
                <i class="ni ni-fat-delete"></i>
                <span>fat-delete</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="fat-remove" title="Select this icon">
              <div>
                <i class="ni ni-fat-remove"></i>
                <span>fat-remove</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="favourite-28" title="Select this icon">
              <div>
                <i class="ni ni-favourite-28"></i>
                <span>favourite-28</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="folder-17" title="Select this icon">
              <div>
                <i class="ni ni-folder-17"></i>
                <span>folder-17</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="glasses-2" title="Select this icon">
              <div>
                <i class="ni ni-glasses-2"></i>
                <span>glasses-2</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="hat-3" title="Select this icon">
              <div>
                <i class="ni ni-hat-3"></i>
                <span>hat-3</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="headphones" title="Select this icon">
              <div>
                <i class="ni ni-headphones"></i>
                <span>headphones</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="html5" title="Select this icon">
              <div>
                <i class="ni ni-html5"></i>
                <span>html5</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="istanbul" title="Select this icon">
              <div>
                <i class="ni ni-istanbul"></i>
                <span>istanbul</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="circle-08" title="Select this icon">
              <div>
                <i class="ni ni-circle-08"></i>
                <span>circle-08</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="key-25" title="Select this icon">
              <div>
                <i class="ni ni-key-25"></i>
                <span>key-25</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="laptop" title="Select this icon">
              <div>
                <i class="ni ni-laptop"></i>
                <span>laptop</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="like-2" title="Select this icon">
              <div>
                <i class="ni ni-like-2"></i>
                <span>like-2</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="lock-circle-open" title="Select this icon">
              <div>
                <i class="ni ni-lock-circle-open"></i>
                <span>lock-circle-open</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="map-big" title="Select this icon">
              <div>
                <i class="ni ni-map-big"></i>
                <span>map-big</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="mobile-button" title="Select this icon">
              <div>
                <i class="ni ni-mobile-button"></i>
                <span>mobile-button</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="money-coins" title="Select this icon">
              <div>
                <i class="ni ni-money-coins"></i>
                <span>money-coins</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="note-03" title="Select this icon">
              <div>
                <i class="ni ni-note-03"></i>
                <span>note-03</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="notification-70" title="Select this icon">
              <div>
                <i class="ni ni-notification-70"></i>
                <span>notification-70</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="palette" title="Select this icon">
              <div>
                <i class="ni ni-palette"></i>
                <span>palette</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="paper-diploma" title="Select this icon">
              <div>
                <i class="ni ni-paper-diploma"></i>
                <span>paper-diploma</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="pin-3" title="Select this icon">
              <div>
                <i class="ni ni-pin-3"></i>
                <span>pin-3</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="planet" title="Select this icon">
              <div>
                <i class="ni ni-planet"></i>
                <span>planet</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="ruler-pencil" title="Select this icon">
              <div>
                <i class="ni ni-ruler-pencil"></i>
                <span>ruler-pencil</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="satisfied" title="Select this icon">
              <div>
                <i class="ni ni-satisfied"></i>
                <span>satisfied</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="scissors" title="Select this icon">
              <div>
                <i class="ni ni-scissors"></i>
                <span>scissors</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="send" title="Select this icon">
              <div>
                <i class="ni ni-send"></i>
                <span>send</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="settings-gear-65" title="Select this icon">
              <div>
                <i class="ni ni-settings-gear-65"></i>
                <span>settings-gear-65</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="settings" title="Select this icon">
              <div>
                <i class="ni ni-settings"></i>
                <span>settings</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="single-02" title="Select this icon">
              <div>
                <i class="ni ni-single-02"></i>
                <span>single-02</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="single-copy-04" title="Select this icon">
              <div>
                <i class="ni ni-single-copy-04"></i>
                <span>single-copy-04</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="sound-wave" title="Select this icon">
              <div>
                <i class="ni ni-sound-wave"></i>
                <span>sound-wave</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="spaceship" title="Select this icon">
              <div>
                <i class="ni ni-spaceship"></i>
                <span>spaceship</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="square-pin" title="Select this icon">
              <div>
                <i class="ni ni-square-pin"></i>
                <span>square-pin</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="support-16" title="Select this icon">
              <div>
                <i class="ni ni-support-16"></i>
                <span>support-16</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="tablet-button" title="Select this icon">
              <div>
                <i class="ni ni-tablet-button"></i>
                <span>tablet-button</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="tag" title="Select this icon">
              <div>
                <i class="ni ni-tag"></i>
                <span>tag</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="tie-bow" title="Select this icon">
              <div>
                <i class="ni ni-tie-bow"></i>
                <span>tie-bow</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="time-alarm" title="Select this icon">
              <div>
                <i class="ni ni-time-alarm"></i>
                <span>time-alarm</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="trophy" title="Select this icon">
              <div>
                <i class="ni ni-trophy"></i>
                <span>trophy</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="tv-2" title="Select this icon">
              <div>
                <i class="ni ni-tv-2"></i>
                <span>tv-2</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="umbrella-13" title="Select this icon">
              <div>
                <i class="ni ni-umbrella-13"></i>
                <span>umbrella-13</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="user-run" title="Select this icon">
              <div>
                <i class="ni ni-user-run"></i>
                <span>user-run</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="vector" title="Select this icon">
              <div>
                <i class="ni ni-vector"></i>
                <span>vector</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="watch-time" title="Select this icon">
              <div>
                <i class="ni ni-watch-time"></i>
                <span>watch-time</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="world" title="Select this icon">
              <div>
                <i class="ni ni-world"></i>
                <span>world</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="zoom-split-in" title="Select this icon">
              <div>
                <i class="ni ni-zoom-split-in"></i>
                <span>zoom-split-in</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="collection" title="Select this icon">
              <div>
                <i class="ni ni-collection"></i>
                <span>collection</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="image" title="Select this icon">
              <div>
                <i class="ni ni-image"></i>
                <span>image</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="shop" title="Select this icon">
              <div>
                <i class="ni ni-shop"></i>
                <span>shop</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="ungroup" title="Select this icon">
              <div>
                <i class="ni ni-ungroup"></i>
                <span>ungroup</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="world-2" title="Select this icon">
              <div>
                <i class="ni ni-world-2"></i>
                <span>world-2</span>
              </div>
            </button>
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn-sm btn-warning myIcon" data-clipboard-text="ui-04" title="Select this icon">
              <div>
                <i class="ni ni-ui-04"></i>
                <span>ui-04</span>
              </div>
            </button>
          </div>
        </div>
        </div>
      </div>
      
      <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Content:</strong>
            {!! Form::textarea('content', null, ['class'=>'form-control', 'id'=>'summary-ckeditor']) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Order:</strong>
            {!! Form::input('number','order', null, array('placeholder' => 'Order','class' => 'form-control')) !!}{!! Form::input('hidden','author', Auth::user()->id , array('placeholder' => 'Order','class' => 'form-control')) !!}
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
<script>
    window.onload = function() {
        var g = document.getElementsByClassName('myIcon');
        icon = [];
for (var i = 0, len = g.length; i < len; i++)
{

    (function(event){
        g[event].onclick = function(){
              icon=[];
              icon.push(g[event]);
              document.getElementById('icon').value=icon[0].innerText;
              document.getElementById('icons').innerHTML="<i class='ni ni-"+icon[0].innerText.trim()+"'></i>";
        }    
    })(i);
    
}
  }
    
</script>
<script src="https://cdn.ckeditor.com/4.5.6/standard/ckeditor.js">
  
</script>
<script>
     CKEDITOR.replace( 'summary-ckeditor',
            {
            enterMode: CKEDITOR.ENTER_BR,
            
         
         });

</script>
@endsection