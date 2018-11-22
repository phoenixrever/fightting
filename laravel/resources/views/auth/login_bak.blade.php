@extends('layouts.login.login_layout')

@section("title")
    "登陆"
@stop
@section('body')
    <body class="pace-top">

    <!-- begin #page-loader -->
    <div id="page-loader" class="fade show"><span class="spinner"></span></div>
    <!-- end #page-loader -->

    <div class="login-cover">
        <div class="login-cover-image" style="background-image: url( {{$login_bg}}" data-id="login-cover-image"></div>
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
                <form method="POST" action="{{ route('login') }}" class="margin-bottom-0">
                    @csrf

                    @if ($errors->has('email'))
                        <div class="form-group form m-b-15">
                            <div class="note note-danger">
                                <div class="note-icon"><i class="fa fa-lightbulb"></i></div>
                                <div class="note-content">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="form-group m-b-15">
                        <!--
                        　　p~ul选择器 p之后出现的所有ul。
                               两种元素必须拥有相同的父元素，但是 ul不必直接紧随 p。
                               css3特有的选择器，A>B 表示选择A元素的所有子B元素。
                               与A B的区别在于，A B选择所有后代元素，而A>B只选择一代。
                                is-invalid~invalid-feedback  设置相同父元素厚度的feedback display:blocK
                        -->
                        <input type="email" name="email" class="form-control form-control-lg "
                               placeholder="Email Address" value="{{ old('email') }}" autofocus required/>
                    </div>

                    <div class="form-group m-b-15">
                        <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }} form-control-lg"
                               placeholder="Password" required/>

                        @if ($errors->has('password'))
                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif

                    </div>
                    <div class="checkbox checkbox-css m-b-30">
                        <input type="checkbox" id="remember_me_checkbox"
                               name="remember" {{ old('remember') ? 'checked' : '' }} />
                        <label for="remember_me_checkbox">
                            Remember Me
                        </label>
                    </div>
                    <div class="login-buttons">
                        <button type="submit" class="btn btn-primary btn-block btn-lg">Sign me in</button>
                    </div>
                    <div class="m-t-20 m-b-40 p-b-40">
                        Not a member yet? Click <a href="{{route("register")}}">here</a> to register.
                    </div>
                    {{--<div class="m-t-20 m-b-40 p-b-40">--}}
                        {{--<a class="btn btn-link" href="{{ route('password.request') }}">--}}
                            {{--{{ __('Forgot Your Password?') }}--}}
                        {{--</a>--}}
                    {{--</div>--}}
                    <hr/>
                    {{--<p class="text-center">--}}
                        {{--&copy; Color Admin All Right Reserved 2018--}}
                    {{--</p>--}}
                </form>
            </div>
            <!-- end login-content -->
        </div>
        <!-- end login -->

        {{--<ul class="login-bg-list clearfix">--}}
            {{--<li class="active"><a href="javascript:;" data-click="change-bg" data-img="admin_doc/assets/img/login-bg/login-bg-17.jpg" style="background-image: {{asset("admin_doc/assets/img/login-bg/login-bg-17.jpg")}}"></a></li>--}}
            {{--<li><a href="javascript:;" data-click="change-bg" data-img="admin_doc/assets/img/login-bg/login-bg-16.jpg" style="background-image: {{asset("admin_doc/assets/img/login-bg/login-bg-16.jpg")}}"></a></li>--}}
            {{--<li><a href="javascript:;" data-click="change-bg" data-img="admin_doc/assets/img/login-bg/login-bg-15.jpg" style="background-image: {{asset("admin_doc/assets/img/login-bg/login-bg-15.jpg")}}"></a></li>--}}
            {{--<li><a href="javascript:;" data-click="change-bg" data-img="admin_doc/assets/img/login-bg/login-bg-14.jpg" style="background-image: {{asset("admin_doc/assets/img/login-bg/login-bg-14.jpg")}}"></a></li>--}}
            {{--<li><a href="javascript:;" data-click="change-bg" data-img="admin_doc/assets/img/login-bg/login-bg-13.jpg" style="background-image: {{asset("admin_doc/assets/img/login-bg/login-bg-13.jpg")}}"></a></li>--}}
            {{--<li><a href="javascript:;" data-click="change-bg" data-img="admin_doc/assets/img/login-bg/login-bg-12.jpg" style="background-image: {{asset("admin_doc/assets/img/login-bg/login-bg-12.jpg")}}"></a></li>--}}
        {{--</ul>--}}


        <!-- begin theme-panel -->
    @include('layouts.theme-panel')
    <!-- end theme-panel -->
    </div>
    <!-- end page container -->
    @stop

    @section('other_script')
        <script>
            $(document).ready(function () {
                App.init();
            });
        </script>
    @stop