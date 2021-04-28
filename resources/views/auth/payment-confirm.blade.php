<html dir="ltr" lang="en-US">

<head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="author" content="SemiColonWeb" />

    <!-- Stylesheets
        ============================================= -->
        <link
        href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700|Raleway:300,400,500,600,700|Crete+Round:400i"
        rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="{{asset('artist/css/bootstrap.css')}}" type="text/css" />
        <link rel="stylesheet" href="{{asset('artist/css/style.css')}}" type="text/css" />
        <link rel="stylesheet" href="{{asset('artist/css/dark.css')}}" type="text/css" />
        <link rel="stylesheet" href="{{asset('artist/css/font-icons.css')}}" type="text/css" />
        <link rel="stylesheet" href="{{asset('artist/css/animate.css')}}" type="text/css" />
        <link rel="stylesheet" href="{{asset('artist/css/magnific-popup.css')}}" type="text/css" />
        <link rel="stylesheet" href="{{asset('artist/css/responsive.css')}}" type="text/css" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <!-- Modern Blog Demo Specific Stylesheet -->

        <style>
            .process-steps li {
                pointer-events: none;
            }
        </style>

        <style id="fit-vids-style">
            .fluid-width-video-wrapper {
                width: 100%;
                position: relative;
                padding: 0;
            }

            .fluid-width-video-wrapper iframe,
            .fluid-width-video-wrapper object,
            .fluid-width-video-wrapper embed {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
            }
        </style>
    </head>

    <body class="stretched device-xl">
        <section id="content" class="mt-5" style="margin-bottom: 0px;">
<div class="row justify-content-center">
    <div class="col-lg-4 col-md-4 mt-4 mt-md-0">
        <div class="card text-center">
            <div class="card-body py-4">
                <h3 class="card-title t400">Hi, {{$payment->customer}}</h3>
                <h4 class="card-title t400">Please Complete this invoice :  <font style="font-family:calibri;color:red">{{ $payment->invoice }}</font></h3>
            </div>
            <div class="line my-1"></div>
            <div class="card-body py-4">
                <p class="card-text pricing-sub t600">Payment Method : {!!  $payment->payment_method_name !!}</p>
                <p class="card-text pricing-sub t600">Total : Rp.{{number_format($payment->total_amount, 0, ".", ".")}}</p>
                <p class="card-text pricing-sub t600">Artist : {!! $payment->artist_name !!}</p>
                <p class="card-text pricing-sub t600">Expired : {!! $payment->date_expired !!}</p>
                <strong>Thank You.</strong> Your order has processed once we verify the Payment !. <br>Go to <a href="http://{{$domain}}">{{$domain}}</a>
                <p class="mt-5"> This Website Powered By <a href="http://ngefans.id"    >Ngefans.id</a></p>
            </div>
        </div>
    </div>
</div>
</section>
<script src="{{asset('artist/js/jquery.js')}}"></script>
<script src="{{asset('artist/js/plugins.js')}}"></script>

    <!-- Footer Scripts
       ============================================= -->
       <script src="{{asset('artist/js/functions.js')}}"></script>
</body>
</html>