<!DOCTYPE html>
<html>
<head>
    <!-- Standard Meta -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <link rel="stylesheet" href="{{ mix('/frontend/css/app.css') }}">

    <!-- Site Properties -->
    <title>cherrybeal - 做最好的自己</title>


    @yield('css')

</head>
<body>

<!-- header -->
@include('home.layouts.header')

@yield('content')

<!-- footer -->
@include('home.layouts.footer')
</body>

</html>
<script src="{{ mix('/frontend/js/app.js') }}"></script>
@yield('js')
