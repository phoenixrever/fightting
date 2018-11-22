var permissionTableReady = function () {

    var settings;

    return {
        init: function (option) {
            if (option) {
                settings = option;
            }
            var table = $('#data-table-default').DataTable({
                processing: true,
                serverSide: true,
                mark: true,
                keys: {
                    keys: ["\t".charCodeAt(0), 38, 40]
                },
                ajax: settings.anyDataURL,
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
                "rowCallback": function (row, data) {
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
                    if (saveState[1] === 1) {
                        $("#delete-" + saveState[2]).parents("tr").addClass("changeColor");
                        // console.log( $("#delete-"+saveState[1]).parents("tr"));
                        saveState[1] = 0;
                    }
                },
                dom: 'lBfrtip',
                buttons: [
                    {
                        text: "Add",
                        name: 'add',
                        className: "btn-sm",
                        action: function (e, dt, node, config) {
                            $(".alert-warning").attr("hidden", true);
                            $("#submit_btn").val("add");
                            $("#modal-dialog").modal();
                            // JSON.stringify( dt.row( { selected: true } ).data() )
                        },
                    },
                    {
                        extend: 'selected', // Bind to Selected row
                        text: 'Edit',
                        name: 'edit',       // do not change name
                        className: "btn-sm",
                        action: function (e, dt, node, config) {
                            $("#submit_btn").val('edit');
                            // console.log(dt.row({selected:true}).data());
                            $("#permission_name").val(dt.row({selected: true}).data()['name']);
                            $("#permission_desc").val(dt.row({selected: true}).data()['description']);
                            // console.log(table.rows(".selected").data().length);
                            if (table.rows(".selected").data().length > 1) {
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
                        action: function (e, dt, node, config) {
                            var rowId = table.rows('.selected').data();
                            var ids = {};
                            for (var i = 0; i < table.rows('.selected').data().length; i++) {
                                ids[i] = rowId[i]['id'];
                            }
                            layer.msg('确认删除吗这' + rowId.length + '项嘛?', {
                                time: 200000,
                                btn: ['取消', '确认'],
                                btn1: function () {
                                    layer.closeAll();
                                },
                                btn2: function () {
                                    $.ajax({
                                        url: settings.deleteAll,
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
                                            } else {
                                                index = layer.msg('<span class="text-danger">' + data + '</span>', {
                                                    time: 1000,
                                                    btn: ['confirm']
                                                });
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
                columnNames: settings.columnNames,
                unique: settings.unique,
                line_edit: settings.line_edit,
                add: settings.add,
                deleteAll: settings.deleteAll,
                delete: settings.delete,
                _token: settings._token,
            });
            window.Parsley.on('field:validate', function (parsleyField) {
                if (parsleyField.$element.attr('name') == 'name') {
                    // given that this is the field we want, we'll hide the div
                    // console.log((new Date()).getTime());
                    $(".la-pacman").removeAttr("hidden");
                }
            });

            window.Parsley.on('field:validated', function (parsleyField) {
                if (parsleyField.$element.attr('name') == 'name') {
                    $(".la-pacman").attr("hidden", true);
                }
            });
            window.Parsley.addAsyncValidator('checkPermissionName', function (xhr) {
                console.log(settings.checkNameURL);
                var response = $.parseJSON(xhr.responseText);
                if (table.rows('.selected').data().length > 0) {
                    if ($.trim($("#permission_name").val()).replace(/[ ]/g, "") === table.rows('.selected').data()[0]['name']) {
                        return true;
                    }
                }
                return '1' === response['status'];

            },settings.checkNameURL);
        }
    }
}();