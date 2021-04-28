@extends('artist.layout.default')
@section('content')
<section id="slider" class="slider-element clearfix" style="height: 100% !important;">
    <div class="fslider full-screen force-full-screen" data-speed="1800" data-pause="5000" data-animation="fade"
        data-arrows="true" data-pagi="false">
        <div class="flexslider full-screen force-full-screen">
            <div class="slider-wrap force-full-screen">
                <!-- Slide 1 -->
                @if(count($_slider)>0)
                @foreach ($_slider as $key => $slider)
                <div class="slide center full-screen force-full-screen"
                    style="background: url({{ asset("storage/slider/{$slider->image}") }}) center center; background-size: cover;">
                    <div class="flex-caption dark d-block">
                        <h3 class="mb-2 h1"><a href="#" class="text-white">{{$slider->title}}</a></h3>
                        <p class="h5">{{$slider->subtitle}}</p>
                    </div>
                </div>
                @endforeach
                @else
                <div class="slide center full-screen force-full-screen"
                    style="background: url('artist/images/slider/1560456047_5d02ab6fcf188.jpg') center center; background-size: cover;">
                    <div class="flex-caption dark d-block">
                        <h3 class="mb-2 h1"><a href="#" class="text-white">Thing That Make You Love</a></h3>
                        <p class="h5">Credibly synthesize seamless</p>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section><!-- #Slider end -->
<!-- Content
      ============================================= -->
<section id="content" class="bg-light">
    <div class="content-wrap pt-lg-0 pt-xl-0 pb-0">
        <div class="container clearfix">
            <div class="heading-block nobottomborder center pt-4 mb-3">
                <h3 class="titlex">{{($locale=='en') ? 'Home' : 'Beranda'}}</h3>
            </div>
            <!-- Posts
            ============================================= -->
            <div class="row grid-container infinity-wrapper clearfix">
                <!-- ARTICLE NO. 1 -->
                @if(count($_post)>0)
                @foreach($_post as $key=> $post)
                <div class="col-md-6 p-3">
                    <div class="entry mb-1 clearfix">
                        <div class="entry-image mb-3">
                            <a href="{{asset('storage/artikel')}}/{{$post->image}}" data-lightbox="image"
                                style="background: url({{asset("storage/artikel/{$post->image}")}}) no-repeat center center; background-size: cover; height: 278px;"></a>
                        </div>
                        <div class="entry-title">
                            <h3><a href="{{route('detail', [$locale, $post->slugpost])}}">{{$post->title}}</a></h3>
                        </div>
                        <div class="entry-content">
                            <p>{{$post->excerpt}}</p>
                        </div>
                        <ul class="entry-meta nohover clearfix">
                            <li class="fleft"><i class="icon-calendar2"></i>{{$post->created_at}}</li>
                            <li class="fright">{{$post->category}}</li>
                        </ul>
                        <ul class="entry-meta hover clearfix">
                            <li class="fleft ls1"><a href="{{route('detail', [$locale, $post->slugpost])}}">View More
                                    &rarr;</a></li>
                        </ul>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    @else
    <div class="col-md-6 p-3">
        <div class="entry mb-1 clearfix">
            <div class="entry-image mb-3">
                <a href="{{asset('artist/css/modern-blog/images/items/lightbox/1.jpg')}}" data-lightbox="image"
                    style="background: url('artist/css/modern-blog/images/items/1.jpg') no-repeat center center; background-size: cover; height: 278px;"></a>
            </div>
            <div class="entry-title">
                <h3><a href="#">How To Make More travel By Doing Less</a></h3>
            </div>
            <div class="entry-content">
                <p>Distinctively unleash e-business testing procedures vis-a-vis future-proof leadership. Energistically
                    synthesize leveraged e-business whereas proactive.</p>
            </div>
            <ul class="entry-meta nohover clearfix">
                <li class="fleft"><i class="icon-calendar2"></i> 10th Feb 2014</li>
                <li class="fright">MockUp</li>
            </ul>
            <ul class="entry-meta hover clearfix">
                <li class="fleft ls1"><a href="#">View More &rarr;</a></li>
            </ul>
        </div>
    </div>

    </div>
    </div>
    </div>
    @endif
    <!-- Infinity Scroll Loader
            ============================================= -->
    <div class="text-center">
        <div class="page-load-status hovering-load-status">
            <div class="css3-spinner infinite-scroll-request">
                <div class="css3-spinner-ball-pulse-sync">
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
            </div>
            <div class="alert alert-warning center infinite-scroll-last mx-auto" style="max-width: 20rem;">End of
                content</div>
            <div class="alert alert-warning center infinite-scroll-error mx-auto" style="max-width: 20rem;">No more
                pages to load</div>
        </div>
    </div>
    <div class="center d-none">
        <a href="#" class="load-next-posts"></a>
    </div>
    </div>
    </div>
    <!-- Copyrights
        ============================================= -->
    <!-- #content end -->
    <div class="modal-on-load" data-target="#myModal1"></div>
    <!-- Modal -->
    <div class="modal1 mfp-hide" id="myModal1">
        <div class="block divcenter" style="background-color: #FFF; max-width:70%;">
            <h1 class="center">Subscribe for more benefit</h1>
            <div class="row p-3">
                
                @foreach($mybenefit['data'] as $key => $benefit)
                <div class="col-lg-4 col-md-4 mt-4 mt-md-0">
                    @if(strtolower($benefit['name'])!='silver')
                    <div class="card text-center" style="background:#0000001f">
                    @else
                    <div class="card text-center">
                    @endif
                        <div class="card-body py-4">
                            <h3 class="card-title t400">{{$benefit['name']}}</h3>
                            <!-- Price Value -->
                            <div class="pricing-price t600 py-2" style="font-size: 32px !important">{{$benefit['amount']}}</div>
                            <p class="card-text pricing-sub t600" style="opacity: .2;">1 Bulan</p>
                        </div>
                        <div class="line my-1"></div>
                        <div class="card-body py-4">
                            <ul class="iconlist ml-0" style="opacity: .8">
                                @foreach($mybenefit['data'][$key]['benefit'] as $v => $list)
                                <li>{{$list}}</li>
                                @endforeach
                            </ul>
                            <?php
                             $x=explode('.', request()->getHost());
                                 if($x[1]=='local'){
                                   $d='http://membership.local/en/subscribed/'.request()->getHost();
                                    }
                                    else{
                                    $d='http://ngefans.id/en/subscribed/'.request()->getHost();
                                    }
                             ?>
                             @if(strtolower($benefit['name'])!='silver')
                            <a href="#"
                                class="button button-rounded button-large ls0 t400 m-0 nott" style="background-color: #444;color: #FFF;
    text-shadow: 1px 1px 1px rgba(0,0,0,0.2);
}">Coming Soon</a>
                            @else
                            <a href="{{$d}}"
                                class="button button-rounded button-large ls0 t400 m-0 nott" style="background-color:#1ABC9C">Subscribe</a>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="section center nomargin" style="padding: 30px;">
                <p style="font-size: 1.4em;color: #737373;">already have an account?
                <a href="{{route('dashboard', $locale)}}">Login</a></p>
                <a href="#" class="button" onClick="$.magnificPopup.close();return false;">Close this</a>
            </div>
        </div>
    </div>
    @stop