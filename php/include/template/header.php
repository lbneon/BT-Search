<?php 
ob_start(); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" >
	<title><?php echo $siteconf['title']; ?></title>
	<meta name="keywords" content="<?php echo $siteconf['keywords']; ?>" />
	<meta name="description" content="<?php echo $siteconf['description']; ?>" />

	<link rel="stylesheet" href="<?php echo $siteconf['url'].'public/css/bootstrap.min.css'; ?>">
	<link rel="stylesheet" href="<?php echo $siteconf['url'].'public/css/bootstrap-theme.css'; ?>">
	<link href="<?php echo $siteconf['url'].'public/css/style.css'; ?>" rel="stylesheet">
	<script type="text/javascript" src="<?php echo $siteconf['url'].'public/js/jquery.min.js'; ?>"></script>
	<!--[if lte IE 7]><script>window.location.href='http://cdn.dmeng.net/upgrade-your-browser.html';</script><![endif]-->
</head>
<body>