<html>
<head>
	<title><?php echo $title ?></title>
	<link rel=StyleSheet href="<?php echo base_url().'/css/blueish.css'.'"'?> type="text/css" media=screen>
</head>
<body>
	<div id="menu">
	<h1><?php echo $title ?></h1>
	<h2><?php echo base_url(); ?></h2>
	<ul class="link_list">
	<li><?php echo anchor("login","Login",'class="list_link"');?></li>
	<li><?php echo anchor("search","Search Messages",'class="list_link"');?></li>
	<li><?php echo anchor("post","Post a new message",'class="list_link"');?></li>
	<li><?php echo anchor("feed","Feed",'class="list_link"');?></li>
	<li><?php echo anchor("user/view","View All Messages",'class="list_link"');?></li>	
	<li><?php echo anchor("logout","Logout",'class="list_link"');?></li>
	</ul>
	</div>
