{% extends client/master.html.php %}

<article class="mb-4">
    {% block content %}
    <div class="row gx-4 gx-lg-5 justify-content-center">
        <div class="col-md-10 col-lg-8 col-xl-7" id="blog-content">
            <?= $post->{\NTHB\Entity\PostEntity::KEY_CONTENT} ?>
        </div>
    </div>
    {% endblock %}
</article>

{% block custom_scripts %}
<script>
    document.querySelectorAll('#blog-content h2').forEach(h2 => h2.classList.add('section-heading'))
    document.querySelectorAll('#blog-content img').forEach(h2 => h2.classList.add('img-fluid'))
    document.querySelectorAll('#blog-content blockquote').forEach(h2 => h2.classList.add('blockquote'))
</script>
{% endblock %}
