var userTableReady = function () {

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
                        // targets:  0,
                        orderable: false,
                        searchable: false,
                        data: null,
                        defaultContent: ''
                    },
                    {data: 'DT_Row_Index', orderable: false, searchable: false},
                    {data: 'name', name: 'name'},
                    {
                        data: 'email',
                        name: 'email',
                        // render: function (data, type, full, meta) {
                        //     return  data.substr(0,50);
                        // },
                        // targets: 3,
                    },
                    {
                        data: 'roles',
                        name: 'roles',
                        orderable: false,
                    },
                    {data: 'created_at', name: 'created_at'},
                    {data: 'updated_at', name: 'updated_at'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ],
                order: [[6, 'desc']],
                drawCallback: function (settings) {
                    saveState[0] = 1;
                    if (saveState[1] === 1) {
                        console.log(saveState[2]);
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
                            $(".pass-hide").show();
                            $("#modal-dialog").modal();
                            // JSON.stringify( dt.row( { selected: true } ).data() )
                            // $("#multiple-select2-modal option").remove();
                            select2ElemModal=$("#multiple-select2-modal").select2({
                                width: '100%',
                                multiple: true,
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
                            $("#user-name").val(dt.row({selected: true}).data()['name']);
                            $("#user-email").val(dt.row({selected: true}).data()['email']);
                            $(".pass-hide").hide();
                            // console.log(table.rows(".selected").data().length);
                            if (table.rows(".selected").data().length > 1) {
                                $(".alert-warning").removeAttr("hidden");
                            }
                            var roles=new Array();
                            $(dt.row({selected: true}).data()['roles']).each(function(){
                                roles.push($(this).text());
                            });
                            var str='';
                           for(var i=0;i<roles.length;i++){
                               str+='<option value="' +roles[i] + '" selected>' +roles[i] + '</option>'
                           }
                            console.log(str);
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
                select2URL:settings.select2RolesURL,
                select2ColName:settings.select2ColName,
            });
            $("#user-email").parsley().on('field:validate', function (parsleyField) {
                // We need to check what is the validated field
                // if (parsleyField.$element.attr('name') === 'email') {
                    // given that this is the field we want, we'll hide the div
                    // console.log((new Date()).getTime());
                    $("#email-hide").removeAttr("hidden");
                // }
            });

            $("#user-email").parsley().on('field:validated', function (parsleyField) {
                // if (parsleyField.$element.attr('name') === 'email') {
                $("#email-hide").attr("hidden", true);
                // }
            });

            $("#user-name").parsley().on('field:validate', function (parsleyField) {
                $("#name-hide").removeAttr("hidden");
            });

            $("#user-name").parsley().on('field:validated', function (parsleyField) {
                $("#name-hide").attr("hidden", true);
            });


            // window.Parsley.addValidator('uppercase', {
            //     requirementType: 'number',
            //     validateString: function (value, requirement) {
            //         var uppercases = value.match(/[A-Z]/g) || [];
            //         return uppercases.length >= requirement;
            //     },
            //     messages: {
            //         en: 'Your password must contain at least (%s) uppercase letter.'
            //     }
            // });
            //
            // //has lowercase
            // window.Parsley.addValidator('lowercase', {
            //     requirementType: 'number',
            //     validateString: function (value, requirement) {
            //         var lowecases = value.match(/[a-z]/g) || [];
            //         return lowecases.length >= requirement;
            //     },
            //     messages: {
            //         en: 'Your password must contain at least (%s) lowercase letter.'
            //     }
            // });
            //
            // //has number
            // window.Parsley.addValidator('number', {
            //     requirementType: 'number',
            //     validateString: function (value, requirement) {
            //         var numbers = value.match(/[0-9]/g) || [];
            //         return numbers.length >= requirement;
            //     },
            //     messages: {
            //         en: 'Your password must contain at least (%s) number.'
            //     }
            // });
            //
            // //has special char
            // window.Parsley.addValidator('special', {
            //     requirementType: 'number',
            //     validateString: function (value, requirement) {
            //         var specials = value.match(/[^a-zA-Z0-9]/g) || [];
            //         return specials.length >= requirement;
            //     },
            //     messages: {
            //         en: 'Your password must contain at least (%s) special characters.'
            //     }
            // });
            window.Parsley.addAsyncValidator('checkEmailName', function (xhr) {
                var response = $.parseJSON(xhr.responseText);
                if (table.rows('.selected').data().length > 0) {
                    if ($.trim($("#user-email").val()).replace(/[ ]/g, "") === table.rows('.selected').data()[0]['email']) {
                        return true;
                    }
                }
                return '1' === response['status'];

            }, settings.checkEmailURL);

            window.Parsley.addAsyncValidator('checkUserName', function (xhr) {
                var response = $.parseJSON(xhr.responseText);
                if (table.rows('.selected').data().length > 0) {
                    if ($.trim($("#user-name").val()).replace(/[ ]/g, "") === table.rows('.selected').data()[0]['name']) {
                        return true;
                    }
                }
                return '1' === response['status'];

            }, settings.checkUserNameURL);

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
                if($("#multiple-select2").val().length>0){
                    // $(".error-border").removeClass("parsley-error");
                    $(".error-border").addClass("parsley-success");
                // }else{
                //     $(".error-border").removeClass("parsley-success");
                //     $(".error-border").addClass("parsley-error");
                }
            });

        }
    }
}();