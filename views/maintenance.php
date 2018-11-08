<?php
/**
 * Maintenance mode template that"s shown to logged out users.
 *
 * @package   ip-maintenance-mode
 *
 * @copyright Copyright (c) 2018, Ivan Petermann
 * @license   GPL2+
 */
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<link href="//fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="<?php echo plugins_url('assets/css/maintenance.min.css', dirname(__FILE__)); ?>">

	<title><?php echo esc_html(get_bloginfo('name')); ?> - <?php _e('Melhorias estão sendo implementadas', 'ip-maintenance-mode');?>.</title>
</head>
<body>
<div class="absolute"></div>
<div class="container">
	<div class="wrap">
		<h1><?php _e('Algumas melhorias estão sendo implementadas', 'ip-maintenance-mode');?></h1>
		<h4><?php _e('Volte em alguns instantes', 'ip-maintenance-mode');?>...</h4>
		<h3><?php _e('Obrigado', 'ip-maintenance-mode');?></h3>
		<h4><?php echo esc_html(get_bloginfo('name')); ?></h4>
	</div>
</div>
</body>
</html>
