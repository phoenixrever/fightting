 <!-- begin #sidebar -->
    <div id="sidebar" class="sidebar">
        <!-- begin sidebar scrollbar -->
        <div data-scrollbar="true" data-height="100%">
            <!-- begin sidebar user -->
            <ul class="nav">
                <li class="nav-profile">
                    <a href="javascript:;" data-toggle="nav-profile">
                        <div class="image">
                            <img src={{ $user_13 }} alt=""/>
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
            <ul class="nav" style="font-size: 15px;"><!--导航栏字体变大-->
                <li class="nav-header"><h3>导航</h3></li>
                <li class="{{ $dashbord or ' ' }}">
                    <a   href="admin_index">
                        <i class="fa fa-th-large"></i>
                        <span>仪表板</span>
                    </a>
                </li>
                <li class="{{ $table_article or ' ' }}">
                    <a href="table_article">
                        <i class="fa fa-hdd"></i>
                        <span>文章列表</span>
                    </a>
                </li>
                <li class="{{$table_user or ' ' }}">
                    <a href="table_user">
                        <i class="fa fa-gem"></i>
                        <span>用户管理<span class="label label-theme m-l-5">NEW</span></span>
                    </a>
                </li>
                <li class="has-sub">
                    <a href="javascript:;">
                        <b class="caret"></b>
                        <i class="fa fa-table"></i>
                        <span>Tables</span>
                    </a>
                    <ul class="sub-menu">
                        <li><a href="table_basic">Basic Tables</a></li>
                        <li class="has-sub">
                            <a href="javascript:;"><b class="caret pull-right"></b> Managed Tables</a>
                            <ul class="sub-menu">
                                <li><a href="table_manage">Default</a></li>
                                <li><a href="table_manage_autofill">Autofill</a></li>
                                <li><a href="table_manage_buttons">Buttons</a></li>
                                <li><a href="table_manage_colreorder">ColReorder</a></li>
                                <li><a href="table_manage_fixed_columns">Fixed Column</a></li>
                                <li><a href="table_manage_fixed_header">Fixed Header</a></li>
                                <li><a href="table_manage_keytable">KeyTable</a></li>
                                <li><a href="table_manage_responsive">Responsive</a></li>
                                <li><a href="table_manage_rowreorder">RowReorder</a></li>
                                <li><a href="table_manage_scroller">Scroller</a></li>
                                <li><a href="table_manage_select">Select</a></li>
                                <li><a href="table_manage_combine">Extension Combination</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="has-sub">
                    <a href="javascript:;">
                        <b class="caret"></b>
                        <i class="fa fa-chart-pie"></i>
                        <span>Chart</span>
                    </a>
                    <ul class="sub-menu">
                        <li><a href="chart-flot.blade.php">Flot Chart</a></li>
                        <li><a href="chart-morris.blade.php">Morris Chart</a></li>
                        <li><a href="chart-js.blade.php">Chart JS</a></li>
                        <li><a href="chart-d3.blade.php">d3 Chart</a></li>
                    </ul>
                </li>
                <li><a href="calendar.blade.php"><i class="fa fa-calendar"></i> <span>Calendar</span></a></li>
                <li class="has-sub">
                    <a href="javascript:;">
                        <b class="caret"></b>
                        <i class="fa fa-map"></i>
                        <span>Map</span>
                    </a>
                    <ul class="sub-menu">
                        <li><a href="map_vector.blade.php">Vector Map</a></li>
                        <li><a href="map_google.blade.php">Google Map</a></li>
                    </ul>
                </li>
                <li class="has-sub">
                    <a href="javascript:;">
                        <b class="caret"></b>
                        <i class="fa fa-image"></i>
                        <span>Gallery</span>
                    </a>
                    <ul class="sub-menu">
                        <li><a href="gallery.blade.php">Gallery v1</a></li>
                        <li><a href="gallery_v2.blade.php">Gallery v2</a></li>
                    </ul>
                </li>
                <li class="has-sub">
                    <a href="javascript:;">
                        <b class="caret"></b>
                        <i class="fa fa-cogs"></i>
                        <span>Page Options</span>
                    </a>
                    <ul class="sub-menu">
                        <li><a href="page_blank.blade.php">Blank Page</a></li>
                        <li><a href="page_with_footer.blade.php">Page with Footer</a></li>
                        <li><a href="page_without_sidebar.blade.php">Page without Sidebar</a></li>
                        <li><a href="page_with_right_sidebar.blade.php">Page with Right Sidebar</a></li>
                        <li><a href="page_with_minified_sidebar.blade.php">Page with Minified Sidebar</a></li>
                        <li><a href="page_with_two_sidebar.blade.php">Page with Two Sidebar</a></li>
                        <li><a href="page_with_line_icons.blade.php">Page with Line Icons</a></li>
                        <li><a href="page_with_ionicons.blade.php">Page with Ionicons</a></li>
                        <li><a href="page_full_height.blade.php">Full Height Content</a></li>
                        <li><a href="page_with_wide_sidebar.blade.php">Page with Wide Sidebar</a></li>
                        <li><a href="page_with_mega_menu.blade.php">Page with Mega Menu</a></li>
                        <li><a href="page_with_top_menu.blade.php">Page with Top Menu</a></li>
                        <li><a href="page_with_boxed_layout.blade.php">Page with Boxed Layout</a></li>
                        <li><a href="page_with_mixed_menu.blade.php">Page with Mixed Menu</a></li>
                        <li><a href="page_boxed_layout_with_mixed_menu.blade.php">Boxed Layout with Mixed Menu</a></li>
                    </ul>
                </li>
                <li class="has-sub">
                    <a href="javascript:;">
                        <b class="caret"></b>
                        <i class="fa fa-gift"></i>
                        <span>Extra</span>
                    </a>
                    <ul class="sub-menu">
                        <li><a href="extra_timeline.blade.php">Timeline</a></li>
                        <li><a href="extra_coming_soon.blade.php">Coming Soon Page</a></li>
                        <li><a href="extra_search_results.blade.php">Search Results</a></li>
                        <li><a href="extra_invoice.blade.php">Invoice</a></li>
                        <li><a href="extra_404_error.blade.php">404 Error Page</a></li>
                        <li><a href="extra_profile.blade.php">Profile Page</a></li>
                    </ul>
                </li>
                <li class="has-sub">
                    <a href="javascript:;">
                        <b class="caret"></b>
                        <i class="fa fa-key"></i>
                        <span>Login & Register</span>
                    </a>
                    <ul class="sub-menu">
                        <li><a href="login.blade.php">Login</a></li>
                        <li><a href="login_v2.blade.php">Login v2</a></li>
                        <li><a href="login_v3.blade.php">Login v3</a></li>
                        <li><a href="register_v3.blade.php">Register v3</a></li>
                    </ul>
                </li>
                <li class="has-sub">
                    <a href="javascript:;">
                        <b class="caret"></b>
                        <i class="fa fa-cubes"></i>
                        <span>Version <span class="label label-theme m-l-5">NEW</span></span>
                    </a>
                    <ul class="sub-menu">
                        <li><a href="javascript:;">HTML</a></li>
                        <li><a href="../ajax/index.blade.php">AJAX</a></li>
                        <li><a href="../angularjs/index.blade.php">ANGULAR JS</a></li>
                        <li><a href="../angularjs5/index.blade.php">ANGULAR JS 5 <i
                                        class="fa fa-paper-plane text-theme m-l-5"></i></a></li>
                        <li><a href="javascript:alert('Laravel Preview is not available on our demo site.');">LARAVEL
                                <i class="fa fa-paper-plane text-theme m-l-5"></i></a></li>
                        <li><a href="../material/index.blade.php">MATERIAL DESIGN</a></li>
                        <li><a href="../template_apple/index.blade.php">APPLE DESIGN</a></li>
                        <li><a href="../transparent/index.blade.php">TRANSPARENT DESIGN <i
                                        class="fa fa-paper-plane text-theme m-l-5"></i></a></li>
                    </ul>
                </li>
                <li class="has-sub">
                    <a href="javascript:;">
                        <b class="caret"></b>
                        <i class="fa fa-medkit"></i>
                        <span>Helper</span>
                    </a>
                    <ul class="sub-menu">
                        <li><a href="helper_css.blade.php">Predefined CSS Classes</a></li>
                    </ul>
                </li>
                <!-- begin sidebar minify button -->
                <li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i
                                class="fa fa-angle-double-left"></i></a></li>
                <!-- end sidebar minify button -->
            </ul>
            <!-- end sidebar nav -->
        </div>
        <!-- end sidebar scrollbar -->
    </div>
    <div class="sidebar-bg"></div>
    <!-- end #sidebar -->