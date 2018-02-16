<!DOCTYPE html>
<head>
  <meta charset="<?php bloginfo( 'charset' ) ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width">
  <title><?php wp_title( '|', true, 'right' ) ?></title>
	<meta name="author" content="">
	<link rel="author" href="">
	<?php wp_head() ?>
</head>

<body <?php body_class() ?>>
  <header id="page-header">
  	<h1 id="page-logo">
  		<?php if (!is_front_page()): ?>
  			<a href="<?php bloginfo('url') ?>" title="<?php bloginfo('name') ?> - <?php bloginfo('description') ?>">
  				<?php bloginfo('name') ?>
  			</a>
  		<?php else: ?>
  			<span>
  				<?php bloginfo('name') ?>
  			</span>
  		<?php endif; ?>
  	</h1>
  	<?php wp_nav_menu(array(
  		'theme_location' => 'main-nav',
  		'container'      => 'nav',
  		'container_id'   => 'primary-nav'
  	)) ?>
  </header>
  <div id="content-wrap">
