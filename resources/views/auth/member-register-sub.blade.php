<html dir="ltr" lang="en-US">

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="author" content="SemiColonWeb" />
    <!-- Stylesheets ============================================= -->
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
    <section id="content" style="margin-bottom: 0px;">
        <h1 class="text-center mt-5">Hi Fans, Create Account Before Subscribe Your Artist !</h2>
            <div class="content-wrap">
                <div class="container clearfix">
                    <div id="processTabs" class="ui-tabs ui-corner-all ui-widget ui-widget-content">
                        <ul class="process-steps bottommargin clearfix ui-tabs-nav ui-corner-all ui-helper-reset ui-helper-clearfix ui-widget-header"
                            role="tablist">
                            <li role="tab" tabindex="0"
                                class="ui-tabs-tab ui-corner-top ui-state-default ui-tab ui-tabs-active ui-state-active"
                                aria-controls="ptab1" aria-labelledby="ui-id-1" aria-selected="true"
                                aria-expanded="true">
                                <a href="#ptab1" class="i-circled i-bordered i-alt divcenter ui-tabs-anchor"
                                    role="presentation" tabindex="-1" id="ui-id-1">1</a>
                                <h5>
                                    Create Account
                                </h5>
                            </li>
                            <li role="tab" tabindex="-1" class="ui-tabs-tab ui-corner-top ui-state-default ui-tab"
                                aria-controls="ptab2" aria-labelledby="ui-id-2" aria-selected="false"
                                aria-expanded="false">
                                <a href="#ptab2" class="i-circled i-bordered i-alt divcenter ui-tabs-anchor"
                                    role="presentation" tabindex="-1" id="ui-id-2">2</a>
                                <h5>Select Member Type</h5>
                            </li>
                            <li role="tab" tabindex="-1" class="ui-tabs-tab ui-corner-top ui-state-default ui-tab"
                                aria-controls="ptab3" aria-labelledby="ui-id-3" aria-selected="false"
                                aria-expanded="false">
                                <a href="#ptab3" class="i-circled i-bordered i-alt divcenter ui-tabs-anchor"
                                    role="presentation" tabindex="-1" id="ui-id-3">3</a>
                                <h5>Complete Payment</h5>
                            </li>
                            <li role="tab" tabindex="-1" class="ui-tabs-tab ui-corner-top ui-state-default ui-tab"
                                aria-controls="ptab4" aria-labelledby="ui-id-4" aria-selected="false"
                                aria-expanded="false">
                                <a href="#ptab4" class="i-circled i-bordered i-alt divcenter ui-tabs-anchor"
                                    role="presentation" tabindex="-1" id="ui-id-4">4</a>
                                <h5>Order Complete</h5>
                            </li>
                        </ul>
                        <div id="ptab1" aria-labelledby="ui-id-1" role="tabpanel"
                            class="ui-tabs-panel ui-corner-bottom ui-widget-content justify-content-center"
                            aria-hidden="false">
                            <div class="postcontent">
                                <form class="offset-lg-1">
                                    <div id="emailInfo"></div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="Email1">Email address</label>
                                                <input type="hidden" name="domain" class="form-control"
                                                    value="{{$domain}}" id="domain" aria-describedby="nameHelp"
                                                    placeholder="domain" required>
                                                <input type="hidden" name="locale" class="form-control"
                                                    value="{{$locale}}" id="locale" aria-describedby="nameHelp"
                                                    placeholder="domain" required>
                                                <input type="email" name="email" class="form-control" id="Email1"
                                                    aria-describedby="emailHelp" placeholder="Enter email" required>
                                                <small id="emailHelp" class="form-text text-muted">your email.</small>
                                            </div>
                                            <div class="form-group">
                                                <label for="Password1">Password</label>
                                                <input type="password" name="password" class="form-control"
                                                    id="Password1" placeholder="Password" required>
                                                <small id="passwordHelp" class="form-text text-muted">your
                                                    password.</small>
                                            </div>
                                            <div class="form-group">
                                                <label for="Password2">Confirm Password</label>
                                                <input type="password" name="confirm_password" class="form-control"
                                                    id="Password12" placeholder="Confim Password" required>
                                                <small id="confirm_passwordHelp" class="form-text text-muted">same
                                                    password.</small>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 offset-lg-2">
                                            <div class="form-group">
                                                <label for="Name1">Name</label>
                                                <input type="name" name="name" class="form-control" id="Name1"
                                                    aria-describedby="nameHelp" placeholder="Enter name" required>
                                                <small id="nameHelp" class="form-text text-muted">your name.</small>
                                            </div>
                                            <div class="form-group">
                                                <label for="Gender">Gender</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="gender"
                                                        id="gridRadios1" value="1">
                                                    <label class="form-check-label" for="gridRadios1">
                                                        Men
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="gender"
                                                        id="gridRadios2" value="2">
                                                    <label class="form-check-label" for="gridRadios2">
                                                        Women
                                                    </label>
                                                </div>
                                                <small id="genderHelp" class="form-text text-muted">your gender.</small>
                                            </div>
                                            <div class="form-group">
                                                <label for="Dob">Date of Birth</label>
                                                <input type="date" name="dob" class="form-control" id="dob"
                                                    aria-describedby="dob" required>
                                                <small id="dobHelp" class="form-text text-muted">your date of
                                                    birth.</small>
                                            </div>
                                            <div class="form-group">
                                                <label for="Pob">Place of Birth</label>
                                                <input type="text" name="pob" placeholder="Place of birth"
                                                    class="form-control" id="pob" aria-describedby="pob" required>
                                                <small id="pobHelp" class="form-text text-muted">your place of
                                                    birth.</small>
                                            </div>
                                            <div class="form-group">
                                                <label for="province">Province</label>
                                                <select id="province" name="province" class="form-control">
                                                    <option value="">Select Province...</option>
                                                    @foreach($provinces as $key => $value)
                                                    <option value="{{$value->id_province}}">{{$value->name}}</option>
                                                    @endforeach
                                                </select>
                                                <small id="provinceHelp" class="form-text text-muted">your
                                                    province.</small>
                                            </div>
                                            <div class="form-group">
                                                <label for="city">city</label>
                                                <select id="city" name="city" class="form-control">
                                                </select>
                                                <small id="cityHelp" class="form-text text-muted">your city.</small>
                                            </div>
                                            <div class="form-group">
                                                <label for="Phone">Phone Number</label>
                                                <input type="text" class="form-control" name="phone_number" id="Phone"
                                                    placeholder="Phone Number" required>
                                                <small id="phoneHelp" class="form-text text-muted">your phone
                                                    number.</small>
                                            </div>
                                            <div class="form-group">
                                                <label for="Address">Address</label>
                                                <input type="text" name="address" class="form-control" id="Address"
                                                    aria-describedby="emailHelp" placeholder="Enter Address" required>
                                                <small id="addressHelp" class="form-text text-muted">your
                                                    address.</small>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <a href="#" class="button button-3d nomargin fright tab-linker" id="next" rel="2">Next ⇒</a>
                        </div>
                        <div id="ptab2" aria-labelledby="ui-id-2" role="tabpanel"
                            class="ui-tabs-panel ui-corner-bottom ui-widget-content justify-content-center"
                            aria-hidden="true" style="display: none;">
                            <div id="register-info"></div>
                            <h4>Select Your Membership ! </h4>
                            <div id="subs">
                            </div>
                            <a href="#" class="button button-3d nomargin tab-linker" rel="1" id="prev">Previous</a>
                            <a href="#" class="button button-rounded button-large ls0 t400 m-0 nott tab-linker"
                                id="succ" rel="3">Subscribe</a>
                            <div class="line"></div>
                        </div>
                        <div id="ptab3" aria-labelledby="ui-id-3" role="tabpanel"
                            class="ui-tabs-panel ui-corner-bottom ui-widget-content" aria-hidden="true"
                            style="display: none;">
                            <h4>Select Your Payment ! </h4>
                            <div id="pays">
                            </div>
                            <a href="#" class="button button-rounded button-large ls0 t400 m-0 nott tab-linker"
                                style="display:none;" id="succ2" rel="4"></a>
                            <div class="line"></div>

                        </div>
                        <div id="ptab4" aria-labelledby="ui-id-4" role="tabpanel"
                            class="ui-tabs-panel ui-corner-bottom ui-widget-content" aria-hidden="true"
                            style="display: none;">
                            <div class="alert alert-success">
                                <div id="thanks"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
            </div>

    </section>
    <script src="{{asset('artist/js/jquery.js')}}"></script>
    <script src="{{asset('artist/js/plugins.js')}}"></script>

    <!-- Footer Scripts
       ============================================= -->
    <script src="{{asset('artist/js/functions.js')}}"></script>
    <script>
    $(function() {
        $('#prev').hide();
        $("#processTabs").tabs({
            show: {
                effect: "fade",
                duration: 400
            }
        });
        $(".tab-linker").click(function() {
            $("#processTabs").tabs("option", "active", $(this).attr('rel') - 1);
            return false;
        });
    });
    $(document).ready(function() {
        $('select[name="province"]').on('change', function() {
            var stateID = $(this).val();
            if (stateID) {
                $.ajax({
                    url: '/api/city/' + stateID,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="city"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="city"]').append('<option value="' +
                                value.id_city + '">' + value.name + '</option>');
                        });
                    }
                });
            } else {
                $('select[name="city"]').empty();
            }
        });
    });

    $("#next").click(function() {
        var data = $('form').serializeArray();
        $.post("/api/register/", data,
            function(data, status) {
                if (data.error) {
                    if (data.error.name) {
                        $(document).ready(function() {
                            setTimeout(() => {
                                $('#prev').click();
                                $('#nameHelp').html("<font color='red'>" + data.error.name[
                                    0] + "</font>");
                                $("input[name=name]").css({
                                    "border-color": "red"
                                });
                            }, 300);
                        });
                    }
                    if (data.error.email) {
                        $(document).ready(function() {
                            setTimeout(() => {
                                $('#prev').click();
                                $('#emailHelp').html("<font color='red'>" + data.error
                                    .email[0] + "</font>");
                                $('#emailInfo').html(
                                    "<h5 align='left'>Allready have account.<a href='#'><font color='green'> Login ?</font></a></h5>"
                                );
                                $("input[name=email]").css({
                                    "border-color": "red"
                                });
                            }, 300);
                        });
                    }
                    if (data.error.address) {
                        $(document).ready(function() {
                            setTimeout(() => {
                                $('#prev').click();
                                $('#addressHelp').html("<font color='red'>" + data.error
                                    .address[0] + "</font>");
                                $("input[name=address]").css({
                                    "border-color": "red"
                                });
                            }, 300);
                        });
                    }
                    if (data.error.phone_number) {
                        $(document).ready(function() {
                            setTimeout(() => {
                                $('#prev').click();
                                $('#phoneHelp').html("<font color='red'>" + data.error
                                    .phone_number[0] + "</font>");
                                $("input[name=phone_number]").css({
                                    "border-color": "red"
                                });
                            }, 300);
                        });
                    }
                    if (data.error.pob) {
                        $(document).ready(function() {
                            setTimeout(() => {
                                $('#prev').click();
                                $('#pobHelp').html("<font color='red'>" + data.error
                                    .pob[0] + "</font>");
                                $("input[name=pob]").css({
                                    "border-color": "red"
                                });
                            }, 300);
                        });
                    }
                    if (data.error.city) {
                        $(document).ready(function() {
                            setTimeout(() => {
                                $('#prev').click();
                                $('#cityHelp').html("<font color='red'>" + data.error
                                    .city[0] + "</font>");
                                $("input[name=city]").css({
                                    "border-color": "red"
                                });
                            }, 300);
                        });
                    }
                    if (data.error.province) {
                        $(document).ready(function() {
                            setTimeout(() => {
                                $('#prev').click();
                                $('#provinceHelp').html("<font color='red'>" + data.error
                                    .province[0] + "</font>");
                                $("input[name=province]").css({
                                    "border-color": "red"
                                });
                            }, 300);
                        });
                    }
                    if (data.error.gender) {
                        $(document).ready(function() {
                            setTimeout(() => {
                                $('#prev').click();
                                $('#genderHelp').html("<font color='red'>" + data.error
                                    .gender[0] + "</font>");
                                $("input[name=gender]").css({
                                    "border-color": "red"
                                });
                            }, 300);
                        });
                    }
                    if (data.error.dob) {
                        $(document).ready(function() {
                            setTimeout(() => {
                                $('#prev').click();
                                $('#dobHelp').html("<font color='red'>" + data.error
                                    .dob[0] + "</font>");
                                $("input[name=dob]").css({
                                    "border-color": "red"
                                });
                            }, 300);
                        });
                    }
                    if (data.error.confirm_password) {
                        $(document).ready(function() {
                            setTimeout(() => {
                                $('#prev').click();
                                $('#confirm_passwordHelp').html("<font color='red'>" + data
                                    .error.confirm_password[0] + "</font>");
                                $("input[name=confirm_password]").css({
                                    "border-color": "red"
                                });
                            }, 300);
                        });
                    }
                    if (data.error.password) {
                        $(document).ready(function() {
                            setTimeout(() => {
                                $('#prev').click();
                                $('#passwordHelp').html("<font color='red'>" + data
                                    .error.password[0] + "</font>");
                                $("input[name=password]").css({
                                    "border-color": "red"
                                });
                            }, 300);
                        });
                    }
                } else {
                    var success = data.success;
                    /* $(document).ready(function() {
                         setTimeout(() => {
                             $("#getCodeModal").modal('show');
                         }, 300);

                     });*/

                    if (success.status == true) {
                        if (data.success.status == true) {
                            var success = data.success;
                            console.log(success);
                            $(document).ready(function() {
                                $('#prev').hide();
                                $('#succ').hide();
                                $('#subs').html(success.subscribtion);
                                localStorage.setItem('key', success.token);
                            });
                        }
                    }
                }
            }
        )
    });
    </script>
    <!-- ADD-ONS JS FILES -->
</body>

</html>