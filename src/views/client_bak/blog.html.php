{% extends client/master.html.php %}

{% block content %}
<div class="row">
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 ">
        <article role="pge-title-content" class="blog-header">
            <header>
                <h2><span>News</span> Updates from studio</h2>
            </header>
            <p>Get all information about our studio from latest news posts & updates page.</p>
        </article>
        <ul class="grid-lod effect-2" id="grid">
            <?php foreach ($posts as $post): ?>
            <?php
                if (!$post instanceof \NTHB\Entity\PostEntity)
                    continue;
                
                $published_date = $post->get_published_date();
            ?>
            <li>
                <section class="blog-content">
                    <a href="/blog/show?post=<?= $post->{\NTHB\Entity\PostEntity::KEY_SLUG} ?>">
                        <figure>
                            <div class="post-date">
                                <span><?= $published_date->format('d') ?></span> <?= $published_date->format('F') ?> <?= $published_date->format('Y') ?>
                            </div>
                            <img src="<?= $post->get_cover_image_path() ?>" alt="" class="img-responsive"/>
                        </figure>
                    </a>
                    <article><?= $post->{\NTHB\Entity\PostEntity::KEY_SUMMARY} ?></article>
                </section>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
{% endblock %}
