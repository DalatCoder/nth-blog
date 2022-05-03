{% extends client/master.html.php %}

{% block content %}
<div class="row gx-4 gx-lg-5 justify-content-center">
    <div class="col-md-10 col-lg-8 col-xl-7">
        <?php foreach ($posts as $post): ?>
            <!-- Post preview-->
            <div class="post-preview">
                <a href="/blog/show?post=<?= $post->{\NTHB\Entity\PostEntity::KEY_SLUG} ?>">
                    <h2 class="post-title"><?= $post->{\NTHB\Entity\PostEntity::KEY_TITLE} ?></h2>
                    <h3 class="post-subtitle"><?= $post->{\NTHB\Entity\PostEntity::KEY_SUMMARY} ?></h3>
                </a>
                <p class="post-meta">
                    Đăng bởi
                    <a href="#"><?= $post->get_author()->get_fullname() ?></a>
                    vào ngày <?= $post->get_published_date()->format('d-m-Y') ?>
                    lúc <?= $post->get_published_date()->format('H:i:s') ?>
                </p>
                <p class="post-meta">
                    <?php if (count($post->fetch_categories()) > 0): ?>
                        <?php foreach ($post->fetch_categories() as $category): ?>
                            <a href="/blog?category=<?= $category->{\NTHB\Entity\CategoryEntity::KEY_SLUG} ?>">
                                <span
                                    class="badge rounded-pill bg-light text-dark"><?= $category->{\NTHB\Entity\CategoryEntity::KEY_TITLE} ?></span>
                            </a>
                        <?php endforeach; ?>
                    <?php endif; ?>

                    <?php if (count($post->fetch_tags()) > 0): ?>
                        <br>
                        <?php foreach ($post->fetch_tags() as $tag): ?>
                            <a href="/blog?tag=<?= $tag->{\NTHB\Entity\TagEntity::KEY_SLUG} ?>">
                                <span
                                    class="badge rounded-pill bg-light text-dark">#<?= $tag->{\NTHB\Entity\TagEntity::KEY_TITLE} ?></span>
                            </a>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </p>
            </div>
            <!-- Divider-->
            <hr class="my-4"/>
        <?php endforeach; ?>

        <div class="d-flex justify-content-end mb-4"><a class="btn btn-primary text-uppercase" href="#">Bài viết cũ hơn
                →</a></div>
    </div>
</div>
{% endblock %}
