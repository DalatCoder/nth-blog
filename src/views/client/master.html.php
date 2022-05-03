<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title><?= $website_name . ($page_title ? ' | ' . $page_title : '') ?></title>
    
    <link rel="icon" type="image/x-icon" href="/static/sblog/assets/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="/static/sblog/vendor/fontawesome/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="/static/sblog/font/lora.css" rel="stylesheet" type="text/css" />
    <link href="/static/sblog/font/open-sans.css" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="/static/sblog/css/styles.css" rel="stylesheet" />
    
    {% yield custom_styles %}
</head>
<body>
<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="/"><?= $website_name ?></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ms-auto py-4 py-lg-0">
                <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="/">Trang chú</a></li>
                <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="/about">Giới thiệu</a></li>
                <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="/contact">Liên hệ</a></li>
            </ul>
        </div>
    </div>
</nav>
<!-- Page Header-->
<header class="masthead" style="background-image: url('/static/sblog/assets/img/home-bg.jpg')">
    <div class="container position-relative px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="site-heading">
                    <h1><?= empty($page_title) ? $website_name : $page_title ?></h1>
                    <span class="subheading"><?= empty($page_sub_title) ? '' : $page_sub_title ?></span>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Main Content-->
<div class="container px-4 px-lg-5">
    {% yield inner_content %}
</div>

{% yield outer_content %}

<!-- Footer-->
<footer class="border-top mt-5">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <ul class="list-inline text-center">
                    <li class="list-inline-item">
                        <a href="#">
                                    <span class="fa-stack fa-lg">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fab fa-twitter fa-stack-1x fa-inverse"></i>
                                    </span>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="https://www.facebook.com/dalatcoder" target="_blank">
                                    <span class="fa-stack fa-lg">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fab fa-facebook-f fa-stack-1x fa-inverse"></i>
                                    </span>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="https://github.com/DalatCoder" target="_blank">
                                    <span class="fa-stack fa-lg">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fab fa-github fa-stack-1x fa-inverse"></i>
                                    </span>
                        </a>
                    </li>
                </ul>
                <div class="small text-center text-muted fst-italic">Copyright &copy; <?= $website_name ?> <?= date('Y') ?></div>
            </div>
        </div>
    </div>
</footer>
<!-- Bootstrap core JS-->
<script src="/static/sblog/vendor/bootstrap/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="/static/sblog/js/scripts.js"></script>

{% yield custom_scripts %}
</body>
</html>
