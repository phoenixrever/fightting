@extends('layouts.default')

@section('title', 'fourm')

@section('css')
    <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
    <link href={{ asset("frontend_assets/css/forum.css") }} rel="stylesheet"/>
    <!-- ================== END PAGE LEVEL STYLE ================== -->
@endsection

@section('content')
    <!-- begin search-banner -->
    <div class="search-banner has-bg m-t-50">
    {{--<div class="search-banner">--}}
        {{--<!-- begin bg-cover -->--}}
        {{--<div class="bg-cover"><img src="{{url("frontend_assets/img/cover/cover-5.jpg")}}" alt=""/></div>--}}
        {{--<!-- end bg-cover -->--}}
        {{--<!-- begin container -->--}}
        <div class="container">
            <h1>1,293 Post for discussion</h1>
            <form class="m-b-20">
                <div class="form-group">
                    <input type="text" class="form-control  input-lg" placeholder="Search the forums"/>
                    <button type="submit" class="btn btn-search"><i class="fas fa-search fa-lg"></i></button>
                </div>
            </form>
            <h5>Browse by Popular Categories</h5>
            <ul class="popular-tags">
                <li><a href="#"><i class="fa fa-circle text-danger"></i> CSS</a></li>
                <li><a href="#"><i class="fa fa-circle text-primary"></i> Bootstrap</a></li>
                <li><a href="#"><i class="fa fa-circle text-warning"></i> Javascript</a></li>
                <li><a href="#"><i class="fa fa-circle"></i> jQuery</a></li>
                <li><a href="#"><i class="fa fa-circle text-success"></i> Android</a></li>
                <li><a href="#"><i class="fa fa-circle text-muted"></i> iOS</a></li>
                <li><a href="#"><i class="fa fa-circle text-purple"></i> Template</a></li>
            </ul>
        </div>
        <!-- end container -->
    </div>
    <!-- end search-banner -->

    <div class="container">
        <!-- begin  -->
        <div class="col-md-10">
            <div class="panel panel-inverse">
                <!-- begin panel-heading -->
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default"
                           data-click="panel-expand"><i
                                    class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success"
                           data-click="panel-reload"><i
                                    class="fa fa-redo"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning"
                           data-click="panel-collapse"><i
                                    class="fa fa-minus"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger"
                           data-click="panel-remove"><i
                                    class="fa fa-times"></i></a>
                    </div>
                    <h4 class="panel-title">Official Management District</h4>
                </div>
                <!-- end panel-heading -->
                <!-- begin panel-body -->
                <div class="panel-body">
                    <ul class="forum-list">
                        <li>
                            <!-- begin media -->
                            <div class="media">
                                <img src="{{url("frontend_assets/img/icon/icon-gold-note.png")}}" alt=""/>
                            </div>
                            <!-- end media -->
                            <!-- begin info-container -->
                            <div class="info-container">
                                <div class="info">
                                    <h4 class="title"><a href="category_list.html">Announcement</a></h4>
                                    <p class="desc">
                                        The latest official news, events , announcements, updates and other information
                                        released .
                                    </p>
                                </div>
                                <div class="total-count">
                                    <span class="total-post">1,293</span> <span class="divider">/</span> <span
                                            class="total-comment">9,291</span>
                                </div>
                                <div class="latest-post">
                                    <h4 class="title"><a href="category_list.html">Migrate from jQuery 1.8.x to jQuery
                                            2.0.x</a></h4>
                                    <p class="time">Yesterday 10:49pm <a href="category_list.html"
                                                                         class="user">admin</a></p>
                                </div>
                            </div>
                            <!-- end info-container -->
                        </li>
                        <li>
                            <!-- begin media -->
                            <div class="media">
                                <img src="{{url("frontend_assets/img/icon/icon-cone.png")}}" alt=""/>
                            </div>
                            <!-- end media -->
                            <!-- begin info-container -->
                            <div class="info-container">
                                <div class="info">
                                    <h4 class="title"><a href="category_list.html">Bug / Suggestion</a></h4>
                                    <p class="desc">
                                        Template development proposals, content-related complaints and bug submission.
                                    </p>
                                </div>
                                <div class="total-count">
                                    <span class="total-post">1,293</span> <span class="divider">/</span> <span
                                            class="total-comment">9,291</span>
                                </div>
                                <div class="latest-post">
                                    <h4 class="title"><a href="category_list.html">Migrate from jQuery 1.8.x to jQuery
                                            2.0.x</a></h4>
                                    <p class="time">Yesterday 10:49pm <a href="category_list.html"
                                                                         class="user">admin</a></p>
                                </div>
                            </div>
                            <!-- end info-container -->
                        </li>
                    </ul>
                </div>
                <!-- end panel-body -->
            </div>
            <div class="panel panel-inverse ">
                <!-- begin panel-heading -->
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default"
                           data-click="panel-expand"><i
                                    class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success"
                           data-click="panel-reload"><i
                                    class="fa fa-redo"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning"
                           data-click="panel-collapse"><i
                                    class="fa fa-minus"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger"
                           data-click="panel-remove"><i
                                    class="fa fa-times"></i></a>
                    </div>
                    <h4 class="panel-title">Official Management District</h4>
                </div>
                <!-- end panel-heading -->
                <!-- begin panel-body -->
                <div class="panel-body">
                    <ul class="forum-list">
                        <li>
                            <!-- begin media -->
                            <div class="media">
                                <img src="{{url("frontend_assets/img/icon/icon-chat-bubble.png")}}" alt=""/>
                            </div>
                            <!-- end media -->
                            <!-- begin info-container -->
                            <div class="info-container">
                                <div class="info">
                                    <h4 class="title"><a href="category_list.html">Announcement</a></h4>
                                    <p class="desc">
                                        The latest official news, events , announcements, updates and other information
                                        released .
                                    </p>
                                </div>
                                <div class="total-count">
                                    <span class="total-post">1,293</span> <span class="divider">/</span> <span
                                            class="total-comment">9,291</span>
                                </div>
                                <div class="latest-post">
                                    <h4 class="title"><a href="category_list.html">Migrate from jQuery 1.8.x to jQuery
                                            2.0.x</a></h4>
                                    <p class="time">Yesterday 10:49pm <a href="category_list.html"
                                                                         class="user">admin</a></p>
                                </div>
                            </div>
                            <!-- end info-container -->
                        </li>
                        <li>
                            <!-- begin media -->
                            <div class="media">
                                <img src="{{url("frontend_assets/img/icon/icon-chat-bubble.png")}}" alt=""/>
                            </div>
                            <!-- end media -->
                            <!-- begin info-container -->
                            <div class="info-container">
                                <div class="info">
                                    <h4 class="title"><a href="category_list.html">Bug / Suggestion</a></h4>
                                    <p class="desc">
                                        Template development proposals, content-related complaints and bug submission.
                                    </p>
                                </div>
                                <div class="total-count">
                                    <span class="total-post">1,293</span> <span class="divider">/</span> <span
                                            class="total-comment">9,291</span>
                                </div>
                                <div class="latest-post">
                                    <h4 class="title"><a href="category_list.html">Migrate from jQuery 1.8.x to jQuery
                                            2.0.x</a></h4>
                                    <p class="time">Yesterday 10:49pm <a href="category_list.html"
                                                                         class="user">admin</a></p>
                                </div>
                            </div>
                            <!-- end info-container -->
                        </li>
                        <li>
                            <!-- begin media -->
                            <div class="media">
                                <img src="{{url("frontend_assets/img/icon/icon-chat-bubble.png")}}" alt=""/>
                            </div>
                            <!-- end media -->
                            <!-- begin info-container -->
                            <div class="info-container">
                                <div class="info">
                                    <h4 class="title"><a href="category_list.html">Bug / Suggestion</a></h4>
                                    <p class="desc">
                                        Template development proposals, content-related complaints and bug submission.
                                    </p>
                                </div>
                                <div class="total-count">
                                    <span class="total-post">1,293</span> <span class="divider">/</span> <span
                                            class="total-comment">9,291</span>
                                </div>
                                <div class="latest-post">
                                    <h4 class="title"><a href="category_list.html">Migrate from jQuery 1.8.x to jQuery
                                            2.0.x</a></h4>
                                    <p class="time">Yesterday 10:49pm <a href="category_list.html"
                                                                         class="user">admin</a></p>
                                </div>
                            </div>
                            <!-- end info-container -->
                        </li>
                    </ul>
                </div>
                <!-- end panel-body -->
            </div>
            <div class="panel panel-inverse ">
                <!-- begin panel-heading -->
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default"
                           data-click="panel-expand"><i
                                    class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success"
                           data-click="panel-reload"><i
                                    class="fa fa-redo"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning"
                           data-click="panel-collapse"><i
                                    class="fa fa-minus"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger"
                           data-click="panel-remove"><i
                                    class="fa fa-times"></i></a>
                    </div>
                    <h4 class="panel-title">Official Management District</h4>
                </div>
                <!-- end panel-heading -->
                <!-- begin panel-body -->
                <div class="panel-body">
                    <ul class="forum-list">
                        <li>
                            <!-- begin media -->
                            <div class="media">
                                <img src="{{url("frontend_assets/img/icon/icon-gold-note.png")}}" alt=""/>
                            </div>
                            <!-- end media -->
                            <!-- begin info-container -->
                            <div class="info-container">
                                <div class="info">
                                    <h4 class="title"><a href="category_list.html">Announcement</a></h4>
                                    <p class="desc">
                                        The latest official news, events , announcements, updates and other information
                                        released .
                                    </p>
                                </div>
                                <div class="total-count">
                                    <span class="total-post">1,293</span> <span class="divider">/</span> <span
                                            class="total-comment">9,291</span>
                                </div>
                                <div class="latest-post">
                                    <h4 class="title"><a href="category_list.html">Migrate from jQuery 1.8.x to jQuery
                                            2.0.x</a></h4>
                                    <p class="time">Yesterday 10:49pm <a href="category_list.html"
                                                                         class="user">admin</a></p>
                                </div>
                            </div>
                            <!-- end info-container -->
                        </li>
                        <li>
                            <!-- begin media -->
                            <div class="media">
                                <img src="{{url("frontend_assets/img/icon/icon-cone.png")}}" alt=""/>
                            </div>
                            <!-- end media -->
                            <!-- begin info-container -->
                            <div class="info-container">
                                <div class="info">
                                    <h4 class="title"><a href="category_list.html">Bug / Suggestion</a></h4>
                                    <p class="desc">
                                        Template development proposals, content-related complaints and bug submission.
                                    </p>
                                </div>
                                <div class="total-count">
                                    <span class="total-post">1,293</span> <span class="divider">/</span> <span
                                            class="total-comment">9,291</span>
                                </div>
                                <div class="latest-post">
                                    <h4 class="title"><a href="category_list.html">Migrate from jQuery 1.8.x to jQuery
                                            2.0.x</a></h4>
                                    <p class="time">Yesterday 10:49pm <a href="category_list.html"
                                                                         class="user">admin</a></p>
                                </div>
                            </div>
                            <!-- end info-container -->
                        </li>
                    </ul>
                </div>
                <!-- end panel-body -->
            </div>
        </div>
    </div>


    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
@endsection

@section('scripts')

    <script>
        $(document).ready(function () {
            // $(window).on('scroll', function() {
            //     var totalScrollTop = $(window).scrollTop();
            //     if (totalScrollTop >= 50){
            //         $('#header').addClass('navbar-sm');
            //     } else {
            //         $('#header').removeClass('navbar-sm');
            //     }
            // });
            $(window).on("scroll load", function () {
                if ($(window).scrollTop() > 20) {
                    $("#header").addClass("navbar-sm")
                } else {
                    $("#header").removeClass("navbar-sm")
                }
            });
        });
    </script>
@endsection

