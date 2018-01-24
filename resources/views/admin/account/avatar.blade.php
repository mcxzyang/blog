<link rel="stylesheet" href="/backend/css/avatar.css">
<form class="avatar-form" action="{{ route('admin.tool.uploadAvatar') }}" enctype="multipart/form-data" method="post">
    <div class="modal-header">
        <button class="close" data-dismiss="modal" type="button">&times;</button>
        <h4 class="modal-title" id="avatar-modal-label">修改头像</h4>
    </div>
    <div class="modal-body">
        <div class="avatar-body">
            <div class="avatar-upload">
                <input class="avatar-src" name="avatar_src" type="hidden">
                <input class="avatar-data" name="avatar_data" type="hidden">
                <label for="avatarInput">图片上传</label>
                <input class="avatar-input" id="avatarInput" name="avatar_file" type="file"></div>
            <div class="row">
                <div class="col-md-9">
                    <div class="avatar-wrapper"></div>
                </div>
                <div class="col-md-3">
                    <div class="avatar-preview preview-lg"></div>
                    <div class="avatar-preview preview-md"></div>
                    <div class="avatar-preview preview-sm"></div>
                </div>
            </div>
            <div class="row avatar-btns">
                <div class="col-md-9">
                    <div class="btn-group">
                        <button class="btn" data-method="rotate" data-option="-90" type="button" title="Rotate -90 degrees"><i class="fa fa-undo"></i> 向左旋转</button>
                    </div>
                    <div class="btn-group">
                        <button class="btn" data-method="rotate" data-option="90" type="button" title="Rotate 90 degrees"><i class="fa fa-repeat"></i> 向右旋转</button>
                    </div>
                </div>
                <div class="col-md-3">
                    <button class="btn btn-success btn-block avatar-save" type="submit"><i class="fa fa-save"></i> 保存修改</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script src="/backend/js/avatar.js"></script>
