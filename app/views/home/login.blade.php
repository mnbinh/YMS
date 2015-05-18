<!DOCTYPE html>
<html class="bg-black">
    <head>
        <meta charset="UTF-8">
        <title>Demo Auth | Log in</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="../../css/AdminLTE.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="bg-black">

        <div class="form-box" id="login-box">
            <div class="header bg-red">Log In</div>
            <form action="{{{ URL::to('/users/login') }}}" method="post" accept-charset="UTF-8">
              <input type="hidden" name="_token" value="{{{ Session::getToken() }}}">
                <div class="body bg-gray">
                    <div class="form-group">
                        <input type="text" name="email" id="email" class="form-control" placeholder="Email or Username"
                         {{Confide::user() ? 'value="'.Confide::user()->username.'"' : 'value=""'   }}/>
                    </div>
                    <div class="form-group">
                        <input id="password" type="password" name="password" class="form-control" placeholder="Password"/>
                    </div>
                    <p class="">{{Session::has('error') ? Session::get('error') : ''}}</p>
                    <div class="form-group">
                        <input type="checkbox" name="remember" id="remember"/> Ghi nhớ
                    </div>
                </div>
                <div class="footer">
                    <button type="submit" class="btn bg-red btn-block ">Đăng Nhập</button>

                    <p><a href="#">Quên mật khẩu </a></p>

                    {{--<a href="register.html" class="text-center">Register a new membership</a>--}}
                </div>
            </form>

            <div class="margin text-center">
                <span>Đăng Nhập bằng tài khoản google</span>
                <br/>

                <a class="btn bg-red btn-circle" href="{{{ URL::to('/gauth') }}}"><i class="fa fa-google-plus"></i></a>

            </div>
        </div>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js" type="text/javascript"></script>

    </body>
</html>
