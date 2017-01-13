<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ConecTECHC</title>
  
    <!-- Styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ URL::asset('css/style.css') }}"> 
    <!-- Script -->

</head>
<body id="app-layout">
    <nav class="navbar navbar-inverse navbar-static-top">
        <div class="container">
            @if (!Auth::guest())
            <div class="navbar-header col-sm-6 col-md-7 col-lg-8">
            @else
            <div class="navbar-header col-sm-9 col-md-9 col-lg-10">
            @endif
                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                
                <a class="navbar-brand" style="padding:0" href="{{ url('/timeline') }}"><img src="{{ url('/img/logo.png')}}"></a>
                @if (Auth::guest())
                <a class="navbar-brand font_si" href="{{ url('/') }}">
                @else
                <a class="navbar-brand font_si" href="{{ url('/timeline') }}">
                @endif
                    ConecTECH  
                </a>
            </div>
            
            @if (!Auth::guest())
            <div class="collapse navbar-collapse col-sm-6 col-md-5 col-lg-4" id="app-navbar-collapse"　id="myNavbar">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li {{{ (Request::is('profile') ? 'class=active' : '') }}}><a href="{{ url('/profile') }}">プロフィール</a></li>
                    <li {{{ (Request::is('timeline') ? 'class=active' : '') }}}><a href="{{ url('/timeline') }}">TL</a></li>
                    <li {{{ (Request::is('blog') ? 'class=active' : '') }}}><a href="{{ url('/article/' . Auth::user()->username) }}">ブログ</a></li>
                </ul>
            @else
                <div class="collapse navbar-collapse col-sm-3 col-md-3 col-lg-2" id="app-navbar-collapse"　id="myNavbar">
            @endif
                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                  <li><a href="{{ url('/login') }}"><span class="glyphicon glyphicon-user">ログイン</span></a></li>
                  <li><a href="{{ url('/register') }}"><span class="glyphicon glyphicon-log-in"> 登録</span></a></li>
                    @else
                        <ul class="nav navbar-nav navbar-right hide">
                          <li style="transform: translateY(50%);display:flex">
                            <input name="" type="text" value=""/>
                            <div class="serch_icon" style="background: white;width: 22px;border-radius: 0px 5px 5px 0px;text-align: center;">
                              <span style="transform: translateY(20%);" class="glyphicon glyphicon-search"></span>
                            </div>
                          </li>
                        </ul>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->username }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/profile/edit') }}">編集</a></li>
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>ログアウト</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    @yield('content')
    <div id="gradient"></div>
    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <!--{{-- <script src="{{ elixir('js/app.js') }}"></script> --}}-->
    
</body>
</html>
