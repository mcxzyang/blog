@extends('admin.layouts.app')

@section('content')
    <div class="row animated bounceInRight">
        <div class="col-sm-12">
            <div class="card-box">
                <div class="row">
                    <div class="col-lg-10 col-md-10 col-lg-offset-1 col-md-offset-1">
                        <form role="form" onsubmit="task(this)">
                            <div class="form-group  m-b-20">
                                <label class="control-label">标题</label>
                                <input type="text" class="form-control" name="title" value="{{ $article->title }}" required>
                            </div>
                            <div class="form-group  m-b-20">
                                <label class="control-label">图片</label>
                                <input type="file" class="filestyle" data-buttonname="btn-default" id="avatarFile"  onchange="uploadByQiniu()">
                                <input type="hidden" name="image" id="get-value" value="{{ $article->image }}">
                                <span class="help-block">尺寸为 1150 x 340</span>
                                <span class="help-block" id="image-content">
                                     <img class="img-thumbnail" style="height: 200px" id="get-src" src="{{ getPicAsset($article->image) }}" alt="">
                                </span>
                            </div>
                            <div class="form-group  m-b-20">
                                <label class="control-label">专辑</label>
                                @if(count($albums))
                                    <select name="album_id" class="select2 form-control">
                                        @foreach($albums as $album)
                                            <option value="{{ $album->id }}" @if($article->album_id == $album->id) selected @endif>{{ $album->title }}</option>
                                            @endforeach
                                    </select>
                                    @endif
                            </div>

                            <div class="form-group  m-b-20">
                                <label class="control-label">标签</label>
                                @if(count($tags))
                                <select class="select2 form-control select2-multiple" name="tag_id[]" multiple="multiple" data-placeholder="选择标签...">
                                    @foreach($tags as $tag)
                                        <option value="{{ $tag->id }}" @if(in_array($tag->id, array_column($article->tags->toArray(), 'id'))) selected @endif>{{ $tag->title }}</option>
                                        @endforeach
                                </select>
                                    @endif
                            </div>

                            <div class="form-group m-b-20">
                                <label class="form-label">内容</label>
                                <div id="test-editormd">
                                    <textarea name="content_raw" style="display:none;">{!! $article->content_raw !!}</textarea>
                                </div>
                                @include('markdown::encode',['editors'=>['test-editormd']])
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-sm w-sm waves-effect m-t-10 waves-light"><i class="fa fa-save"></i> 保存</button>
                                <a href="{{ route('admin.article.index') }}" class="btn btn-danger btn-sm w-sm waves-effect m-t-10 waves-light"><i class="fa fa-reply"></i> 返回</a>
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

            $(".select2").select2();
        });

        function task(el){
            window.event.preventDefault();
            return toSubmit({
                el: $(el),
                method: 'PATCH',
                action: '{{ route('admin.article.update', $article->id) }}',
                jump: '{{ route('admin.article.index') }}'
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
