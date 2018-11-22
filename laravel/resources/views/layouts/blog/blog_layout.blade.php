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
{{--    <link href={{ asset("admin_doc/assets/plugins/bootstrap/4.0.0/css/bootstrap.min.css") }} rel="stylesheet" />--}}
    <link href={{ asset("frontend/assets/plugins/bootstrap3/css/bootstrap.min.css") }} rel="stylesheet" />
    <link href={{ asset("admin_doc/assets/plugins/font-awesome/5.0/css/fontawesome-all.min.css") }} rel="stylesheet" />
    <link href={{ asset("admin_doc/assets/plugins/animate/animate.min.css") }} rel="stylesheet" />
    <link href={{ asset("frontend/assets/css/blog/style.min.css") }} rel="stylesheet" />
    <link href={{ asset("frontend/assets/css/blog/style-responsive.min.css") }} rel="stylesheet" />
    <link href={{ asset("frontend/assets/css/blog/theme/default.css") }} rel="stylesheet" id="theme" />
    <!-- ================== END BASE CSS STYLE ================== -->

    <!-- ================== BEGIN BASE JS ================== -->
    <script src={{ asset("admin_doc/assets/plugins/pace/pace.min.js")}}></script>
    <!-- ================== END BASE JS ================== -->

    @yield('other_head')

</head>
<body>

@include('layouts.blog.header')
@yield('content')

@include('layouts.blog.footer')
<!-- ================== BEGIN BASE JS ================== -->
<script src={{ asset("admin_doc/assets/plugins/jquery/jquery-3.2.1.min.js") }}></script>
<script src={{ asset("admin_doc/assets/plugins/bootstrap/4.0.0/js/bootstrap.bundle.min.js") }}></script>
<!--[if lt IE 9]>
<script src={{ asset("admin_doc/assets/crossbrowserjs/html5shiv.js") }}></script>
<script src={{ asset("admin_doc/assets/crossbrowserjs/respond.min.js") }}></script>
<script src={{ asset("admin_doc/assets/crossbrowserjs/excanvas.min.js") }}></script>
<![endif]-->
<script src={{ asset("admin_doc/assets/plugins/js-cookie/js.cookie.js") }}></script>
<script src={{ asset("frontend/assets/js/blog/apps.min.js") }}></script>
<!-- ================== END BASE JS ================== -->

@yield('other_script')

</body>
</html>