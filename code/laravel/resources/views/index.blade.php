<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include('includes.head')
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
@endphp
<body class="{{ $bodyClass }}">
@include('includes.component.page-loader')

<div id="page-container" class="page-container fade page-sidebar-fixed page-header-fixed {{ $pageContainerClass }}">

    @include('includes.header')

    @includeWhen($topMenu, 'includes.top-menu')

{{--    @includeWhen(!$sidebarHide, 'includes.sidebar')--}}

    {{--@includeWhen($sidebarTwo, 'includes.sidebar-right')--}}
    <!-- begin #sidebar -->
        <div id="sidebar" class="sidebar">
            <!-- begin sidebar scrollbar -->
            <div data-scrollbar="true" data-height="100%">
                <!-- begin sidebar user -->
                <ul class="nav">
                    <li class="nav-profile">
                        <a href="javascript:;" data-toggle="nav-profile">
                            <div class="cover with-shadow"></div>
                            <div class="image">
                                <img src="../assets/img/user/user-13.jpg" alt="" />
                            </div>
                            <div class="info">
                                <b class="caret pull-right"></b>
                                Sean Ngu
                                <small>Front end developer</small>
                            </div>
                        </a>
                    </li>
                    <li>
                        <ul class="nav nav-profile">
                            <li><a href="javascript:;"><i class="fa fa-cog"></i> Settings</a></li>
                            <li><a href="javascript:;"><i class="fa fa-pencil-alt"></i> Send Feedback</a></li>
                            <li><a href="javascript:;"><i class="fa fa-question-circle"></i> Helps</a></li>
                        </ul>
                    </li>
                </ul>
                <!-- end sidebar user -->
                <!-- begin sidebar nav -->
                <ul class="nav">
                    <li class="nav-header">Navigation</li>
                    <li class="has-sub">
                        <a href="javascript:;">
                            <b class="caret"></b>
                            <i class="fa fa-th-large"></i>
                            <span>Dashboard</span>
                        </a>
                        <ul class="sub-menu">
                            <li><a href="#pages/index.html" data-toggle="ajax">Dashboard v1</a></li>
                            <li><a href="/dashboard/v2" data-toggle="ajax">Dashboard v2</a></li>
                        </ul>
                    </li>
                    <li class="has-sub">
                        <a href="javascript:;">
                            <span class="badge pull-right">10</span>
                            <i class="fa fa-hdd"></i>
                            <span>Email</span>
                        </a>
                        <ul class="sub-menu">
                            <li><a href="#pages/email_inbox.html" data-toggle="ajax">Inbox</a></li>
                            <li><a href="#pages/email_compose.html" data-toggle="ajax">Compose</a></li>
                            <li><a href="#pages/email_detail.html" data-toggle="ajax">Detail</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#pages/widget.html" data-toggle="ajax">
                            <i class="fab fa-simplybuilt"></i>
                            <span>Widgets <span class="label label-theme m-l-5">NEW</span></span>
                        </a>
                    </li>
                    <li class="has-sub">
                        <a href="javascript:;">
                            <b class="caret"></b>
                            <i class="fa fa-gem"></i>
                            <span>UI Elements <span class="label label-theme m-l-5">NEW</span></span>
                        </a>
                        <ul class="sub-menu">
                            <li><a href="#pages/ui_general.html" data-toggle="ajax">General <i class="fa fa-paper-plane text-theme m-l-5"></i></a></li>
                            <li><a href="#pages/ui_typography.html" data-toggle="ajax">Typography</a></li>
                            <li><a href="#pages/ui_tabs_accordions.html" data-toggle="ajax">Tabs & Accordions</a></li>
                            <li><a href="#pages/ui_unlimited_tabs.html" data-toggle="ajax">Unlimited Nav Tabs</a></li>
                            <li><a href="#pages/ui_modal_notification.html" data-toggle="ajax">Modal & Notification <i class="fa fa-paper-plane text-theme m-l-5"></i></a></li>
                            <li><a href="#pages/ui_widget_boxes.html" data-toggle="ajax">Widget Boxes</a></li>
                            <li><a href="#pages/ui_media_object.html" data-toggle="ajax">Media Object</a></li>
                            <li><a href="#pages/ui_buttons.html" data-toggle="ajax">Buttons <i class="fa fa-paper-plane text-theme m-l-5"></i></a></li>
                            <li><a href="#pages/ui_icons.html" data-toggle="ajax">Icons</a></li>
                            <li><a href="#pages/ui_simple_line_icons.html" data-toggle="ajax">Simple Line Icons</a></li>
                            <li><a href="#pages/ui_ionicons.html" data-toggle="ajax">Ionicons</a></li>
                            <li><a href="#pages/ui_tree.html" data-toggle="ajax">Tree View</a></li>
                            <li><a href="#pages/ui_language_bar_icon.html" data-toggle="ajax">Language Bar & Icon</a></li>
                            <li><a href="#pages/ui_social_buttons.html" data-toggle="ajax">Social Buttons</a></li>
                            <li><a href="#pages/ui_tour.html" data-toggle="ajax">Intro JS</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#pages/bootstrap_4.html" data-toggle="ajax">
                            <div class="icon-img">
                                <img src="../assets/img/logo/logo-bs4.png" alt="" />
                            </div>
                            <span>Bootstrap 4 <span class="label label-theme m-l-5">NEW</span></span>
                        </a>
                    </li>
                    <li class="has-sub">
                        <a href="javascript:;">
                            <b class="caret"></b>
                            <i class="fa fa-list-ol"></i>
                            <span>Form Stuff <span class="label label-theme m-l-5">NEW</span></span>
                        </a>
                        <ul class="sub-menu">
                            <li><a href="#pages/form_elements.html" data-toggle="ajax">Form Elements <i class="fa fa-paper-plane text-theme m-l-5"></i></a></li>
                            <li><a href="#pages/form_plugins.html" data-toggle="ajax">Form Plugins <i class="fa fa-paper-plane text-theme m-l-5"></i></a></li>
                            <li><a href="#pages/form_slider_switcher.html" data-toggle="ajax">Form Slider + Switcher</a></li>
                            <li><a href="#pages/form_validation.html" data-toggle="ajax">Form Validation</a></li>
                            <li><a href="#pages/form_wizards.html" data-toggle="ajax">Wizards</a></li>
                            <li><a href="#pages/form_wizards_validation.html" data-toggle="ajax">Wizards + Validation</a></li>
                            <li><a href="#pages/form_wysiwyg.html" data-toggle="ajax">WYSIWYG</a></li>
                            <li><a href="#pages/form_editable.html" data-toggle="ajax">X-Editable</a></li>
                            <li><a href="#pages/form_multiple_upload.html" data-toggle="ajax">Multiple File Upload</a></li>
                            <li><a href="#pages/form_summernote.html" data-toggle="ajax">Summernote</a></li>
                            <li><a href="#pages/form_dropzone.html" data-toggle="ajax">Dropzone</a></li>
                        </ul>
                    </li>
                    <li class="has-sub">
                        <a href="javascript:;">
                            <b class="caret"></b>
                            <i class="fa fa-table"></i>
                            <span>Tables</span>
                        </a>
                        <ul class="sub-menu">
                            <li><a href="#pages/table_basic.html" data-toggle="ajax">Basic Tables</a></li>
                            <li class="has-sub">
                                <a href="javascript:;"><b class="caret pull-right"></b> Managed Tables</a>
                                <ul class="sub-menu">
                                    <li><a href="/table/manage/default" data-toggle="ajax">Default</a></li>
                                    <li><a href="#pages/table_manage_autofill.html" data-toggle="ajax">Autofill</a></li>
                                    <li><a href="#pages/table_manage_buttons.html" data-toggle="ajax">Buttons</a></li>
                                    <li><a href="#pages/table_manage_colreorder.html" data-toggle="ajax">ColReorder</a></li>
                                    <li><a href="#pages/table_manage_fixed_columns.html" data-toggle="ajax">Fixed Column</a></li>
                                    <li><a href="#pages/table_manage_fixed_header.html" data-toggle="ajax">Fixed Header</a></li>
                                    <li><a href="#pages/table_manage_keytable.html" data-toggle="ajax">KeyTable</a></li>
                                    <li><a href="#pages/table_manage_responsive.html" data-toggle="ajax">Responsive</a></li>
                                    <li><a href="#pages/table_manage_rowreorder.html" data-toggle="ajax">RowReorder</a></li>
                                    <li><a href="#pages/table_manage_scroller.html" data-toggle="ajax">Scroller</a></li>
                                    <li><a href="#pages/table_manage_select.html" data-toggle="ajax">Select</a></li>
                                    <li><a href="#pages/table_manage_combine.html" data-toggle="ajax">Extension Combination</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="has-sub">
                        <a href="javascript:;">
                            <b class="caret"></b>
                            <i class="fa fa-star"></i>
                            <span>Front End</span>
                        </a>
                        <ul class="sub-menu">
                            <li><a href="../../../frontend/template/template_one_page_parallax/index.html" target="_blank">One Page Parallax</a></li>
                            <li><a href="../../../frontend/template/template_blog/index.html" target="_blank">Blog</a></li>
                            <li><a href="../../../frontend/template/template_forum/index.html" target="_blank">Forum</a></li>
                            <li><a href="../../../frontend/template/template_e_commerce/index.html" target="_blank">E-Commerce</a></li>
                        </ul>
                    </li>
                    <li class="has-sub">
                        <a href="javascript:;">
                            <b class="caret"></b>
                            <i class="fa fa-envelope"></i>
                            <span>Email Template</span>
                        </a>
                        <ul class="sub-menu">
                            <li><a href="email_system.html">System Template</a></li>
                            <li><a href="email_newsletter.html">Newsletter Template</a></li>
                        </ul>
                    </li>
                    <li class="has-sub">
                        <a href="javascript:;">
                            <b class="caret"></b>
                            <i class="fa fa-chart-pie"></i>
                            <span>Chart</span>
                        </a>
                        <ul class="sub-menu">
                            <li><a href="#pages/chart-flot.html" data-toggle="ajax">Flot Chart</a></li>
                            <li><a href="#pages/chart-morris.html" data-toggle="ajax">Morris Chart</a></li>
                            <li><a href="#pages/chart-js.html" data-toggle="ajax">Chart JS</a></li>
                            <li><a href="#pages/chart-d3.html" data-toggle="ajax">d3 Chart</a></li>
                        </ul>
                    </li>
                    <li><a href="#pages/calendar.html" data-toggle="ajax"><i class="fa fa-calendar"></i> <span>Calendar</span></a></li>
                    <li class="has-sub">
                        <a href="javascript:;">
                            <b class="caret"></b>
                            <i class="fa fa-map"></i>
                            <span>Map</span>
                        </a>
                        <ul class="sub-menu">
                            <li><a href="#pages/map_vector.html" data-toggle="ajax">Vector Map</a></li>
                            <li><a href="#pages/map_google.html" data-toggle="ajax">Google Map</a></li>
                        </ul>
                    </li>
                    <li class="has-sub">
                        <a href="javascript:;">
                            <b class="caret"></b>
                            <i class="fa fa-image"></i>
                            <span>Gallery</span>
                        </a>
                        <ul class="sub-menu">
                            <li><a href="#pages/gallery.html" data-toggle="ajax">Gallery v1</a></li>
                            <li><a href="#pages/gallery_v2.html" data-toggle="ajax">Gallery v2</a></li>
                        </ul>
                    </li>
                    <li class="has-sub">
                        <a href="javascript:;">
                            <b class="caret"></b>
                            <i class="fa fa-cogs"></i>
                            <span>Page Options</span>
                        </a>
                        <ul class="sub-menu">
                            <li><a href="#pages/page_blank.html" data-toggle="ajax">Blank Page</a></li>
                            <li><a href="page_with_footer.html">Page with Footer</a></li>
                            <li><a href="page_without_sidebar.html">Page without Sidebar</a></li>
                            <li><a href="#pages/page_with_right_sidebar.html" data-toggle="ajax">Page with Right Sidebar</a></li>
                            <li><a href="#pages/page_with_minified_sidebar.html" data-toggle="ajax">Page with Minified Sidebar</a></li>
                            <li><a href="page_with_two_sidebar.html">Page with Two Sidebar</a></li>
                            <li><a href="page_with_line_icons.html">Page with Line Icons</a></li>
                            <li><a href="page_with_ionicons.html">Page with Ionicons</a></li>
                            <li><a href="#pages/page_full_height.html" data-toggle="ajax">Full Height Content</a></li>
                            <li><a href="#pages/page_with_wide_sidebar.html" data-toggle="ajax">Page with Wide Sidebar</a></li>
                            <li><a href="#pages/page_with_light_sidebar.html" data-toggle="ajax">Page with Light Sidebar</a></li>
                            <li><a href="page_with_mega_menu.html">Page with Mega Menu</a></li>
                            <li><a href="page_with_top_menu.html">Page with Top Menu</a></li>
                            <li><a href="#pages/page_with_boxed_layout.html" data-toggle="ajax">Page with Boxed Layout</a></li>
                            <li><a href="page_with_mixed_menu.html">Page with Mixed Menu</a></li>
                            <li><a href="page_boxed_layout_with_mixed_menu.html">Boxed Layout with Mixed Menu</a></li>
                            <li><a href="#pages/page_with_transparent_sidebar.html" data-toggle="ajax">Page with Transparent Sidebar</a></li>
                        </ul>
                    </li>
                    <li class="has-sub">
                        <a href="javascript:;">
                            <b class="caret"></b>
                            <i class="fa fa-gift"></i>
                            <span>Extra</span>
                        </a>
                        <ul class="sub-menu">
                            <li><a href="#pages/extra_timeline.html" data-toggle="ajax">Timeline</a></li>
                            <li><a href="#pages/extra_coming_soon.html">Coming Soon Page</a></li>
                            <li><a href="#pages/extra_search_results.html" data-toggle="ajax">Search Results</a></li>
                            <li><a href="#pages/extra_invoice.html" data-toggle="ajax">Invoice</a></li>
                            <li><a href="extra_404_error.html">404 Error Page</a></li>
                            <li><a href="#pages/extra_profile.html" data-toggle="ajax">Profile Page</a></li>
                        </ul>
                    </li>
                    <li class="has-sub">
                        <a href="javascript:;">
                            <b class="caret"></b>
                            <i class="fa fa-key"></i>
                            <span>Login & Register</span>
                        </a>
                        <ul class="sub-menu">
                            <li><a href="login.html">Login</a></li>
                            <li><a href="login_v2.html">Login v2</a></li>
                            <li><a href="login_v3.html">Login v3</a></li>
                            <li><a href="register_v3.html">Register v3</a></li>
                        </ul>
                    </li>
                    <li class="has-sub">
                        <a href="javascript:;">
                            <b class="caret"></b>
                            <i class="fa fa-cubes"></i>
                            <span>Version <span class="label label-theme m-l-5">NEW</span></span>
                        </a>
                        <ul class="sub-menu">
                            <li><a href="../template_ajax/index.html">HTML</a></li>
                            <li><a href="javascript:;">AJAX</a></li>
                            <li><a href="../template_angularjs/index.html">ANGULAR JS</a></li>
                            <li><a href="../template_angularjs6/index.html">ANGULAR JS 6 <i class="fa fa-paper-plane text-theme m-l-5"></i></a></li>
                            <li><a href="../template_laravel/index.html">LARAVEL <i class="fa fa-paper-plane text-theme m-l-5"></i></a></li>
                            <li><a href="../template_material/index.html">MATERIAL DESIGN</a></li>
                            <li><a href="../template_apple/index.html">APPLE DESIGN</a></li>
                            <li><a href="../template_transparent/index.html">TRANSPARENT DESIGN <i class="fa fa-paper-plane text-theme m-l-5"></i></a></li>
                        </ul>
                    </li>
                    <li class="has-sub">
                        <a href="javascript:;">
                            <b class="caret"></b>
                            <i class="fa fa-medkit"></i>
                            <span>Helper</span>
                        </a>
                        <ul class="sub-menu">
                            <li><a href="#pages/helper_css.html" data-toggle="ajax">Predefined CSS Classes</a></li>
                        </ul>
                    </li>
                    <li class="has-sub">
                        <a href="javascript:;">
                            <b class="caret"></b>
                            <i class="fa fa-align-left"></i>
                            <span>Menu Level</span>
                        </a>
                        <ul class="sub-menu">
                            <li class="has-sub">
                                <a href="javascript:;">
                                    <b class="caret"></b>
                                    Menu 1.1
                                </a>
                                <ul class="sub-menu">
                                    <li class="has-sub">
                                        <a href="javascript:;">
                                            <b class="caret"></b>
                                            Menu 2.1
                                        </a>
                                        <ul class="sub-menu">
                                            <li><a href="javascript:;">Menu 3.1</a></li>
                                            <li><a href="javascript:;">Menu 3.2</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="javascript:;">Menu 2.2</a></li>
                                    <li><a href="javascript:;">Menu 2.3</a></li>
                                </ul>
                            </li>
                            <li><a href="javascript:;">Menu 1.2</a></li>
                            <li><a href="javascript:;">Menu 1.3</a></li>
                        </ul>
                    </li>
                    <!-- begin sidebar minify button -->
                    <li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
                    <!-- end sidebar minify button -->
                </ul>
                <!-- end sidebar nav -->
            </div>
            <!-- end sidebar scrollbar -->
        </div>
        <div class="sidebar-bg"></div>
        <!-- end #sidebar -->

    <div id="content" class="content {{ $contentClass }}">
        @yield('content')
    </div>

    @includeWhen($footer, 'includes.footer')

    @include('includes.component.theme-panel')

    @include('includes.component.scroll-top-btn')

</div>

@include('includes.page-js')
</body>
</html>
