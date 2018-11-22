<meta charset="utf-8" />
<title id="page-title">Color Admin | @yield('title')</title>
<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
<meta http-equiv="x-pjax-version">
<meta content="" name="description" />
<meta content="" name="author" />

<!-- ================== BEGIN BASE CSS STYLE ================== -->
{{--<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />--}}
<link href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" rel="stylesheet" />
<link href="/assets/css/bundle.css" rel="stylesheet" />

<link href={{ asset("assets/css/transparent/style.css") }} rel="stylesheet" />
<link href={{ asset("assets/css/transparent/style-responsive.css") }} rel="stylesheet" />
<link href={{ asset("assets/css/transparent/theme/default.css") }} rel="stylesheet" id="theme" />

<link href={{ asset("assets/plugins/gritter/css/jquery.gritter.css") }} rel="stylesheet" id="theme" />
<link href={{ asset("assets/plugins/parsleyjs/src/parsley.css") }} rel="stylesheet" id="theme" />
<link href={{ asset("assets/plugins/jquery-emoji/dist/css/jquery.emoji.css") }} rel="stylesheet" id="theme" />
<link href={{ asset("assets/plugins/jquery-emoji/src/css/jquery.mCustomScrollbar.css") }} rel="stylesheet" id="theme" />

<link href="{{asset("load-awesome-1.1.0/docs/assets/loaders.css")}}" rel="stylesheet"/>
<link href={{ asset("css/layer.css")}} rel="stylesheet"/>
<link href="/css/transparent.css" rel="stylesheet"/>

<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
<link href={{ asset("frontend_assets/css/forum.css") }} rel="stylesheet"/>
<link href={{ asset("frontend_assets/css/category.css") }} rel="stylesheet"/>
<link href="/assets/plugins/lightbox2/css/lightbox.css" rel="stylesheet" />
<link href="{{asset("frontend_assets/css/count.css")}}" rel="stylesheet"/>
{{--<link href="{{asset("assets/plugins/jquery-emoji/src/css/jquery.emoji.css")}}" rel="stylesheet"/>--}}
{{--<link href="{{asset("assets/plugins/simplePagination/simplePagination.css")}}" rel="stylesheet"/>--}}
<!-- ================== END PAGE LEVEL STYLE ================== -->

<!-- ================== BEGIN BASE JS ================== -->
<script src="/assets/plugins/pace/pace.min.js"></script>
<!-- ================== END BASE JS ================== -->

@yield('css')
