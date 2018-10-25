@extends('layouts.frontend')

@section('title', 'fourm')

@section('content')
    <!-- begin forum-list -->
    {{--@php--}}
    {{--dd(Auth::user()->blogs());--}}
    {{--@endphp--}}
    <ul class="forum-list forum-detail-list left80">
        @if($comments->currentPage()===1)
            <li>
                <div class="headimg">
                    <img src="../assets/img/user/user-1.jpg" alt=""/>
                    <span class="label label-danger">{{$blog->user->name}}</span>
                </div>
                <!-- end media -->
                <!-- begin info-container -->
                <div class="info-container">
                    @guest
                    @else
                        @if(Auth()->user()->id===$blog->user->id)
                            <div class="dropdown pull-right">
                                <button href="javascript:;" class="btn btn-white btn-sm toggle-button"
                                        data-toggle="dropdown" aria-expanded="false"><i
                                            class="fa fa-ellipsis-h f-s-14 t-plus-1"></i></button>
                                <ul class="dropdown-menu dropdown-menu-left" x-placement="bottom-start"
                                    style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 24px, 0px);">
                                    @can('edit-blog')
                                        <li><a href="javascript:;" id="toggle"
                                               class="ajax-{{$blog->id}}">InlineEditor</a></li>
                                        <li><a href="{{route("blogs.edit",$blog->id)}}">Editor</a></li>
                                    @endcan
                                    @can('delete-blog')
                                        <li><a class="delete-blog" href="{{route("blog.delete",$blog->id)}}">Delete</a>
                                        </li>
                                    @endcan
                                    <li class="divider"></li>
                                    <li><a href="#">Quit</a></li>
                                </ul>
                            </div>
                        @endif
                    @endguest
                    <h4 class="text-info" style="margin-bottom: 25px">{{$blog->title}}</h4>
                    <div class="post-content blog-content image gallery-group-{{$blog->id}}"
                         id="gallery-group-{{$blog->id}}">
                        {!! $blog->body !!}
                    </div>
                    <div class="post-time">
                        <span>{{$blog->created_at}}</span>
                        <div class="pull-right">
                            <a href="javascript:;" class="m-r-15 text-white"><i
                                        class="fa fa-thumbs-up fa-fw fa-lg m-r-3"></i> Like</a>
                            <a href="javascript:;" class="m-r-15 text-white"><i
                                        class="fa fa-share fa-fw fa-lg m-r-3"></i> Share</a>
                            {{--<a href="javascript:;" class= "m-r-15 text-white " data-toggle="collapse" data-target="#collapseOne"><i class="fa fa-comments fa-fw fa-lg m-r-3"></i> Comment</a>--}}
                        </div>
                    </div>
                </div>
                <!-- end info-container -->
            </li>
        @endif
        @foreach($comments as $comment)
            <li>
                <div class="headimg">
                    <img src="../assets/img/user/user-1.jpg" alt=""/>
                    <span class="label label-danger">{{$comment->user->name}}</span>
                </div>
                <!-- end media -->
                <!-- begin info-container -->
                <div class="info-container">
                    @if(Auth()->user()->id===$comment->user->id)
                        <div class="dropdown pull-right">
                            <a href="javascript:;" class="btn btn-white btn-sm" data-toggle="dropdown"
                               aria-expanded="false"><i class="fa fa-ellipsis-h f-s-14 t-plus-1"></i></a>
                            <ul class="dropdown-menu dropdown-menu-left" x-placement="bottom-start"
                                style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 24px, 0px);">
                                @can('delete-comment')
                                    <li><a href="{{route("comment.delete",$comment->id)}}">Delete</a></li>
                                @endcan
                                <li class="divider"></li>
                                <li><a href="#">Quit</a></li>
                            </ul>
                        </div>
                    @endif
                    <h4 class="text-info" style="margin-bottom: 25px">{{$comment->user->name}}</h4>
                    <div class="post-content image gallery-group-{{$comment->id}}" id="gallery-group-{{$comment->id}}">
                        {!! $comment->body!!}
                    </div>

                    <div class="post-time">
                        <span>{{$comment->created_at}}</span>
                        <div class="pull-right">
                            <a href="javascript:;" class="m-r-15 text-white"><i
                                        class="fa fa-thumbs-up fa-fw fa-lg m-r-3"></i> Like</a>
                            <a href="javascript:;" class="m-r-15 text-white"><i
                                        class="fa fa-share fa-fw fa-lg m-r-3"></i> Share</a>
                            <a href="javascript:;" class="m-r-15 text-white " data-toggle="collapse"
                               data-target="#collapseOne"><i class="fa fa-comments fa-fw fa-lg m-r-3"></i> Comment</a>
                        </div>
                    </div>
                    <div class="card m-t-20">
                        {{--<div class="card-header bg-black text-white pointer-cursor" data-toggle="collapse" data-target="#collapseOne">--}}
                        {{--Collapsible Group Item #1--}}
                        {{--</div>--}}
                        <div id="collapseOne" class="collapse profile-content show" data-parent="#accordion">
{{--                            <input type="hidden"  class="page-json" value="{{json_encode($comment->replyComments->body)}}">--}}
                            <div class="card-body">
                                {{--@php--}}
                                    {{--$n=ceil($comment->replyComments->count()/5);--}}
                                {{--@endphp--}}
                                {{--@for($i=1;$i<=$n;$i++)--}}
                                    {{--@php--}}
                                        {{--$chunks=$comment->replyComments->forPage($i, 5)->all();--}}
                                    {{--@endphp--}}
                                        {{--@if($i===1)--}}
                                            {{--<div class="tab-pane fade show active" id="tab-{{$i}}">--}}
                                        {{--@else--}}
                                            {{--<div class="tab-pane fade show " id="tab-{{$i}}">--}}
                                        {{--@endif--}}
                                        @foreach($comment->replyComments as $reply)
                                            <div class="p-10">
                                                <div class="media media-xs overflow-visible">
                                                    <a class="media-left" href="javascript:;">
                                                        <img src="../assets/img/user/user-1.jpg" alt=""
                                                             class="media-object img-circle"/>
                                                    </a>
                                                    <div class="media-body valign-middle">
                                                        @php
                                                            if(isset($reply->replyTo)){
                                                                $strArr=explode(":",$reply->body);
                                                                $str=$strArr[0];
                                                                unset($strArr[0]);
                                                                $body_text=implode("",$strArr);
                                                            }else{
                                                                $str=$reply->user->name;
                                                                $body_text=$reply->body;
                                                            }
                                                        @endphp
                                                        <b ><a href="javascript:;">{{ $str }}</a></b>
                                                        <span>{{ $body_text }}</span>
                                                        <p class="text-right"><span>{{$reply->created_at}}</span><a href="javascript:" class="{{$reply->user->name}}-{{$reply->user->id}} text-info m-l-5 reply" >回复</a></p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        </div>
                                {{--@endfor--}}
                            </div> <!-- card-bofy -->
                                            {{--<ul class="pagination profile-header-tab pagination-xs m-t-0 m-b-5 nav pull-right m-r-20">--}}
                                                {{--<li class="page-item head-tab hide"><a href="#tab-1" class="page-link" data-toggle="tab">首页</a></li>--}}
                                                {{--@for($j=1;$j<=$n;$j++)--}}
                                                    {{--@if($j===1)--}}
                                                        {{--<li class="page-item active"><a href="#tab-{{$j}}" class="page-link" data-toggle="tab">{{$j}}</a></li>--}}
                                                    {{--@else--}}
                                                        {{--<li class="page-item "><a href="#tab-{{$j}}" class="page-link" data-toggle="tab">{{$j}}</a></li>--}}
                                                    {{--@endif--}}
                                                {{--@endfor--}}
                                                {{--<li class="page-item foot-tab hide"><a href="#tab-{{$n}}" class="page-link" data-toggle="tab">尾页</a></li>--}}
                                            {{--</ul>--}}
                                            <div class="input-group  send-box p-10">
                                                {{--<textarea type="text" class="form-control input-char-count" name="message" maxlength="200"--}}
                                                {{--style="overflow:hidden; resize:none; " placeholder="Enter your message here."></textarea>--}}
                                                <div id="edit-div" contenteditable class="plaintext form-control" maxlength="150"
                                                     showlength="50"></div>
                                                <span class="form-control-character-count " hidden>你最多还能输入64个字符</span>
                                                <span class="input-group-append ">
                                                <div class="emoji-box"></div>
                                                    {{--<button id="emoji-button" class="btn btn-primary" type="button"><i class="fa fa-camera"></i></button>--}}
                                                    <button id="send-comment" class="btn btn-primary " type="button" value="comment-{{$comment->id}}-{{$blog->id}}">
                                                        <i class="fa fa-link"></i>
                                                        <div style="color: #fdaed4" class="la-ball-scale-ripple-multiple la-sm hide">
                                                            <div></div>
                                                            <div></div>
                                                            <div></div>
                                                        </div>
                                                    </button>
                                            </span>
                                            </div>
                        </div>
                    </div>
                </div>
                <!-- end info-container -->
            </li>
        @endforeach
    </ul>
    <!-- end forum-list -->
    <!-- begin pagination -->
    <div class="pull-right">
        {{$comments->links()}}
    </div>
    <!-- end pagination -->
    @include("includes.frontends.editor")
@endsection

