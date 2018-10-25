<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>Color Admin | Login Page</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />

    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href={{ asset("admin_doc/assets/plugins/jquery-ui/jquery-ui.min.css") }} rel="stylesheet" />
    <link href={{ asset("admin_doc/assets/plugins/bootstrap/4.0.0/css/bootstrap.min.css") }} rel="stylesheet" />
    <link href={{ asset("admin_doc/assets/plugins/font-awesome/5.0/css/fontawesome-all.min.css") }} rel="stylesheet" />
    <link href={{ asset("admin_doc/assets/plugins/animate/animate.min.css") }} rel="stylesheet" />
    <link href={{ asset("admin_doc/assets/css/transparent/style.min.css") }} rel="stylesheet" />
    <link href={{ asset("admin_doc/assets/css/transparent/style-responsive.min.css") }} rel="stylesheet" />
    <link href={{ asset("admin_doc/assets/css/transparent/theme/default.css") }} rel="stylesheet" id="theme" />
    <!-- ================== END BASE CSS STYLE ================== -->

    <!-- ================== BEGIN BASE JS ================== -->
    <script src={{ asset("admin_doc/assets/plugins/pace/pace.min.js")}}></script>
    <!-- ================== END BASE JS ================== -->
</head>
<body class="pace-top">
	
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade show"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	
	<div class="login-cover">
	    <div class="login-cover-image" style="background-image: url(../assets/img/login-bg/login-bg-17.jpg)" data-id="login-cover-image"></div>
	    <div class="login-cover-bg"></div>
	</div>
	<!-- begin #page-container -->
	<div id="page-container" class="fade">
	    <!-- begin login -->
        <div class="login login-v2" data-pageload-addclass="animated fadeIn">
            <!-- begin brand -->
            <div class="login-header">
                <div class="brand">
                    <span class="logo"></span> <b>Color</b> Admin
                    <small>responsive bootstrap 3 admin template</small>
                </div>
                <div class="icon">
                    <i class="fa fa-lock"></i>
                </div>
            </div>
            <!-- end brand -->
            <!-- begin login-content -->
            <div class="login-content">
                <form action="index.html" method="GET" class="margin-bottom-0">
                    <div class="form-group m-b-20">
                        <input type="text" class="form-control form-control-lg" placeholder="Email Address" required />
                    </div>
                    <div class="form-group m-b-20">
                        <input type="password" class="form-control form-control-lg" placeholder="Password" required />
                    </div>
                    <div class="checkbox checkbox-css m-b-20">
                        <input type="checkbox" id="remember_checkbox" />
                        <label for="remember_checkbox">
                        	Remember Me
                        </label>
                    </div>
                    <div class="login-buttons">
                        <button type="submit" class="btn btn-success btn-block btn-lg">Sign me in</button>
                    </div>
                    <div class="m-t-20">
                        Not a member yet? Click <a href="javascript:;">here</a> to register.
                    </div>
                </form>
            </div>
            <!-- end login-content -->
        </div>
        <!-- end login -->

        <ul class="login-bg-list clearfix">
            <li class="active"><a href="javascript:;" data-click="change-bg" data-img="../assets/img/login-bg/login-bg-17.jpg" style="background-image: url(../assets/img/login-bg/login-bg-17.jpg)"></a></li>
            <li><a href="javascript:;" data-click="change-bg" data-img="../assets/img/login-bg/login-bg-16.jpg" style="background-image: url(../assets/img/login-bg/login-bg-16.jpg)"></a></li>
            <li><a href="javascript:;" data-click="change-bg" data-img="../assets/img/login-bg/login-bg-15.jpg" style="background-image: url(../assets/img/login-bg/login-bg-15.jpg)"></a></li>
            <li><a href="javascript:;" data-click="change-bg" data-img="../assets/img/login-bg/login-bg-14.jpg" style="background-image: url(../assets/img/login-bg/login-bg-14.jpg)"></a></li>
            <li><a href="javascript:;" data-click="change-bg" data-img="../assets/img/login-bg/login-bg-13.jpg" style="background-image: url(../assets/img/login-bg/login-bg-13.jpg)"></a></li>
            <li><a href="javascript:;" data-click="change-bg" data-img="../assets/img/login-bg/login-bg-12.jpg" style="background-image: url(../assets/img/login-bg/login-bg-12.jpg)"></a></li>
        </ul>

        <!-- begin theme-panel -->
        @include('layouts.theme-panel')
        <!-- end theme-panel -->
	</div>
	<!-- end page container -->

    <!-- ================== BEGIN BASE JS ================== -->
    <script src={{ asset("admin_doc/assets/plugins/jquery/jquery-3.2.1.min.js") }}></script>
    <script src={{ asset("admin_doc/assets/plugins/jquery-ui/jquery-ui.min.js") }}></script>
    <script src={{ asset("admin_doc/assets/plugins/bootstrap/4.0.0/js/bootstrap.bundle.min.js") }}></script>
    <!--[if lt IE 9]>
    <script src={{ asset("admin_doc/assets/crossbrowserjs/html5shiv.js") }}></script>
    <script src={{ asset("admin_doc/assets/crossbrowserjs/respond.min.js") }}></script>
    <script src={{ asset("admin_doc/assets/crossbrowserjs/excanvas.min.js") }}></script>
    <![endif]-->
    <script src={{ asset("admin_doc/assets/plugins/slimscroll/jquery.slimscroll.min.js") }}></script>
    <script src={{ asset("admin_doc/assets/plugins/js-cookie/js.cookie.js") }}></script>
    <script src={{ asset("admin_doc/assets/js/theme/transparent.min.js") }}></script>
    <script src={{ asset("admin_doc/assets/js/apps.min.js") }}></script>
    <!-- ================== END BASE JS ================== -->

	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="../assets/js/demo/login-v2.demo.min.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->

	<script>
		$(document).ready(function() {
			App.init();
			LoginV2.init();
		});
	</script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-53034621-1', 'auto');
  ga('send', 'pageview');

</script>
</body>
</html>

