<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $website_name . ($page_title ? ' | ' . $page_title : '') ?></title>

    {% yield custom_styles %}
</head>
<body>
{% yield content %}

{% yield custom_scripts %}
</body>
</html>
