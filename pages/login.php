<!DOCTYPE html>
<?php require_once("../config/function.php")?>

<html lang="en" class="dark-style layout-navbar-fixed layout-menu-100vh layout-menu-fixed" dir="ltr"
    data-theme="theme-default" data-assets-path="/sneat/assets/" data-template="vertical-menu-template-starter">

<?php
if ($LTT->site("auth_otp") == "ON"){
    if (isset($_SESSION['username'])){
        if ($LTT ->getUsers("status_account") == "wait"){
            $email = $LTT -> getUsers("email");
            header("Location: /Auth-OTP?email=".$email);
        }
    }
}else{
    if (isset($_SESSION['username'])){
        header("Location: /home");
    }
}

$text = getCurURL();
$check_url = (explode('/', $text));
$url_name = strtoupper($check_url['3']);
?>

<head>
    <style>
    .dark .preloader .preloader-icon {
        border-color: #06163a;
        border-top-color: #3252f0
    }

    .preloader {
        position: fixed;
        right: 0;
        left: 0;
        top: 0;
        bottom: 0;
        z-index: 9999;

        background-color: #<?php if ($LTT->site('color_web')=="dark") {
            echo "232e3b";
        }

        else {
            echo "fff";
        }

        ?>;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 15px
    }

    .preloader span {
        text-transform: uppercase;
        font-size: 12px;
        letter-spacing: 2px;
        margin-top: 15px
    }

    .preloader .preloader-icon {
        border: 5px solid #f4f4f4;
        border-radius: 50%;
        border-top: 5px solid #546de5;
        border-bottom: 5px solid #FFBF00;
        border-left: 5px solid #00FF00;
        border-right: 5px solid #FF0000;
        width: 100px;
        height: 100px;
        margin-left: 10px;
        animation: spin 0.5s linear infinite
    }

    @keyframes spin {
        0% {
            transform: rotate(0)
        }

        100% {
            transform: rotate(360deg)
        }
    }

    .preloader svg path {
        fill: #546de5
    }

    .dark .preloader {
        background-color: #353b48
    }

    .dark .preloader .preloader-icon {
        border-color: #353b48;
        border-top-color: #546de5
    }

    .preloader img {
        width: 140px
    }

    .preloader .preloader-icon {
        width: 95px;
        height: 95px
    }
    </style>
    <?php require_once("../config/head.php")?>
</head>
<div class="preloader">
    <div class="preloader-icon"></div>
</div>
<script>
$('body').load(
    $('.preloader').fadeOut(1000)
);
</script>
<div class="preloader">
    <div class="preloader-icon"></div>
</div>

<head>
    <title><?php 
    if ($url_name == "LOGIN"){ 
        echo "Đăng nhập tài khoản";
    } else if ($url_name == "REGISTER"){
        echo "Đăng kí tài khoản";
    } else if ($url_name == "AUTH-OTP"){
        echo "Xác thực OTP";
    } else if ($url_name == "FORGOT-PASSWORD"){
        echo "Quên Mật Khẩu";
    } else if ($url_name == "CHANGE-PASWORD"){
        echo "Khôi phục mật khẩu";
    } else if ($url_name == "ACTIVE"){
        echo "Kích hoạt website";
    } else {
        echo "";
    } ?>
    </title>
    <style>
    .table th {
        text-transform: none !important;
        font-size: 14px !important;
    }

    .table> :not(caption)>*>* {
        padding: 5px 10px !important;
    }

    .badge {
        text-transform: none !important;
        padding: 0.5rem 0.5rem !important;
    }

    .table td {
        font-size: 14px !important;
    }

    #swal2-title,
    #swal2-html-container {
        font-weight: 600 !important;
    }
    </style>

<body>
    <div class="authentication-wrapper authentication-cover">
        <div class="authentication-inner row m-0">
            <div class="d-none d-lg-flex col-lg-7 col-xl-8 align-items-center p-5">
                <div class="w-100 d-flex justify-content-center">
                    <img src='/sneat/assets/img/illustrations/<?php if ($url_name == "LOGIN"){ echo "boy-with-rocket-dark.png"; }else{ echo"girl-with-laptop-dark.png"; }?>'
                        class="img-fluid" alt="Login image" width="700"
                        data-app-dark-img="illustrations/<?php if ($url_name == "LOGIN"){ echo "boy-with-rocket-dark.png"; }else{ echo"girl-with-laptop-dark.png"; }?>"
                        data-app-light-img='illustrations/<?php if ($url_name == "LOGIN"){ echo "boy-with-rocket-dark.png"; }else{ echo"girl-with-laptop-dark.png"; }?>'>
                </div>
            </div>
            <div class="d-flex col-12 col-lg-5 col-xl-4 align-items-center authentication-bg p-sm-5 p-4">
                <div class="w-px-400 mx-auto">

                    <div class="app-brand mb-5">
                        <a href="/home" class="app-brand-link gap-2">
                            <span class="app-brand-logo demo">
                                <svg width="25" viewBox="0 0 25 42" version="1.1" xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <defs>
                                        <path
                                            d="M13.7918663,0.358365126 L3.39788168,7.44174259 C0.566865006,9.69408886 -0.379795268,12.4788597 0.557900856,15.7960551 C0.68998853,16.2305145 1.09562888,17.7872135 3.12357076,19.2293357 C3.8146334,19.7207684 5.32369333,20.3834223 7.65075054,21.2172976 L7.59773219,21.2525164 L2.63468769,24.5493413 C0.445452254,26.3002124 0.0884951797,28.5083815 1.56381646,31.1738486 C2.83770406,32.8170431 5.20850219,33.2640127 7.09180128,32.5391577 C8.347334,32.0559211 11.4559176,30.0011079 16.4175519,26.3747182 C18.0338572,24.4997857 18.6973423,22.4544883 18.4080071,20.2388261 C17.963753,17.5346866 16.1776345,15.5799961 13.0496516,14.3747546 L10.9194936,13.4715819 L18.6192054,7.984237 L13.7918663,0.358365126 Z"
                                            id="path-1"></path>
                                        <path
                                            d="M5.47320593,6.00457225 C4.05321814,8.216144 4.36334763,10.0722806 6.40359441,11.5729822 C8.61520715,12.571656 10.0999176,13.2171421 10.8577257,13.5094407 L15.5088241,14.433041 L18.6192054,7.984237 C15.5364148,3.11535317 13.9273018,0.573395879 13.7918663,0.358365126 C13.5790555,0.511491653 10.8061687,2.3935607 5.47320593,6.00457225 Z"
                                            id="path-3"></path>
                                        <path
                                            d="M7.50063644,21.2294429 L12.3234468,23.3159332 C14.1688022,24.7579751 14.397098,26.4880487 13.008334,28.506154 C11.6195701,30.5242593 10.3099883,31.790241 9.07958868,32.3040991 C5.78142938,33.4346997 4.13234973,34 4.13234973,34 C4.13234973,34 2.75489982,33.0538207 2.37032616e-14,31.1614621 C-0.55822714,27.8186216 -0.55822714,26.0572515 -4.05231404e-15,25.8773518 C0.83734071,25.6075023 2.77988457,22.8248993 3.3049379,22.52991 C3.65497346,22.3332504 5.05353963,21.8997614 7.50063644,21.2294429 Z"
                                            id="path-4"></path>
                                        <path
                                            d="M20.6,7.13333333 L25.6,13.8 C26.2627417,14.6836556 26.0836556,15.9372583 25.2,16.6 C24.8538077,16.8596443 24.4327404,17 24,17 L14,17 C12.8954305,17 12,16.1045695 12,15 C12,14.5672596 12.1403557,14.1461923 12.4,13.8 L17.4,7.13333333 C18.0627417,6.24967773 19.3163444,6.07059163 20.2,6.73333333 C20.3516113,6.84704183 20.4862915,6.981722 20.6,7.13333333 Z"
                                            id="path-5"></path>
                                    </defs>
                                    <g id="g-app-brand" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <g id="Brand-Logo" transform="translate(-27.000000, -15.000000)">
                                            <g id="Icon" transform="translate(27.000000, 15.000000)">
                                                <g id="Mask" transform="translate(0.000000, 8.000000)">
                                                    <mask id="mask-2" fill="white">
                                                        <use xlink:href="#path-1"></use>
                                                    </mask>
                                                    <use fill="#696cff" xlink:href="#path-1"></use>
                                                    <g id="Path-3" mask="url(#mask-2)">
                                                        <use fill="#696cff" xlink:href="#path-3"></use>
                                                        <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-3">
                                                        </use>
                                                    </g>
                                                    <g id="Path-4" mask="url(#mask-2)">
                                                        <use fill="#696cff" xlink:href="#path-4"></use>
                                                        <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-4">
                                                        </use>
                                                    </g>
                                                </g>
                                                <g id="Triangle"
                                                    transform="translate(19.000000, 11.000000) rotate(-300.000000) translate(-19.000000, -11.000000) ">
                                                    <use fill="#696cff" xlink:href="#path-5"></use>
                                                    <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-5"></use>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                            </span>
                            <span class="app-brand-text demo text-body fw-bolder"><?=$LTT->site("ten_website");?></span>
                        </a>
                    </div>

                    <h4 class="mb-2">Đăng nhập tài khoản 🚀</h4>
                    <p class="mb-4">Xin mời nhập thông tin !</p>
                    <?php if ($url_name == "LOGIN") { ?>
                    <form submit-ajax="LTT" method="post" action="<?= BASE_URL('api/account/login'); ?>" class="mb-5">
                        <o id="callback"></o>
                        <input type="hidden" name="_token"
                            value="EAAGNO4a7r2wBACZCsE13XcejbEqLa6Oia7ndpaKLBmAbwBYUDLL6thCRh9OzP">

                        <div class="mb-3">
                            <label for="" class="form-label">Tài khoản</label>
                            <input type="text" class="form-control" name="username" value=""
                                placeholder="Nhập tài khoản">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Mật khẩu</label>
                            <input type="password" class="form-control" name="password" value=""
                                placeholder="Nhập mật khẩu">
                        </div>

                        <div class="row">
                            <div class="col-7">
                                <div class="custom-control custom-checkbox mb-3 text-left"></div>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="terms-conditions" name="terms" />
                                Ghi nhớ.
                            </div><br><br>
                            <div class="col-5">
                                <div class="forgot-password"><a class="custom-control-label"
                                        href="/Forgot-Password">Quên mật khẩu ?</a></div>
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button class="btn btn-primary btn-block" type="submit">Đăng
                                nhập</button>
                    </form>
                    <p class="text-center pt-3">
                        <span>Bạn chưa có tài khoản?</span>
                        <a href="/Register">
                            <span>Đăng kí</span>
                        </a>.
                    </p>

                </div>
            </div>

        </div>
    </div>
    <?php } else if ($url_name == "REGISTER") { ?>

    <form submit-ajax="LTT" method="post"
        href='<?php if ($LTT->site("auth_otp") == "ON"){ echo "/home";}else{echo "/home";}?>'
        action="<?=BASE_URL('api/account/register'); ?>" api_token="<?=$LTT -> site ("token")?>" href="/Login"
        class="mb-5">
        <o id="callback"></o>
        <input type="hidden" name="_token" value="9jILCFLdUiKHj5NIvPwKO98dWO5obzeL3msiDKcQ">
        <div class="mb-3">
            <label for="" class="form-label">Họ và tên</label>
            <input type="text" class="form-control" name="name" value="" placeholder="Nhập họ và tên">
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" value="" placeholder="Nhập địa chỉ email">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Tài khoản</label>
            <input type="text" class="form-control" name="username" value="" placeholder="Nhập tài khoản">
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Mật khẩu</label>
            <input type="password" class="form-control" name="password" value="" placeholder="Nhập mật khẩu"
                id="password">
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" onclick="showPass()" id="terms-conditions" name="terms" />
            Hiện mật khẩu
        </div><br>
        <div class="d-grid gap-2">
            <button class="btn btn-primary btn-block" type="submit">Đăng
                kí</button>
        </div>
    </form>

    <p class="text-center pt-3">
        <span>Bạn đã có tài khoản?</span>
        <a href="/Login">
            <span>đăng nhập</span>
        </a>.
    </p>

    </div>
    </div>

    </div>
    </div>
    <?php } else if (strpos($url_name, "AUTH-OTP") !== false){?>
    <form submit-ajax="LTT" method="post" action="<?= BASE_URL('api/account/otp'); ?>"
        api_token="<?=$LTT -> site ("token")?>" href="/home" class="mb-5">
        <o id="callback"></o>
        <input type="hidden" name="_token" value="9jILCFLdUiKHj5NIvPwKO98dWO5obzeL3msiDKcQ">
        <div class="mb-3">
            <h4>Chúng tôi đã gửi mã OTP tới email <?=$_GET['email']?></h4>
            <input type="hidden" class="form-control" name="email" value="<?=$_GET['email']?>" placeholder="">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Mã OTP</label>
            <input type="text" class="form-control" name="otp" maxlength='6' size="6"
                value='<?php if (isset($_GET["code"])){ echo $_GET["code"];} else {echo "";}?>' placeholder="******">
        </div>
        <div class="d-grid gap-2">
            <button class="btn btn-primary btn-block" type="submit">Xác thực</button>
        </div>
    </form>

    <p class="text-center pt-3">
        <span>Bạn đã có tài khoản?</span>
        <a href="/Login">
            <span>Đăng nhập</span>
        </a>.
    </p>

    </div>
    </div>

    </div>
    </div>
    <?php } else if (strpos($url_name, "FORGOT-PASSWORD") !== false){?>
    <form submit-ajax="LTT" method="post" action="<?= BASE_URL('api/account/forgot-password'); ?>" class="mb-5">
        <o id="callback"></o>
        <input type="hidden" name="_token" value="EAAGNO4a7r2wBACZCsE13XcejbEqLa6Oia7ndpaKLBmAbwBYUDLL6thCRh9OzP">
        <input type="hidden" name="action" value="get_otp">
        <div class="mb-3">
            <label for="" class="form-label">Email</label>
            <input type="text" class="form-control" name="email" value="" placeholder="Nhập email của bạn">
        </div>
        <div class="d-grid gap-2">
            <button class="btn btn-primary btn-block" type="submit">Lấy mã xác minh</button>
        </div>
    </form>

    <p class="text-center pt-3">
        <span>Bạn đã có tài khoản?</span>
        <a href="/Login">
            <span>đăng nhập</span>
        </a>.
    </p>

    </div>
    </div>

    </div>
    </div>
    <?php } else if (strpos($url_name, "CHANGE-PASSWORD") !== false){?>
    <form submit-ajax="LTT" method="post" action="<?= BASE_URL('api/account/forgot-password'); ?>" class="mb-5">
        <o id="callback"></o>
        <input type="hidden" name="_token" value="EAAGNO4a7r2wBACZCsE13XcejbEqLa6Oia7ndpaKLBmAbwBYUDLL6thCRh9OzP">
        <input type="hidden" name="action" value="change_pass">
        <div class="mb-3">
            <label for="" class="form-label">Mã OTP đã gửi tới email: <?=$_GET['email']?></label>
            <input type="hidden" class="form-control" name="email" value="<?=$_GET['email']?>"
                placeholder="Nhập email của bạn">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Mã OTP</label>
            <input type="text" class="form-control" name="otp" value="" placeholder="Nhập mã OTP được gửi tới email">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Mật khẩu mới</label>
            <input type="password" class="form-control" name="password" value="" placeholder="******" id="password">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Nhập lại khẩu mới</label>
            <input type="password" class="form-control" name="repassword" value="" placeholder="******" id="repassword">
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" onclick="showPass()" id="terms-conditions" name="terms" />
            Hiện mật khẩu
        </div><br>
        <div class="d-grid gap-2">
            <button class="btn btn-primary btn-block" type="submit">Xác nhận</button>
        </div>
    </form>

    <p class="text-center pt-3">
        <span>Bạn đã có tài khoản?</span>
        <a href="/Login">
            <span>đăng nhập</span>
        </a>.
    </p>

    </div>
    </div>

    </div>
    </div>
    <?php } ?>
    <?php require_once("../config/scr.php"); ?>
    <?php require_once("../config/end.php"); ?>
    <script>
    $('body').load(
        $('.preloader').fadeOut(750)
    );
    </script>
    <script>
    function showPass() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
        try{
            var y = document.getElementById("repassword");
            if (y.type === "password") {
                y.type = "text";
            } else {
                y.type = "password";
            }
        } catch (err) {
            
        }
    }
    </script>
</body>

</html>