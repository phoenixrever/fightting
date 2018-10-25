// var saveState = [1,0, 0, 0, 0,0,0];//0-是否添加input 1-remote验证开关    ,2---坐标  3新增加是否颜色渐变  4,5 focus次数与失去焦点次数 6 当前页数
var saveState = [1, 0, 0, '', '', '', 1];//0-是否添加input ----1新增加是否颜色渐变 2颜色渐变ID 3 4 保存删除的div 5 currentRuest 6 select2 open
var select2Options = [];
var selectElem = null;
$.fn.dataTable.Api.register('cellEditor()', function (settings) {
    var table = this.table();
    var index = null;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': settings._token,
        }
    });
    $.ajax({
        url: settings.select2URL,
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            select2Options = $.map(data, function (obj) {
                obj.id = obj.id || obj.id; // replace pk with your identifier
                obj.text = obj.text || obj.text;
                return obj;
            });
        }
    });

    // table.on( 'processing.dt', function ( e, settings, processing ) {
    //     alert("xxx");
    // } );
    var keyFocus = function (e, datatable, cell, originalEvent) {
        // var rowId = datatable.row(cell.index().row).data();
        var columns = table.settings().init().columns;
        // var columns =settings.columnNames;
        var colIndex = cell.index().column;
        // saveState[1] = cell.index().row;
        // saveState[2] = cell.index().column;

        if (settings.columnNames.indexOf(columns[colIndex].name) > -1) {
            if ($(cell.node()).find("#tdnput").length < 1) {
                if (saveState[0] === 1) {
                    if (columns[colIndex].name === settings.select2ColName) {
                        var str = '<div class="error-border"><select id="multiple-select2" class="multiple-select2 form-control" multiple="multiple">';
                        if ($(cell.node()).find("span").length > 0) {
                            $(cell.node()).find("span").each(function () {
                                str = str + '<option value="' + $(this).text() + '" selected>' + $(this).text() + '</option>';
                            });
                        }
                        str = str + '</select></div>';
                        $(cell.node()).html(str);
                        selectElem = $("#multiple-select2").select2({
                            closeOnSelect: false,
                            width: '100%',
                            data: select2Options
                            // dropdownClass: "bigdrop",
                            // ajax: {
                            //     url: settings.select2URL,
                            //     dataType: 'json',
                            //     data: function (params) {
                            //         return {
                            //             q: params.term, // search term
                            //             page: params.page,
                            //         };
                            //     },
                            //     processResults: function (data, params) {
                            //         params.page = params.page || 1;
                            //         return {
                            //             results: data.results,
                            //             pagination: {
                            //                 more: (params.page * 30) < 100
                            //             }
                            //         };
                            //     },
                            //     cache: true
                            // },
                        });
                        $("#multiple-select2").select2('open');
                    } else {
                        if (saveState[0] === 1) {
                            if(settings.unique.indexOf(columns[colIndex].name)>-1){
                                var str = '<input  type="text" id="tdInput" class="form-control form-control-sm" onkeyup="this.value=this.value.replace(/[ ]/g,\'\');">';
                            }else{
                                var str = '<input  type="text" id="tdInput" class="form-control form-control-sm">';
                            }
                            // var str = '<input  type="text" id="tdInput" class="form-control form-control-sm" onkeyup="this.value=this.value.replace(/[ ]/g,\'\');">';
                            $(cell.node()).html(str);
                            $(cell.node()).find("#tdInput").focus().val(cell.data());
                        }
                    }
                }
            }
        }
    };
    var keyBlur = function (e, datatable, cell) {
        var rowId = datatable.row(cell.index().row).data();
        var columns = table.settings().init().columns;
        var colIndex = cell.index().column;
        var passData = {};
        if (settings.columnNames.indexOf(columns[colIndex].name) > -1) {
            // console.log($(cell.node()).find("tdInput").val() );
            if ($(cell.node()).find("#tdInput").length > 0) {
                if ($(cell.node()).find("#tdInput").val() !== cell.data()) {
                    saveState[0] = 0;
                    // for(var i=0;i<settings.unique.length;i++){
                    //         if (columns[colIndex].name === settings.unique[i]) {
                    //             passData[columns[colIndex].name] = $.trim(($(cell.node()).find('input').val()).replace(/[ ]/g, ""));
                    //             console.log(passData[columns[colIndex].name]+"-------------------");
                    //         }else{
                    //
                    //         }
                    // }
                    passData[columns[colIndex].name] = $.trim($(cell.node()).find('input').val());
                    var sortNumber = table.order()[0][0];
                    passData['current_sort'] = columns[sortNumber].name;
                    passData['sort_direction'] = table.order()[0][1];
                    console.log(passData);
                    $.ajax({
                        url: settings.line_edit + '/' + rowId['id'],
                        type: 'PUT',
                        dataType: 'json',
                        data: {
                            data: JSON.stringify(passData)
                        },
                        success: function (data) {
                            // console.log(data);
                            if (data['status'] === "1") {
                                saveState[2] = data['id'];
                                // var currentPageIndex = table.page.info().page;
                                var page = Math.floor(data['id_index'] / table.page.info().length);
                                saveState[1] = 1;
                                table.page(page).draw(false);
                            } else {
                                $(cell.node()).find('#tdInput').addClass('parsley-error');
                                $(cell.node()).find('#tdInput').focus();
                                layer.close(index);
                                index = layer.msg('<span class="text-danger">' + data['errors'] + '</span>', {
                                    time: 100000,
                                    btn: ['confirm']
                                });
                            }
                        },
                    });
                } else {
                    $(cell.node()).html(cell.data());
                    saveState[0] = 1;
                }
            } else {
                if ($(cell.node()).find("select").length > 0) {
                    var arr = [];
                    $($(cell.data())).each(function () {
                        arr.push($(this).text());
                    });
                    if (arr.toString() !== $("#multiple-select2").val().toString()) {
                        saveState[0] = 0;
                        if ($("#multiple-select2").val().length > 20) {
                            layer.close(index);
                            index = layer.msg('<span class="text-danger">' + '不能超过20个选项' + '</span>', {
                                time: 100000,
                                btn: ['confirm']
                            });
                        } else {
                            $("#multiple-select2").select2('close');
                            // $('#multiple-select2').attr('disabled', 'true');
                            passData[settings.select2ColName] = $("#multiple-select2").val();
                            var sortNumber = table.order()[0][0];
                            passData['current_sort'] = columns[sortNumber].name;
                            passData['sort_direction'] = table.order()[0][1];
                            console.log(passData);
                            $.ajax({
                                url: settings.line_edit + '/' + rowId['id'],
                                type: 'PUT',
                                dataType: 'json',
                                data: {
                                    data: JSON.stringify(passData)
                                },
                                beforeSend: function () {
                                    saveState[6] = 0;
                                },
                                success: function (data) {
                                    console.log(data);
                                    if (data['status'] === "1") {
                                        saveState[2] = data['id'];
                                        // var currentPageIndex = table.page.info().page;
                                        var page = Math.floor(data['id_index'] / table.page.info().length);
                                        saveState[1] = 1;
                                        table.page(page).draw(false);
                                    } else {
                                        // $("#multiple-select2").addClass('parsley-error');
                                        // $(".error-border").addClass("parsley-error");
                                        // $("#multiple-select2").select2('open');
                                        layer.close(index);
                                        index = layer.msg('<span class="text-danger">' + data['errors'] + '</span>', {
                                            time: 100000,
                                            btn: ['confirm']
                                        });
                                        saveState[6] = 1;
                                    }
                                },
                            });
                        }
                    } else {
                        //恢复span
                        $(cell.node()).html(cell.data());
                        saveState[0] = 1;
                    }
                }
            }
        }
    };
    table
        .on('key-focus', keyFocus)
        .on('key-blur', keyBlur)
        .on('key', function (e, datatable, key, cell, originalEvent) {
            if (key === 13) { // return
                //     editor
                //         .one('close', function () {
                //             table.keys.enable();
                //         })
                //         .inline(cell);
                //
                //     table.keys.disable();
                $(cell.node()).blur();
            }
        });
    $(".select-all").on('click', function () {
        if ($(this).hasClass("selected")) {
            $(this).removeClass("selected");
            table.select.style("os");
            table.rows().deselect();
        } else {
            $(this).addClass("selected");
            table.select.style("multi");
            table.rows().select();
        }
    });


    // var p = $("#modal-form").parsley();
    // $('#submit_btn').click(function () {
    //     p.whenValidate().done(function() {
    //         alert("xxx");
    //     });
    // });
    $("#submit_btn").on('click', function (e) {
        // $("#modal-form").parsley().destroy();
        var f=$("#submit_btn").val();
        var p=null;
        if(f==='edit'){
            p = $("#modal-form").parsley({
                excluded: '#password,#password_confirmation'
            });
            // $('#password').attr('data-parsley-required', 'false');
            // $('#password-confirm').attr('data-parsley-required', 'false');
        }else{
            // $('#password').attr('data-parsley-required', 'true');
            // $('#password-confirm').attr('data-parsley-required', 'true');
            p = $("#modal-form").parsley();
        }
        if($("#multiple-select2-modal").length!==0){
            var m=$("#multiple-select2-modal").parsley();
            console.log(m.isValid());
            if(m.isValid()===false){
                if($("#error-border").hasClass("parsley-success")){
                    $("#error-border").removeClass("parsley-success");
                }
                $("#error-border").addClass("error-border");
                $(".error-border").addClass("parsley-error");
            }else{
                $("#error-border").addClass("error-border");
                $("#error-border").addClass("parsley-success")
            }
        }
        p.whenValidate().done(function () {
            $("#submit_btn").attr("disabled", "true");
            var passData = {};
            var inputArray = $("#modal-form").find("input,textarea,select");
            $.each(inputArray, function (key, value) {
                if ($(value).attr("name")) {
                    if ($(value).attr("name") === settings.select2ColName) {
                        passData[settings.select2ColName] = $("#" + $(value).attr("id")).val();
                    } else {
                        // passData[$(value).attr("name")] = $.trim($("#" + $(value).attr("id")).val()).replace(/[ ]/g, "");
                        passData[$(value).attr("name")] = $.trim($("#" + $(value).attr("id")).val());
                        // $.each(settings.unique,function(){
                        //     if ($(value).attr("name") === this) {
                        //         passData[$(value).attr("name")] = $.trim($("#" + $(value).attr("id")).val()).replace(/[ ]/g, "");
                        //     }else{
                        //         passData[$(value).attr("name")] = $.trim($("#" + $(value).attr("id")).val());
                        //     }
                        // });
                    }
                }
            });
            console.log(passData);
            var URL = "", type = '', rowId = '';

            if (table.rows(".selected").data()[0]) {
                rowId = table.rows(".selected").data()[0]['id'];
            }
            switch (f) {
                case "add":
                    URL = settings.add;
                    type = "POST";
                    break;
                case "edit":
                    URL = settings.line_edit + '/' + rowId;
                    type = "PUT";
                    // if ($.trim($("input[name=" + settings.unique + "]").val()).replace(/[ ]/g, "") === table.rows('.selected').data()[0][settings.unique]) {
                    // $.each(settings.unique,function(){
                        if ($.trim($("input[name=" + this + "]").val()) === table.rows('.selected').data()[0][settings.unique]) {
                            delete passData[settings.unique];
                        }
                    // });
                    break;
                default:
                    break;
            }
            var columns = table.settings().init().columns;
            var sortNumber = table.order()[0][0];
            passData['current_sort'] = columns[sortNumber].name;
            passData['sort_direction'] = table.order()[0][1];
            console.log(passData);
            $.ajax({
                url: URL,
                type: type,
                dataType: 'json',
                data: {
                    data: JSON.stringify(passData)
                },
                complete: function (data) {
                    $("#submit_btn").removeAttr("disabled");
                    console.log(data);
                    if (data['responseJSON']['status'] === "1") {
                        $('#modal-dialog').modal("hide");
                        saveState[1] = 1;
                        saveState[2] = data['responseJSON']['id'];
                        // var currentPageIndex = table.page.info().page;
                        var page = Math.floor(data['responseJSON']['id_index'] / table.page.info().length);
                        // console.log(page);
                        table.page(page).draw(false);
                    }
                },
            });
        });
        return false;
    });
    $(document).off("change", '#multiple-select2');
    $(document).on("change", '#multiple-select2', function () {
        selectElem.resize();
    });

    $(document).off("select2:unselect", "#multiple-select2,#multiple-select2-modal");
    $(document).on("select2:unselect", "#multiple-select2,#multiple-select2-modal", function (evt) {
        if (!evt.params.originalEvent) {
            return;
        }
        evt.params.originalEvent.stopPropagation();
    });
    $(document).off('click', ".delete");
    $(document).on('click', ".delete", function (e) {
        console.log($(e.target));
        if ($(e.target).attr("id")) {
            var rowId = $(e.target).attr("id").split("-")[1];
            layer.msg('确认删除吗?', {
                time: 200000,
                btn: ['取消', '确认'],
                btn1: function () {
                    layer.closeAll();
                },
                btn2: function () {
                    $.ajax({
                        url: settings.delete + '/' + rowId,
                        type: 'DELETE',
                        success: function (data) {
                            if (data['success'] = 1) {
                                var currentPageIndex = table.page.info().page;
                                table.page(currentPageIndex).draw(false);
                            }
                        }
                    });
                }
            });
            // JSON.stringify( dt.row( { selected: true } ).data()
        }
    });
    $(".fas").on('click', function (e) {
        e.preventDefault();
        $(e.target).parent("a").click();
        // JSON.stringify( dt.row( { selected: true } ).data()
    });

    $('#modal-dialog').on('hidden.bs.modal', function (e) {
        $(this).data('bs.modal', null);
        $("#modal-form")[0].reset();
        window.Parsley._remoteCache = {};//chear cache ;
        // $(".multiple-select2").select2('data', {id: null, text: null});
        $("#multiple-select2-modal option").remove();
        // select2Options=[1,2,3];
        $("#modal-form").parsley().reset();
        if ($("#error-border").hasClass("error-border")) {
            $("#error-border").removeClass("error-border")
        }
    });
});


//
// var cellEditor = function (table, arr, line_edit, _token) {
//     table
//         .on('key-focus', function (e, datatable, cell, originalEvent) {
//             // console.log("focus---------------");
//             var str = '<input id="ejbeatycelledit" class="form-control form-control-sm">';
//             if (arr.indexOf(cell.index().column) > -1) {
//                 $(cell.node()).html(str);
//                 $(cell.node()).find("input").focus().val(cell.data());
//
//             }
//             // console.log(arr.indexOf(cell.index().column))
//         })
//         .on('key-blur', function (e, datatable, cell) {
//             var rowId = datatable.row(cell.index().row).data()
//             if (arr.indexOf(cell.index().column) > -1) {
//                 // console.log("blur---------->node" + $(cell.node()));
//                 // console.log("blur---------->data" + cell.data());
//                 // console.log(colStr[cell.index().column]);
//                 switch(arr.indexOf(cell.index().column)){
//                     case 1:
//                         var passName=$(cell.node()).find("input").val();
//                         var passDesc=rowId['description'];
//                         break;
//                     case 2:
//                         var passName=rowId['name'];
//                         var passDesc=$(cell.node()).find("input").val();
//                         break;
//                 }
//                 if ($(cell.node()).find("input").length > 0 && $(cell.node()).find("input").val() !== cell.data()) {
//                     $.ajax({
//                         url: line_edit + '/' + rowId['id'],
//                         type: 'PUT',
//                         async: true,
//                         dataType: 'json',
//                         data: {
//                             _method: '_PUT',
//                             _token: _token,
//                             name: passName,
//                             description: passDesc,
//                         },
//                         success: function (data) {
//                             console.log("success------------->"+data['id']);
//                             console.log("success------------->"+data['input']);
//                             if (data['status'] === "1") {
//                                 console.log("redraw----------->");
//                                 var currentPageIndex = table.page.info().page;
//                                 // console.log(currentPageIndex);
//                                 table.page(currentPageIndex).draw(false);
//                             }
//                         },
//                         complete:function(){
//                             console.log("complete");
//                         },
//                     });
//                     console.log("ajaxend");
//                 }else {
//                     console.log("selse------------------>"+cell.data());
//                     $(cell.node()).html(cell.data());
//                 }
//             }
//         })
//         .on( 'key', function ( e, datatable, key, cell, originalEvent ) {
//                 if (key === 13) { // return
//                     //     editor
//                     //         .one('close', function () {
//                     //             table.keys.enable();
//                     //         })
//                     //         .inline(cell);
//                     //
//                     //     table.keys.disable();
//                 }
//         });
// };
//
// $(document).on('ajax:start',function(){
//    alert("staart");
// });