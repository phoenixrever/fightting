var roleTableReady = function () {

    var settings;
    var select2ElemModal=null;

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
                        orderable: false,
                        searchable: false,
                        data: null,
                        defaultContent: ''
                    },
                    {data: 'DT_Row_Index', orderable: false, searchable: false},
                    {data: 'name', name: 'name'},
                    {
                        data: 'permissions',
                        name: 'permissions',
                        orderable: false,
                        // render: function ( data, type, row, meta ) {
                        //     var selectStr='<select class="multiple-select2 form-control-sm" multiple="multiple">';
                        //     selectStr=selectStr+'<option value="'+value+'">'+value+'</option>';
                        //     $.each(data,function(key,value){
                        //        selectStr=selectStr+'<option value="'+value+'">'+value+'</option>';
                        //     });
                        //     selectStr=selectStr+ '</select>';
                        //     return selectStr;
                        // }
                    },
                    {data: 'created_at', name: 'created_at'},
                    {data: 'updated_at', name: 'updated_at'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ],
                order: [[5, 'desc']],

                drawCallback: function (settings) {
                    // $(".multiple-select2").select2({placeholder:"Select a state"});
                    // saveState[3]=$(".multiple-select2");
                    // saveState[4]=$(".select2-container");
                    // $(".multiple-select2").remove();
                    // $(".select2-container").remove();
                    // $(".select2-container").show();
                    saveState[0] = 1;
                    if (saveState[1] === 1) {
                        $("#delete-" + saveState[2]).parents("tr").addClass("changeColor");
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
                            select2ElemModal=$("#multiple-select2-modal").select2({
                                width: '100%',
                                closeOnSelect: false,
                                data:select2Options,
                            });
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
                            $("#role-name").val(dt.row({selected: true}).data()['name']);
                            // console.log(table.rows(".selected").data().length);
                            if (table.rows(".selected").data().length > 1) {
                                $(".alert-warning").removeAttr("hidden");
                            }
                            var permissions=new Array();
                            $(dt.row({selected: true}).data()['permissions']).each(function(){
                                permissions.push($(this).text());
                            });
                            var str='';
                            for(var i=0;i<permissions.length;i++){
                                str+='<option value="' +permissions[i] + '" selected>' +permissions[i] + '</option>'
                            }
                            $("#modal-dialog").modal();
                            $("#multiple-select2-modal").append(str);
                            select2ElemModal=$("#multiple-select2-modal").select2({
                                width: '100%',
                                closeOnSelect: false,
                                data:select2Options,
                            });
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
                select2URL:settings.select2PermissionsURL,
                select2ColName:settings.select2ColName,
            });
            $("#role-name").parsley().on('field:validate', function (parsleyField) {
                if (parsleyField.$element.attr('name') == 'name') {
                    // given that this is the field we want, we'll hide the div
                    // console.log((new Date()).getTime());
                    $(".la-pacman").removeAttr("hidden");
                }
            });

            $("#role-name").parsley().on('field:validated', function (parsleyField) {
                if (parsleyField.$element.attr('name') == 'name') {
                    $(".la-pacman").attr("hidden", true);
                }
            });
            window.Parsley.addAsyncValidator('checkRoleName', function (xhr) {
                console.log(settings.checkNameURL);
                var response = $.parseJSON(xhr.responseText);
                if (table.rows('.selected').data().length > 0) {
                    if ($.trim($("#role_name").val()).replace(/[ ]/g, "") === table.rows('.selected').data()[0]['name']) {
                        return true;
                    }
                }
                return '1' === response['status'];

            },settings.checkNameURL);

            $("#multiple-select2-modal").change(function() {
                select2ElemModal.resize();
                $(this).parsley().validate();
                if($(this).parsley().isValid()){
                    $(".error-border").removeClass("parsley-error");
                    $(".error-border").addClass("parsley-success");
                }else{
                    $(".error-border").removeClass("parsley-success");
                    $(".error-border").addClass("parsley-error");
                }
            });
            $('#multiple-select2-modal').on('select2:open',function() {
                if(!$("#error-border").hasClass("error-border")){
                    $("#error-border").addClass("error-border")
                }
            });
            // $(document).on('select2:close','#multiple-select2-modal',function() {
            //     if($("#error-border").hasClass("error-border")) {
            //         $("#error-border").removeClass("error-border")
            //     }
            // });
            $(document).on('change','#multiple-select2',function() {
              if($("#multiple-select2").val().length>0 && $("#multiple-select2").val().length<=5){
                  $(".error-border").removeClass("parsley-error");
                  $(".error-border").addClass("parsley-success");
                }else{
                  $(".error-border").removeClass("parsley-success");
                  $(".error-border").addClass("parsley-error");
                 }
            });
        }
    }
}();