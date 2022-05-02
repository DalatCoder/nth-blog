{% extends admin/master.html.php %}

{% block content_header %}
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Danh mục tác giả</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/admin/dashboard">Trang quản trị</a></li>
                    <li class="breadcrumb-item active">Danh mục tác giả</li>
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
    <div class="container-fluid">
        <!-- /.row -->
        <div class="row">
            <div class="col-12 mb-2">
                <a href="/admin/author/create" class="btn btn-primary">Thêm tác giả mới</a>
            </div>

            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Danh sách tác giả trên hệ thống</h3>

                        <div class="card-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" id="search" name="table_search" class="form-control float-right"
                                       placeholder="Tìm kiếm nhanh">

                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên</th>
                                <th>Họ đệm</th>
                                <th>Email</th>
                                <th>Số bài viết</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody id="tbody">
                            <?php foreach ($users as $user): ?>
                                <tr>
                                    <td><?= $user->{\NTHB\Entity\UserEntity::KEY_ID} ?></td>
                                    <td><?= $user->{\NTHB\Entity\UserEntity::KEY_FIRST_NAME} ?></td>
                                    <td><?= $user->{\NTHB\Entity\UserEntity::KEY_LAST_NAME} ?></td>
                                    <td><?= $user->{\NTHB\Entity\UserEntity::KEY_EMAIL} ?></td>
                                    <td>1</td>
                                    <td class="text-right py-0 align-middle">
                                        <div class="btn-group btn-group-sm">
                                            <a href="#" class="btn btn-info mr-2"><i class="fas fa-eye"></i></a>
                                            <a href="#" class="btn btn-warning mr-2"><i class="fas fa-edit"></i></a>
                                            <a href="#" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.row -->
    </div>
</section>
<!-- /.content -->
{% endblock %}

