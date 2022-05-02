{% extends admin/master.html.php %}

{% block content_header %}
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Thêm tác giả mới</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/admin/dashboard">Trang quản trị</a></li>
                    <li class="breadcrumb-item"><a href="/admin/author">Danh sách tác giả</a></li>
                    <li class="breadcrumb-item active">Thêm tác giả mới</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
{% endblock %}

{% block content_main %}
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-lg-8">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Thông tin chung</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="first_name">Tên *</label>
                        <input type="text" id="first_name" class="form-control" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="last_name">Họ *</label>
                        <input type="text" id="last_name" class="form-control" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="intro">Giới thiệu ngắn</label>
                        <textarea id="intro" class="form-control" rows="4"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="profile">Giới thiệu bản thân</label>
                        <textarea id="profile" class="form-control" rows="10"></textarea>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <div class="col-lg-4">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Thông tin đăng nhập</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" class="form-control" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="password">Mật khẩu</label>
                        <input type="password" id="password" class="form-control" autocomplete="off">
                    </div>

                    <input type="submit" value="Tạo tác giả mới" class="btn btn-success float-right">
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
</section>
<!-- /.content -->
{% endblock %}
