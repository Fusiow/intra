<?php
/**
 *
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('dev', 'Intra 42');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('icomoon');
		echo $this->Html->css('home');
		if ($title_for_layout == "Login")
			echo $this->Html->css('login');
		else
			echo $this->Html->css('main');
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<?php if ($title_for_layout != "Login") { ?>
	<header>
		<!-- Menu -->
			<div id='menu'>
				<ul>
					<li id='first'><a href="#"><i id='iconmenu' class='icon-home'></i></a></li>
					<li><a href="#"><i class='icon-user3'></i>Profil</a></li>
					<li><a href="#"><i class='icon-tree'></i>Modules</a></li>
					<li><a href="#"><i class='icon-bubbles2'></i>Forum</a></li>
					<li><a href="#"><i class='icon-calendar'></i>Planning</a></li>
					<li id='last'><a href="#"><i id='iconmenu' class='icon-cog'></i></a></li>
					<li class='stretch'></li>
</ul>
			</div>
	</header>
	<?php } ?>
<div id='content'>
	<?= $this->fetch('content') ?>
</div>
</body>
</html>
