<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> Error 404 Page | <?php echo $this->config->item('website_name','tank_auth');?></title>

<!-- Internet Explorer HTML5 enabling script: -->

<!--[if IE]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/styles.css" />

</head>

<body>

<div id="rocket"></div>

<hgroup>
    <h1>Page Not Found</h1>
    <h2>We couldn't find what you were looking for.</h2>
</hgroup>

<p class="createdBy"><?php echo anchor(base_url(),$this->config->item('website_name','tank_auth'));?><!--<a href="http://tutorialzine.com/2010/08/animated-404-not-found-page-css-jquery/">Read &amp; Download on Tutorialzine &raquo;</a>--></p>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script src="<?php echo base_url();?>js/script.js"></script>
</body>
</html>
