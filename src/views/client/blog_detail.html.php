{% extends client/master.html.php %}

{% block custom_styles %}
<style>
    @media (min-width: 0) {
        #comment-section .g-mr-15 {
            margin-right: 1.07143rem !important;
        }
    }

    @media (min-width: 0) {
        #comment-section .g-mt-3 {
            margin-top: 0.21429rem !important;
        }
    }

    #comment-section .g-height-50 {
        height: 50px;
    }

    #comment-section .g-width-50 {
        width: 50px !important;
    }

    @media (min-width: 0) {
        #comment-section .g-pa-30 {
            padding: 2.14286rem !important;
        }
    }

    #comment-section .g-bg-secondary {
        background-color: #fafafa !important;
    }

    #comment-section .u-shadow-v18 {
        box-shadow: 0 5px 10px -6px rgba(0, 0, 0, 0.15);
    }

    #comment-section .g-color-gray-dark-v4 {
        color: #777 !important;
    }

    #comment-section .g-font-size-12 {
        font-size: 0.85714rem !important;
    }

    #comment-section .media-comment {
        margin-top: 20px
    }
</style>
{% endblock %}

<article class="mb-4">
    {% block inner_content %}
    <div class="row gx-4 gx-lg-5 justify-content-center">
        <div class="col-md-10 col-lg-8 col-xl-7" id="blog-content">
            <?= $post->{\NTHB\Entity\PostEntity::KEY_CONTENT} ?>
        </div>
    </div>
    {% endblock %}
</article>

{% block outer_content %}
<div class="container px-4 px-lg-5">
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <hr>
            <div class="media g-mb-30 media-comment mt-5">
                <div class="media-body u-shadow-v18 g-bg-secondary g-pa-30">
                    <div class="mb-3">
                        <h5 class="h5 g-color-gray-dark-v1 mb-0">Chia sẻ cảm nghĩ của bạn về bài viết...</h5>
                    </div>

                    <form action="/comment/create" method="POST" class="">
                        <input type="hidden" name="post_id" value="<?= $post->id ?>">
                        <input type="hidden" name="parent_id" value="0">
                        <input type="hidden" name="slug" value="<?= $post->slug ?>">
                        <?php if ($login_user instanceof \NTHB\Entity\UserEntity): ?>
                            <input type="hidden" name="author_id" value="<?= $login_user->id ?>">
                        <?php endif; ?>

                        <div class="row g-3 my-4">
                            <div class="col-lg-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control form-control-sm" id="first_name"
                                           placeholder="Tên"
                                           value="<?= $login_user instanceof \NTHB\Entity\UserEntity ? $login_user->first_name : '' ?>"
                                           required
                                           name="first_name"
                                           autocomplete="off"
                                    >
                                    <label for="first_name">Tên *</label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="last_name"
                                           placeholder="Họ đệm"
                                           value="<?= $login_user instanceof \NTHB\Entity\UserEntity ? $login_user->last_name : '' ?>"
                                           name="last_name"
                                           autocomplete="off"
                                    >
                                    <label for="last_name">Họ đệm</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" id="email"
                                           placeholder="email"
                                           value="<?= $login_user instanceof \NTHB\Entity\UserEntity ? $login_user->email : '' ?>"
                                           required
                                           name="email"
                                           autocomplete="off"
                                    >
                                    <label for="email">Email *</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea name="content" class="form-control" placeholder="Nhập cảm nghĩ của bạn"
                                              id="content" style="height: 120px"></textarea>
                                    <label for="content">Nội dung *</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <input type="submit" value="Gửi nhận xét" class="btn btn-primary">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center" id="comment-section">
        <?php foreach ($post->fetch_comments() as $comment): ?>
            <?php if ($comment->is_accepted() || $is_login): ?>
                <div class="col-md-8">
                    <div class="media g-mb-30 media-comment">
                        <div class="media-body u-shadow-v18 g-bg-secondary g-pa-30">
                            <div class="g-mb-15">
                                <div class="d-flex align-items-baseline">
                                    <h5 class="h5 g-color-gray-dark-v1 mb-0">
                                        <?= $comment->last_name . ' ' . $comment->first_name ?>
                                    </h5>
                                    <?php if ($comment->author_id): ?>
                                        <span class="text-muted g-font-size-12 d-block ms-1">Tác giả</span>
                                    <?php endif; ?>
                                </div>

                                <span
                                    class="g-color-gray-dark-v4 g-font-size-12"><?= $comment->get_created_at()->format('d-m-Y H:i:s') ?></span>
                            </div>

                            <p><?= $comment->content ?></p>

                            <?php if ($is_login): ?>
                                <ul class="list-inline d-sm-flex my-0">
                                    <li class="list-inline-item g-mr-20" id="comment-<?= $comment->id ?>">
                                        <?php if ($comment->is_accepted()): ?>
                                            <a
                                                class="u-link-v5 g-color-gray-dark-v4 g-color-primary--hover"
                                                href="/admin/comment/deny?id=<?= $comment->id ?>&redirect_url=/blog/show?post=<?= $post->slug ?>#comment-<?= $comment->id ?>"
                                            >
                                                <i class="fa fa-thumbs-down g-pos-rel g-top-1 g-mr-3"></i>
                                                Gỡ phản hồi
                                            </a>
                                        <?php else: ?>
                                            <a
                                                class="u-link-v5 g-color-gray-dark-v4 g-color-primary--hover"
                                                href="/admin/comment/accept?id=<?= $comment->id ?>&redirect_url=/blog/show?post=<?= $post->slug ?>#comment-<?= $comment->id ?>"
                                            >
                                                <i class="fa fa-thumbs-up g-pos-rel g-top-1 g-mr-3"></i>
                                                Chấp nhận phản hồi
                                            </a>
                                        <?php endif; ?>
                                    </li>
                                    <!--
                                    <li class="list-inline-item ml-auto">
                                        <a class="u-link-v5 g-color-gray-dark-v4 g-color-primary--hover" href="#!">
                                            <i class="fa fa-reply g-pos-rel g-top-1 g-mr-3"></i>
                                            Phản hồi
                                        </a>
                                    </li>
                                    -->
                                </ul>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>
{% endblock %}

{% block custom_scripts %}
<script>
    document.querySelectorAll('#blog-content h2').forEach(h2 => h2.classList.add('section-heading'))
    document.querySelectorAll('#blog-content img').forEach(h2 => h2.classList.add('img-fluid'))
    document.querySelectorAll('#blog-content blockquote').forEach(h2 => h2.classList.add('blockquote'))
</script>
{% endblock %}
