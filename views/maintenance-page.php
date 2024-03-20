<?php
/*
 * Maintenance mode page template that is shown to logged out users.
 *
 * @package   maintenance-mode
 *
 * @copyright Copyright (c) 2023 Ivan Petermann, Copyright (c) 2024 sre3
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

	<title><?php echo esc_html(get_bloginfo('name')); ?> - <?php _e('Site Under Maintenance', 'maintenance-mode');?>.</title>
</head>
<body>
<div class="absolute"></div>
<div class="container">
	<div class="wrap">
		<h1><?php _e('Site Under Maintenance', 'maintenance-mode');?></h1>
		<p><?php _e('The site will be back up shortly', 'maintenance-mode');?></p>
		<h2><?php echo esc_html(get_bloginfo('name')); ?></h2>
	</div>
</div>
</body>
</html>
