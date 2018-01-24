<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="cherrybeal">

    <!-- App favicon -->
    <link rel="shortcut icon" href="/backend/images/favicon.ico">
    <!-- App title -->
    <title>@yield('title') - {{ config('app.name') }}</title>

    <link rel="stylesheet" href="{{ mix('/backend/css/admin.css') }}">

    @yield('css')
</head>

@yield('body')
<!-- Modal -->
<div class="modal fade animated" id="myModal-primary" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        </div><!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade animated" id="myModal-large" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
        </div><!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
</html>
<script>
    var resizefunc = [];
</script>
<script src="{{ mix('/backend/js/admin.js') }}"></script>
@yield('js')

