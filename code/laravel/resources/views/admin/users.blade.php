@extends('layouts.default')

@section('title', 'Users')

@section('css')
    {{--<link href="/assets/plugins/datatables/css/dataTables.bootstrap4.css" rel="stylesheet"/>--}}
    {{--<link href={{asset("assets/plugins/datatables/css/buttons/buttons.bootstrap4.css")}} rel="stylesheet"/>--}}
    {{--<link href="/assets/plugins/datatables/css/responsive/responsive.bootstrap4.css" rel="stylesheet"/>--}}
    {{--<link href="/assets/plugins/datatables/css/select/select.bootstrap4.min.css" rel="stylesheet"/>--}}
    {{--<link href="/assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />--}}
    {{--<link href="{{asset("load-awesome-1.1.0/docs/assets/loaders.css")}}" rel="stylesheet"/>--}}
    {{--<link href={{ asset("css/layer.css")}} rel="stylesheet"/>--}}
    {{--<link href="/css/transparent.css" rel="stylesheet"/>--}}
    <!-- ================== END PAGE LEVEL STYLE ================== -->
@endsection

@section('content')
    @if(request()->pjax())
        <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
        {{--<link href="/assets/plugins/datatables/css/dataTables.bootstrap4.css" rel="stylesheet"/>--}}
        {{--<link href={{asset("assets/plugins/datatables/css/buttons/buttons.bootstrap4.css")}} rel="stylesheet"/>--}}
        {{--<link href="/assets/plugins/datatables/css/responsive/responsive.bootstrap4.css" rel="stylesheet"/>--}}
        {{--<link href="/assets/plugins/datatables/css/select/select.bootstrap4.min.css" rel="stylesheet"/>--}}
        {{--<link href="/assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />--}}
        {{--<link href="{{asset("load-awesome-1.1.0/docs/assets/loaders.css")}}" rel="stylesheet"/>--}}
        {{--<link href={{ asset("css/layer.css")}} rel="stylesheet"/>--}}
        {{--<link href="/css/transparent.css" rel="stylesheet"/>--}}
        <!-- ================== END PAGE LEVEL STYLE ================== -->
    @endif

    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
        <li class="breadcrumb-item"><a href="javascript:;">Tables</a></li>
        <li class="breadcrumb-item active">Managed Tables</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Managed Tables
        <small>header small text goes here...</small>
    </h1>
    <!-- end page-header -->

    <!-- begin panel -->
    <div class="panel panel-inverse">
        <!-- begin panel-heading -->
        <div class="panel-heading">
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i
                            class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i
                            class="fa fa-redo"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i
                            class="fa fa-minus"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i
                            class="fa fa-times"></i></a>
            </div>
            <h4 class="panel-title">Data Table - Default</h4>
        </div>
        <!-- end panel-heading -->
        <!-- begin panel-body -->
        <div class="panel-body">
            <div class="table-responsive transparent-scrollbar">
                <table id="data-table-default" class="table table-striped table-bordered ">
                    {{--<table id="data-table-default" class="table table-striped table-bordered table-responsive">--}}
                    <thead>
                    <tr>
                        <th width="1%" class="select-all text-nowrap"></th>
                        <th width="1%">id</th>
                        <th width="5%">name</th>
                        <th width="15%">email</th>
                        <th width="15%" class="text-nowrap">roles</th>
                        <th width="5%" class="text-nowrap">created-at</th>
                        <th width="5%" class="text-nowrap">updated_at</th>
                        <th width="5%" class="text-nowrap">action</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
        <!-- end panel-body -->
    </div>
    <!-- end panel -->
    <!-- #modal-dialog -->
    <div class="modal fade " id="modal-dialog">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title .text-white">Modal Dialog</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body" style="overflow:hidden">
                    <div class="alert alert-warning fade show" hidden>
                        <span class="close" data-dismiss="alert">×</span>
                        <strong>Note!</strong>
                        multiple select will only access the first data!
                    </div>
                    <form id="modal-form" class="form-horizontal"
                          data-parsley-validate="true">

                        <div class="form-group row m-b-15">
                            <label class="col-md-4 col-sm-4 col-form-label pull-right" for="user-name">用户名 :</label>
                            <div class="col-md-8 col-sm-8">
                                <input type="text" class="form-control" id="user-name" name="name"
                                       data-parsley-required="true"
                                       onkeyup="this.value=this.value.replace(/[ ]/g,'');"
                                       data-parsley-trigger="blur"
                                       data-parsley-remote-options='{ "type": "POST","cache":"false"}'
                                       data-parsley-remote-validator="checkUserName"
                                       data-parsley-remote-message="user name already exists."
                                       data-parsley-remote
                                       placeholder="Required"/>
                                <div class="la-pacman la-sm m-t-5 " id="name-hide" hidden>
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row m-b-15">
                            <label class="col-md-4 col-sm-4 col-form-label" for="user-email">邮箱 :</label>
                            <div class="col-md-8 col-sm-8">
                                <input type="email" class="form-control" id="user-email" name="email"
                                       data-parsley-required="true"
                                       onkeyup="this.value=this.value.replace(/[ ]/g,'');"
                                       data-parsley-trigger="blur"
                                       data-parsley-type="email"
                                       data-parsley-remote-options='{ "type": "POST","cache":"false"}'
                                       data-parsley-remote-validator="checkEmailName"
                                       data-parsley-remote-message="Email already exists."
                                       data-parsley-remote
                                       placeholder="Required"/>
                                <div class="la-pacman la-sm m-t-5" id="email-hide" hidden>
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                </div>
                            </div>

                        </div>

                        <div class="form-group row m-b-15">
                            <label class="col-md-4 col-sm-4 col-form-label" for="multiple-select2-modal">角色名称 :</label>
                            <div class="col-md-8 col-sm-8">
                                <div id="error-border">
                                    <select id="multiple-select2-modal" class="multiple-select2 form-control" multiple="multiple"
                                            name="roles"
                                            data-parsley-trigger="change"
                                            data-parsley-maxcheck="5"
                                            data-parsley-errors-container="#select2-error-box"></select>
                                </div>
                                <div id="select2-error-box"></div>
                            </div>

                        </div>

                        <div class="form-group row m-b-15 pass-hide">
                            <label class="col-md-4 col-sm-4 col-form-label" for="password">密码 :</label>
                            <div class="col-md-8 col-sm-8">
                                <input type="password" class="form-control" id="password" name="password"
                                       data-parsley-required="true"
                                       data-parsley-trigger="change"
                                       onkeyup="this.value=this.value.replace(/[ ]/g,'');"
                                       data-parsley-length="[6, 20]"
                                       data-parsley-uppercase="1"
                                       data-parsley-lowercase="1"
                                       data-parsley-number="1"
                                       {{--data-parsley-special="1"--}}
                                       placeholder="Required">
                            </div>
                        </div>

                        <div class="form-group row m-b-15 pass-hide">
                            <label class="col-md-4 col-sm-4 col-form-label" for="password_confirmation">确认密码 :</label>
                            <div class="col-md-8 col-sm-8">
                                <input type="password" class="form-control" id="password_confirmation"
                                       name="password_confirmation"
                                       data-parsley-required="true"
                                       data-parsley-trigger="change"
                                       onkeyup="this.value=this.value.replace(/[ ]/g,'');"
                                       data-parsley-equalto="#password"
                                       placeholder="Required">
                            </div>
                        </div>


                        <div class="form-group row m-b-0">
                            <label class="col-md-4 col-sm-4 col-form-label">&nbsp;</label>
                            <div class="col-md-8 col-sm-8 button-loader">
                                <button type="submit" id="submit_btn" class="btn btn-primary" validate>Submit</button>
                                <div style="color: yellow" class="la-ball-clip-rotate-pulse la">
                                    <div></div>
                                    <div></div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end modal-dialog -->
    @if(request()->pjax())
        <script>
            // App.setPageTitle('Usersssssssssss');
            App.restartGlobalFunction();

            $.getScript("{{asset("js/ready/userTableReady.js")}}").done(function () {
                $.when(
                    $.Deferred(function (deferred) {
                        $(deferred.resolve);
                    })
                ).done(function () {
                    userTableReady.init({
                        anyDataURL: "{{route('users.anyData')}}",
                        columnNames: ["name", "email","roles"],
                        unique: ["name","email"],
                        select2ColName:'roles',
                        line_edit: "{{url()->current()}}",
                        add: "{{route("users.store")}}",
                        deleteAll: "{{route("users.multiDelete")}}",
                        delete: "{{url()->current()}}",
                        _token: "{{csrf_token()}}",
                        checkEmailURL: "{{route("users.checkEmail")}}",
                        select2RolesURL:'{{route('select2',['roles'])}}',
                    });
                });
            });
        </script>
    @endif
@endsection

@section('scripts')
    {{--<script src={{asset("assets/plugins/datatables/js/jquery.dataTables.js")}}></script>--}}
    {{--<script src="/assets/plugins/datatables/js/dataTables.bootstrap4.js"></script>--}}
    {{--<script src="/assets/plugins/datatables/js/buttons/dataTables.buttons.js"></script>--}}
    {{--<script src="/assets/plugins/datatables/js/buttons/buttons.bootstrap4.js"></script>--}}
    {{--<script src="/assets/plugins/datatables/js/buttons/buttons.flash.js"></script>--}}
    {{--<script src={{asset("assets/plugins/datatables/js/buttons/jszip.min.js")}}></script>--}}
    {{--<script src={{asset("assets/plugins/datatables/js/buttons/pdfmake.min.js")}}></script>--}}
    {{--<script src={{asset("assets/plugins/datatables/js/buttons/vfs_fonts.min.js")}}></script>--}}
    {{--<script src="/assets/plugins/datatables/js/buttons/buttons.html5.js"></script>--}}
    {{--<script src="/assets/plugins/datatables/js/buttons/buttons.print.js"></script>--}}
    {{--<script src={{asset("assets/plugins/datatables/js/keyTable/dataTables.keyTable.js")}}></script>--}}
    {{--<script src="/assets/plugins/datatables/js/responsive/dataTables.responsive.js"></script>--}}
    {{--<script src="/assets/plugins/datatables/js/responsive/responsive.bootstrap4.js"></script>--}}
    {{--<script src={{asset("assets/plugins/datatables/js/select/dataTables.select.js")}}></script>--}}
    {{--<script src={{asset("js/editor.js")}}></script>--}}
    <script src={{asset("js/ready/userTableReady.js")}}></script>
    <script>
        $(document).ready(function () {
            userTableReady.init({
                anyDataURL: "{{route('users.anyData')}}",
                columnNames: ["name", "email","roles"],
                unique: ["name","email"],
                select2ColName:'roles',
                line_edit: "{{url()->current()}}",
                add: "{{route("users.store")}}",
                deleteAll: "{{route("users.multiDelete")}}",
                delete: "{{url()->current()}}",
                _token: "{{csrf_token()}}",
                checkEmailURL: "{{route("users.checkEmail")}}",
                checkUserNameURL: "{{route("users.checkUserName")}}",
                select2RolesURL:'{{route('select2',['roles'])}}',
            });
        });
    </script>
@endsection

