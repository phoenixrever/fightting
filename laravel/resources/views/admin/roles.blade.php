@extends('layouts.default')

@section('title', 'Roles')

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
                        <th width="1%" class="select-all"> </th>
                        <th width="1%">id</th>
                        <th width="5%">name</th>
                        <th width="15%" class="text-nowrap">permissions</th>
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
                <div class="modal-body">
                    <div class="alert alert-warning fade show" hidden>
                        <span class="close" data-dismiss="alert">×</span>
                        <strong>Note!</strong>
                        multiple select will only access the first data!
                    </div>
                    <form id="modal-form" class="form-horizontal"
                          data-parsley-validate="true">

                        <div class="form-group row m-b-15">
                            <label class="col-md-4 col-sm-4 col-form-label" for="role-name">名称 :</label>
                            <div class="col-md-8 col-sm-8">
                                <input type="text" class="form-control" id="role-name"
                                       name="name" data-parsley-required="true"
                                       onkeyup="this.value=this.value.replace(/[ ]/g,'');"
                                       data-parsley-trigger="blur"
                                       data-parsley-remote-options='{ "type": "POST" ,"_token": "{{ csrf_token() }}","cache":"false"}'
                                       data-parsley-remote-validator="checkRoleName"
                                       data-parsley-remote-message="Name already exists."
                                       data-parsley-remote
                                       data-parsley-maxlength="20" placeholder="Required"/>
                                <div class="la-pacman la-sm m-t-5" hidden>
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
                            <label class="col-md-4 col-sm-4 col-form-label" for="multiple-select2-modal">权限名称 :</label>
                            <div class="col-md-8 col-sm-8">
                                <div id="error-border">
                                    <select id="multiple-select2-modal" class="multiple-select2 form-control" multiple="multiple"
                                        name="permissions"
                                            {{--你他妈逗我!!!!!data-parsley-mincheck="2"--}}
                                        data-parsley-required="true" data-parsley-maxcheck="20"
                                        data-parsley-trigger="change" data-parsley-errors-container="#select2-error-box"></select>
                                </div>
                                <div id="select2-error-box"></div>
                            </div>

                        </div>
                        <div id="#select2-errors"></div>
                        <div class="form-group row m-b-0">
                            <label class="col-md-4 col-sm-4 col-form-label">&nbsp;</label>
                            <div class="col-md-8 col-sm-8 button-loader">
                                <button type="submit" id="submit_btn" class="btn btn-primary">Submit</button>
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
            App.setPageTitle('Color Admin | Managed Tables');
            App.restartGlobalFunction();

            $.getScript("{{asset("js/ready/roleTableReady.js")}}").done(function () {
                $.when(
                    $.Deferred(function (deferred) {
                        $(deferred.resolve);
                    })
                ).done(function () {
                    $(document).ready(function () {
                        roleTableReady.init({
                            anyDataURL: "{{route('roles.anyData')}}",
                            columnNames:["name","permissions"],
                            unique: ["name"],
                            select2ColName:'permissions',
                            line_edit: "{{url()->current()}}",
                            add: "{{route("roles.store")}}",
                            deleteAll: "{{route("roles.multiDelete")}}",
                            delete: "{{url()->current()}}",
                            _token: "{{csrf_token()}}",
                            checkNameURL: "{{route("roles.checkRole")}}",
                            select2PermissionsURL:'{{route('select2',['permissions'])}}',
                        });
                    });
                });

            {{--$.getScript('/assets/plugins/datatables/js/jquery.dataTables.js').done(function () {--}}
                {{--$.when(--}}
                    {{--$.getScript("/assets/plugins/datatables/js/dataTables.bootstrap4.js"),--}}
                    {{--$.getScript("/assets/plugins/datatables/js/buttons/dataTables.buttons.js"),--}}
                    {{--$.getScript("/assets/plugins/datatables/js/buttons/buttons.bootstrap4.js"),--}}
                    {{--$.getScript("/assets/plugins/datatables/js/responsive/dataTables.responsive.js"),--}}
                    {{--$.getScript("/assets/plugins/datatables/js/responsive/responsive.bootstrap4.js"),--}}
                    {{--$.getScript("/assets/plugins/datatables/js/responsive/responsive.bootstrap4.js"),--}}
                    {{--$.getScript("/assets/plugins/datatables/js/select/dataTables.select.js"),--}}
                    {{--$.getScript("{{asset("assets/plugins/select2/dist/js/select2.js")}}"),--}}
                    {{--$.getScript("{{asset("js/editor.js")}}"),--}}
                    {{--$.getScript("{{asset("js/ready/roleTableReady.js")}}"),--}}
                    {{--$.Deferred(function (deferred) {--}}
                        {{--$(deferred.resolve);--}}
                    {{--})--}}
                {{--).done(function () {--}}
                    {{--$(document).ready(function () {--}}
                        {{--roleTableReady.init({--}}
                            {{--anyDataURL: "{{route('roles.anyData')}}",--}}
                            {{--columnNames:["name","permissions"],--}}
                            {{--unique: "name",--}}
                            {{--line_edit: "{{url()->current()}}",--}}
                            {{--add: "{{route("roles.store")}}",--}}
                            {{--deleteAll: "{{route("roles.multiDelete")}}",--}}
                            {{--delete: "{{url()->current()}}",--}}
                            {{--_token: "{{csrf_token()}}",--}}
                            {{--checkNameURL: "{{route("roles.checkRole")}}",--}}
                            {{--select2URL:'{{route('permissions.select2')}}',--}}
                        {{--});--}}
                    {{--});--}}
                {{--});--}}
            });
        </script>
    @endif
@endsection

@section('scripts')
    {{--<script src={{asset("assets/plugins/datatables/js/jquery.dataTables.js")}}></script>--}}
    {{--<script src="/assets/plugins/datatables/js/dataTables.bootstrap4.js"></script>--}}
    {{--<script src="/assets/plugins/datatables/js/buttons/dataTables.buttons.js"></script>--}}
    {{--<script src="/assets/plugins/datatables/js/buttons/buttons.bootstrap4.js"></script>--}}
    {{--<script src={{asset("assets/plugins/datatables/js/keyTable/dataTables.keyTable.js")}}></script>--}}
    {{--<script src="/assets/plugins/datatables/js/responsive/dataTables.responsive.js"></script>--}}
    {{--<script src="/assets/plugins/datatables/js/responsive/responsive.bootstrap4.js"></script>--}}
    {{--<script src={{asset("assets/plugins/datatables/js/select/dataTables.select.js")}}></script>--}}
    {{--<script src={{asset("assets/plugins/select2/dist/js/select2.js")}}></script>--}}
    <script src={{asset("js/ready/roleTableReady.js")}}></script>
    <script>
        $(document).ready(function () {
            roleTableReady.init({
                    anyDataURL: "{{route('roles.anyData')}}",
                    columnNames:["name","permissions"],
                    unique: ["name"],
                    select2ColName:'permissions',
                    line_edit: "{{url()->current()}}",
                    add: "{{route("roles.store")}}",
                    deleteAll: "{{route("roles.multiDelete")}}",
                    delete: "{{url()->current()}}",
                    _token: "{{csrf_token()}}",
                    checkNameURL: "{{route("roles.checkRole")}}",
                    select2PermissionsURL:'{{route('select2',['permissions'])}}',
            });
        });
    </script>
@endsection

