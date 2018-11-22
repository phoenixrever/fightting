<script src={{asset("assets/js/bundle.js")}}></script>
{{--<script src="/assets/js/theme/default.js"></script>--}}
<script src={{ asset("assets/plugins/gritter/js/jquery.gritter.js")}}></script>
<script src={{ asset("assets/plugins/parsleyjs/dist/parsley.js")}}></script>
<script src={{ asset("assets/js/theme/transparent.js") }}></script>
<script src={{asset("assets/plugins/mark/jquery.mark.es6.js")}}></script>
<script src={{asset("assets/plugins/mark/datatables.mark.es6.js")}}></script>
<script src={{asset("assets/js/apps.js")}}></script>
<script src={{ asset("layer/layer.js")}}></script>
<script src={{ asset("js/jquery.pjax.js") }} ></script>
<script src={{asset("assets/plugins/datatables/js/jquery.dataTables.js")}}></script>
<script src="/assets/plugins/datatables/js/dataTables.bootstrap4.js"></script>
<script src="/assets/plugins/datatables/js/buttons/dataTables.buttons.js"></script>
<script src="/assets/plugins/datatables/js/buttons/buttons.bootstrap4.js"></script>
<script src={{asset("assets/plugins/datatables/js/keyTable/dataTables.keyTable.js")}}></script>
<script src="/assets/plugins/datatables/js/responsive/dataTables.responsive.js"></script>
<script src="/assets/plugins/datatables/js/responsive/responsive.bootstrap4.js"></script>
<script src={{asset("assets/plugins/datatables/js/select/dataTables.select.js")}}></script>
<script src={{asset("assets/plugins/select2/dist/js/select2.js")}}></script>
<script src={{asset("js/editor.js")}}></script>
<script>
    // var CLEAR_OPTION = '';
    // var handleAjaxMode = function(setting) {
    //     var emptyHtml = (setting.emptyHtml) ?  setting.emptyHtml : '<div class="p-t-40 p-b-40 text-center f-s-20 content"><i class="fa fa-warning fa-lg text-muted m-r-5"></i> <span class="f-w-600 text-inverse">Error 404! Page not found.</span></div>';
    //     var defaultUrl = (setting.ajaxDefaultUrl) ? setting.ajaxDefaultUrl : '';
    //     defaultUrl = (window.location.hash) ? window.location.hash : defaultUrl;
    //
    //     if (defaultUrl === '') {
    //         $('#content').html(emptyHtml);
    //     } else {
    //         renderAjax(defaultUrl, '', true);
    //     }

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
            var targetElm = '#sidebar [data-toggle="ajax"][href="'+ url +'"]';
            if ($(targetElm).length !== 0) {
                $('#sidebar li').removeClass('active');
                $(targetElm).closest('li').addClass('active');
                $(targetElm).parents().addClass('active');
            }
        }

        // function checkPushState(url) {
        // var targetUrl = url.replace('#','');
        // 	var targetUserAgent = window.navigator.userAgent;
        // 	var isIE = targetUserAgent.indexOf('MSIE ');
        //
        // 	if (isIE && (isIE > 0 && isIE < 9)) {
        // 		window.location.href = targetUrl;
        // 	} else {
        // 		// history.pushState('', '', '#' + targetUrl);
        // 		history.pushState('', '', '#' + targetUrl);
        //        history.pushState('', '',  targetUrl);
        // 	}
        // }

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

        // function renderAjax(url, elm, disablePushState) {
        //     // Pace.restart();
        //
        //     checkLoading(false);
        //     clearElement();
        //     checkSidebarActive(url);
        //     checkClearOption();
        //     // if (!disablePushState) {
        //     // 	checkPushState(url);
        //     // }
        //
        //     var targetContainer= '#content';
        //     // var targetUrl 	   = url.replace('#','');
        //     var targetUrl 	   = url;
        //     var targetType 	   = (setting.ajaxType) ? setting.ajaxType : 'GET';
        //     var targetDataType = (setting.ajaxDataType) ? setting.ajaxDataType : 'html';
        //     if (elm) {
        //         targetDataType = ($(elm).attr('data-type')) ? $(elm).attr('data-type') : targetDataType;
        //         targetDataDataType = ($(elm).attr('data-data-type')) ? $(elm).attr('data-data-type') : targetDataType;
        //     }
        //
        //     $.ajax({
        //         url: targetUrl,
        //         type: targetType,
        //         dataType: targetDataType,
        //         success: function(data) {
        //             $(targetContainer).html(data);
        //         },
        //         error: function(jqXHR, textStatus, errorThrown) {
        //             $(targetContainer).html(emptyHtml);
        //         }
        //     }).done(function() {
        //         checkLoading(true);
        //         $('html, body').animate({ scrollTop: 0 }, 0);
        //         App.initComponent();
        //     });
        // }
        //
        // $(window).on('hashchange', function() {
        //     if (window.location.hash) {
        //         renderAjax(window.location.hash, '', true);
        //     }
        // });
        //
        // $(document).on('click', '[data-toggle="ajax"]', function(e) {
        //     e.preventDefault();
        //     renderAjax($(this).attr('href'), this);
        // });
    // };

	$(document).ready(function() {
		App.init();
        $.pjax.defaults.maxCacheLength = 0;

        window.Parsley.addValidator('uppercase', {
            requirementType: 'number',
            validateString: function (value, requirement) {
                var uppercases = value.match(/[A-Z]/g) || [];
                return uppercases.length >= requirement;
            },
            messages: {
                en: 'Your password must contain at least (%s) uppercase letter.'
            }
        });

        //has lowercase
        window.Parsley.addValidator('lowercase', {
            requirementType: 'number',
            validateString: function (value, requirement) {
                var lowecases = value.match(/[a-z]/g) || [];
                return lowecases.length >= requirement;
            },
            messages: {
                en: 'Your password must contain at least (%s) lowercase letter.'
            }
        });

        //has number
        window.Parsley.addValidator('number', {
            requirementType: 'number',
            validateString: function (value, requirement) {
                var numbers = value.match(/[0-9]/g) || [];
                return numbers.length >= requirement;
            },
            messages: {
                en: 'Your password must contain at least (%s) number.'
            }
        });

        //has special char
        window.Parsley.addValidator('special', {
            requirementType: 'number',
            validateString: function (value, requirement) {
                var specials = value.match(/[^a-zA-Z0-9]/g) || [];
                return specials.length >= requirement;
            },
            messages: {
                en: 'Your password must contain at least (%s) special characters.'
            }
        });
        // window.Parsley.addValidator('multi', {
        //     requirementType: 'number',
        //     validateString: function(value, requirement) {
        //         return value.split(',').length<=requirement;
        //     },
        //     messages: {
        //         en: "Your can only %s max.",
        //         fr: "Cette phrase est trop court."
        //     }
        // });

        $(document).pjax('a', "#content");

        $(document).on('pjax:start', function () {
            console.log("pjax-start");
            // checkLoading(false);
            // clearElement();
            // checkSidebarActive(url);
            // checkClearOption();
            // alert("pjax");
        });

        $(document).on('pjax:success', function () {
            console.log("pjax-success");
            $("#modal-form").parsley();
        });
	});
</script>

@yield('scripts')
