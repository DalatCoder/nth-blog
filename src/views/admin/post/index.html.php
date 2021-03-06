{% extends admin/master.html.php %}

{% block content_header %}
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Danh mục bài viết</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/admin/dashboard">Trang quản trị</a></li>
                    <li class="breadcrumb-item active">Danh mục bài viết</li>
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
                <a href="/admin/post/create" class="btn btn-primary">Thêm bài viết mới</a>
            </div>
            
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Danh sách bài viết trên hệ thống</h3>

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
                                <th>Tiêu đề</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody id="tbody">
                            <?php foreach ($posts as $post): ?>
                                <tr>
                                    <td><?= $post->{\NTHB\Entity\PostEntity::KEY_ID} ?></td>
                                    <td><?= $post->{\NTHB\Entity\PostEntity::KEY_TITLE} ?></td>
                                    <td class="text-right py-0 align-middle">
                                        <div class="btn-group btn-group-sm">
                                            <a href="/blog/show?post=<?= $post->slug ?>" target="_blank" class="btn btn-info mr-2"><i class="fas fa-eye"></i></a>
                                            <a href="/admin/post/edit?id=<?= $post->id ?>" class="btn btn-warning mr-2"><i class="fas fa-edit"></i></a>
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
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
{% endblock %}
