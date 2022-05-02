{% extends admin/master.html.php %}

{% block content_header %}
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Danh mục bình luận</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/admin/dashboard">Trang quản trị</a></li>
                    <li class="breadcrumb-item active">Danh mục bình luận</li>
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
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Danh sách bình luận trên hệ thống</h3>

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
                                <th>Email</th>
                                <th>Bài viết</th>
                                <th>Nội dung</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody id="tbody">
                            <?php foreach ($comments as $comment): ?>
                                <tr class="<?= is_null($comment->{\NTHB\Entity\PostComment::KEY_PUBLISHED_AT}) ? 'table-warning' : '' ?>">
                                    <td><?= $comment->{\NTHB\Entity\PostComment::PRIMARY_KEY} ?></td>
                                    <td><?= $comment->{\NTHB\Entity\PostComment::KEY_EMAIL} ?></td>
                                    <td><?= $comment->{\NTHB\Entity\PostComment::KEY_POST_ID} ?></td>
                                    <td><?= $comment->{\NTHB\Entity\PostComment::KEY_CONTENT} ?></td>
                                    <td class="text-right py-0 align-middle">
                                        <div class="btn-group btn-group-sm">
                                            <?php if (is_null($comment->{\NTHB\Entity\PostComment::KEY_PUBLISHED_AT})): ?>
                                                <a href="/admin/comment/accept?id=<?= $comment->id ?>" class="btn btn-info mr-2"><i class="fas fa-thumbs-up"></i></a>
                                            <?php else: ?>
                                                <a href="/admin/comment/deny?id=<?= $comment->id ?>" class="btn btn-info mr-2"><i class="fas fa-thumbs-down"></i></a>
                                            <?php endif; ?>
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
