<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập - Electro</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('public/frontend/electro-master/css/login.css')}}">
</head>

<body>
    <div class="login-card">
        <div class="column">
            <h1>Login</h1>
            <p>After logining in, you can enjoy the privileges.</p>
            <?php
            $message = Session::get('message');
            if ($message) {
                echo '<span class="" style="color:red; display:block;width:100%;">' . $message . '</span>';
                Session::put('message', null);
            }
            ?>
            <form action="{{URL::to('/user-dashboard')}}" method="post">
                {{ csrf_field() }}
                <div class="form-item">
                    <input type="text" name="user_email" class="form-element" placeholder="Username or Email" required>
                </div>
                <div class="form-item">
                    <input type="password" name="user_password" class="form-element" placeholder="Password" required>
                </div>
                <div class="form-checkbox-item">
                    <input type="checkbox" id="rememberMe">
                    <label for="rememberMe">Remember Me</label>
                </div>
                <div class="flex">
                    <button type="submit">Sign In</button>
                    @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                    @endif
                </div>
                <p style="margin-top:3rem; margin-bottom:1.5rem;">Other sign-in methods</p>
                <div class="socials-button">
                    <a href="{{URL::to('/login-facebook/facebook')}}" class="facebook">
                        <i class="bi bi-facebook"></i>
                    </a>
                    <a href="#" class="twitter">
                        <i class="bi bi-twitter"></i>
                    </a>
                    <a href="#" class="github">
                        <i class="bi bi-github"></i>
                    </a>
                </div>
            </form>
        </div>
        <div class="column">
            <h2>Welcome to Electro</h2>
            <p>If you don't have an account, would you like to register right now?</p>
            <a href="/DATN_ELaravel/sign-up">Sign Up</a>
        </div>
    </div>


</body>

</html>