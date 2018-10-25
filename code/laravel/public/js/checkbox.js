var ids = [];
var index = '';

function checkAll() {
    var ck = $(".check_item");
    if ($("#checkAll").prop("checked")) {
        ck.each(function () {
            $(this).prop("checked", true);
        });
    } else {
        ck.each(function () {
            $(this).prop("checked", false);
        });
    }
    check();
}

function check() {
    var items = [];
    var ck = $(".check_item");
    ck.each(function () {
        if ($(this).prop("checked")) {
            items.push($(this).val());
        }
    });
    ids = items;
}

// var fixed_header = function(){
//     if ($('#data-table-fixed-header').length !== 0) {
//         $('#data-table-fixed-header').DataTable({
//             searching:false,
//             autoWidth: false,
//             paging:false,
//             info:false,
//             fixedHeader: {
//                 header: true,multiDelete
//                 headerOffset: $('#header').height()
//             },
//             "order": [],
//             "columns": [
//                 {
//                     "orderable": false,
//                     "sClass":"hiddenCol",
//                 },
//                 {
//                     "orderable": false,
//                 },
//                 null,
//                 null,
//                 {
//                     "orderable": false,
//                 },
//             ],
//             // responsive: true
//         });
//
//         $('#data-table-fixed-header th').each(function () {
//             if($(this).find("a").attr("class")!=''){
//                 $(this).removeClass('sorting').addClass('sorting_'+$(this).find("a").attr("class"));
//             }
//             if($(this).find("a").attr("class")=="asc"){
//                 $(this).find("a").attr("href",window.location.pathname+"?keyword="+$(this).attr("id")+"&sort=desc");
//             }else if($(this).find("a").attr("class")=="desc"){
//                 $(this).find("a").attr("href",window.location.pathname+"?keyword="+$(this).attr("id")+"&sort=asc");
//             }else {
//                 $(this).find("a").attr("href", window.location.pathname + "?keyword=" + $(this).attr("id") + "&sort=desc");
//             }
//         });
//
//         $('#data-table-fixed-header th').unbind('click.DT');
//
//         $('#data-table-fixed-header th').on('click',function(e) {
//                 $(this).find("a").children()[0].click();
//         });
//     }
//
// };

function sortInit() {
    $('.sort-click').each(function () {
        if ($(this).hasClass('asc')) {
            $(this).find("a").find("i").removeClass("fa-sort").addClass("fa-sort-up");
            // $(this).find("a").attr("href",window.location.pathname+"/"+$(this).attr("id")+"/desc");
        } else if ($(this).hasClass("desc")) {
            $(this).find("a").find("i").removeClass("fa-sort").addClass("fa-sort-down");
            // $(this).find("a").attr("href",window.location.pathname+"/"+$(this).attr("id")+"/asc");
        }
    });
}

function selectNum(){
    $("#search_link").attr("href", $("#search_url").val()+'/'+$("#data-table-default-select").val());
    $("#search_link span").click();
}

var chg = function () {
    if ($("#check_btn").text() != "多选删除") {
        $("#check_btn").text("多选删除");
        $("#deleteAll").css("display", "none");
    } else {
        $("#check_btn").text("取消多选");
        $("#deleteAll").css("display", "inline-block");
    }
};

function searchIn() {
    if($("#search_word").val()==''){
        $("#search_link").attr("href", $("#search_url").val());
    }else{
        $("#search_link").attr("href", $("#search_url").val() +'/search/'+ $("#search_word").val());
        $("#result_search").text('"'+$("#search_word").val()+'"'+"的搜索结果");
    }
      // console.log($("#search_word").val());
     $("#search_link span").click();
}
function lala(){
    if($("#search_word").val()!=''){
        $("#result_search").text('"'+$("#search_word").val()+'"'+"的搜索结果");
    }
}

function clickEvent() {

    $(document).on('click', ".update", function () {
        $("#modal-update").modal();
        $("#permission_name2").val(($(this).attr("id").substr(7)));
        //$("#permission_name").attr("disabled",true);
        $("#modal-update-form").attr("action", $(this).val());//路径问题
        console.log($(this).val());
    });


    $(document).on('click', ".sort-click", function (e) {
        // console.log($(e.target));
        $(e.target).children().children().click();
    });

    $(document).on('click', "#checkAll", function () {
        checkAll();
    });

    $(document).on('click', ".checkbox", function () {
        check();
    });

    $(document).on('click', "#check_btn", function () {
        $(".with-checkbox").toggle();
        chg();
    });

    $(document).on("keydown",'#search_word',function(event) {
        if(event.keyCode == "13") {
            searchIn();
        }
    });

    $(document).on("click",'#search_button',function() {
        searchIn();
    });

    $(document).on("change",'#data-table-default-select',function() {
        console.log("xx");
        selectNum();
    });


    $(document).on('click', '#multiDelete', function () {
        var str = ids.join("-");
        if (str == "") {
            layer.msg('没有选中任何项目', {
                time: 200000, //20s后自动关闭
                btn: ['确认'],
            });
        } else {
            $("#deleteStr").val(str);
            layer.msg('确认删除吗?', {
                skin: "layer_danger",
                time: 20000000, //20s后自动关闭
                btn: ['取消', '确认'],
                btn1: function () {
                    layer.closeAll();
                },
                btn2: function () {
                    $("#deleteAll").submit();
                }
            });
        }
    });

    $(document).pjax('a', "#pjax_content");

    $(document).on('pjax:start', function () {
        //加载层-风格4
        index = layer.msg('加载中', {
            icon: 16,
            shade: 0.01,
            time: 400,
        });
    });

    $(document).on('pjax:success', function () {
        layer.close(index);
        $('form').parsley();
        sortInit();
        // if ( !$.fn.dataTable.isDataTable( '#data-table-fixed-header' ) ) {
        //     fixed_header();
        // }
        // if($("#search_bool") != null){
        //   }
        //   alert($("#search_bool").val());
    });

}


