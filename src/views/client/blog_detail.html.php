{% extends client/master.html.php %}

{% block content %}
<div class="blog-details">
    <article class="post-details" id="post-details">
        <header role="bog-header" class="bog-header text-center">
            <?php 
            $published_at = $post->get_published_date();
            ?>
            <h3><span><?= $published_at->format('d') ?></span> <?= $published_at->format('F') ?> <?= $published_at->format('Y') ?></h3>
            <h2><?= $post->{\NTHB\Entity\PostEntity::KEY_TITLE} ?></h2>
        </header>

        <div class="enter-content">
            <?= $post->{\NTHB\Entity\PostEntity::KEY_CONTENT} ?>
        </div>
    </article>

    <div class="" style="margin-top: 5rem; margin-bottom: 3rem">
        <?php $author = $post->get_author(); ?>
        <?php if ($author instanceof \NTHB\Entity\UserEntity): ?>
        <?php 
            $author_created_date = $author->get_created_at();
            $month = $author_created_date->format('F');
            $date = $author_created_date->format('d');
            $year = $author_created_date->format('Y');
        ?>
        
        <h3 style="margin-bottom: 3rem">Về tác giả</h3>
        <ul class="comments-reply">
            <li>
                <figure>
                    <img src="/static/avana/images/blog-images/image-2.jpg" alt="" class="img-responsive"/>
                </figure>
                <section>
                    <h4><?= $author->last_name . ' ' . $author->first_name ?> <a href="#"></a></h4>
                    <div class="date-pan">Ngày tham gia: <?= $month ?> <?= $date ?>, <?= $year ?></div>
                    <?= $author->{\NTHB\Entity\UserEntity::KEY_INTRO} ?>
                </section>
            </li>    
        </ul>
        <?php endif; ?>
        
    </div>

    <!-- Comments -->

    <div class="comments-pan">
        <h3>3 Comments</h3>
        <ul class="comments-reply">
            <li>
                <figure>
                    <img src="/static/avana/images/blog-images/image-1.jpg" alt="" class="img-responsive"/>
                </figure>
                <section>
                    <h4>Anna Greenfield <a href="#">Reply</a></h4>
                    <div class="date-pan">January 26, 2016</div>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed volutpat eu nibh ultricies semper.
                    Vivamus porta, felis vitae facilisis sodales, felis est iaculis orci, et ornare sem mauris ut
                    turpis. Pellentesque vitae tortor nec tellus hendrerit aliquam. Donec condimentum leo eu ullamcorper
                    scelerisque pellentesque urna rhoncus.
                </section>

                <ol class="reply-pan">
                    <li>
                        <figure>
                            <img src="/static/avana/images/blog-images/image-2.jpg" alt="" class="img-responsive"/>
                        </figure>

                        <section>
                            <h4>Johnathan Doe <a href="#">Reply</a></h4>
                            <div class="date-pan">January 26, 2016</div>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed volutpat eu nibh ultricies
                            semper. Vivamus porta, felis vitae facilisis sodales, felis est iaculis orci, et ornare sem
                            mauris ut turpis. Pellentesque vitae tortor nec tellus hendrerit aliquam. Donec condimentum
                            leo eu ullamcorper scelerisque pellentesque urna rhoncus.
                        </section>
                    </li>
                </ol>
            </li>

            <li>
                <figure>
                    <img src="/static/avana/images/blog-images/image-3.jpg" alt="" class="img-responsive"/>
                </figure>
                <section>
                    <h4>Anna Greenfield <a href="#">Reply</a></h4>
                    <div class="date-pan">January 26, 2016</div>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed volutpat eu nibh ultricies semper.
                    Vivamus porta, felis vitae facilisis sodales, felis est iaculis orci, et ornare sem mauris ut
                    turpis. Pellentesque vitae tortor nec tellus hendrerit aliquam. Donec condimentum leo eu ullamcorper
                    scelerisque pellentesque urna rhoncus.
                </section>
            </li>
        </ul>
        <div class="commentys-form">
            <h4>Để lại bình luận</h4>
            <div class="row">
                <form action="/comment/create" method="POST" id="comment-form">
                    <?php if ($is_login): ?>
                        <input type="hidden" name="author_id" value="<?= $login_user->id ?>">
                        <div class="col-xs-12 col-sm-4 col-md-4">
                            <input name="first_name" type="text" placeholder="Tên *" autocomplete="off" value="<?= $login_user->first_name ?>" readonly>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-4">
                            <input name="last_name" type="text" placeholder="Họ đệm *" autocomplete="off" value="<?= $login_user->last_name ?>" readonly>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-4">
                            <input name="email" type="text" placeholder="Email *" autocomplete="off" value="<?= $login_user->email ?>">
                        </div>
                    <?php else: ?>
                        <div class="col-xs-12 col-sm-4 col-md-4">
                            <input name="first_name" type="text" placeholder="Tên *" autocomplete="off">
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-4">
                            <input name="last_name" type="text" placeholder="Họ đệm *" autocomplete="off">
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-4">
                            <input name="email" type="text" placeholder="Email *" autocomplete="off">
                        </div>
                    <?php endif; ?>
                    <input type="hidden" name="parent_id" id="comment_parent_id" value="">
                    <input type="hidden" name="post_id" value="<?= $post->{\NTHB\Entity\PostEntity::PRIMARY_KEY} ?>">
                    <input type="hidden" name="slug" value="<?= $post->{\NTHB\Entity\PostEntity::KEY_SLUG} ?>">
                    <div class="clearfix"></div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <textarea name="content" cols="" rows="3" placeholder="Chia sẻ cảm nghĩ của bạn về bài viết..."></textarea>
                    </div>
                    <div class="text-center">
                        <input id="create-comment-button" name="" type="button" value="Nhận xét">
                        <input type="submit" value="" id="submit-comment-button" style="opacity: 0">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{% endblock %}

{% block custom_scripts %}
<script>
    document.getElementById('create-comment-button').addEventListener('click', function () {
        document.getElementById('submit-comment-button').click()
    })
</script>
{% endblock %}
