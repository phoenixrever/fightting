@extends('layouts.blog.blog_layout')

@section('tiitle')
    浴火重生
@stop

@section('content')
<!-- begin #page-title -->
    <div id="page-title" class="page-title has-bg">
        <div class="bg-cover"><img src="frontend/assets/img/cover/cover-5.jpg" alt="" /></div>
        <div class="container">
            <h1>Official Color Admin Blog</h1>
            <p>Blog Concept Front End Page</p>
        </div>
    </div>
    <!-- end #page-title -->

    <!-- begin #content -->
    <div id="content" class="content">
        <!-- begin container -->
        <div class="container">
            <!-- begin row -->
            <div class="row row-space-30">
                <!-- begin col-9 -->
                <div class="col-md-9">
                    <!-- begin post-list -->
                    <ul class="post-list">

                        @foreach($blogs as $blog)
                        <li>
                            <!-- begin post-left-info -->
                            <div class="post-left-info">
                                <div class="post-date">
                                    <span class="day">{{$blog->created_at->day}}</span>
                                    <span class="month">{{substr($blog->created_at->toFormattedDateString(),0,3)}}</span>
                                </div>
                                <div class="post-likes">
                                    <i class="fa fa-heart-o"></i>
                                    <span class="number">1,292</span>
                                </div>
                            </div>
                            <!-- end post-left-info -->
                            <!-- begin post-content -->
                            <div class="post-content">
                                <!-- begin post-image -->
                                {{--<div class="post-image post-image-with-carousel ">--}}
                                    {{--<!-- begin carousel -->--}}
                                    {{--<div id="carousel-post" class="carousel slide" data-ride="carousel">--}}
                                        {{--<!-- begin carousel-indicators -->--}}
                                        {{--<ol class="carousel-indicators">--}}
                                            {{--@for($i=0;$i<count($imgs);$i++)--}}
                                                {{--<li data-target="#carousel-post" data-slide-to={{$i}} class={{$i==0?"active":''}}></li>--}}
                                            {{--@endfor--}}
                                        {{--</ol>--}}
                                        {{--<!-- end carousel-indicators -->--}}
                                        {{--<!-- begin carousel-inner -->--}}
                                        {{--<div class="carousel-inner">--}}
                                            {{--@foreach($imgs  as $imgs)--}}
                                                {{--<div class="item {{$loop->iteration==1?'active':''}}">--}}
                                                    {{--<a href="post_detail.html"><img src={{$imgSrc}} alt="" /></a>--}}
                                                {{--</div>--}}
                                            {{--@endforeach--}}
                                        {{--</div>--}}
                                        {{--<!-- end carousel-inner -->--}}
                                        {{--<!-- begin carousel-control -->--}}
                                        {{--<a class="left carousel-control" href="#carousel-post" role="button" data-slide="prev">--}}
                                            {{--<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>--}}
                                        {{--</a>--}}
                                        {{--<a class="right carousel-control" href="#carousel-post" role="button" data-slide="next">--}}
                                            {{--<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>--}}
                                        {{--</a>--}}
                                        {{--<!-- end carousel-control -->--}}
                                    {{--</div>--}}
                                    {{--<!-- end carousel -->--}}
                                {{--</div>--}}
                                <!-- end post-image -->
                                <!-- begin post-info -->
                                <div class="post-info">
                                    <h4 class="post-title">
                                        <a href="post_detail.html">   {{$blog->title}} </a>
                                    </h4>
                                    <div class="post-by">
                                        Posted By <a href="#">admin</a> <span class="divider">|</span> <a href="#">Sports</a>, <a href="#">Parachute</a>, <a href="#">Blue Sky</a> <span class="divider">|</span> 12 Comments
                                    </div>
                                    <div class="post-desc">
                                         {!! $blog->body!!}
                                    </div>
                                </div>
                                <!-- end post-info -->
                                <!-- begin read-btn-container -->
                                <div class="read-btn-container">
                                    <a href="post_detail.html" class="read-btn">Read More <i class="fa fa-angle-double-right"></i></a>
                                </div>
                                <!-- end read-btn-container -->
                            </div>
                            <!-- end post-content -->
                        </li>
                        @endforeach
                    </ul>
                    <!-- end post-list -->
                    
                    <!-- begin pagination -->
                    <div class="section-container">
                        <div class="pagination-container text-center">
                            <ul class="pagination m-t-0 m-b-0">
                                <li class="disabled"><a href="javascript:;">Prev</a></li>
                                <li class="active"><a href="javascript:;">1</a></li>
                                <li><a href="javascript:;">2</a></li>
                                <li><a href="javascript:;">3</a></li>
                                <li><span class="text">...</span></li>
                                <li><a href="javascript:;">1797</a></li>
                                <li><a href="javascript:;">Next</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- end pagination -->
                </div>
                <!-- end col-9 -->
                <!-- begin col-3 -->
                <div class="col-md-3">
                    <!-- begin section-container -->
                    <div class="section-container">
                        <div class="input-group sidebar-search">
                            <input type="text" class="form-control" placeholder="Search Our Stories..." />
                            <span class="input-group-btn">
                                <button class="btn btn-inverse" type="button"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </div>
                    <!-- end section-container -->
                    <!-- begin section-container -->
                    <div class="section-container">
                        <h4 class="section-title"><span>Categories</span></h4>
                        <ul class="sidebar-list">
                            <li><a href="#">Sports (20)</a></li>
                            <li><a href="#">Outdoor Sports (45)</a></li>
                            <li><a href="#">Indoor Sports (1,292)</a></li>
                            <li><a href="#">Video Shooting (12)</a></li>
                            <li><a href="#">Drone (229)</a></li>
                            <li><a href="#">Uncategorized (1,482)</a></li>
                        </ul>
                    </div>
                    <!-- end section-container -->
                    <!-- begin section-container -->
                    <div class="section-container">
                        <h4 class="section-title"><span>Recent Post</span></h4>
                        <ul class="sidebar-recent-post">
                            <li>
                                <div class="info">
                                    <h4 class="title"><a href="#">Lorem ipsum dolor sit amet.</a></h4>
                                    <div class="date">23 December 2015</div>
                                </div>
                            </li>
                            <li>
                                <div class="info">
                                    <h4 class="title"><a href="#">Vestibulum a cursus arcu.</a></h4>
                                    <div class="date">16 December 2015</div>
                                </div>
                            </li>
                            <li>
                                <div class="info">
                                    <h4 class="title"><a href="#">Nullam vel condimentum lectus. </a></h4>
                                    <div class="date">7 December 2015</div>
                                </div>
                            </li>
                            <li>
                                <div class="info">
                                    <h4 class="title"><a href="#">Proin in dui egestas libero posuere ullamcorper. </a></h4>
                                    <div class="date">20 November 2015</div>
                                </div>
                            </li>
                            <li>
                                <div class="info">
                                    <h4 class="title"><a href="#">Interdum et malesuada fames ac ante.</a></h4>
                                    <div class="date">5 November 2015</div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!-- end section-container -->
                    <!-- begin section-container -->
                    <div class="section-container">
                        <h4 class="section-title"><span>Follow Us</span></h4>
                        <ul class="sidebar-social-list">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                        </ul>
                    </div>
                    <!-- end section-container -->
                </div>
                <!-- end col-3 -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end #content -->
@stop
@section('other_script')
    <script>
        $(document).ready(function() {
            App.init();
        });
    </script>
@stop
