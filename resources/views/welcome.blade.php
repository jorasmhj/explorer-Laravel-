<?php
if(Auth::user()){
    'ok';   
}else{
    'no';
}
?>
<!DOCTYPE html>
<html lang="en" style="overflow-x:hidden">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="theme-color" content="#2ca398" />
  <meta name="description" content="">
  <meta name="author" content="">
	<title>Explorer</title>
  <link rel="icon" type="image/png" href="{{ URL::to('assets/images/explore.png') }}" />
  <link rel="stylesheet" type="text/css" href="assets/css/jquery-ui.css" />
  <script type="text/javascript" src="assets/js/jquery.js"></script>
  <script src="{{ URL::to('assets/js/jquery-ui.js') }}"></script>
  <script type="text/javascript" src="{{ URL::to('assets/js/bootstrap.js') }}"></script>
  <script type="text/javascript" src="{{ URL::to('assets/js/main.js') }}"></script>
  <link rel="stylesheet" type="text/css" href="{{ URL::to('assets/css/bootstrap.css') }}" />
  <link rel="stylesheet" type="text/css" href="{{ URL::to('assets/css/style.css') }}" />
  <link rel="stylesheet" type="text/css" href="{{ URL::to('assets/css/animate.css') }}" />
  <link href='http://fonts.googleapis.com/css?family=Inder' rel='stylesheet' type='text/css' />
  <link rel="stylesheet" type="text/css" href="{{ URL::to('assets/font-awesome/css/font-awesome.css') }}" />
  <!-- Important Owl stylesheet -->
  <link rel="stylesheet" href="{{ URL::to('assets/owl-carousel/owl.carousel.css') }}" >
  <!-- Default Theme -->
  <link rel="stylesheet" href="{{ URL::to('assets/owl-carousel/owl.theme.css') }}">
  <!-- Include js plugin -->
  <script src="{{ URL::to('assets/owl-carousel/owl.carousel.js') }}"></script>
  <!--sweetAlert-->
    <script type="text/javascript" src="{{ URL::to('assets/js/sweetalert.min.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ URL::to('assets/css/sweetalert.css') }}" />
</head>
<body class='welcome-body'>
  <div class="main">
    <login>
    <div class="login-background">
      <div class='login-main'>
       @include('includes.info')
        @if(count($errors))
          @foreach($errors->all() as $error)
            {{ $error }}
          @endforeach
        @endif
        <button class="primary_button signup">Sign Up</button>
      	<div class="login-form container">
      		<div class="login-input">
            <div class="text-center">
             @if(@Session::has('user'))
               <img src="{{ URL::to('uploads/avatars') }}/{{ @Session::get('user')->avatar }}" alt="" />
             @else
               <img src="{{ URL::to('assets/images/default_pro_pic.jpg') }}" alt="" />
             @endif
              
            </div>
            <div class="text-center"><a class="another-user" style="display:none" href="#">Login as another user.</a> </div>
            <form action="{{ route('login') }}" method="POST">
                <input type="text" required placeholder="Username"  autocomplete="off" id='login_username' value="{{ @Session::get('user')->username }}" name="username" onkeydown="hide_err('.usr_err');" class="form-control {{ @Session::has('user') ? 'hidden' : '' }}">
                <span class="usr_err"></span>
                <div class="input-password">
                    <input type="password" placeholder="Password" id="login_password" required name="password" onkeydown="hide_err('.pwd_err');" class="form-control">
                    <i class="fa fa-eye show-password" aria-hidden="true"></i>
                    <span class="pwd_err"></span><br>    
                </div>
                
                
                <input type="checkbox" id="c3" name="cc" />
                <!--<label for="c3" style="color:%fff;"><span></span>Keep me logged in.</label><br>-->
                <input type="hidden" name="_token" value="{{ Session::token() }}">
                <div class="text-center">
                    <button type="submit" class='login'>Login <i class="fa fa-unlock-alt"></i></button> <!--onclick="validate_login()"-->
                    <br>
                    Forgot password?
                </div>
            </form>
            <!-- Don't have an account? <button class="signup simple">Sign Up</button>-->
      		</div>
      	</div>
      </div>
    </div>

  </login>


  <signup>
      <div class="login-background">
        <div class='login-main'>
          <button class="primary_button signin">Login</button>
          <div class="login-form">
            <div class="text-center">
              <h4>Sign Up! Lets Have Fun Together!</h4>
            </div>
            <div class="signup-input">
              <form action="{{ route('signup') }}" method="POST" class="signup-form">
                <input type="text" autocomplete="off" placeholder="Firstname" id='signup_fname' style="width:48%;float:left;margin-right:10px" required name='fname'  value="" class="form-control">
                <input type="text" style="width:48%" autocomplete="off" placeholder="Last name" id='signup_lname' required name='lname' value="" class="form-control">
                <input type="email" autocomplete="off" placeholder="Your Email" required id='signup_email' name='email' value="" onkeydown="hide_err('#signup_email_err');" class="form-control"><span id="signup_email_err"></span>
                <input type="text" placeholder="Username" id="signup_username" class="form-control" required name='username' value="" autocomplete="off" onkeydown="hide_err('#signup_username_err');"><span id="signup_username_err"></span>
                <input type="password" placeholder="Password" class="form-control" id="signup_password" required name='password' onkeydown="hide_err('#signup_password_err');"><span id="signup_password_err"></span>
                <input type="hidden" name="_token" value="{{ Session::token() }}">
                <div class="text-center">
                  <button type="submit"  class='login'>Sign Up</button>
                </div>
              </form>
              Have an account? <button class="signin simple" >Sign In.</button>
            </div>
          </div>
        </div>
    </div>
  </signup>
</div>
  <div class="footer"></div>
  <script type="text/javascript">
    $(window).load(function(){
      query=$('.loader').fadeOut(1000);
      $.when(query).done(function(){
        $('.main').show('slide',500);
      })
    })
  </script>
</body>
</html>