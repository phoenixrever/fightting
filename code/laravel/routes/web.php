<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Http\Models\Blog;
//Route::get('logout', 'Auth\LoginController@logout')->name('logout');
//
//
//
//Route::get('admin_index', 'Admin\IndexController@index')->name('admin_index');
//Route::get('admin_index_v2', 'Admin\AdminController@index_v2')->name('admin_index_v2');
//Route::get('admin_article_table', 'Admin\ArticleController@article_table')->name('admin_article_table');
//Route::get('table', 'Admin\UserController@index')->name('table_user');

Auth::routes();
Route::get("test",'Admin\RoleController@update')->name("roles.index");
Route::get("select2/{name}",'Admin\Select2Controller@select2')->name("select2");

Route::delete("permissions/multiDelete",'Admin\PermissionController@multiDelete')->name("permissions.multiDelete");
Route::delete("users/multiDelete",'Admin\UserController@multiDelete')->name("users.multiDelete");
Route::delete("roles/multiDelete",'Admin\RoleController@multiDelete')->name("roles.multiDelete");
//Route::get("users/search/{keyword}",'Admin\UserController@search')->name('users.search');

//Route::get("permissions/search/{sort_keyword}/{sort}/{search_word}",'Admin\PermissionController@sortSearch')->name('permissions.sortSearch');
Route::post("permissions/checkName",'Admin\CheckUniqueController@checkPermissionName')->name('permissions.checkName');
Route::post("users/checkEmail",'Admin\CheckUniqueController@checkUserEmail')->name('users.checkEmail');
Route::post("users/checkUserName",'Admin\CheckUniqueController@checkUserName')->name('users.checkUserName');
Route::post("roles/checkRole",'Admin\CheckUniqueController@checkRole')->name('roles.checkRole');


//Route::get("permissions/{select}",'Admin\PermissionController@set_select')->name('permissions.set_select');
//Route::get("permissions/{sort_keyword}/{sort}",'Admin\PermissionController@sortIndex')->name("permissions.sortIndex");
/* 必須放放resource 前面  爲什麽--------------*/
Route::get("permissions/anyData",'Admin\PermissionController@anyData')->name('permissions.anyData');
Route::get("users/anyData",'Admin\UserController@anyData')->name('users.anyData');
Route::get("roles/anyData",'Admin\RoleController@anyData')->name('roles.anyData');
Route::post("blog/ajax/{id}",'Admin\BlogController@ajaxUpdate')->name('blog.ajaxUpdate');
Route::post("comment/ajax/{id}",'Admin\CommentController@ajaxReplyStore')->name('comment.ajaxReplayStore');
Route::get("blog/delete/{id}",'Admin\BlogController@delete')->name('blog.delete');
Route::get("comment/delete/{id}",'Admin\CommentController@delete')->name('comment.delete');
Route::resource('users', 'Admin\UserController');
Route::resource('permissions', 'Admin\PermissionController');
Route::resource('roles', 'Admin\RoleController');

//Route::resource('roles', 'Admin\RoleController');
Route::resource('blogs', 'Admin\BlogController');

Route::post("comments/{id}",'Admin\CommentController@store')->name('comments.store');


Route::get('/index1', function () {
    return view('frontend.index1');
});
Route::get('/index2', function () {
    $i=rand(0,5);
    $cover_path="frontend_assets/img/cover/star-".$i.".jpg";
    $a=[
        'boxedLayout'=>1,
        'paceTop'=>1,
        'bodyExtraClass'=>1,
        'sidebarHide'=>1,
        'headerMenu'=>1,
        'headerMegaMenu'=>1,
        //'topMenu'=>1,
        'footer'=>1,
        'page_cover'=>url($cover_path),
        'contentInverseMode'>1,
    ];
    return view('frontend.index2',$a);
});

Route::get('/category', function () {
    $i=rand(1,5);
    $cover_path="frontend_assets/img/cover/star-".$i.".jpg";
    $jumbotron_cover="frontend_assets/img/cover/cover-pain.jpg";
    $a=[
        'boxedLayout'=>1,
        'paceTop'=>1,
        'bodyExtraClass'=>1,
        'sidebarHide'=>1,
        'headerMenu'=>1,
        'headerMegaMenu'=>1,
        //'topMenu'=>1,
        'footer'=>1,
        'page_cover'=>url($cover_path),
        'jumbotron_cover'=>url( $jumbotron_cover),
        'contentInverseMode'>1,
    ];
    return view('frontend.category',$a);
});


//Route::any('detail', function () {
//    $i=rand(1,5);
//    $cover_path="frontend_assets/img/cover/star-".$i.".jpg";
//    $jumbotron_cover="frontend_assets/img/cover/cover-pain.jpg";
//    $blogs=Blog::orderby('id','desc')->paginate(5);
//    $a=[
//        'boxedLayout'=>1,
//        'paceTop'=>1,
//        'bodyExtraClass'=>1,
//        'sidebarHide'=>1,
//        'headerMenu'=>1,
//        'headerMegaMenu'=>1,
//        //'topMenu'=>1,
//        'footer'=>1,
//        'page_cover'=>url($cover_path),
//        'jumbotron_cover'=>url( $jumbotron_cover),
//        'contentInverseMode'>1,
//        'blogs'=>$blogs,
//    ];
//    return view('frontend.detail',$a);
//})->name("detail");

//Route::get('/', function () {
//    return response()->streamDownload(function () {
//        echo file_get_contents('https://images.pexels.com/photos/458766/pexels-photo-458766.jpeg?auto=compress&cs=tinysrgb&h=650&w=940');
//    }, 'nice-name.jpg');
//});




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Route::get("/",'Admin\PermissionController@index')->name('permissions.index');
//Route::delete("/",'Admin\PermissionController@destroy')->name('permissions.destroy');

Route::get('/dashboard/v1', function () {
    return view('pages/dashboard-v1');
});
Route::get('/dashboard/v2', function () {
    return view('pages/dashboard-v2');
});
Route::get('/email/inbox', function () {
    return view('pages/email-inbox');
});
Route::get('/email/compose', function () {
    return view('pages/email-compose');
});
Route::get('/email/detail', function () {
    return view('pages/email-detail');
});
Route::get('/widget', function () {
    return view('pages/widget');
});
Route::get('/ui/general', function () {
    return view('pages/ui-general');
});
Route::get('/ui/typography', function () {
    return view('pages/ui-typography');
});
Route::get('/ui/tabs-accordions', function () {
    return view('pages/ui-tabs-accordions');
});
Route::get('/ui/unlimited-nav-tabs', function () {
    return view('pages/ui-unlimited-nav-tabs');
});
Route::get('/ui/modal-notification', function () {
    return view('pages/ui-modal-notification');
});
Route::get('/ui/widget-boxes', function () {
    return view('pages/ui-widget-boxes');
});
Route::get('/ui/media-object', function () {
    return view('pages/ui-media-object');
});
Route::get('/ui/buttons', function () {
    return view('pages/ui-buttons');
});
Route::get('/ui/icons', function () {
    return view('pages/ui-icons');
});
Route::get('/ui/simple-line-icons', function () {
    return view('pages/ui-simple-line-icons');
});
Route::get('/ui/ionicons', function () {
    return view('pages/ui-ionicons');
});
Route::get('/ui/tree-view', function () {
    return view('pages/ui-tree-view');
});
Route::get('/ui/language-bar-icon', function () {
    return view('pages/ui-language-bar-icon');
});
Route::get('/ui/social-buttons', function () {
    return view('pages/ui-social-buttons');
});
Route::get('/ui/intro-js', function () {
    return view('pages/ui-intro-js');
});
Route::get('/bootstrap-4', function () {
    return view('pages/bootstrap-4');
});
Route::get('/form/elements', function () {
    return view('pages/form-elements');
});
Route::get('/form/plugins', function () {
    return view('pages/form-plugins');
});
Route::get('/form/slider-switcher', function () {
    return view('pages/form-slider-switcher');
});
Route::get('/form/validation', function () {
    return view('pages/form-validation');
});
Route::get('/form/wizards', function () {
    return view('pages/form-wizards');
});
Route::get('/form/wizards-validation', function () {
    return view('pages/form-wizards-validation');
});
Route::get('/form/wysiwyg', function () {
    return view('pages/form-wysiwyg');
});
Route::get('/form/x-editable', function () {
    return view('pages/form-x-editable');
});
Route::get('/form/multiple-file-upload', function () {
    return view('pages/form-multiple-file-upload');
});
Route::get('/form/summernote', function () {
    return view('pages/form-summernote');
});
Route::get('/form/dropzone', function () {
    return view('pages/form-dropzone');
});
Route::get('/table/basic', function () {
    return view('pages/table-basic');
});
Route::get('/table/manage/default', function () {
    return view('pages/table-manage-default');
});
Route::get('/table/manage/autofill', function () {
    return view('pages/table-manage-autofill');
});
Route::get('/table/manage/buttons', function () {
    return view('pages/table-manage-buttons');
});
Route::get('/table/manage/colreorder', function () {
    return view('pages/table-manage-colreorder');
});
Route::get('/table/manage/fixed-column', function () {
    return view('pages/table-manage-fixed-column');
});
Route::get('/table/manage/fixed-header', function () {
    return view('pages/table-manage-fixed-header');
});
Route::get('/table/manage/keytable', function () {
    return view('pages/table-manage-keytable');
});
Route::get('/table/manage/responsive', function () {
    return view('pages/table-manage-responsive');
});
Route::get('/table/manage/rowreorder', function () {
    return view('pages/table-manage-rowreorder');
});
Route::get('/table/manage/scroller', function () {
    return view('pages/table-manage-scroller');
});
Route::get('/table/manage/select', function () {
    return view('pages/table-manage-select');
});
Route::get('/table/manage/combine', function () {
    return view('pages/table-manage-combine');
});
Route::get('/email-template/system', function () {
    return view('pages/email-template-system');
});
Route::get('/email-template/newsletter', function () {
    return view('pages/email-template-newsletter');
});
Route::get('/chart/flot', function () {
    return view('pages/chart-flot');
});
Route::get('/chart/morris', function () {
    return view('pages/chart-morris');
});
Route::get('/chart/js', function () {
    return view('pages/chart-js');
});
Route::get('/chart/d3', function () {
    return view('pages/chart-d3');
});
Route::get('/calendar', function () {
    return view('pages/calendar');
});
Route::get('/map/vector', function () {
    return view('pages/map-vector');
});
Route::get('/map/google', function () {
    return view('pages/map-google');
});
Route::get('/gallery/v1', function () {
    return view('pages/gallery-v1');
});
Route::get('/gallery/v2', function () {
    return view('pages/gallery-v2');
});
Route::get('/page-option/page-blank', function () {
    return view('pages/page-blank');
});
Route::get('/page-option/page-with-footer', function () {
    return view('pages/page-with-footer');
});
Route::get('/page-option/page-without-sidebar', function () {
    return view('pages/page-without-sidebar');
});
Route::get('/page-option/page-with-right-sidebar', function () {
    return view('pages/page-with-right-sidebar');
});
Route::get('/page-option/page-with-minified-sidebar', function () {
    return view('pages/page-with-minified-sidebar');
});
Route::get('/page-option/page-with-two-sidebar', function () {
    return view('pages/page-with-two-sidebar');
});
Route::get('/page-option/page-full-height', function () {
    return view('pages/page-full-height');
});
Route::get('/page-option/page-with-wide-sidebar', function () {
    return view('pages/page-with-wide-sidebar');
});
Route::get('/page-option/page-with-light-sidebar', function () {
    return view('pages/page-with-light-sidebar');
});
Route::get('/page-option/page-with-mega-menu', function () {
    return view('pages/page-with-mega-menu');
});
Route::get('/page-option/page-with-top-menu', function () {
    return view('pages/page-with-top-menu');
});
Route::get('/page-option/page-with-boxed-layout', function () {
    return view('pages/page-with-boxed-layout');
});
Route::get('/page-option/page-with-mixed-menu', function () {
    return view('pages/page-with-mixed-menu');
});
Route::get('/page-option/boxed-layout-with-mixed-menu', function () {
    return view('pages/page-boxed-layout-with-mixed-menu');
});
Route::get('/page-option/page-with-transparent-sidebar', function () {
    return view('pages/page-with-transparent-sidebar');
});
Route::get('/extra/timeline', function () {
    return view('pages/extra-timeline');
});
Route::get('/extra/coming-soon', function () {
    return view('pages/extra-coming-soon');
});
Route::get('/extra/search-result', function () {
    return view('pages/extra-search-result');
});
Route::get('/extra/invoice', function () {
    return view('pages/extra-invoice');
});
Route::get('/extra/error-page', function () {
    return view('pages/extra-error-page');
});
Route::get('/extra/profile', function () {
    return view('pages/extra-profile');
});
Route::get('/login/v1', function () {
    return view('pages/login-v1');
});
Route::get('/login/v2', function () {
    return view('pages/login-v2');
});
Route::get('/login/v3', function () {
    return view('pages/login-v3');
});
Route::get('/register/v3', function () {
    return view('pages/register-v3');
});
Route::get('/helper/css', function () {
    return view('pages/helper-css');
});

