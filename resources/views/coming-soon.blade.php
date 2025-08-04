<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="Awaiken Theme">
    <!-- Page Title -->
    <title>أصوات جزائرية</title>
    <!-- Google Fonts css-->
    <link href="comingsoon/https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400,700" rel="stylesheet">
    <!-- Bootstrap css -->
    <link href="comingsoon/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <!-- Font Awesome icon css-->
    <link href="comingsoon/css/font-awesome.min.css" rel="stylesheet" media="screen">
    <!-- Main custom css -->
    <link href="comingsoon/css/custom.css" rel="stylesheet" media="screen">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="comingsoon/https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="comingsoon/https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

    <!-- Coming Soon Wrapper starts -->
    <div class="comming-soon">

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="coming-soon-box">
                        <!-- Logo Start -->
                        <div class="logo">
                            <img height="50px" src="comingsoon/images/logo.png" alt="الشعار">
                        </div>
                        <!-- Logo end -->

                        <!-- Types Information start -->
                        <div class="coming-text">
                            <h2><span class="typed-title">"أصوات جزائرية</span></h2>
                            <div class="typing-title">
                                <p>أصوات جزائرية</p>
                                <p>قريبا</p>
                            </div>
                        </div>
                        <!-- Types Information end -->

                        <!-- Countdown start -->
                        <div class="countdown-timer-wrapper">
                            <div class="timer" id="countdown"></div>
                        </div>
                        <!-- Countdown end -->

                        <!-- Newsletter Form start -->
                        <div class="newsletter">
                            <h4>كن في الصورة</h4>

                            <div class="newsletter-form">
                                <form action="#" method="post">
                                    <input type="text" class="new-text" placeholder="أدخل بريدك الإلكتروني..."
                                        required />
                                    <button type="submit" class="new-btn">أبلغني</button>
                                </form>
                            </div>
                        </div>
                        <!-- Newsletter Form end -->

                        <!-- Social Media start -->
                        {{-- <div class="social-link">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>   
                            <a href="#"><i class="fa fa-linkedin"></i></a>
                            <a href="#"><i class="fa fa-pinterest"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                        </div> --}}
                        <!-- Social Media end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Coming Soon Wrapper end -->

    <!-- Jquery Library File -->
    <script src="comingsoon/js/jquery-1.12.4.min.js"></script>
    <!-- Timer counter js file -->
    <script src="comingsoon/js/countdown-timer.js"></script>
    <!-- Typed js file -->
    <script src="comingsoon/js/typed.js"></script>
    <!-- SmoothScroll -->
    <script src="comingsoon/js/SmoothScroll.js"></script>
    <!-- Bootstrap js file -->
    <script src="comingsoon/js/bootstrap.min.js"></script>
    <!-- Main Custom js file -->
    <script src="comingsoon/js/function.js"></script>
    <!-- Timer counter start -->

    <script>
        $(document).ready(function() {
            var myDate = new Date('2025-09-15T00:00:00');
            $("#countdown").countdown(myDate, function(event) {
                $(this).html(
                    event.strftime(
                        '<div class="timer-wrapper"><div class="time">%D</div><span class="text">%!D:يوم;</span></div>' +
                        '<div class="timer-wrapper"><div class="time">%H</div><span class="text">%!H:ساعة;</span></div>' +
                        '<div class="timer-wrapper"><div class="time">%M</div><span class="text">%!M:دقيقة;</span></div>' +
                        '<div class="timer-wrapper"><div class="time">%S</div><span class="text">%!S:ثانية;</span></div>'
                    )
                );
            });
        });
    </script>


</body>

</html>
