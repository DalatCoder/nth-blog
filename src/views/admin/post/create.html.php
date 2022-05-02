{% extends admin/master.html.php %}

{% block custom_styles %}
<!-- summernote -->
<link rel="stylesheet" href="/static/admin-lte/plugins/summernote/summernote-bs4.min.css">
<!-- CodeMirror -->
<link rel="stylesheet" href="/static/admin-lte/plugins/codemirror/codemirror.css">
<link rel="stylesheet" href="/static/admin-lte/plugins/codemirror/theme/monokai.css">
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
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Xuất bản</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="inputEstimatedBudget">Estimated budget</label>
                        <input type="number" id="inputEstimatedBudget" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="inputSpentBudget">Total amount spent</label>
                        <input type="number" id="inputSpentBudget" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="inputEstimatedDuration">Estimated project duration</label>
                        <input type="number" id="inputEstimatedDuration" class="form-control">
                    </div>
                    <div class="form-group">
                        <a href="#" class="btn btn-secondary">Cancel</a>
                        <input type="submit" value="Create new Project" class="btn btn-success float-right">
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

<script>
    $(function () {
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
    })
</script>
{% endblock %}
