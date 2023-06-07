<!DOCTYPE html>
<html lang="en">
 <head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <meta name="site_url" content="{{url('')}}">
   
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Olukotide</title>
  
  <link rel="stylesheet" href="{{ asset('back/assets/css/app.min.css')}}">
  <link rel="stylesheet" href="{{ asset('back/assets/bundles/bootstrap-social/bootstrap-social.css')}}">
  @section('head')
  @show
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Source+Sans+3:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('back/assets/css/style.css')}}">
  <link rel="stylesheet" href="{{ asset('back/assets/css/components.css')}}">
  <link rel="stylesheet" href="{{ asset('back/assets/css/custom.css')}}">
  <link rel='shortcut icon' type='image/x-icon' href="{{ asset('front/assets/img/favicon.png')}}"/>

</head>
 @yield('body')
</html>