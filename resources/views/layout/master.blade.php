<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="{{ URL::to('assets/css/bootstrap.css') }}" />
    <link rel="icon" type="image/png" href="{{ URL::to('assets/images/explore.png') }}" />
    <link rel="stylesheet" type="text/css" href="{{ URL::to('assets/css/jquery-ui.css') }}" />
  	<script type="text/javascript" src="{{ URL::to('assets/js/jquery.js') }}"></script>
    <script src="{{ URL::to('assets/js/jquery-ui.js') }}"></script>
  	<script type="text/javascript" src="{{ URL::to('assets/js/bootstrap.js') }}"></script>
    <script type="text/javascript" src="{{ URL::to('assets/js/main.js') }}"></script>
    <script type="text/javascript" src="{{ URL:: to('assets/js/isotope.js') }}"></script>
    <script type="text/javascript" src="{{ URL:: to('assets/js/friends.js') }}"></script>
    <script type="text/javascript" src="{{ URL::to('assets/js/app.js') }}"></script>
    <script type="text/javascript" src="{{ URL::to('assets/js/profile_pic_uploader.js') }}"></script>
  	<link rel="stylesheet" type="text/css" href="{{ URL::to('assets/css/style.css') }}" />
    <link href='http://fonts.googleapis.com/css?family=Inder' rel='stylesheet' type='text/css' />
  	<link rel="stylesheet" type="text/css" href="{{ URL::to('assets/font-awesome/css/font-awesome.css') }}" />
      <!-- Important Owl stylesheet -->
    <link rel="stylesheet" href="{{ URL::to('assets/owl-carousel/owl.carousel.css') }}" >
    <!-- Default Theme -->
    <link rel="stylesheet" href="{{ URL::to('assets/owl-carousel/owl.theme.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.imagesloaded/3.1.8/imagesloaded.pkgd.min.js"></script>
    <!-- Include js plugin -->
    <script src="{{ URL::to('assets/owl-carousel/owl.carousel.js') }}"></script>
    <script type="text/javascript" src="{{ URL::to('assets/masonry.pkgd.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::to('assets/js/clockpicker.min.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ URL::to('assets/css/clockpicker.min.css') }}" />
    <!--Magnify-->
    <script type="text/javascript" src="{{ URL::to('assets/js/jquery.magnific-popup.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ URL::to('assets/css/magnific-popup.css') }}" />
    <!--sweetAlert-->
    <script type="text/javascript" src="{{ URL::to('assets/js/sweetalert.min.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ URL::to('assets/css/sweetalert.css') }}" />

  </head>
  <body>
    <main>
      @include('includes/header')
      @include('includes.info')
      <div class="container">
        @yield('content')
      </div>
    </main>
    @include('includes.footer')
  </body>
</html>
