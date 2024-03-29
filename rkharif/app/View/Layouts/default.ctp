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
echo $this->Html->css('admin');
echo $this->Html->css('show');
echo $this->Html->css('new');
echo $this->Html->css('markdown');
echo $this->Html->css('toggle');
echo $this->Html->css('subject');
echo $this->Html->css('dark');
echo $this->Html->css('ticket');
echo $this->Html->css('planning');
echo $this->Html->css('profile');
echo $this->Html->css('//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css');

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
echo $this->Html->script('chart');
echo $this->Html->script('http://code.jquery.com/color/jquery.color-2.1.2.min.js');


echo $this->fetch('meta');
echo $this->fetch('css');
echo $this->fetch('script');
?>
<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
</head>
<body>
	<?= $this->Session->flash() ?>
	<?php if ($title_for_layout != "Login") { ?>
	<header>
		<div class='head'>
			<table>
				<tr>
					<td>
						<h1>INTRA</h1>
					</td>
					<td>
						<?= $this->Form->create('Lulz', array('url' => array('controller' => 'users', 'action' => 'search'))); ?>
						<?= $this->Form->input('search', array('placeholder' => 'Search...', 'id' => "search", 'label' => '')); ?>
						</form>
					</td>
				</tr>
			</table>
		</div>
		<div class='menu'>
			<table>
				<tr><td><a href='/'><i class='icon-home'></i></a></td></tr>
				<tr><td onMouseOver="show_sub2('.sub_profile')"><a href='/users/profile/<?= $this->Session->read('LDAP.User.uidnumber') ?>'<i class='icon-user3'></i></td></tr>
				<tr><td onMouseOver="show_sub2('.sub_module')"><a href='#'><i class='icon-tree'></i></a></td></tr>
				<tr><td onMouseOver="show_sub2('.sub_forum')"><a href='/forums'><i class='icon-bubbles2'></i></a></td></tr>
				<tr><td><a href='/plannings'><i class='icon-calendar'></i></a></td></tr>
				<tr><td onMouseOver="show_sub2('.sub_param')"><a href='#'><i class='icon-cog'></i></a></td></tr>
			</table>
		</div>
		<div class='submenu'>
			<span class='title'><?= $this->Session->read('LDAP.User.uid'); ?></span>
			<ul>
				<li onclick="show_sub('.sub_profile')"><i class='icon-user3'></i> Profil <i class='fa fa-chevron-down'></i></li>
				<li class='sub_menu sub_profile'>
					<ul>
					<a href="/users/profile/<?= $this->Session->read('LDAP.User.uidnumber') ?>"><li>Voir son profil</li></a>
						<a href="#"><li>Fil d'actualite</li></a>
					</ul>
				</li>
				<li onclick="show_sub('.sub_module')"><i class='icon-tree'></i> Modules <i class='fa fa-chevron-down'></i></li>
				<li class='sub_menu sub_module'>
					<ul>
<?php
foreach($mods as $mod) {
	echo "<a href='/shows/module/".$mod['Module']['id']."'><li>".$mod['Module']['name']."</li></a>";
}
?>
					</ul>
				</li>
				<li onclick="show_sub('.sub_forum')"><i class='icon-bubbles2'></i><a href='/forums'> Forum</a> <i class='fa fa-chevron-down'></i></li>
				<li class='sub_menu sub_forum'>
				<ul>
					<a href='/forums/add'><li>Nouveau sujet</li></a>
<?php
foreach($mods as $mod) {
	echo "<a href='/forums/show/".$mod['Module']['id']."'><li>".$mod['Module']['name']."</li></a>";
}
?>	</ul>
				</li>
				<li><i class='icon-calendar'></i><a href='/plannings'> Planning </a><i class='fa fa-chevron-down'></i></li>
<?php
if (isset($admin)) {
	echo "<li onclick=\"show_sub('.sub_admin')\"><i class='icon-user4'></i> Admin <i class='fa fa-chevron-down'></i></li>
	<li class='sub_menu sub_admin'>
	<ul>
	<a href=\"/admins/create_module\"><li>Creer un Module</li></a>
	<a href=\"/admins/create_subject\"><li>Creer un Sujet</li></a>
	</ul>
	</li>";
}
?>

				<li onclick="show_sub('.sub_param')"><i class='icon-cog'></i> Parametres <i class='fa fa-chevron-down'></i></li>
				<li class='sub_menu sub_param'>
					<ul>
						<a href='/tickets/'><li>Tickets</li></a>
						<a href="#"><li>Modifier</li></a>
						<a href='/users/logout'><li>Deconnexion</li></a>
					</ul>
				</li>
			<div id="search_result">

			</div>
		</div>
		<!-- Menu 
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
</div>-->
	</header>
	<?php } ?>
<div id='content'>
<?php echo $this->Session->flash(); ?>
	<?= $this->fetch('content') ?>
</div>
</body>
</html>
