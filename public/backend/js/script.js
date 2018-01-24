var Applocation = {
    init: function(){

        $('.modal').on('hide.bs.modal', function () {
            $(this).removeData('bs.modal');
        });

        $('.modal').on('show.bs.modal', function (event) {
            var e = $(event.relatedTarget);
            var animate = e.data('animate');
            var el = e.data('target');
            $(el).addClass(animate);
        });

        $('.selectpicker').selectpicker();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('[data-toggle="tooltip"]').tooltip();

        window.failed = function(message){
            toastr.error(message);
        };

        window.succeed = function(message, url = null){
            tswal(message, url);
        };

        window.tswal = function(message, url = null){
            swal({
                title: message,
                text: "",
                type: "success",
                confirmButtonClass: 'btn-success',
                confirmButtonText: "确定"
            }, function () {
                if(url !== null){
                    location.href = url;
                }
            });
        };

        window.toSubmit = function(params){
            $.ajax({
                type: params.method,
                url: params.action,
                data: params.el ? params.el.serialize() : {},
                dataType: 'JSON',
                success: function(response){
                    return response.status
                        ? (params.callback
                        ? params.callback()
                        : succeed(response.message, params.jump))
                        : failed(response.message)
                }
            })
        };

        $(document).on('click', '.delete-item', function(){
            var url = $(this).data('href');
            swal({
                title: "确定删除这条记录吗?",
                text: "这条记录将被永久删除!",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: 'btn-warning',
                confirmButtonText: "确定",
                cancelButtonText: "取消",
                closeOnConfirm: false
            }, function () {
                toSubmit({
                    method: "DELETE",
                    action: url,
                    callback: function(){
                        location.reload();
                    }
                });
            });
        })
    }
};

$(document).ready(function () {
    Applocation.init();
});
