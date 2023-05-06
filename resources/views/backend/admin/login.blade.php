<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>

<head>
    <title>Admin - Electro</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <script type="application/x-javascript">
        addEventListener("load", function() {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <!-- bootstrap-css -->
    <link rel="stylesheet" href="{{asset('public/backend/web/css/bootstrap.min.css')}}">
    <!-- //bootstrap-css -->
    <!-- Custom CSS -->
    <link href="{{asset('public/backend/web/css/style.css')}}" rel='stylesheet' type='text/css' />
    <link href="{{asset('public/backend/web/css/style-responsive.css')}}" rel="stylesheet" />
    <!-- font CSS -->
    <link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <!-- font-awesome icons -->
    <link rel="stylesheet" href="{{asset('public/backend/web/css/font.css')}}" type="text/css" />
    <link href="{{asset('public/backend/web/css/font-awesome.css')}}" rel="stylesheet" />
    <!-- //font-awesome icons -->
    <script src="{{asset('public/backend/web/js/jquery2.0.3.min.js')}}"></script>
</head>

<body>
    <div class="log-w3">
        <div class="w3layouts-main">
            <h2>Sign In</h2>
            <?php
            $message = Session::get('message');
            if ($message) {
                echo '<span class="" style="color:red; display:block;width:100%;">' . $message . '</span>';
                Session::put('message', null);
            }
            ?>
            <form action="{{URL::to('/admin-dashboard')}}" method="POST">
                {{ csrf_field() }}
                <input type="email" class="ggg" name="user_email" placeholder="Email" required>
                <input type="password" class="ggg" name="user_password" placeholder="Password" required>
                <span><input type="checkbox" class="" style="margin-right: 4px;" />Remember Me</span>
                <h6><a href="#">Forgot Password?</a></h6>
                <div class="clearfix"></div>
                <input type="submit" value="Sign In" name="login">
            </form>
            <!-- <p>Don't Have an Account ?<a href="registration.html">Create an account</a></p> -->
        </div>
    </div>
    <script src="{{asset('public/backend/web/js/bootstrap.js')}}"></script>
    <script src="{{asset('public/backend/web/js/jquery.dcjqaccordion.2.7.js')}}"></script>
    <script src="{{asset('public/backend/web/js/scripts.js')}}"></script>
    <script src="{{asset('public/backend/web/js/jquery.slimscroll.js')}}"></script>
    <script src="{{asset('public/backend/web/js/jquery.nicescroll.js')}}"></script>
    <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
    <script src="{{asset('public/backend/web/js/jquery.scrollTo.js')}}"></script>
</body>

</html>