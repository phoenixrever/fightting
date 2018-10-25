@extends("layouts.admin.base")

@section("title")
    "用户管理"
@stop

@section("other_head")

    <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
    <link href="{{asset("admin_doc/assets/plugins/bootstrap-wysihtml5/dist/bootstrap3-wysihtml5.min.css")}}" rel="stylesheet"/>
    <link href="{{asset("admin_doc/assets/plugins/parsley/src/parsley.css")}}" rel="stylesheet" />
    <!-- ================== END PAGE LEVEL STYLE ================== -->

@stop

@section('content')

    <!-- begin #content -->
    <div id="content" class="content">
        <!-- begin breadcrumb -->
        <ol class="breadcrumb pull-right">
            <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
            <li class="breadcrumb-item"><a href="javascript:;">Form Stuff</a></li>
            <li class="breadcrumb-item active">Form WYSIWYG</li>
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">Form WYSIWYG
            <small>header small text goes here...</small>
        </h1>
        <!-- end page-header -->


        <div class="panel panel-inverse col-lg-10" data-sortable-id="form-plugins-14">
            {{--<!-- begin panel-heading -->--}}
            {{--<div class="panel-heading">--}}
                {{--<div class="panel-heading-btn">--}}
                    {{--<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>--}}
                    {{--<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>--}}
                    {{--<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>--}}
                    {{--<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>--}}
                {{--</div>--}}
                {{--<h4 class="panel-title">Masked Input</h4>--}}
            {{--</div>--}}
            <!-- end panel-heading -->
                <!-- begin panel-body -->
                <div class="panel-body">
                    <form  method="POST" action="{{ route('blogs.store') }}" data-parsley-validate="true" name="demo-form">

                        @csrf

                        <label class="col-form-label" for="fullname">标题 * :</label>
                        <div class="form-group row m-b-15">
                            <div class="col-md-12 col-sm-12">
                                <input class="form-control" type="text" id="fullname" name="fullname" placeholder="Required" data-parsley-required="true" />
                            </div>
                        </div>

                        {{--<label class="col-form-label" for="email">Email * :</label>--}}
                        {{--<div class="form-group row m-b-15">--}}
                            {{--<div class="col-md-12 col-sm-12">--}}
                                {{--<input class="form-control" type="text" id="email" name="email" data-parsley-type="email" placeholder="Email" data-parsley-required="true" />--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<label class="col-form-label" for="website">Website :</label>--}}
                        {{--<div class="form-group row m-b-15">--}}
                            {{--<div class="col-md-12 col-sm-12">--}}
                                {{--<input class="form-control" type="url" id="website" name="website" data-parsley-type="url" placeholder="url" />--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        <label class="col-form-label" for="content">正文 :</label>
                        <div class="form-group row m-b-15">
                            <div class="col-md-12 col-sm-12">
                                <textarea id="my-editor" name="content" class="form-control">{!! old('content', 'test editor content') !!}</textarea>
                            </div>
                        </div>

                        <div class="form-group row m-b-0">
                            <div class="col-md-12 col-sm-12">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>

                    </form>
                </div>
                <!-- end panel-body -->
        </div>
    </div>
    <!-- end #content -->
@stop

@section("other_script")

    <!-- ================== BEGIN PAGE LEVEL JS ================== -->
    {{--<script src={{asset("admin_doc/assets/plugins/ckeditor/ckeditor.js")}}></script>--}}
    <script src={{asset("admin_doc/assets/plugins/bootstrap-wysihtml5/dist/bootstrap3-wysihtml5.all.min.js")}}></script>
    <script src={{asset("admin_doc/assets/js/demo/form-wysiwyg.demo.min.js")}}></script>
    <script src={{asset("admin_doc/assets/plugins/parsley/dist/parsley.js")}}></script>
    <script src={{asset("admin_doc/assets/plugins/highlight/highlight.common.js")}}></script>
    <script src={{asset("admin_doc/assets/js/demo/render.highlight.js")}}></script>
    <script src={{asset("admin_doc/assets/js/demo/render.highlight.js")}}></script>
    <!-- ================== END PAGE LEVEL JS ================== -->

    <script>
        $(document).ready(function () {
            App.init();
            FormWysihtml5.init();
            var options = {
                filebrowserBrowseUrl : '/elfinder/ckeditor',
                extraPlugins: 'justify',
                skins: 'moono-dark',
            };
            CKEDITOR.replace('my-editor', options);
        });
    </script>
@stop