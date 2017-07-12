<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo $this->settings['project']['title']; ?></title>

    <!-- Bootstrap -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendor/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="vendor/theme/theme.css" rel="stylesheet">
    <link href="vendor/theme/markdown.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<div class="jumbotron">
    <div class="container">
        <h1><?php echo $this->settings['project']['title']; ?></h1>
    </div>
</div><!--end of .jumbotron-->

<div class="container">
    <div class="row">

        <div class="col-md-3">
            <div id="toc"><?php echo $toc; ?></div>
        </div>

        <div class="col-md-9">
            <article class="markdown-body"><?php echo $doc; ?></article>
        </div>

    </div><!--end of .row-->
</div><!--end of .container-->

<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="vendor/theme/theme.js"></script>
</body>
</html>