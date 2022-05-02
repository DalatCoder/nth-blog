{% extends client/master.html.php %}

{% block content %}
<div class="row">
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 ">
        <article role="pge-title-content" class="contact-header">
            <header>
                <h2><span>Hey There!</span> we love to hear you.</h2>
            </header>
            <p><a href="tel:8197654321"><i class="fa fa-phone" aria-hidden="true"></i> +8197654321</a><a
                    href="mailto:contact@avana.com"><i class="fa fa-envelope" aria-hidden="true"></i> contact@avana.com</a>
            </p>
        </article>
    </div>

    <!-- map -->
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
        <div class="demo-wrapper">
            <div id="surabaya"></div>
        </div>
    </div>
    <!-- map -->
    <div class="clearfix"></div>
    <!-- contat-from-wrapper -->
    <div class="contat-from-wrapper">
        <div id="message"></div>
        <form method="post" action="" name="cform" id="cform">
            <div class="row">
                <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                    <input name="name" id="name" type="text" placeholder="Whats your name">
                </div>
                <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                    <input name="email" id="email" type="email" placeholder="Whats your email">
                </div>
            </div>
            <div class="clearfix"></div>
            <textarea name="comments" id="comments" cols="" rows="" placeholder="Whats in your mind"></textarea>
            <div class="clearfix"></div>
            <input name="" type="submit" value="Send email">
            <div id="simple-msg"></div>
        </form>
    </div>
    <!-- contat-from-wrapper -->
</div>
{% endblock %}
