<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{('./public/frontend/electro-master/css/up_in.css')}}" />
    <title>Đăng Ký - Electro</title>
</head>

<body>
    <div class="container sign-up-mode">
        <div class="forms-container">
            <div class="signin-signup">
                <!-- <form action="#" class="sign-in-form">
                    <h2 class="title">Sign in</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="Username" />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="Password" />
                    </div>
                    <input type="submit" value="Login" class="btn solid" />
                    <p class="social-text">Or Sign in with social platforms</p>
                    <div class="social-media">
                        <a href="#" class="social-icon">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-google"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </form> -->
                <form role="form" action="{{URL::to('/user-sign-up')}}" method="POST">
                    <h2 class="title">Đăng ký</h2>
                    <?php
                    $message = Session::get('message');
                    if ($message) {
                        echo '<span class="" style="color:red; display:block;width:100%;">' . $message . '</span>';
                        Session::put('message', null);
                    }
                    ?>
                    {{ csrf_field() }}
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" name="user_name" placeholder="Tên đầy đủ" required />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-envelope"></i>
                        <input type="email" name="user_email" placeholder="Email" required />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-map-marker-alt"></i>
                        <input type="text" name="user_address" placeholder="Địa chỉ" required />
                    </div>
                    <!-- <div class="input-field" style="display:none;">
                        <i class="fas fa-lock"></i>
                        <input type="text" name="user_role" placeholder="Role id" required />
                    </div> -->
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="user_password" placeholder="Mật khẩu" required />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="user_cpassword" placeholder="Xác nhận mật khẩu" required />
                    </div>
                    <button type="submit" name="user_sign_up" class="btn">Đăng ký</button>
                    <!-- <p class="social-text">Or Sign up with social platforms</p>
                    <div class="social-media">
                        <a href="#" class="social-icon">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-google"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div> -->
                </form>
            </div>
        </div>

        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>New here ?</h3>
                    <p>
                        If you already have an account, sign in right now?
                    </p>
                    <button class="btn transparent" id="sign-up-btn">
                        Sign up
                    </button>
                </div>
                <img src="img/log.svg" class="image" alt="" />
            </div>
            <div class="panel right-panel">
                <div class="content">
                    <h3>One of us ?</h3>
                    <p>
                        Nếu bạn đã có tài khoản, đăng nhập ngay?
                    </p>
                    <a href="{{URL::to('/user-login')}}" class="btn-link transparent" id="sign-in-btn">
                        Đăng nhập
                    </a>
                </div>
                <img src="img/register.svg" class="image" alt="" />
            </div>
        </div>
    </div>

    <!-- <script>
        const sign_in_btn = document.querySelector("#sign-in-btn");
        const sign_up_btn = document.querySelector("#sign-up-btn");
        const container = document.querySelector(".container");

        sign_up_btn.addEventListener('click', () => {
            container.classList.add("sign-up-mode");
        });

        sign_in_btn.addEventListener('click', () => {
            container.classList.remove("sign-up-mode");
        });
    </script> -->
</body>

</html>