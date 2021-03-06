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
{{--<link href="/assets/css/default/style.min.css" rel="stylesheet" />--}}
{{--<link href="/assets/css/default/style-responsive.min.css" rel="stylesheet" />--}}
{{--<link href="/assets/css/default/theme/default.css" rel="stylesheet" id="theme" />--}}

<link href={{ asset("assets/css/transparent/style.css") }} rel="stylesheet" />
<link href={{ asset("assets/css/transparent/style-responsive.css") }} rel="stylesheet" />
<link href={{ asset("assets/css/transparent/theme/default.css") }} rel="stylesheet" id="theme" />

<link href={{ asset("assets/plugins/gritter/css/jquery.gritter.css") }} rel="stylesheet" id="theme" />
<link href={{ asset("assets/plugins/parsleyjs/src/parsley.css") }} rel="stylesheet" id="theme" />

<link href={{asset("assets/plugins/mark/datatables.mark.css")}} rel="stylesheet" id="theme" />
<!-- ================== END BASE CSS STYLE ================== -->

<link href="/assets/plugins/datatables/css/dataTables.bootstrap4.css" rel="stylesheet"/>
<link href={{asset("assets/plugins/datatables/css/buttons/buttons.bootstrap4.css")}} rel="stylesheet"/>
<link href="/assets/plugins/datatables/css/responsive/responsive.bootstrap4.css" rel="stylesheet"/>
<link href="/assets/plugins/datatables/css/select/select.bootstrap4.min.css" rel="stylesheet"/>
<link href="/assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
<link href="{{asset("load-awesome-1.1.0/docs/assets/loaders.css")}}" rel="stylesheet"/>
<link href={{ asset("css/layer.css")}} rel="stylesheet"/>
<link href="/css/transparent.css" rel="stylesheet"/>


<!-- ================== BEGIN BASE JS ================== -->
<script src="/assets/plugins/pace/pace.min.js"></script>
<!-- ================== END BASE JS ================== -->

@yield('css')
