<!DOCTYPE html>
<html lang="ar" dir="rtl" class="js">

<head>

    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="صفحة تسجيل دخول بسيطة وآمنة">
    <link rel="shortcut icon" href="./images/favicon.png">
    <title>تسجيل الدخول</title>
    <link rel="stylesheet" href="../dashlite/assets/css/dashlite.css?ver=3.3.0">
    <link id="skin-default" rel="stylesheet" href="../dashlite/assets/css/theme.css?ver=3.3.0">
    <link rel="icon" type="image/svg+xml" href="{{ asset('user/assets/images/icon-logo.svg') }}" />

    <style>
        :root {
            --primary-color: #52B788;
            --primary-hover: #40916c;
            --input-focus: #d8f3dc;
        }

        .logo-img {
            transition: transform 0.3s ease;
        }

        .logo-img:hover {
            transform: scale(1.05);
        }

        .btn-primary-custom {
            background-color: var(--primary-color);
            color: white;
            transition: all 0.3s ease;
            border: none;
            position: relative;
            overflow: hidden;
        }

        .btn-primary-custom:hover {
            background-color: var(--primary-hover);
            transform: translateY(-2px);
            color: #ffffff;
        }

        .btn-primary-custom:active {
            transform: translateY(0);
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(82, 183, 136, 0.25);
        }

        .password-toggle {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #6c757d;
        }

        .password-toggle:hover {
            color: var(--primary-color);
        }

        .loader {
            display: none;
            width: 20px;
            height: 20px;
            border: 2px solid #f3f3f3;
            border-top: 2px solid var(--primary-color);
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin-right: 10px;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .alert {
            display: none;
            padding: 12px 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        @media (max-width: 576px) {
            .card {
                border: none !important;
                box-shadow: none !important;
            }
        }
    </style>
</head>

<body class="nk-body bg-white npc-general pg-auth">
    <div class="nk-app-root">
        <div class="nk-main">
            <div class="nk-wrap nk-wrap-nosidebar">
                <div class="nk-content">
                    <div class="nk-block nk-block-middle nk-auth-body wide-xs">
                        <div class="brand-logo pb-4 text-center">
                            <a href="#" class="logo-link">
                                <img class="logo-img logo-img-lg" src="../dashlite/images/logo.jpg" alt="الشعار">
                            </a>
                        </div>
                        <div class="card card-bordered">
                            <div class="card-inner card-inner-lg">
                                <div class="nk-block-head">
                                    <div class="nk-block-head-content text-center">
                                        <h4 class="nk-block-title">تسجيل الدخول</h4>
                                        <p class="text-soft">مرحباً بعودتك، يرجى تسجيل الدخول إلى حسابك</p>
                                    </div>
                                </div>

                                <div id="alertBox" class="alert"></div>

                                <form id="loginForm" action="{{ route('dashboard.login') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label class="form-label" for="email">البريد الإلكتروني</label>
                                        <div class="form-control-wrap">
                                            <input type="email" name="email" class="form-control form-control-lg"
                                                id="email" placeholder="أدخل بريدك الإلكتروني" required
                                                value="{{ old('email') }}">
                                        </div>
                                        @error('email')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label" for="password">كلمة المرور</label>
                                        <div class="form-control-wrap position-relative">
                                            <input type="password" name="password" class="form-control form-control-lg"
                                                id="password" placeholder="أدخل كلمة المرور" required>
                                            <span class="password-toggle" id="passwordToggle">
                                                <i class="fa fa-eye"></i>
                                            </span>
                                        </div>
                                        @error('password')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" id="loginButton"
                                            class="btn btn-lg btn-block btn-primary-custom">
                                            <span id="buttonText">دخول</span>
                                        </button>
                                    </div>
                                </form>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../dashlite/assets/js/bundle.js?ver=3.3.0"></script>
    <script src="../dashlite/assets/js/scripts.js?ver=3.3.0"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>

</html>
