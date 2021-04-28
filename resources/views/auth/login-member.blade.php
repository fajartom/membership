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

    	<section id="content" style="margin-bottom: 0px;">

    		<div class="content-wrap nopadding">

    			<div class="section nopadding nomargin" style="width: 100%; height: 100%; position: absolute; left: 0; top: 0; background: #444;"></div>

    			<div class="section nobg full-screen nopadding nomargin" style="height: 247px;">
    				<div class="container-fluid vertical-middle divcenter clearfix" style="position: absolute; top: 50%; width: 100%; padding-top: 0px; padding-bottom: 0px; margin-top: -359.5px;">

    					<div class="center">
    						
    					</div>

    					<div class="card divcenter noradius noborder" style="max-width: 400px;">
    						<div class="card-body" style="padding: 40px;">
    							<form id="login-form" class="nobottommargin">
    								<h3>Login to your ngefans account</h3>
    								<div id="wait" style="display:none;width:69px;height:89px;border:0px solid black;position:absolute;top:80%;left:40%;padding:2px;"><img src="{{asset('artist/images/preloader.gif')}}"></div>
    								<div class="col_full">
    									<label for="login-form-username">email:</label>
    									<input type="text" id="login-form-username" name="email" value="" class="form-control not-dark">
    									<input type="hidden" id="domain" name="domain" value="http://{{$_SERVER['SERVER_NAME']}}" class="form-control not-dark">
    								</div>

    								<div class="col_full">
    									<label for="login-form-password">password:</label>
    									<input type="password" id="login-form-password" name="password" value="" class="form-control not-dark">
    								</div>

    								<div class="col_full nobottommargin">
    									<a class="button button-3d button-black nomargin" id="login">Login</a>
    									<a href="#" class="fright">Forgot Password?</a>
    								</div>
    							</form>
    							<form id="nextform" hidden action="" method="POST">
    							<input type="hidden" name="token">
    							</form>
    						</div>
    					</div>
    				</div>
    			</div>
    		</div>
    	</section>
    	<script src="{{asset('artist/js/jquery.js')}}"></script>
    	<script src="{{asset('artist/js/plugins.js')}}"></script>
    	<script src="{{asset('artist/js/functions.js')}}"></script>
    	<script type="text/javascript">
    	   $(document).ajaxStart(function(){
    			$("#wait").css("display", "block");
  		   });
    	    $(document).ajaxComplete(function(){
    			$("#wait").css("display", "none");
  			});
    	 $("#login").click(function() {

    		var data = $('#login-form').serializeArray();
    		var domain = window.location.hostname;
    		var origin = domain.split('.');
    		console.log(origin[1]);
    		if(origin[1]=='local'){
    			var rest='http://membership.local';
    		}
    		else{
    			var rest='http://ngefans.id';
    		}
    	
			    $.post(rest+"/login-member", data,
			        function(data, status) {
			            var success = data.success;
			           if(success.status==true){
			           	alert('ok');
			            }
			    });
		});
    		
    	</script>
    </body>
    </html>