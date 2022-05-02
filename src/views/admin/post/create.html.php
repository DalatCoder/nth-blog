{% extends admin/master.html.php %}

{% block custom_styles %}
<!-- summernote -->
<link rel="stylesheet" href="/static/admin-lte/plugins/summernote/summernote-bs4.min.css">
<!-- CodeMirror -->
<link rel="stylesheet" href="/static/admin-lte/plugins/codemirror/codemirror.css">
<link rel="stylesheet" href="/static/admin-lte/plugins/codemirror/theme/monokai.css">
<!-- Select2 -->
<link rel="stylesheet" href="/static/admin-lte/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="/static/admin-lte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<!-- SweetAlert2 -->
<link rel="stylesheet" href="/static/admin-lte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
{% endblock %}

{% block content_header %}
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Thêm bài viết mới</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/admin/dashboard">Trang quản trị</a></li>
                    <li class="breadcrumb-item"><a href="/admin/post">Bài viết</a></li>
                    <li class="breadcrumb-item active">Thêm bài viết mới</li>
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
        <div class="col-12 mb-3 d-flex justify-content-end">
            <button class="btn btn-secondary mr-4">Lưu nháp</button>
            <button class="btn btn-primary">Xuất bản</button>
        </div>
        
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
                <div class="card-body" style="display: block;">
                    <div class="form-group">
                        <label for="title">Tiêu đề *</label>
                        <input type="text" id="title" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="meta-title">SEO Meta</label>
                        <input type="text" id="meta-title" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="summary">Tóm tắt</label>
                        <textarea id="summary" class="form-control" rows="4"></textarea>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <div class="col-lg-4">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Thể loại</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="categories">Chọn thể loại *</label>
                        <select class="categories-select2" id="categories" multiple="multiple" data-placeholder="Chọn 1 hoặc nhiều thể loại" style="width: 100%;">
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= $category->{\NTHB\Entity\CategoryEntity::KEY_ID} ?>"><?= $category->{\NTHB\Entity\CategoryEntity::KEY_TITLE} ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="new-category">Tên thể loại</label>
                        <input type="text" id="new-category" class="form-control">
                    </div>
                    <div class="form-group">
                        <input id="new-category-button" type="submit" value="Thêm thể loại mới" class="btn btn-primary float-right">
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Gắn thẻ</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="tags">Chọn thẻ</label>
                        <select class="tags-select2" id="tags" multiple="multiple" data-placeholder="Chọn 1 hoặc nhiều thẻ" style="width: 100%;">
                            <?php foreach ($tags as $tag): ?>
                                <option value="<?= $tag->{\NTHB\Entity\TagEntity::KEY_ID} ?>"><?= $tag->{\NTHB\Entity\TagEntity::KEY_TITLE} ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="new-tag">Tên thẻ</label>
                        <input type="text" id="new-tag" class="form-control">
                    </div>
                    <div class="form-group">
                        <input id="new-tag-button" type="submit" value="Thêm thẻ mới" class="btn btn-primary float-right">
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>

        <div class="col-12">
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title">
                        Nội dung bài viết
                    </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <textarea id="summernote"></textarea>
                </div>
                <div class="card-footer">
                    Truy cập <a href="https://github.com/summernote/summernote/" target="_blank">Summernote</a> để xem
                    hướng dẫn sử dụng.
                </div>
            </div>
        </div>
        
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Ảnh bìa</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="cover-image">Ảnh bìa</label>
                        <input type="number" id="cover-image" class="form-control">
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>

        <div class="col-12 mb-3 d-flex justify-content-end">
            <button class="btn btn-secondary mr-4">Lưu nháp</button>
            <button class="btn btn-primary">Xuất bản</button>
        </div>
    </div>

</section>
<!-- /.content -->
{% endblock %}

{% block custom_scripts %}
<!-- Summernote -->
<script src="/static/admin-lte/plugins/summernote/summernote-bs4.min.js"></script>
<!-- CodeMirror -->
<script src="/static/admin-lte/plugins/codemirror/codemirror.js"></script>
<script src="/static/admin-lte/plugins/codemirror/mode/css/css.js"></script>
<script src="/static/admin-lte/plugins/codemirror/mode/xml/xml.js"></script>
<script src="/static/admin-lte/plugins/codemirror/mode/htmlmixed/htmlmixed.js"></script>
<!-- Select2 -->
<script src="/static/admin-lte/plugins/select2/js/select2.full.min.js"></script>
<!--SweeetAlert-->
<script src="/static/admin-lte/plugins/sweetalert2/sweetalert2.min.js"></script>

<script>
    $(function () {
        //Initialize Select2 Elements
        $('.categories-select2').select2()
        $('.tags-select2').select2()
        
        function uploadFile(file, onSuccess, onError) {
            const data = new FormData()
            data.append("file", file)
            
            $.ajax({
                url: '/api/v1/media/upload',
                data: data,
                type: 'POST',
                cache: false,
                contentType: false,
                processData: false,
            })
            .done(function (data) {
                if (onSuccess) onSuccess(data)
            })
            .fail(function () {
                if (onError) onError()
                console.log('Error while trying to upload an image')
            })
        }
        
        // Summernote
        $('#summernote').summernote({
            height: 720,
            placeholder: 'Nhập nội dung bài viết vào đây ...',
            codemirror: { 
                theme: 'monokai'
            },
            callbacks: {
                onImageUpload: function (files) {
                    uploadFile(files[0], function (data) {
                        if (data.status === 'success') {
                            // const url = `${data.data.scheme}://${data.data.host}${data.data.path}`
                            const url = data.data.path
                            $('#summernote').summernote('insertImage', url);
                        }
                        else {
                            alert('Error while trying to upload image: ' + (data.msg || ''))
                        }
                    })
                }
            },
        })

        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        })

        const DOMSelect = {
            newCategoryInput: document.getElementById('new-category'),
            newCategoryButton: document.getElementById('new-category-button'),
            newTagInput: document.getElementById('new-tag'),
            newTagButton: document.getElementById('new-tag-button')
        }
        
        DOMSelect.newCategoryButton.addEventListener('click', function (e) {
            e.preventDefault()

            const data = {
                title: DOMSelect.newCategoryInput.value,
                metaTitle: '',
                slug: '',
                content: ''
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

                        DOMSelect.newCategoryInput.value = ''
                        
                        const newCategory = data.data
                        const newOption = new Option(newCategory.title, newCategory.id, true, true);
                        $('.categories-select2').append(newOption).trigger('change');
                    }
                    else {
                        Toast.fire({
                            icon: 'error',
                            title: data.msg
                        })
                    }
                })
        })

        DOMSelect.newTagButton.addEventListener('click', function (e) {
            e.preventDefault()

            const data = {
                title: DOMSelect.newTagInput.value,
                metaTitle: '',
                slug: '',
                content: ''
            }

            fetch('/api/v1/tag', {
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

                        DOMSelect.newTagInput.value = ''

                        const newTag = data.data
                        const newOption = new Option(newTag.title, newTag.id, true, true);
                        $('.tags-select2').append(newOption).trigger('change');
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
