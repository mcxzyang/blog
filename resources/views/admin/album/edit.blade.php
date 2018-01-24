@extends('admin.layouts.app')

@section('content')
    <div class="row animated bounceInRight">
        <div class="col-sm-12">
            <div class="card-box">
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-lg-offset-2 col-md-offset-2">
                        <form role="form" onsubmit="task(this)">
                            <div class="form-group m-b-20">
                                <label class="control-label">标题</label>
                                <input type="text" class="form-control" name="title" value="{{ $album->title }}" required>
                            </div>
                            <div class="form-group">
                                <label class="control-label">描述</label>
                                <input type="text" class="form-control" name="description" value="{{ $album->description }}" required>
                            </div>
                            <div class="form-group  m-b-20">
                                <label class="control-label">封面</label>
                                <input type="file" class="filestyle" data-buttonname="btn-default" id="avatarFile"  onchange="uploadByQiniu()">
                                <input type="hidden" name="image" id="get-value" value="{{ $album->image }}">
                                <span class="help-block">尺寸为 1200 x 750</span>
                                <span class="help-block" id="image-content">
                                     <img class="img-thumbnail" style="height: 200px" id="get-src" src="{{ getPicAsset($album->image) }}" alt="">
                                </span>
                            </div>
                            <div class="form-group  m-b-20">
                                <label class="control-label">是否精选</label>
                                <div>
                                    <input type="checkbox" id="switch" name="is_high" @if($album->is_high) checked @endif value="1" switch="success">
                                    <label for="switch" data-on-label="是" data-off-label="否"></label>
                                </div>

                            </div>
                            <div class="form-group  m-b-20">
                                <label class="control-label">排序</label>
                                <input type="text" class="form-control" name="weight" value="{{ $album->weight }}">
                                <span class="help-block">数字越小越靠前</span>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-sm w-sm waves-effect m-t-10 waves-light"><i class="fa fa-save"></i> 保存</button>
                                <a href="{{ route('admin.album.index') }}" class="btn btn-danger btn-sm w-sm waves-effect m-t-10 waves-light"><i class="fa fa-reply"></i> 返回</a>
                            </div>

                        </form>
                    </div> <!-- end col -->


                    <!-- end col -->

                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script src="/backend/js/bootstrap-filestyle.min.js"></script>
    <script>
        $(function(){
            $(":file").filestyle({input: false});
        });

        function task(el){
            window.event.preventDefault();
            return toSubmit({
                el: $(el),
                method: 'PATCH',
                action: '{{ route('admin.album.update', $album->id) }}',
                jump: '{{ route('admin.album.index') }}'
            })
        }

        function uploadByQiniu(){
            var file = $('#avatarFile')[0].files[0];
            if(!file || file == 'undefined'){
                return;
            }
            var formData = new FormData();
            formData.append('file', file);
            //formData.append('X-XSRF-TOKEN', $('input[name="_token"]').val());
            var url = '{{ route('admin.tool.uploadQiniu') }}';
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN' : $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: url,
                type: 'post',
                data: formData,
                dataType: 'json',
                processData : false,
                contentType : false,
                success: function(data){
                    if(data.status){
                        $('#get-value').val(data.src);
                        $('#get-src').attr('src', data.url);
                        $('#image-content').show();
                    } else {
                        alert(data.message);
                        return false;
                    }
                }
            })
        }
    </script>
@stop
