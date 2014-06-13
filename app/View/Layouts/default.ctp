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
		/* Css stylesheet */
			echo $this->Html->css('icomoon');
			echo $this->Html->css('home');
			echo $this->Html->css('forum');
			echo $this->Html->css('show');
			echo $this->Html->css('new');
			echo $this->Html->css('markdown');
			echo $this->Html->css('toggle');
			echo $this->Html->css('subject');
			echo $this->Html->css('dark');

			/* Enlever le menu style de la page login */
				if ($title_for_layout == "Login")
					echo $this->Html->css('login');
				else
					echo $this->Html->css('main');

		/* Js scripts */
			echo $this->Html->script('http://code.jquery.com/jquery-1.9.0.js');
			echo $this->Html->script('http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/jquery-ui.min.js');
			echo $this->Html->script('toggles.min');
			echo $this->Html->script('main');
			echo $this->Html->script('showdown');
			echo $this->Html->script('highlight.pack');
		

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<?= $this->Session->flash() ?>
	<?php if ($title_for_layout != "Login") { ?>
	<header>
		<!-- Menu -->
			<div id='menu'>
				<ul>
					<li id='first'><a href="/"><i id='iconmenu' class='icon-home'></i></a></li>
					<li><a href="/users/profile/<?= $this->Session->read('LDAP.User.uidnumber')?>"><i class='icon-user3'></i><?= $this->Session->read('LDAP.User.uid')?></a></li>
					<li><a href="#" onMouseOver="subMenu('module')"><i class='icon-tree'></i>Modules</a></li>
					<li><a href="/forums"><i class='icon-bubbles2'></i>Forum</a></li>
					<li><a href="#"><i class='icon-calendar'></i>Planning</a></li>
					<li id='last'><a href="#" onMouseOver="subMenu('param')"><i id='iconmenu' class='icon-cog'></i></a>
										</li>
					<li class='stretch'></li>
</ul>	
<ul class='sub sub_param'>
		<li><a href="#"><i class='icon-cogs'></i>Parametres</a></li>
		<li><a href="/users/logout"><i class='icon-switch'></i>Deconnexion</a></li>
</ul>
<ul class='sub sub_module'>
	<?php
		foreach ($mods as $mod) {
			echo "<li><a href='/Shows/module/".$mod['Module']['id']."''>".$mod['Module']['name']."</a></li>";
		}
	?>
</ul>
</div>
	</header>
	<?php } ?>
<div id='content'>
	<?= $this->fetch('content') ?>
</div>
</body>
</html>
