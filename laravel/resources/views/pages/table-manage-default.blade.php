@extends('layouts.default')

@section('title', 'Managed Tables')

@push('css')
    <link href="/assets/plugins/datatables/css/dataTables.bootstrap4.css" rel="stylesheet"/>
    <link href="/assets/plugins/datatables/css/buttons/buttons.bootstrap4.css" rel="stylesheet" />
    <link href="/assets/plugins/datatables/css/responsive/responsive.bootstrap4.css" rel="stylesheet"/>
    <link href="/assets/plugins/datatables/css/select/select.bootstrap4.min.css" rel="stylesheet"/>
    <link href="{{asset("load-awesome-1.1.0/docs/assets/loaders.css")}}" rel="stylesheet"/>
    <link href={{ asset("css/layer.css")}} rel="stylesheet" />
    <link href="/css/processing.css" rel="stylesheet"/>
    {{--<link href={{asset("css/permission_default.css")}} rel="stylesheet"/>--}}

    <!-- ================== END PAGE LEVEL STYLE ================== -->
@endpush

@section('content')
    @if(request()->pjax())
        <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
        <link href="/assets/plugins/datatables/css/dataTables.bootstrap4.css" rel="stylesheet"/>
        <link href="/assets/plugins/datatables/css/responsive/responsive.bootstrap4.css" rel="stylesheet"/>
        <link href={{asset("assets/plugins/datatables/css/keyTable/keyTable.bootstrap4.min.css")}} rel="stylesheet"/>
        <link href={{ asset("assets/plugins/parsleyjs/src/parsley.css")}} rel="stylesheet" />
        <link href={{ asset("css/layer.css")}} rel="stylesheet" />
        <link href="/css/processing.css" rel="stylesheet"/>
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
                    <th width="1%" >id</th>
                    <th width="5%">name</th>
                    <th width="15%">description</th>
                    <th width="5%" >created-at</th>
                    <th width="5%" >updated_at</th>
                    <th width="5%">action</th>
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
                          data-parsley-validate="true"  >

                        <div class="form-group row m-b-15">
                            <label class="col-md-4 col-sm-4 col-form-label" for="permission_name">权限名称 :</label>
                            <div class="col-md-8 col-sm-8">
                                <input type="text" class="form-control" id="permission_name"
                                       name="name" data-parsley-required="true" onkeyup="this.value=this.value.replace(/[ ]/g,'');"
                                       data-parsley-trigger="blur"
                                       data-parsley-remote-options='{ "type": "POST" ,"_token": "{{ csrf_token() }}","cache":"false"}'
                                       data-parsley-remote-validator="validateName"
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
                            <label class="col-md-4 col-sm-4 col-form-label" for="permission_desc">权限描述 :</label>
                            <div class="col-md-8 col-sm-8">
                                <textarea class="form-control" id="permission_desc" name="description" rows="4"
                                          data-parsley-required="true"
                                          data-parsley-trigger="change"
                                          data-parsley-maxlength="200"
                                          placeholder="Range from 20 - 200"></textarea>
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
            App.setPageTitle('Color Admin | Managed Tables');
            App.restartGlobalFunction();

            $.getScript('/assets/plugins/datatables/js/jquery.dataTables.js').done(function () {
                $.when(
                    $.getScript("/assets/plugins/datatables/js/dataTables.bootstrap4.js"),
                    $.getScript("/assets/plugins/datatables/js/buttons/dataTables.buttons.js"),
                    $.getScript("/assets/plugins/datatables/js/buttons/buttons.bootstrap4.js"),
                    $.getScript("/assets/plugins/datatables/js/responsive/dataTables.responsive.js"),
                    $.getScript("/assets/plugins/datatables/js/responsive/responsive.bootstrap4.js"),
                    $.getScript("/assets/plugins/datatables/js/responsive/responsive.bootstrap4.js"),
                    $.getScript("/assets/plugins/datatables/js/select/dataTables.select.js"),
                    $.getScript("/assets/js/editor.js"),
                    $.Deferred(function (deferred) {
                        $(deferred.resolve);
                    })
                ).done(function () {
                    init();
                });
            });
        </script>
    @endif
@endsection

@push('scripts')
    <script src={{asset("assets/plugins/datatables/js/jquery.dataTables.js")}}></script>
    <script src="/assets/plugins/datatables/js/dataTables.bootstrap4.js"></script>
    <script src="/assets/plugins/datatables/js/buttons/dataTables.buttons.js"></script>
    <script src="/assets/plugins/datatables/js/buttons/buttons.bootstrap4.js"></script>
    {{--<script src="/assets/plugins/datatables/js/buttons/buttons.flash.js"></script>--}}
    {{--<script src={{asset("assets/plugins/datatables/js/buttons/jszip.min.js")}}></script>--}}
    {{--<script src={{asset("assets/plugins/datatables/js/buttons/pdfmake.min.js")}}></script>--}}
    {{--<script src={{asset("assets/plugins/datatables/js/buttons/vfs_fonts.min.js")}}></script>--}}
    {{--<script src="/assets/plugins/datatables/js/buttons/buttons.html5.js"></script>--}}
    {{--<script src="/assets/plugins/datatables/js/buttons/buttons.print.js"></script>--}}
    <script src={{asset("assets/plugins/datatables/js/keyTable/dataTables.keyTable.js")}}></script>
    <script src="/assets/plugins/datatables/js/responsive/dataTables.responsive.js"></script>
    <script src="/assets/plugins/datatables/js/responsive/responsive.bootstrap4.js"></script>
    <script src={{asset("assets/plugins/datatables/js/select/dataTables.select.js")}}></script>
    <script src={{asset("assets/js/editor.js")}}></script>
    <script>
        $(document).ready(function () {
            var init=function(){
                var table = $('#data-table-default').DataTable({
                    processing: true,
                    serverSide: true,
                    mark: true,
                    keys: {
                        keys: [ "\t".charCodeAt(0),38,40 ]
                    },
                    ajax: '{!! route('permissions.anyData') !!}',
                    // rowId: 'id',
                    select: {
                        style: 'os',
                        selector: 'td:first-child'
                    },

                    columns: [
                        {
                            className: 'select-checkbox',
                            // targets:  0,
                            orderable: false,
                            searchable: false,
                            data: null,
                            defaultContent: ''
                        },
                        {data: 'DT_Row_Index', orderable: false, searchable: false},
                        {data: 'name', name: 'name'},
                        {
                            data: 'description',
                            name: 'description',
                            // render: function (data, type, full, meta) {
                            //     return  data.substr(0,50);
                            // },
                            // targets: 3,
                        },
                        {data: 'created_at', name: 'created_at'},
                        {data: 'updated_at', name: 'updated_at'},
                        {data: 'action', name: 'action', orderable: false, searchable: false}
                    ],
                    order: [[5, 'desc']],
                    "rowCallback": function( row, data ) {
                    },
                    drawCallback: function (settings) {
                        // if (saveState[1] !== 0 || saveState[2] !== 0) {
                        // table.rows( ".selected").deselect();
                        // table.row("#"+saveState[1]).select();
                        saveState[0] = 1;
                        //     console.log(saveState[4] - saveState[5]);
                        //     if (saveState[4] - saveState[5] === 1 && table.page.info().page===saveState[6]) {
                        //         table.cell(saveState[1], saveState[2]).focus();
                        //     }
                        // }
                        if(saveState[3]===1){
                            $("#delete-"+saveState[1]).parents("tr").addClass("changeColor");
                            // console.log( $("#delete-"+saveState[1]).parents("tr"));
                            saveState[3]=0;
                        }
                    },
                    dom: 'lBfrtip',
                    buttons: [
                        {
                            text: "Add",
                            name: 'add',
                            className: "btn-sm",
                            action: function ( e, dt, node, config ) {
                                $(".alert-warning").attr("hidden",true);
                                $("#submit_btn").val("add");
                                $("#modal-dialog").modal();
                                // JSON.stringify( dt.row( { selected: true } ).data() )
                            },
                        },
                        {
                            extend: 'selected', // Bind to Selected row
                            text: 'Edit',
                            name: 'edit' ,       // do not change name
                            className: "btn-sm",
                            action: function ( e, dt, node, config ) {
                                $("#submit_btn").val('edit');
                                // console.log(dt.row({selected:true}).data());
                                $("#permission_name").val(dt.row({selected:true}).data()['name']);
                                $("#permission_desc").val(dt.row({selected:true}).data()['description']);
                                // console.log(table.rows(".selected").data().length);
                                if(table.rows(".selected").data().length>1){
                                    $(".alert-warning").removeAttr("hidden");
                                }
                                $("#modal-dialog").modal();
                                // JSON.stringify( dt.row( { selected: true } ).data() )
                            },
                        },
                        {
                            extend: 'selected', // Bind to Selected row
                            text: 'Delete',
                            name: 'delete',
                            className: "btn-sm m-r-20",
                            action: function ( e, dt, node, config ) {
                                var rowId=table.rows('.selected').data();
                                var ids={};
                                for(var i=0;i<table.rows('.selected').data().length;i++){
                                    ids[i]=rowId[i]['id'];
                                }
                                layer.msg('确认删除吗这'+rowId.length+'项嘛?', {
                                    time:200000,
                                    btn: ['取消', '确认'],
                                    btn1: function () {
                                        layer.closeAll();
                                    },
                                    btn2: function () {
                                        $.ajax({
                                            url: "{{route('permissions.multiDelete')}}",
                                            type: 'DELETE',
                                            dataType: 'json',
                                            data: {
                                                data: JSON.stringify(ids)
                                            },
                                            success: function (data) {
                                                // console.log(data);
                                                if (data['success'] === "1") {
                                                    var currentPageIndex = table.page.info().page;
                                                    table.page(currentPageIndex).draw(false);
                                                }else{
                                                    index= layer.msg('<span class="text-danger">'+data+'</span>',{time:1000,btn:['confirm']});
                                                }
                                            },
                                        });
                                    }
                                });
                            }
                        },
                        // {extend: "copy", className: "btn-sm"},
                        // {extend: "csv", className: "btn-sm"},
                        // {extend: "excel", className: "btn-sm"},
                        // {extend: "pdf", className: "btn-sm"},
                        // {extend: "print", className: "btn-sm"},
                    ],
                });
                table.cellEditor({
                    columnNames: ["name", "description"],
                    unique:"name",
                    line_edit: "{{url()->current()}}",
                    add:"{{route("permissions.store")}}",
                    deleteAll:"{{route("permissions.multiDelete")}}",
                    delete:"{{url()->current()}}",
                    _token: "{{ csrf_token() }}",
                });
                window.Parsley.on('parsley:field:validate', function(parsleyField) {
                    // We need to check what is the validated field
                    if (parsleyField.$element.attr('name') == 'name') {
                        // given that this is the field we want, we'll hide the div
                        // console.log((new Date()).getTime());
                        $(".la-pacman").removeAttr("hidden");
                    }
                });

                window.Parsley.on('parsley:field:validated', function(parsleyField) {
                    if (parsleyField.$element.attr('name') == 'name') {
                        $(".la-pacman").attr("hidden",true);
                    }
                });
                window.Parsley.addAsyncValidator('validateName', function (xhr) {
                    var  response = $.parseJSON(xhr.responseText);
                    if(table.rows('.selected').data().length>0){
                        if($.trim($("#permission_name").val()).replace(/[ ]/g,"")===table.rows('.selected').data()[0]['name']){
                            return true;
                        }
                    }
                    return '1'===response['status'];

                }, '{{URL('permissions/checkName')}}',{
                    "data":{
                        "name":$("#permission_name").val(),
                    }
                });
            };
            init();
        });
    </script>
@endpush

