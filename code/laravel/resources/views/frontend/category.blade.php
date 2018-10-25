@extends('layouts.frontend')

@section('title', 'fourm')

@section('content')
    <div class="panel panel-inverse ">
        <!-- begin panel-heading -->
        <div class="panel-heading">
            <div class="panel-heading-btn">
                <a href="#" class="btn btn-primary btn-xs ">sort</a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default"
                   data-click="panel-expand" hidden><i
                            class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success"
                   data-click="panel-reload" hidden><i
                            class="fa fa-redo"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning"
                   data-click="panel-collapse" hidden><i
                            class="fa fa-minus"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger"
                   data-click="panel-remove" hidden><i
                            class="fa fa-times"></i></a>
            </div>
            <h4 class="panel-title">Official Management District</h4>
        </div>
        <!-- end panel-heading -->
        <!-- begin panel-body -->
        <div class="panel-body">
            <ul class="forum-list forum-topic-list">
                <li>
                    <!-- begin media -->
                    <div class="headimg">
                        <img src="../assets/img/user/user-1.jpg" alt=""/>
                    </div>
                    <!-- end media -->
                    <!-- begin info-container -->
                    <div class="info-container">
                        <div class="info">
                            <h4 class="title"><a href="detail.html">How to create an arrow by using css?</a>
                            </h4>
                            <ul class="info-start-end">
                                <li>post by <a href="detail.html">Radomit Grigor</a></li>
                                <li>latest reply <a href="detail.html">Kama Adisa</a></li>
                            </ul>
                        </div>
                        <div class="date-replies">
                            <div class="time">
                                8 hours ago
                            </div>
                            <div class="replies">
                                <div class="total">8</div>
                                <div class="text">REPLIES</div>
                            </div>
                        </div>
                    </div>
                    <!-- end info-container -->
                </li>
                <li>
                    <!-- begin media -->
                    <div class="headimg">
                        <img src="../assets/img/user/user-1.jpg" alt=""/>
                    </div>
                    <!-- end media -->
                    <!-- begin info-container -->
                    <div class="info-container">
                        <div class="info">
                            <h4 class="title"><a href="detail.html">How to create an arrow by using css?</a>
                            </h4>
                            <ul class="info-start-end">
                                <li>post by <a href="detail.html">Radomit Grigor</a></li>
                                <li>latest reply <a href="detail.html">Kama Adisa</a></li>
                            </ul>
                        </div>
                        <div class="date-replies">
                            <div class="time">
                                8 hours ago
                            </div>
                            <div class="replies">
                                <div class="total">8</div>
                                <div class="text">REPLIES</div>
                            </div>
                        </div>
                    </div>
                    <!-- end info-container -->
                </li>
            </ul>
            <div class="divider text-danger m-t-20 m-b-20" style="border:3px solid red"></div>
            <ul class="forum-list forum-topic-list">
                @foreach($blogs as $blog)
                    <li>
                        <!-- begin media -->
                        <div class="headimg">
                            <img src="../assets/img/user/user-1.jpg" alt=""/>
                        </div>
                        <!-- end media -->
                        <!-- begin info-container -->
                        <div class="info-container">
                            <div class="row">
                                <div class="info col-lg-8 col-md-12 col-sm-12 col-xs-12" >
                                    <h4 class="title"><a href="{{route('blogs.show',$blog->id)}}">{{$blog->title}}</a>
                                    </h4>
                                    <div class="info-start-end thumbnailsImg m-b-20">
                                        @foreach($blog->body as $key=>$value)
                                            @if($key<3)
                                                @php
                                                    $doc = new DOMDocument();
                                                    $doc->loadHTML($value);
                                                    $imageTags = $doc->getElementsByTagName('img');
                                                    $imgSrc=$imageTags[0]->getAttribute('src');
                                                @endphp
                                                <a  href="{{$imgSrc}}" data-lightbox="thumbnailsImg-{{$blog->id}}"><img src="{{$imgSrc}}" alt=""/></a>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                <div class="clearfix visible-xs"></div>
                                <div class="author col-lg-2 col-md-10 col-sm-10 col-xs-10" >
                                    <ul class="authorInfo  ">
                                        <li class="m-b-15"><a href="detail.html">{{$blog->user->name}}</a></li>
                                        <li>
                                            <a href="detail.html">{{isset($blog->comments[0]->user->name)?$blog->comments[0]->user->name:'没人评论'}}</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="date-replies col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                    <div class="replies">
                                        <div class="total">{{$blog->comments->count()}}</div>
                                        <div class="text">REPLIES</div>
                                    </div>
                                    <div class="time m-t-10">
                                        {{--<time class="timeago" datetime="{{($blog->comments[0]->created_at)}}"></time>--}}
                                        @if(isset($blog->comments[0]->created_at))
                                            <time class="timeago text-nowrap"
                                                  datetime="{{$blog->comments[0]->created_at}}"></time>
                                        @else
                                            <span class="text-nowrap">no replies</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end info-container -->
                    </li>
                @endforeach

            </ul>
            <!-- end forum-list -->
        </div>
        <!-- end panel-body -->
    </div>
    <!-- begin pagination -->
    <div class="pull-right">
        {{$blogs->links()}}
    </div>
    <!-- end pagination -->
    @include("includes.frontends.editor")
@endsection

