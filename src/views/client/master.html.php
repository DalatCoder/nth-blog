<!DOCTYPE HTML>

<html lang="vi">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <meta charset="utf-8">

    <!-- Description, Keywords and Author -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $website_name . ($page_title ? ' | ' . $page_title : '') ?></title>
    <link rel="shortcut icon" href="/static/avana/images/favicon.ico" type="image/x-icon">

    <!-- bootstrap -->
    <link href="/static/avana/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <!-- responsive -->
    <link href="/static/avana/css/responsive.css" rel="stylesheet" type="text/css">
    <!-- font-awesome -->
    <link href="/static/avana/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- font-awesome -->
    <link href="/static/avana/css/effects/set2.css" rel="stylesheet" type="text/css">
    <link href="/static/avana/css/effects/normalize.css" rel="stylesheet" type="text/css">
    <link href="/static/avana/css/effects/component.css" rel="stylesheet" type="text/css">

    <!-- style -->
    <link href="/static/avana/css/style.css" rel="stylesheet" type="text/css">
    <!-- style -->
    
    {% yield custom_styles %}
</head>

<body>
<!-- header -->
<header role="header">
    <div class="container">
        <!-- logo -->
        <h1>
            <a href="/" title="<?= $website_name ?>"><img src="/static/avana/images/logo.png" alt="<?= $website_name ?>"/></a>
        </h1>
        <!-- logo -->
        <!-- nav -->
        <nav role="header-nav" class="navy">
            <ul>
                <li class="<?= $route == '/' ? 'nav-active': '' ?>"><a href="/" title="Work">Work</a></li>
                <li class="<?= $route == '/about' ? 'nav-active': '' ?>"><a href="/about" title="About">About</a></li>
                <li class="<?= strpos($route, '/blog') !== false ? 'nav-active': '' ?>"><a href="/blog" title="Blog">Blog</a></li>
                <li class="<?= $route == '/contact' ? 'nav-active': '' ?>"><a href="/contact" title="Contact">Contact</a></li>
            </ul>
        </nav>
        <!-- nav -->
    </div>
</header>
<!-- header -->

<!-- main -->
<main role="main-home-wrapper" class="container">
    {% yield content %}
</main>
<!-- main -->

<!-- footer -->
<footer role="footer">
    <!-- logo -->
    <h1>
        <a href="/" title="<?= $website_name ?>"><img src="/static/avana/images/logo.png" alt="<?= $website_name ?>"/></a>
    </h1>
    <!-- logo -->

    <!-- nav -->
    <nav role="footer-nav">
        <ul>
            <li><a href="/" title="Work">Work</a></li>
            <li><a href="/about" title="About">About</a></li>
            <li><a href="/blog" title="Blog">Blog</a></li>
            <li><a href="/contact" title="Contact">Contact</a></li>
        </ul>
    </nav>

    <!-- nav -->
    <ul role="social-icons">
        <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
        <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
        <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
        <li><a href="#"><i class="fa fa-flickr" aria-hidden="true"></i></a></li>
    </ul>

    <p class="copy-right">Shared by <i class="fa fa-love"></i><a href="https://bootstrapthemes.co">BootstrapThemes</a>
    </p>
</footer>
<!-- footer -->

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="/static/avana/js/jquery.min.js" type="text/javascript"></script>
<!-- custom -->
<script src="/static/avana/js/nav.js" type="text/javascript"></script>
<script src="/static/avana/js/custom.js" type="text/javascript"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="/static/avana/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/static/avana/js/effects/masonry.pkgd.min.js" type="text/javascript"></script>
<script src="/static/avana/js/effects/imagesloaded.js" type="text/javascript"></script>
<script src="/static/avana/js/effects/classie.js" type="text/javascript"></script>
<script src="/static/avana/js/effects/AnimOnScroll.js" type="text/javascript"></script>
<script src="/static/avana/js/effects/modernizr.custom.js"></script>
<!-- jquery.countdown -->
<script src="/static/avana/js/html5shiv.js" type="text/javascript"></script>

{% yield custom_scripts %}
</body>

</html>
