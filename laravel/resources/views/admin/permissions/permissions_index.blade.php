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
            </tbody>
        </table>
        <!-- #modal-dialog -->
        <div class="modal fade " id="modal-dialog">
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Modal Dialog</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <form id="modal-form" method="post" action="{{route("permissions.store")}}"
                              class="form-horizontal"
                              data-parsley-validate="true" data-parsley-trigger="change">

                            @csrf

                            <div class="form-group row m-b-15">
                                <label class="col-md-4 col-sm-4 col-form-label" for="permission_name">权限名称 :</label>
                                <div class="col-md-8 col-sm-8">
                                    <input type="text" class="form-control" id="permission_name"
                                           name="permission_name" data-parsley-required="true"
                                           data-parsley-maxlength="40" placeholder="Required"/>
                                </div>
                            </div>
                            <div class="form-group row m-b-15">
                                <label class="col-md-4 col-sm-4 col-form-label" for="permission_desc">权限描述 :</label>
                                <div class="col-md-8 col-sm-8">
                                <textarea class="form-control" id="permission_desc" name="permission_desc" rows="4"
                                          data-parsley-maxlength="10" placeholder="Range from 20 - 200"></textarea>
                                </div>
                            </div>
                            <div class="form-group row m-b-0">
                                <label class="col-md-4 col-sm-4 col-form-label">&nbsp;</label>
                                <div class="col-md-8 col-sm-8">
                                    <button type="submit" id="submit_btn" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- end modal-dialog -->

        <!-- #modal-update -->
        <div class="modal fade " id="modal-update">
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Modal Update</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <form id="modal-update-form" method="post"
                              class="form-horizontal"
                              data-parsley-validate="true" data-parsley-trigger="change">

                            @method("put")
                            @csrf

                            <div class="form-group row m-b-15">
                                <label class="col-md-4 col-sm-4 col-form-label" for="permission_name2">权限名称 :</label>
                                <div class="col-md-8 col-sm-8">
                                    <input type="text" class="form-control" id="permission_name2"
                                           name="permission_name2" data-parsley-required="true"
                                           data-parsley-maxlength="40" placeholder="Required"/>
                                </div>
                            </div>
                            <div class="form-group row m-b-15">
                                <label class="col-md-4 col-sm-4 col-form-label" for="permission_desc2">权限描述 :</label>
                                <div class="col-md-8 col-sm-8">
                                <textarea class="form-control" id="permission_desc2" name="permission_desc2" rows="4"
                                          data-parsley-maxlength="10" placeholder="Range from 20 - 200"></textarea>
                                </div>
                            </div>
                            <div class="form-group row m-b-0">
                                <label class="col-md-4 col-sm-4 col-form-label">&nbsp;</label>
                                <div class="col-md-8 col-sm-8">
                                    <button type="submit" id="submit_btn2" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- end modal-update -->
    </div>
@stop
