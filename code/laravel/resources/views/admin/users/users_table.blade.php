@extends("layouts.admin.pjax_index")
@section('pjax_content')
<div class="panel-body">
    <table id="data-table-fixed-header" class="table table-striped table-bordered">
        <thead>
        <tr>
            <th width="1%"></th>
            <th width="1%" data-orderable="false"></th>
            <th class="text-nowrap">用户名</th>
            <th class="text-nowrap">邮箱</th>
            <th class="text-nowrap">注册时间</th>
            <th class="text-nowrap">权限</th>
            <th class="text-nowrap">编辑</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users  as $user)
            <tr>
                <td width="1%" class="f-s-600">{{$loop->iteration}}</td>
                <td width="1%" class="with-img"><img src="admin_doc/assets/img/user/user-1.jpg" class="img-rounded height-30" /></td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->created_at}}</td>
                <td width="1%" class="with-btn-group" nowrap>
                    <div class="btn-group">
                        <a href="#" class="btn btn-white btn-sm width-90">Settings</a>
                        <a href="#" class="btn btn-white btn-sm dropdown-toggle width-30 no-caret" data-toggle="dropdown">
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="#">Action 1</a></li>
                            <li><a href="#">Action 2</a></li>
                            <li><a href="#">Action 3</a></li>
                            <li class="divider"></li>
                            <li><a href="#">Action 4</a></li>
                        </ul>
                    </div>
                </td>
                <td width="5%" class="with-btn" nowrap>
                    <a href="#" class="btn btn-sm btn-primary width-60 m-r-2">属性</a>
                    <a href="#" class="btn btn-sm btn-white width-60">删除</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <!-- begin row -->
    <div id="data-table-fixed-header_wrapper" class="dataTables_wrapper row form-inline dt-bootstrap no-footer">
        <div class="col-sm-5">
            <div class="dataTables_info" id="data-table-fixed-header_info" role="status" aria-live="polite">Showing 1 to
                12 of 12 entries
            </div>
        </div>
        <div class="col-sm-7 pull-right">
            {{$users->links()}}
        </div>
    </div>
    <!-- end row -->
</div>
@stop
