<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">更新标签</h4>
</div>
<div class="modal-body">
    <form class="form-horizontal" role="form" onsubmit="task(this)">
        <div class="form-group m-b-20">
            <label class="col-md-2 control-label">名称</label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="title" value="{{ $tag->title }}" required>
            </div>
        </div>
        <div class="form-group m-b-20">
            <label class="col-md-2 control-label">排序</label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="weight" value="{{ $tag->weight }}" required>
                <span class="help-block">数字越小越靠前</span>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-8 col-md-offset-2">
                <button type="submit" class="btn btn-success btn-sm w-sm waves-effect m-t-10 waves-light"><i class="fa fa-save"></i> 保存</button>
                <a href="{{ route('admin.tag.index') }}" class="btn btn-danger btn-sm w-sm waves-effect m-t-10 waves-light"><i class="fa fa-reply"></i> 返回</a>
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
            action: '{{ route('admin.tag.update', $tag->id) }}',
            jump: '{{ route('admin.tag.index') }}'
        })
    }
</script>
