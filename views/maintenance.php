<?php
/**
 * Maintenance mode template that"s shown to logged out users.
 *
 * @package   ip-maintenance-mode
 *
 * @copyright Copyright (c) 2023, Ivan Petermann
 * @license   GPL-3.0-or-later
 */
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="<?php echo plugins_url('assets/css/maintenance.min.css', dirname(__FILE__)); ?>">

	<title><?php echo esc_html(get_bloginfo('name')); ?> - <?php _e('Melhorias estão sendo implementadas!', 'ip-maintenance-mode');?>.</title>
</head>
<body>
<div class="absolute"></div>
<div class="container">
	<div class="wrap">
		<h1><?php _e('Melhorias estão sendo implementadas!', 'ip-maintenance-mode');?></h1>
		<p><?php _e('Aguarde, em breve estaremos de volta com nosso site.', 'ip-maintenance-mode');?></p>
		<h2><?php echo esc_html(get_bloginfo('name')); ?></h2>
	</div>
</div>
</body>
</html>
