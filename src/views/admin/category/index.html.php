{% extends admin/master.html.php %}

{% block custom_styles %}
<!-- SweetAlert2 -->
<link rel="stylesheet" href="/static/admin-lte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
{% endblock %}

{% block content_header %}
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Danh mục thể loại</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/admin/dashboard">Trang quản trị</a></li>
                    <li class="breadcrumb-item active">Danh mục thể loại</li>
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
            <div class="col-lg-4">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Tạo thể loại</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="title">Tiêu đề *</label>
                                <input type="text" class="form-control" id="title"
                                       placeholder="Nhập tiêu đề">
                            </div>
                            <div class="form-group">
                                <label for="meta_title">Meta</label>
                                <input type="text" class="form-control" id="meta_title"
                                       placeholder="Nhập meta cho tiêu đề">
                            </div>
                            <div class="form-group">
                                <label for="slug">Slug</label>
                                <input type="text" class="form-control" id="slug"
                                       placeholder="Slug">
                            </div>
                            <div class="form-group">
                                <label for="content">Mô tả</label>
                                <textarea id="content" class="form-control" rows="3" placeholder="Mô tả ..."></textarea>
                            </div>

                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button id="create-button" type="submit" class="btn btn-primary">Tạo mới</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Danh sách thể loại trên hệ thống</h3>

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
                                <th>Mô tả</th>
                                <th>Số bài viết</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody id="tbody">
                            <?php foreach ($categories as $category): ?>
                            <tr>
                                <td><?= $category->{\NTHB\Entity\CategoryEntity::KEY_ID} ?></td>
                                <td><?= $category->{\NTHB\Entity\CategoryEntity::KEY_TITLE} ?></td>
                                <td><?= $category->{\NTHB\Entity\CategoryEntity::KEY_CONTENT} ?></td>
                                <td>1</td>
                                <td class="text-right py-0 align-middle">
                                    <div class="btn-group btn-group-sm">
                                        <a href="#" class="btn btn-info mr-2"><i class="fas fa-eye"></i></a>
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

{% block custom_scripts %}
<script src="/static/admin-lte/plugins/sweetalert2/sweetalert2.min.js"></script>

<script>
    $(function () {
        const Toast = Swal.mixin({
            toast: true, 
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        })
        
        const DOMSelect = {
            createButton: document.getElementById('create-button'),
            titleInput: document.getElementById('title'),
            metaTitleInput: document.getElementById('meta_title'),
            slugInput: document.getElementById('slug'),
            contentInput: document.getElementById('content'),
            tableTbody: document.getElementById('tbody')
        }
        
        DOMSelect.createButton.addEventListener('click', function (e) {
            e.preventDefault()
            
            const data = {
                title: DOMSelect.titleInput.value,
                metaTitle: DOMSelect.metaTitleInput.value,
                slug: DOMSelect.slugInput.value,
                content: DOMSelect.contentInput.value
            }
            
            fetch('/api/v1/category', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    Toast.fire({
                        icon: 'success',
                        title: data.msg
                    })
                    
                    const newCategory = data.data
                    DOMSelect.tableTbody.insertAdjacentHTML('beforeend', `
                        <tr>
                            <td>${newCategory.id}</td>
                            <td>${newCategory.title}</td>
                            <td>${newCategory.content}</td>
                            <td>1</td>
                            <td class="text-right py-0 align-middle">
                                <div class="btn-group btn-group-sm">
                                    <a href="#" class="btn btn-info mr-2"><i class="fas fa-eye"></i></a>
                                    <a href="#" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                    `)
                    
                    DOMSelect.titleInput.value = ''
                    DOMSelect.metaTitleInput.value = ''
                    DOMSelect.slugInput.value = ''
                    DOMSelect.contentInput.value = ''
                }
                else {
                    Toast.fire({
                        icon: 'error',
                        title: data.msg
                    })
                }
            })

        })
    })
</script>
{% endblock %}
