<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
    <meta charset="utf-8" />
    <title>@yield("title","仪表板")</title>
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

    @yield('other_head')

</head>

@yield('body')


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

@yield('other_script')

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