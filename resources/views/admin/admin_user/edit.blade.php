<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">更新管理员</h4>
</div>
<div class="modal-body">
    <form class="form-horizontal" role="form" onsubmit="task(this)">
        <div class="form-group">
            <label class="col-md-2 control-label">登录名</label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="username" required value="{{ $adminUser->username }}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">昵称</label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="name" required value="{{ $adminUser->name }}">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label">密码</label>
            <div class="col-md-10">
                <input type="password" class="form-control" name="password"  placeholder="不修改密码时请不要填写">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label">超级管理员</label>
            <div class="col-md-10">
                <input type="checkbox" id="switch" name="is_super" @if($adminUser->is_super) checked="" @endif value="1" switch="success">
                <label for="switch" data-on-label="是" data-off-label="否"></label>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label">角色</label>
            <div class="col-md-10">
                @if(count($roles))
                    <div class="row">
                        @foreach($roles as $role)
                            <div class="col-xs-6">
                                <div class="checkbox checkbox-info m-b-15">
                                    <input id="{{ $role->name }}" name="roles[]" type="checkbox" value="{{ $role->name }}" @if($adminUser->hasRole($role)) checked @endif>
                                    <label for="{{ $role->name }}">
                                        {{ $role->alias }}-{{ $role->description }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-8 col-md-offset-2">
                <button type="submit" class="btn btn-success btn-sm w-sm waves-effect m-t-10 waves-light"><i class="fa fa-save"></i> 保存</button>
                <a href="{{ route('admin.admin_user.index') }}" class="btn btn-danger btn-sm w-sm waves-effect m-t-10 waves-light"><i class="fa fa-reply"></i> 返回</a>
            </div>
        </div>

    </form>
</div>

<script>
    function task(el){
        window.event.preventDefault();
        return toSubmit({
            el: $(el),
            method: 'PATCH',
            action: '{{ route('admin.admin_user.update', ['id' => $adminUser->id]) }}',
            jump: '{{ route('admin.admin_user.index') }}'
        })
    }
</script>
