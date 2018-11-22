@extends("layouts.admin.pjax_index")
@section('pjax_content')
    <div class="panel-body">
        <div class="dataTables_wrapper form-inline dt-bootstrap no-footer">
            <div class="row m-b-15 white-label">
                <div class="col-sm-6">
                    <div class="form-group" id="data-table-default_length">
                        <label class="m-r-5">Show </label>
                        <select id="data-table-default-select" name="data-table-default_length"
                                class="form-control input-sm">
                            <option value="10" {{$result[3]=='10'?'selected':''}}>10</option>
                            <option value="25" {{$result[3]=='25'?'selected':''}}>25</option>
                            <option value="50" {{$result[3]=='50'?'selected':''}}>50</option>
                            <option value="100" {{$result[3]=='100'?'selected':''}}>100</option>
                        </select>
                        <label class="m-l-5">entries</label>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div id="data-table-default_filter" class="dataTables_filter form-group pull-right">
                        <label>Search: </label>
                        <div class="search-in" id="search-in">
                            <div class="form-group">
                                <input type="text" id="search_word" name="search_word" class="form-control input-sm "
                                       placeholder="" value="{{isset($result[2])?$result[2]:''}}"
                                       aria-controls="data-table-default">
                                <button type="button" class="btn btn-search" id="search_button"><i
                                            class="fa fa-search"></i></button>
                                <input type="hidden" id="search_url" value="{{url("permissions")}}">
                                <a type="hidden" id="search_link"><span></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <table id="permissions_table" class="table table-striped m-b-0 table-bordered">
            <thead>
            <tr>
                <th width="1%" class="with-checkbox checkAll">
                    <div class="checkbox checkbox-css checkbox-success">
                        <input type="checkbox" id="checkAll">
                        <label for="checkAll"> </label>
                    </div>
                </th>
                <th width="1%"></th>
                @if(isset($result))
                    {{--<input type="text" id="search_bool" value="{{$result[2]}}">--}}
                    @if($result[0]=='permissions')
                        <th id="permissions" class="sort-click text-nowrap {{ $result[1] }}"><a
                                    href="{{url("permissions/".(isset($result[2])?"search/":'')."permissions/".($result[1]=='asc'?'desc':'asc')).(isset($result[2])?"/".$result[2]:'')}}"><span>权限<i
                                            class="fas fa-sort pull-right"></i></span></a></th>
                        <th id="description" class="sort-click text-nowrap"><a
                                    href="{{url("permissions/".(isset($result[2])?"search/":'')."description/desc").(isset($result[2])?"/".$result[2]:'')}}"><span>描述<i
                                            class="fas fa-sort pull-right"></i></span></a>
                    @else
                        <th id="permissions" class="sort-click text-nowrap"><a
                                    href="{{url("permissions/".(isset($result[2])?"search/":'')."permissions/desc").(isset($result[2])?"/".$result[2]:'')}}"><span>权限<i
                                            class="fas fa-sort pull-right"></i></span></a></th>
                        <th id="description" class="sort-click text-nowrap  {{$result[1]}}"><a
                                    href="{{url("permissions/".(isset($result[2])?"search/":'')."description/".($result[1]=='asc'?'desc':'asc')).(isset($result[2])?"/".$result[2]:'')}}"><span>描述<i
                                            class="fas fa-sort pull-right"></i></span></a></th>
                    @endif
                @else
                    <th id="permissions" class="sort-click text-nowrap"><a
                                href="{{url("permissions/permissions/desc")}}"><span>权限<i
                                        class="fas fa-sort pull-right"></i></span></a></th>
                    <th id="description" class="sort-click text-nowrap "><a
                                href="{{url("permissions/description/desc")}}"><span>描述<i
                                        class="fas fa-sort pull-right"></i></span></a>
                @endif
                <th class="text-nowrap"><a>编辑</a></th>
            </tr>
            </thead>
            <tbody>
            @if(!$permissions->items())
                <tr ><td colspan='4' style="text-align: center">没有数据</td></tr>
            @else
                @foreach($permissions  as $permission)
                    <tr>
                        <td width="1%" class="with-checkbox ">
                            <div class="checkbox checkbox-css checkbox-success">
                                <input type="checkbox" class="check_item" id="check_{{$loop->iteration}}"
                                       value="{{ $permission->id }}">
                                <label for="check_{{$loop->iteration}}"> </label>
                            </div>
                        </td>
                        <td width="1%">{{$loop->iteration}}</td>
                        <td width="15%">{!! str_replace_first(isset($result[2])?$result[2]:'','<span id="color_word">'.(isset($result[2])?$result[2]:'').'</span>',$permission->name)  !!}</td>
                        <td>{!! str_replace_first(isset($result[2])?$result[2]:'','<span id="color_word">'.(isset($result[2])?$result[2]:'').'</span>',$permission->description) !!}</td>
                        <td width="20%" class="with-btn" nowrap>
                            <form method="POST" action="{{route('permissions.destroy',[$permission->id])}}">
                                @method("delete")
                                @csrf
                                <button type="button" id="update-{{$permission->name}}"
                                        class="update btn btn-warning m-r-10"
                                        value="{{route('permissions.update',[$permission->id])}}">
                                    <i class="far fa-edit pull-left m-r-5"></i><span class="pull-left">编辑</span>
                                </button>
                                <button type="submit" class="btn btn-danger"><i
                                            class="far fa-trash-alt pull-left m-r-5"></i><span
                                            class="pull-left">删除</span></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>

        <div class="row foot-page">
            <div class="col-sm-6 ">
                <div class="form-inline tables_paginate m-t-10">
                    <a href="#modal-dialog" class="btn  btn-primary width-100 m-r-10 m-b-5 "
                       data-toggle="modal">增加权限</a>
                    <button id="check_btn" class="btn  btn-primary width-100 m-r-10  m-b-5">多选删除</button>
                    <form id="deleteAll" method="POST" action="{{route("permissions.deleteAll")}}">
                        @method("delete")
                        @csrf
                        <input type="hidden" id="deleteStr" name="deleteStr">
                        <button type="button" class="btn btn-primary width-100 m-b-5" id="multiDelete">删除</button>
                    </form>
                </div>
            </div>
            <div class="col-sm-6">
                {{--<div class="dataTables_paginate paging_simple_numbers " id="data-table-default_paginate">--}}
                <div class="pull-right m-t-10 ">
                    {{$permissions->links()}}
                </div>
                {{--</div>--}}
            </div>
        </div>
        <!-- end row -->
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
