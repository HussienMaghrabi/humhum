<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hum Hum</title>

  @include('website.includes.styles')
  @yield('styles')

</head>
<body>
@include('website.includes.header')

@include('website.includes.navbar')



<!-- Content Wrapper. Contains page content -->
        @yield('content')
<!-- /.content-wrapper -->
    @include('website.includes.footer')


<!-- ./wrapper -->

@include('website.includes.scripts')
@yield('scripts')
{{--@include('flashy::message')--}}
</body>
</html>
