<div id="forum">
	<div id="forum_menu">
		<ul>
			<li><a href="#">Infographie</a></li>
			<li><a href="#"onclick="subMenu('unix')">Unix_II</a></li>
			<li><a href="#" onclick="subMenu('web')">Web_II</a></li>
			<li class='stretch'></li>
		</ul>
		<ul class='sub sub_f sub_web'>
			<li><a href="#">Framework I</a></li>
			<li><a href="#">Framework II</a></li>
			<li><a href="#">Framework III</a></li>
			<li><a href="#">Gros projet Web</a></li>
		</ul>
		<ul class='sub sub_f sub_unix'>
			<li><a href="#">Malloc</a></li>
			<li><a href="#">Nm</a></li>
			<li><a href="#">Ft_script</a></li>
			<li><a href="#">Philo</a></li>
			<li><a href="#">Ft_p</a></li>
			<li><a href="#">Ft_irc</a></li>
			<li><a href="#">Zappy</a></li>
			<li><a href="#">Lem-IPC</a></li>
		</ul>

	<?= $this->Form->input('word', array('placeholder' => 'Search...', 'label' => '', 'required')); ?>
	</div>
	<br />
		<table class='question'>
		<tr>
			<th class='icon'><i class='icon-question'></i> <i style='padding-left: 20%;' class='icon-bubbles2'></i></th>
			<th>Answers</th>
			<th>Views</th>
			<th>Module</th>
			<th>Subject</th>
			<th style='text-align: left; padding-left: 7%'>Title</th>
		</tr>
		<tr class='space'>
			<td class='type'><i class='icon-question'></i></td>
			<td class='answers'>3</td>
			<td class='views'>32</td>
			<td class='module'>Unix I</td>
			<td class='subject'>42sh</td>
			<td class='title'><span class='text'> What's my name ?</span><span class='author'>Valentin</span></td>
		</tr>
		<tr class='space'>
			<td class='type'><i class='icon-bubbles2'></i></td>
			<td class='answers'>1</td>
			<td class='views'>64</td>
			<td class='module'>NS</td>
			<td class='subject'></td>
			<td class='title'><span class='text'> I don't know</span><span class='author'>Matthieu</span></td>
		</tr>

	</table>
</div>
