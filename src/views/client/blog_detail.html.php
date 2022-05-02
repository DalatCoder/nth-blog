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
            <h4>Leave a comment</h4>
            <div class="row">
                <form action="" method="get">
                    <div class="col-xs-12 col-sm-4 col-md-4">
                        <input name="" type="text" placeholder="Whats your name *">
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4">
                        <input name="" type="email" placeholder="Whats your email *">
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4">
                        <input name="" type="url" placeholder="Runing a Website">
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <textarea name="" cols="" rows="" placeholder="Whats in your mind"></textarea>
                    </div>
                    <div class="text-center">
                        <input name="" type="button" value="Post Comment">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{% endblock %}
