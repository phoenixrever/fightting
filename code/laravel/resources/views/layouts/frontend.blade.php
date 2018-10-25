<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include('includes.frontend-head')
</head>
@php
    $bodyClass = (!empty($boxedLayout)) ? 'boxed-layout' : '';
    $bodyClass .= (!empty($paceTop)) ? 'pace-top ' : '';
    $bodyClass .= (!empty($bodyExtraClass)) ? $bodyExtraClass . ' ' : '';
    $sidebarHide = (!empty($sidebarHide)) ? $sidebarHide : '';
    $sidebarTwo = (!empty($sidebarTwo)) ? $sidebarTwo : '';
    $topMenu = (!empty($topMenu)) ? $topMenu : '';
    $footer = (!empty($footer)) ? $footer : '';

    $pageContainerClass = (!empty($topMenu)) ? 'page-with-top-menu ' : '';
    $pageContainerClass .= (!empty($sidebarRight)) ? 'page-with-right-sidebar ' : '';
    $pageContainerClass .= (!empty($sidebarLight)) ? 'page-with-light-sidebar ' : '';
    $pageContainerClass .= (!empty($sidebarWide)) ? 'page-with-wide-sidebar ' : '';
    $pageContainerClass .= (!empty($sidebarHide)) ? 'page-without-sidebar ' : '';
    $pageContainerClass .= (!empty($sidebarMinified)) ? 'page-sidebar-minified ' : '';
    $pageContainerClass .= (!empty($sidebarTwo)) ? 'page-with-two-sidebar ' : '';
    $pageContainerClass .= (!empty($contentFullHeight)) ? 'page-content-full-height ' : '';

    $contentClass = (!empty($contentFullWidth) || !empty($contentFullHeight)) ? 'content-full-width ' : '';
    $contentClass .= (!empty($contentInverseMode)) ? 'content-inverse-mode ' : '';

    $page_cover = (!empty($page_cover)) ? $page_cover : 'none';
    $jumbotron_cover = (!empty($jumbotron_cover)) ? $jumbotron_cover : 'none';
    $headerLanguageBar="true";
@endphp
<body class="{{ $bodyClass }}" >
<!-- begin page-cover -->
<div class="page-cover" style="background-image: url({{$page_cover}})"></div>
<!-- end page-cover -->
@include('includes.component.page-loader')

<div id="page-container" class="page-container fade page-sidebar-fixed page-header-fixed {{ $pageContainerClass }}">

    @include('includes.header')

    @includeWhen($topMenu, 'includes.top-menu')

    @includeWhen(!$sidebarHide, 'includes.sidebar')

    @includeWhen($sidebarTwo, 'includes.sidebar-right')
    @include("includes.frontends.jumbotron")

    <div class="container">
        <!-- begin row -->
        <div class="row">
            <!-- begin col-9 -->
            <div class="col-lg-9">

                <!-- begin forum-list -->
                <div id="content" class="content {{ $contentClass }}">
                    @yield('content')
                </div>
                <!-- end forum-list -->
            </div>
            <!-- end col-9 -->
            <!-- begin col-3 -->
            <div class="col-lg-3">
                @include("includes.frontends.rightbar2");
            </div>
            <!-- end col-3 -->
        </div>
        <!-- end row -->
    </div>
    @includeWhen($footer, 'includes.footer')

    {{--@include('includes.component.theme-panel')--}}

    @include('includes.component.scroll-top-btn')

</div>

@include('includes.frontend-js')
</body>
</html>