<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>

<head>
    <title>Registration - Electro</title>
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
    <link href="{{asset('public/backend/web/css/font-awesome.css')}}" rel="stylesheet">
    <!-- //font-awesome icons -->
    <script src="{{asset('public/backend/web/js/jquery2.0.3.min.js')}}"></script>
</head>

<body>
    <div class="reg-w3">
        <div class="w3layouts-main">
            <h2>Register Now</h2>
            <form action="{{('/register')}}" method="post">
                {{ csrf_field() }}
                <input type="text" class="ggg" name="name" placeholder="Name" required="">
                <input type="email" class="ggg" name="email" placeholder="Email" required="">
                <input type="text" class="ggg" name="phone" placeholder="Phone" required="">
                <input type="password" class="ggg" name="password" placeholder="Password" required="">
                <input type="cpassword" class="ggg" name="cpassword" placeholder="Confirm Password" required="">
                <h4><input type="checkbox" />I agree to the Terms of Service and Privacy Policy</h4>

                <div class="clearfix"></div>
                <input type="submit" value="submit" name="register">
            </form>
            <p>Already Registered.<a href="{{URL::to('/admin-login')}}">Login</a></p>
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