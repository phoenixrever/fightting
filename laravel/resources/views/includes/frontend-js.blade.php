<script src={{asset("assets/js/bundle.js")}}></script>
{{--<script src="/assets/js/theme/default.js"></script>--}}
<script src={{ asset("assets/plugins/gritter/js/jquery.gritter.js")}}></script>
<script src={{ asset("assets/plugins/parsleyjs/dist/parsley.js")}}></script>
<script src={{asset("assets/plugins/ckeditor/ckeditor.js")}}></script>
@include('ckfinder::setup');
<script src={{ asset("assets/js/theme/transparent.js") }}></script>
<script src={{ asset("js/jquery.timeago.js") }}></script>
<script src={{asset("assets/js/apps.js")}}></script>
<script src={{ asset("layer/layer.js")}}></script>
<script src={{ asset("js/jquery.pjax.js") }} ></script>
<script src={{ asset("assets/plugins/lightbox2/js/lightbox.min.js") }} ></script>
<script src={{ asset("assets/plugins/switchery/switchery.min.js") }} ></script>

<!--[if gt IE 8]><!-->
<script src={{ asset("assets/plugins/jquery-emoji/lib/script/highlight.pack.js") }}></script>
<script>hljs.initHighlightingOnLoad();</script>
<!--<![endif]-->
<script src={{ asset("assets/plugins/jquery-emoji/lib/script/jquery.mousewheel-3.0.6.min.js") }}></script>
<script src={{ asset("assets/plugins/jquery-emoji/lib/script/jquery.mCustomScrollbar.min.js") }}></script>
<script src={{ asset("assets/plugins/Caret.js/src/jquery.caret.js") }}></script>
<script src={{ asset("assets/plugins/jquery-emoji/src/js/jquery.emoji.js") }} ></script>
{{--<script src={{ asset("assets/plugins/jquery.easyPaginate-master/lib/jquery.easyPaginate.js") }} ></script>--}}
<script src={{ asset("assets/plugins/simplePagination/jquery.simplePagination.js") }} ></script>
<script src={{ asset("assets/js/demo/form-slider-switcher.demo.js") }} ></script>
{{--<script src={{ asset("assets/js/demo/gallery.demo.js") }} ></script>--}}
<script>
    function clearElement() {
        $('.jvectormap-label, .jvector-label, .AutoFill_border ,#gritter-notice-wrapper, .ui-autocomplete, .colorpicker, .FixedHeader_Header, .FixedHeader_Cloned .lightboxOverlay, .lightbox, .introjs-hints, .nvtooltip, #float-sub-menu').remove();
        if ($.fn.DataTable) {
            $('.dataTable').DataTable().destroy();
        }
        if ($('#page-container').hasClass('page-sidebar-toggled')) {
            $('#page-container').removeClass('page-sidebar-toggled');
        }
    }

    function checkSidebarActive(url) {
        var targetElm = '#sidebar [data-toggle="ajax"][href="' + url + '"]';
        if ($(targetElm).length !== 0) {
            $('#sidebar li').removeClass('active');
            $(targetElm).closest('li').addClass('active');
            $(targetElm).parents().addClass('active');
        }
    }

    function checkClearOption() {
        if (CLEAR_OPTION) {
            App.clearPageOption(CLEAR_OPTION);
            CLEAR_OPTION = '';
        }
    }

    function checkLoading(load) {
        if (!load) {
            if ($('#page-content-loader').length === 0) {
                $('body').addClass('page-content-loading');
                $('#content').append('<div id="page-content-loader"><span class="spinner"></span></div>');
            }
        } else {
            $('#page-content-loader').remove();
            $('body').removeClass('page-content-loading');
        }
    }

    //均分数组
    function arr_split(arr,len){
        var length=arr.length;
        var result=[];
        // for(var i=0;i<length;i++){
        //     console.log(arr);
        // }
        for(var i=0;i<length;i+=len){
            var s=arr.splice(0,len);
            result.push(s);
        }
        return result;
    }

    function addReplyComments(){
        var dataJson=$.parseJSON($(".page-json").val());
        console.log(dataJson);
        var dataArr=arr_split(dataJson,5);
        console.log(dataArr);
        for(var i=0;i<dataArr.length;i++){
            var str="";
            var pageStr="";
            if(i===0){
                str+='<div class="tab-pane fade show active" id="tab-'+i+'">';
                pageStr+='<li class="page-item active"><a href="#tab-'+i+'" class="page-link" data-toggle="tab">1</a></li>';
            }else{
                str+='<div class="tab-pane fade show" id="tab-'+i+'">';
                pageStr+='<li class="page-item"><a href="#tab-'+i+'" class="page-link" data-toggle="tab">1</a></li>';
            }
             for(var j=0;j<dataArr[i].length;j++){
                    console.log(dataArr[i][j].user.name);
                    if(dataArr[i][j].reply_to!==null){
                        var head=dataArr[i][j].user.name+" 回复 "+dataArr[i][j].reply_to+":&nbsp&nbsp";
                    }else{
                        var head=dataArr[i][j].user.name+":&nbsp&nbsp";
                    }
                     str+='<div class="p-10">';
                     str+='<div class="media media-xs overflow-visible">';
                     str+='<a class="media-left" href="javascript:;">';
                     str+='<img src="../assets/img/user/user-1.jpg" alt="" class="media-object img-circle"/></a>';
                     str+='<div class="media-body valign-middle">';
                     str+='<b class="pull-left"><a href="javascript:;">'+head+'</a></b>';
                     str+='<span>'+dataArr[i][j].body+'</span>';
                     str+='<p class="text-right"><span>'+dataArr[i][j].created_at+'</span><a href="javascript:" class="'+dataArr[i][j].user.name+'-'+dataArr[i][j].user.id+' text-info m-l-5 reply" >回复</a></p>';
                     str+='</div></div></div>';
             }
             str+='</div>';
             str+='<ul class="pagination pagination-xs m-t-0 m-b-5 nav pull-right ">';
             str+=pageStr+"</ul>";
            $(".card-body").append(str);
        }
    }
     // function customPagination(){
     //    var totalPage=$(".pagination-xs");
     //
     //     $(".pagination-xs").each(function(){
     //         var total=$(this).find("li");
     //         if(total.length>8){
     //             for(var i=1;i<total.length;i++){
     //                 if(i>4 && i<total.length-3){
     //                     $(total[i]).addClass("hide");
     //                 }
     //             }
     //             $(total[4]).after('<li class="page-item"><a href="javascript:" class="page-link page-dot" >...</a></li>');
     //         }
     //     });
     // }

     var  lastClickTime=0;
   function  clickTimeFilter(){
        var time = (new Date()).getTime();
        if ((time - lastClickTime) > 5000) {
            lastClickTime =  (new Date()).getTime();
            return true;
        }
        return time - lastClickTime;
    }

    function easyPagenation(){
        $(".card-body").each(function () {
            // Grab whatever we need to paginate
            var pageParts = $(this).find(".reply-sort");

            // How many parts do we have?
            var numPages = pageParts.length;

            // console.log(numPages);
            // How many parts do we want per page?
            var perPage = 5;
            if(Math.ceil(numPages/perPage)>=2){
                // When the document loads we're on page 1
                // So to start with... hide everything else
                pageParts.slice(perPage).hide();
                // Apply simplePagination to our placeholder
                // console.log( $(this).parent(".collapse")[0]);
                $(this).parent(".collapse").find("ul").pagination({
                    items: numPages,
                    itemsOnPage: perPage,
                    cssStyle: "pagination  pagination-xs  m-b-10 nav p-10 m-t-0",
                    // We implement the actual pagination
                    //   in this next function. It runs on
                    //   the event that a user changes page
                    onPageClick: function(pageNum) {
                        // Which page parts do we show?
                        var start = perPage * (pageNum - 1);
                        var end = start + perPage;

                        // First hide all page parts
                        // Then show those just for our page
                        pageParts.hide()
                            .slice(start, end).show();
                    }
                });
            }
        });
    }



    $(document).ready(function () {
        App.init();
        jQuery("time.timeago").timeago();
        $.pjax.defaults.maxCacheLength = 0;//前进后退 刷新ajax

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN':  "{{csrf_token()}}",
            }
        });
        allAddLightImage();
        easyPagenation();






        function addEditorLightImage(introduction){
                for (var i = 0; i < $(introduction).find("img").length; i++) {
                    if (!$($(introduction).find("img")[i]).parent("a").hasClass("isAddLight")) {
                        var id = $(introduction).attr("id").split("-");
                        $($(introduction).find("img")[i]).parent("a").attr("data-lightbox", "gallery-group-" + id[2]);
                        $($(introduction).find("img")[i]).parent("a").addClass("isAddLight");
                    }
                }
        }

        function allAddLightImage(){
            // console.log("初めて");
            $(".post-content").each(function () {
                for (var i = 0; i < $(this).find("img").length; i++) {
                    if($($(this).find("img")[i]).parents("isAddLight").length<1){
                        var id = $(this).attr("id").split("-");
                        var str = '<a  class="isAddLight" href="' + $($(this).find("img")[i]).attr("src") + '" ' + 'data-lightbox=gallery-group-' + id[2] + '></a>';
                        $($(this).find("img")[i]).wrap(str);
                    }
                }
            });
        }

        /*
        * inlline Editor
        * */

        var oldData=null;
        var isEditingEnabled=false;
        var introduction="";
        function toggleEditor() {
            if (isEditingEnabled) {
                if (CKEDITOR.instances.introduction  && CKEDITOR.instances.introduction .checkDirty()) {
                    reset.style.display = 'inline';
                }
                disableEditing();
                introduction.setAttribute('contenteditable', false);
                this.innerHTML = 'Start editing';
                isEditingEnabled = false;
            }
            else {
                introduction.setAttribute('contenteditable', true);
                enableEditing();
                this.innerHTML = 'Finish editing';
                isEditingEnabled = true;
            }
        }

        function disableEditing() {
            var str='<i class="fa fa-ellipsis-h f-s-14 t-plus-1"></i>';
            $(".toggle-button").removeClass("disabled");
            $(".toggle-button").html(str);
            if (CKEDITOR.instances[$(introduction).attr('id')])
            CKEDITOR.instances[$(introduction).attr('id')].destroy();
        }


        function enableEditing() {
            var str='<div style="color:red" class="la-ball-fall la-sm"><div></div><div></div><div></div></div>';
            $(".toggle-button").addClass("disabled");
            $(".toggle-button").html(str);
            if (!CKEDITOR.instances.introduction) {
                CKEDITOR.inline( introduction, {
                    extraAllowedContent: 'a(documentation);abbr[title];code',
                    disallowedContent : 'span',
                    removePlugins: 'stylescombo,image',
                    extraPlugins: 'sourcedialog',
                    startupFocus: true,
                    on: {
                        instanceReady: function (event) {
                            //get current data and save in variable
                            oldData = event.editor.getData();
                            // overwrite the default save function
                        },
                        blur: function( event ) {
                            var data = event.editor.getData();
                            if (oldData !== data) {
                                oldData = data;
                                $.ajax({
                                    type:'post',
                                    url: "{{URL('/blog/ajax')}}"+"/"+$("#toggle").attr("Class").split("-")[1],
                                    data: {
                                        data:data,
                                    },
                                    success: function(data) {
                                        if(data['status']==='1'){
                                            disableEditing();
                                            introduction.setAttribute('contenteditable', false);
                                            addEditorLightImage(introduction);
                                            isEditingEnabled = false;
                                            layer.msg('更新成功');
                                        }
                                    },
                                    // error:function(){
                                    //     disableEditing();
                                    //     introduction.setAttribute('contenteditable', false);
                                    //     isEditingEnabled = false;
                                    // },
                                });
                            } else{
                                console.log("っっっっっっっっっｘ");
                                disableEditing();
                                introduction.setAttribute('contenteditable', false);
                                addEditorLightImage(introduction);
                                isEditingEnabled = false;
                            }
                        }
                    }
                });
            }
        }

        function resetContent() {
            reset.style.display = 'none';
            introduction.innerHTML = introductionHTML;
        }
        //
        // function onClick(element, callback) {
        //     if (window.addEventListener) {
        //         element.addEventListener('click', callback, false);
        //     }
        //     else if (window.attachEvent) {
        //         element.attachEvent('onclick', callback);
        //     }
        // }

        $(document).on('click','#toggle',function(){
                toggle = document.getElementById('toggle');
                // reset = document.getElementById('reset');
                // introduction = document.getElementById('introduction'),
            // var id=$(this).parents(".info-container").find(".post-content").attr("id");
            // var introduction = document.getElementById(id);
            oldData=null;
            isEditingEnabled=false;
            introduction=document.getElementsByClassName("blog-content")[0];
            toggleEditor();
        });
        $(document).on('click','.reset',function(){
            // toggleEditor($(this));
        });

        // $(document).on('input','textarea',function(){
        //     // console.log($(this).val().length);
        //     var count=$(this).attr("maxlength")-$(this).val().length;
        //     if($(this).attr("maxlength")-$(this).val().length<0){
        //         count=0;
        //     }
        //    if($(this).val().length>=150){
        //        $(".form-control-character-count").removeAttr("hidden");
        //        $(".form-control-character-count").text("你最多还可输入"+count);
        //    }else{
        //        $(".form-control-character-count").attr("hidden","true");
        //    }
        // });

        function placeCaretAtEnd(el) {
            el.focus();
            if (typeof window.getSelection != "undefined"
                && typeof document.createRange != "undefined") {
                var range = document.createRange();
                range.selectNodeContents(el);
                range.collapse(false);
                var sel = window.getSelection();
                sel.removeAllRanges();
                sel.addRange(range);
            } else if (typeof document.body.createTextRange != "undefined") {
                var textRange = document.body.createTextRange();
                textRange.moveToElementText(el);
                textRange.collapse(false);
                textRange.select();
            }
        }

        // $(document).on('keydown input paste','.plaintext[contenteditable]', function(e) {
        //     var len=$(this).text().length;
        //     console.log($(this).text().length);
        //     var count=$(this).attr("maxlength")-len;
        //     if($(this).attr("maxlength")-len<=0){
        //         if((e.keyCode !== 8)){
        //             e.preventDefault();
        //         }
        //     }
        //     if(count<=$(this).attr("showlength")){
        //         $(".form-control-character-count").removeAttr("hidden");
        //         $(".form-control-character-count").html("你最多还可输入"+count);
        //     }else{
        //         $(".form-control-character-count").attr("hidden","true");
        //     }
        // });

        function insertTextAtCursor(text) {
            var sel, range, html;
            if (window.getSelection) {
                sel = window.getSelection();
                if (sel.getRangeAt && sel.rangeCount) {
                    range = sel.getRangeAt(0);
                    range.deleteContents();
                    range.insertNode(document.createTextNode(text));
                }
            } else if (document.selection && document.selection.createRange) {
                document.selection.createRange().text = text;
            }
        }

        if($(".plaintext[contenteditable]").length>0){
            $(".plaintext[contenteditable]").each(function(){
                // console.log($(this).attr("id"));
                document.querySelector("#"+$(this).attr("id")).addEventListener("paste", function(e) {
                    e.preventDefault();
                    if (e.clipboardData && e.clipboardData.getData) {
                        var text = e.clipboardData.getData("text/plain");
                        document.execCommand("insertHTML", false, text);
                    } else if (window.clipboardData && window.clipboardData.getData) {
                        var text = window.clipboardData.getData("Text");
                        insertTextAtCursor(text);
                    }
                });
            });
        }

        $(document).on('focus', '.plaintext[contenteditable]', function() {
            const $this = $(this);
            $this.data('before', $this.html());
        }).on('paste input', '.plaintext[contenteditable]', function(e) {
            const $this = $(this);
            // if ($this.data('before') !== $this.html()) {
            //     $this.data('before', $this.html());
            //     $this.trigger('change');
            // }
            var len=$(this).text().length;
            var count=$(this).attr("maxlength")-len;
            if($(this).attr("maxlength")-len<=0){
                count=0;
                var imgLen=150;
                $(this).find("img").each(function(){
                    if(imgLen<1000){
                        imgLen+=this.outerHTML.length;
                    }
                });
                // console.log($(this).html().substr(0, imgLen));
                $(this).html($(this).html().substr(0, imgLen));
                // placeCaretAtEnd( document.getElementById("edit-div") );
                placeCaretAtEnd(this);
            }
            if(count<=$(this).attr("showlength")){
                $(".form-control-character-count").removeAttr("hidden");
                $(".form-control-character-count").html("你最多还可输入"+count);
            }else{
                $(".form-control-character-count").attr("hidden","true");
            }
        });



        createEmoji();
        function createEmoji(){
            $(".plaintext").each(function(){
                $("#"+$(this).attr("id")).emoji({
                    showTab: true,
                    animation: 'fade',
                    // position:'bottomLeft',
                    icons: [{
                        name: "贴吧表情",
                        path: "{{asset("assets/plugins/jquery-emoji/dist/img/tieba")}}"+"/",
                        maxNum: 50,
                        file: ".jpg",
                        placeholder: ":{alias}:",
                        alias: {
                            1: "hehe",
                            2: "haha",
                            3: "tushe",
                            4: "a",
                            5: "ku",
                            6: "lu",
                            7: "kaixin",
                            8: "han",
                            9: "lei",
                            10: "heixian",
                            11: "bishi",
                            12: "bugaoxing",
                            13: "zhenbang",
                            14: "qian",
                            15: "yiwen",
                            16: "yinxian",
                            17: "tu",
                            18: "yi",
                            19: "weiqu",
                            20: "huaxin",
                            21: "hu",
                            22: "xiaonian",
                            23: "neng",
                            24: "taikaixin",
                            25: "huaji",
                            26: "mianqiang",
                            27: "kuanghan",
                            28: "guai",
                            29: "shuijiao",
                            30: "jinku",
                            31: "shengqi",
                            32: "jinya",
                            33: "pen",
                            34: "aixin",
                            35: "xinsui",
                            36: "meigui",
                            37: "liwu",
                            38: "caihong",
                            39: "xxyl",
                            40: "taiyang",
                            41: "qianbi",
                            42: "dnegpao",
                            43: "chabei",
                            44: "dangao",
                            45: "yinyue",
                            46: "haha2",
                            47: "shenli",
                            48: "damuzhi",
                            49: "ruo",
                            50: "OK"
                        },
                        title: {
                            1: "呵呵",
                            2: "哈哈",
                            3: "吐舌",
                            4: "啊",
                            5: "酷",
                            6: "怒",
                            7: "开心",
                            8: "汗",
                            9: "泪",
                            10: "黑线",
                            11: "鄙视",
                            12: "不高兴",
                            13: "真棒",
                            14: "钱",
                            15: "疑问",
                            16: "阴脸",
                            17: "吐",
                            18: "咦",
                            19: "委屈",
                            20: "花心",
                            21: "呼~",
                            22: "笑脸",
                            23: "冷",
                            24: "太开心",
                            25: "滑稽",
                            26: "勉强",
                            27: "狂汗",
                            28: "乖",
                            29: "睡觉",
                            30: "惊哭",
                            31: "生气",
                            32: "惊讶",
                            33: "喷",
                            34: "爱心",
                            35: "心碎",
                            36: "玫瑰",
                            37: "礼物",
                            38: "彩虹",
                            39: "星星月亮",
                            40: "太阳",
                            41: "钱币",
                            42: "灯泡",
                            43: "茶杯",
                            44: "蛋糕",
                            45: "音乐",
                            46: "haha",
                            47: "胜利",
                            48: "大拇指",
                            49: "弱",
                            50: "OK"
                        }
                    }, {
                        name: "QQ高清",
                        path: "{{asset("assets/plugins/jquery-emoji/dist/img/qq/")}}"+"/",
                        maxNum: 91,
                        excludeNums: [41, 45, 54],
                        file: ".gif",
                        placeholder: "#qq_{alias}#"
                    }, {
                        name: "emoji高清",
                        path: "{{asset("assets/plugins/jquery-emoji/dist/img/emoji/")}}"+"/",
                        maxNum: 84,
                        file: ".png",
                        placeholder: "#emoji_{alias}#"
                    }]
                });
            });

            $(window).resize(function(){
                if($(window).width()<1328){
                    $(".emoji_container").css("left", "-524px");
                }else{
                    $(".emoji_container").css("left", "0px");
                }
            }).resize();

            if($(window).width()<1328){
                $(".emoji_container").css("left", "-524px");
            }else{
                $(".emoji_container").css("left", "0px");
            }
        }

        var replyToID=null;
        var replyName=null;
        var oldStr="";
        $(document).on('click','.reply',function(){
            // console.log($(this).parents(".card-body").find(".plaintext"));
            replyName=$(this).attr("class").split(" ")[0].split("-")[0];
            // console.log( replyName);
            replyToID=$(this).attr("class").split(" ")[0].split("-")[1];
            var name="{{Auth::user()->name}}";
            $(".send-box.active").addClass("hide");
            $(".send-box.active").removeClass("active");
            $(this).parents(".card-body").find(".send-box").addClass('active');
            $(this).parents(".card-body").find(".send-box").removeClass('hide');
            // var oldStr='<span class="reply-head">'+name+' 回复 '+ replyName+':</span>';
            oldStr=name+' 回复 '+ replyName+':&nbsp';
            $(this).parents(".card-body").find(".plaintext").html(oldStr);
            $(this).parents(".card-body").find(".plaintext").focus();
            placeCaretAtEnd(document.getElementById($(this).parents(".card-body").find(".plaintext").attr("id")));
        });

        $(document).on('click','.reply-button',function(){
            replyToID=null;
            replyName=null;
            oldStr="";
            // console.log( replyName);
            $(this).closest(".collapse").find(".plaintext").text("");
            if($(this).parents(".card-body").find(".send-box").hasClass("active")){
                $(this).parents(".card-body").find(".send-box").removeClass('active');
                $(this).parents(".card-body").find(".send-box").addClass('hide');
            }else{
                $(".send-box.active").addClass("hide");
                $(".send-box.active").removeClass("active");
                $(this).parents(".card-body").find(".send-box").addClass('active');
                $(this).parents(".card-body").find(".send-box").removeClass('hide');
                placeCaretAtEnd(document.getElementById($(this).parents(".card-body").find(".plaintext").attr("id")));
            }
        });


        $(document).on('click',".send-comment",function(e){
            var t=$(this);
            if($(this).hasClass("disabled")){
                e.preventDefault();
                return false;
            }
            $(this).addClass("disabled");
            var passData=$(this).parents(".send-box").find(".plaintext").html();
            // console.log(passData);
            var m="";
            if(passData===""){
                    layer.msg('不能为空?', {
                        time: 2000,
                        offset: 'auto',
                    });
                e.preventDefault();
                $(this).removeClass("disabled");
            }else{
                if(replyToID!==null){
                    m=passData.split(":")[0];
                    if($.trim(m)!==oldStr.split(":")[0]){
                        replyToID=null;
                        replyName=null;
                    }
                }
                if(replyToID!==null){
                    passData=passData.replace(m+": ","");
                    passData=passData.replace(m+":","");
                }
                $(".fa-link").addClass("hide");
                $(".la-ball-scale-ripple-multiple").removeClass("hide");
                $.ajax({
                    type:'post',
                    url: "{{URL('/comment/ajax')}}"+"/"+$(this).val().split("-")[1],
                    data: {
                        data:passData,
                        blogId:$(this).val().split("-")[2],
                        replyTo:replyToID,
                        replyToName:replyName,
                    },
                    beforeSend:function(){
                        // console.log("stat ajax");
                    },
                    success: function(data) {
                        t.removeClass("disabled");
                        $(".la-ball-scale-ripple-multiple").addClass("hide");
                        $(".fa-link").removeClass("hide");
                        if(data['status']==='1'){
                            var replys=data['replys'];
                            var str="";
                            for(var i=0;i<replys.length;i++) {
                                str+='<div class="p-10 reply-sort">';
                                str+='<div class="media media-xs overflow-visible">';
                                str+='<a class="media-left" href="javascript:;"><img src="../assets/img/user/user-1.jpg" alt="" class="media-object img-circle"/></a>';
                                str+='<div class="media-body valign-middle">';
                                if(replys[i].reply_to!==null){
                                    str+='<b class="pull-left"><a href="javascript:;">'+replys[i].user.name+'</a> 回复 <a href="javascript:;">'+replys[i].reply_to_name+'</a> : </b>';
                                }else{
                                    str+='<b class="pull-left"><a href="javascript:;">'+replys[i].user.name+'</a> : </b>';
                                }
                                str+='<span style="word-break: break-all;white-space: normal;">'+replys[i].body+'</span>';
                                str+='<p class="text-right"><span>'+replys[i].created_at+'</span><a href="javascript:" class="'+replys[i].user.name+'-'+replys[i].user.id+' text-info m-l-5 reply">回复</a></p>';
                                str+='</div></div></div>';
                            }
                            $(e.target).closest(".collapse").find(".reply-sort-box").empty();
                            $(e.target).closest(".collapse").find(".reply-sort-box").append(str);
                            if( $(e.target).closest(".collapse").find(".reply-button").hasClass("hide")){
                                $(e.target).closest(".collapse").find(".reply-button").removeClass("hide");
                            }
                            $(e.target).closest(".send-box").find(".plaintext").text("");

                            replyToID=null;
                            replyName=null;
                            oldStr="";

                            $(e.target).closest(".collapse").find(".page-box").pagination('destroy');

                            var pageParts =  $(e.target).closest(".collapse").find(".reply-sort");
                            // How many parts do we have?
                            var numPages = pageParts.length;

                            // How many parts do we want per page?
                            var perPage = 5;
                            if(Math.ceil(numPages/perPage)>=2){
                                // When the document loads we're on page 1
                                // So to start with... hide everything else
                                pageParts.slice(perPage).hide();
                                // Apply simplePagination to our placeholder
                                $(e.target).parents(".collapse").find(".page-box").pagination({
                                    items: numPages,
                                    itemsOnPage: perPage,
                                    cssStyle: "pagination  pagination-xs  m-b-10 nav p-10 m-t-0",
                                    // We implement the actual pagination
                                    //   in this next function. It runs on
                                    //   the event that a user changes page
                                    onPageClick: function(pageNum) {
                                        // Which page parts do we show?
                                        var start = perPage * (pageNum - 1);
                                        var end = start + perPage;

                                        // First hide all page parts
                                        // Then show those just for our page
                                        pageParts.hide()
                                            .slice(start, end).show();
                                    }
                                });
                                $(e.target).closest(".collapse").find(".page-box").pagination('drawPage', Math.ceil(numPages/perPage));
                                pageParts.hide().slice(perPage*(Math.ceil(numPages/perPage)-1), perPage*(Math.ceil(numPages/perPage)-1)+perPage).show();
                            }
                        }
                        if(data['status']==='0'){
                            layer.msg("wrong fomat");
                        }
                    },
                    error: function(){
                        $("input[type=submit]").attr('disabled',false)
                    },
                });
            }
        });

        // $(document).on('click','.delete-blog',function(){
        //     layer.msg('确认删除吗?', {
        //         time: 200000,
        //         btn: ['确认','取消'],
        //         btn1: function () {
        //             return true
        //         },
        //         btn2:function(){
        //             return false
        //         }
        //     });
        // });

        // onClick(toggle, toggleEditor);
        // onClick(reset, resetContent);
        $(document).on('click','.post-content',function(){
            // toggleEditor($(this));
        });
        {{--console.log("{{route('ckfinder_browser')}}");--}}
        {{--console.log("{{ public_path('/userfiles/')}}");--}}

        var editorHeight="200px";
        if(window.location.href.slice(-4)==='edit'){
            editorHeight="600px"
        }
        CKEDITOR.replace( 'my-editor', {
            // Use named CKFinder browser route
            filebrowserBrowseUrl: '{{ route('ckfinder_browser') }}',
            // Use named CKFinder connector route
            filebrowserUploadUrl: '{{ route('ckfinder_connector') }}?command=QuickUpload&type=Files',
            height:editorHeight,
        });

        $(window).on("scroll load", function () {
            if ($(window).scrollTop() > 20) {
                $("#header").addClass("navbar-sm")
            } else {
                $("#header").removeClass("navbar-sm")
            }
        });



        $(document).pjax('a', "#content");

        $(document).on('pjax:start', function () {
            // console.log("pjax-start");
            checkLoading(false);
            // clearElement();
            // checkSidebarActive(url);
            // checkClearOption();
            // alert("pjax");
        });


        $(document).on('pjax:success', function () {
            console.log("pjax-success");

            $.pjax.defaults.maxCacheLength = 0;

            allAddLightImage();
            easyPagenation();
            createEmoji();
            // console.log(window.location.href.slice(-4));
            if(window.location.href.slice(-4)==='edit'){
                editorHeight="600px"
            }
            CKEDITOR.replace( 'my-editor', {
                // Use named CKFinder browser route
                filebrowserBrowseUrl: '{{ route('ckfinder_browser') }}',
                // Use named CKFinder connector route
                filebrowserUploadUrl: '{{ route('ckfinder_connector') }}?command=QuickUpload&type=Files',
                height:editorHeight,
            } );
        });
    });
</script>

@yield('scripts')
