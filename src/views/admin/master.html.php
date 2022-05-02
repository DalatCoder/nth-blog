<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $website_name . ($page_title ? ' | ' . $page_title : '') ?></title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/static/admin-lte/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
          href="/static/admin-lte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="/static/admin-lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="/static/admin-lte/plugins/jqvmap/jqvmap.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="/static/admin-lte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="/static/admin-lte/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="/static/admin-lte/plugins/summernote/summernote-bs4.min.css">

    {% yield custom_styles %}

    <!-- Theme style -->
    <link rel="stylesheet" href="/static/admin-lte/dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="/static/admin-lte/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60"
             width="60">
    </div>

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="/" target="_blank" class="nav-link">Blog</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <span class="nav-link">Xin chào, <?= $login_user instanceof \NTHB\Entity\UserEntity ? $login_user->first_name . ' ' . $login_user->last_name : 'N/A' ?></span>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Navbar Search -->
            <li class="nav-item">
                <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                    <i class="fas fa-search"></i>
                </a>
                <div class="navbar-search-block">
                    <form class="form-inline">
                        <div class="input-group input-group-sm">
                            <input class="form-control form-control-navbar" type="search" placeholder="Search"
                                   aria-label="Search">
                            <div class="input-group-append">
                                <button class="btn btn-navbar" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#"
                   role="button">
                    <i class="fas fa-th-large"></i>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="/" target="_blank" class="brand-link">
            <img src="/static/admin-lte/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
                 class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light"><?= $website_name ?></span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="/static/admin-lte/dist/img/user2-160x160.jpg" class="img-circle elevation-2"
                         alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block"><?= $login_user instanceof \NTHB\Entity\UserEntity ? $login_user->first_name . ' ' . $login_user->last_name : 'N/A' ?></a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <li class="nav-item">
                        <a href="/admin/dashboard" class="nav-link <?= "/admin/dashboard" == $route ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Tổng quan
                                <span class="right badge badge-danger">Mới</span>
                            </p>
                        </a>
                    </li>
                    <li class="nav-item menu-open">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Bài viết
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/admin/post" class="nav-link <?= "/admin/post" == $route ? 'active' : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Bài viết</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/admin/post/create"
                                   class="nav-link <?= "/admin/post/create" == $route ? 'active' : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Thêm bài viết</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/admin/category"
                                   class="nav-link <?= "/admin/category" == $route ? 'active' : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Thể loại</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/admin/tag" class="nav-link <?= "/admin/tag" == $route ? 'active' : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Tag</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/admin/comment" class="nav-link <?= "/admin/comment" == $route ? 'active' : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                        Bình luận
                                        <span class="badge badge-info right">2</span>
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item menu-open">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Tác giả
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/admin/author"
                                   class="nav-link <?= "/admin/author" == $route ? 'active' : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Tác giả</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/admin/author/create"
                                   class="nav-link <?= "/admin/author/create" == $route ? 'active' : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Thêm tác giả</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="pages/widgets.html" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>Tài nguyên</p>
                        </a>
                    </li>
                    <li class="nav-header">THỐNG KÊ</li>
                    <li class="nav-item">
                        <a href="pages/calendar.html" class="nav-link">
                            <i class="nav-icon far fa-calendar-alt"></i>
                            <p>
                                Thống kê 1
                                <span class="badge badge-info right">2</span>
                            </p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        {% yield content_header %}
        {% yield content_main %}

    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <strong>Copyright &copy; 2022 - <?= date('Y') ?> <a href="#"><?= $website_name ?></a>.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 1.0.0
        </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="/static/admin-lte/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="/static/admin-lte/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="/static/admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="/static/admin-lte/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="/static/admin-lte/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="/static/admin-lte/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src=/static/admin-lte/plugins/jqvmap/maps/jquery.vmap.usa.js
"></script>
<!-- jQuery Knob Chart -->
<script src="/static/admin-lte/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="/static/admin-lte/plugins/moment/moment.min.js"></script>
<script src="/static/admin-lte/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="/static/admin-lte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="/static/admin-lte/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="/static/admin-lte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="/static/admin-lte/dist/js/adminlte.js"></script>

{% yield custom_scripts %}

</body>
</html>
