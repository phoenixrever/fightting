@extends("layouts.admin.base")

@section("title")
    "用户管理"
@stop

@section("base_head")
    <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
    <link href={{ asset("admin_doc/assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css") }} rel="stylesheet" />
    <link href={{ asset("admin_doc/assets/plugins/DataTables/extensions/FixedHeader/css/fixedHeader.bootstrap.min.css") }} rel="stylesheet" />
    <link href={{ asset("admin_doc/assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css") }} rel="stylesheet" />
    <!-- ================== END PAGE LEVEL STYLE ================== -->

    <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
    <link href={{ asset("admin_doc/assets/plugins/gritter/css/jquery.gritter.css") }} rel="stylesheet" />
    <link href={{ asset("admin_doc/assets/plugins/parsley/src/parsley.css")}} rel="stylesheet" />
    <link href={{ asset("css/layer.css")}} rel="stylesheet" />
    <link href={{ asset("css/permission_default.css") }} rel="stylesheet"/>
    <!-- ================== END PAGE LEVEL STYLE ================== -->
    @yield('other_head')
@stop

@section('content')
    <!-- begin #content -->
    <div id="content" class="content">
        <!-- begin breadcrumb -->
        <ol class="breadcrumb pull-right">
            <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
            <li class="breadcrumb-item"><a href="javascript:;">Tables</a></li>
            <li class="breadcrumb-item"><a href="javascript:;">Managed Tables</a></li>
            <li class="breadcrumb-item active">Fixed Header</li>
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">Managed Tables - Fixed Header <small>header small text goes here...</small></h1>
        <!-- end page-header -->
        <!-- begin row -->
        <div class="row">
            <!-- begin col-12 -->
            <div class="col-lg-12">
                <!-- begin panel -->
                <div class="panel panel-inverse">
                    <!-- begin panel-heading -->
                    <div class="panel-heading">
                        <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                        </div>
                        <h4 class="panel-title">DataTable - Fixed Header</h4>
                    </div>
                    <!-- end panel-heading -->
                    <!-- begin alert -->
                    <div class="alert alert-info fade show">
                        <button type="button" class="close" data-dismiss="alert">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <div id="lala">
                            <span id="result_search">This is a test!</span>
                        </div>
                    </div>
                    <!-- end alert -->
                    <!-- begin pjax panel-body -->
                    <div id="pjax_content">
                        @yield('pjax_content')
                    </div>
                    <!-- end pjax panel-body -->
                </div>
                <!-- end panel -->
            </div>
            <!-- end col-12 -->
        </div>
        <!-- end row -->
    </div>
    <!-- end #content -->
@stop

@section("base_script")

    <!-- ================== BEGIN PAGE LEVEL JS ================== -->
    <script src={{ asset("admin_doc/assets/plugins/DataTables/media/js/jquery.dataTables.js") }} ></script>
    <script src={{ asset("admin_doc/assets/plugins/DataTables/media/js/dataTables.bootstrap.min.js") }} ></script>
    <script src={{ asset("admin_doc/assets/plugins/DataTables/extensions/FixedHeader/js/dataTables.fixedHeader.min.js") }} ></script>
    <script src={{ asset("admin_doc/assets/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js") }} ></script>
    <script src={{ asset("admin_doc/assets/js/demo/table-manage-fixed-header.demo.min.js") }} ></script>
    <script src={{ asset("js/jquery.pjax.js") }} ></script>
    <!-- ================== END PAGE LEVEL JS ================== -->

    <!-- ================== BEGIN PAGE LEVEL JS ================== -->
    <script src={{ asset("admin_doc/assets/plugins/parsley/dist/parsley.js")}}></script>
    <script src={{ asset("admin_doc/assets/plugins/gritter/js/jquery.gritter.js")}}></script>
    <script src={{ asset("admin_doc/assets/plugins/bootstrap-sweetalert/sweetalert.min.js")}}></script>
    <script src={{ asset("admin_doc/assets/js/demo/ui-modal-notification.demo.min.js")}}></script>
    <script src={{ asset("admin_doc/assets/plugins/highlight/highlight.common.js")}}></script>
    <script src={{ asset("admin_doc/assets/js/demo/render.highlight.js")}}></script>
    <script src={{ asset("layer/layer.js")}}></script>
{{--    <script src="{{asset("js/checkbox.js")}}"  ></script>--}}
    <!-- ================== END PAGE LEVEL JS ================== -->

    <script>
        $(document).ready(function() {
            App.init();
            Notification.init();
            sortInit();
            lala();
            clickEvent();


            @if(Session::has("flash_message"))
                layer.msg("{!!Session::pull('flash_message') !!}",{time:1000});
            @endif

            // $.gritter.add({
            //     title:"权限",
            //     // text:$("#data-table-fixed-header->tbody->tr:eq(1)").text()+"创建成功",
            //     text:"创建成功",
            //  });
        });
    </script>
@stop




