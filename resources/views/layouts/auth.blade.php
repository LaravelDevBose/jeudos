<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{asset('backend/images/favicon.png')}}">

<title>{{config('app.name')}} - @yield('title')</title>

<!-- Bootstrap 4.0-->
<link rel="stylesheet" href="{{asset('backend/vendor_components/bootstrap/dist/css/bootstrap.min.css')}}">

<!-- theme style -->
<link rel="stylesheet" href="{{asset('backend/css/style.css')}}">

<!-- Admin skins -->
<link rel="stylesheet" href="{{asset('backend/css/skin_color.css')}}">

</head>
@yield('body')

<!-- jQuery 3 -->
<script src="{{asset('backend/vendor_components/jquery-3.3.1/jquery-3.3.1.js')}}"></script>

<!-- fullscreen -->
<script src="{{asset('backend/vendor_components/screenfull/screenfull.js')}}"></script>

<!-- popper -->
<script src="{{asset('backend/vendor_components/popper/dist/popper.min.js')}}"></script>

<!-- Bootstrap 4.0-->
<script src="{{asset('backend/vendor_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
</html>
