<?
	$data["nav"]     = array();
	$data["modules"] = $this->core->libraries(true);
	foreach($data["modules"] as $module):
		include(APPPATH."/libraries/".ucwords($module["title"])."/config.php");
		if(isset($nav)) $data["nav"][$module["title"]] = $nav;
	endforeach;

	foreach($data["nav"] as $lib => $array):

		if(isset($array["nav"]["Settings"])):

?>

<div class="box">
	<h2><?=$lib;?></h2>

	<ul class="nav">
		<? foreach($array["nav"]["Settings"] as $title => $link):?>
		<li <?=($link==uri_string())?"class='active'":"";?>><?=anchor($link,$title);?></li>
		<? endforeach;?>
		<? foreach($array["nav"]["Administrators"] as $title => $link):?>
		<li <?=($link==uri_string())?"class='active'":"";?>><?=anchor($link,'<i class="icon-star"></i> '.$title);?></li>
		<? endforeach;?>
	</ul>

</div>
<? endif;?>

<? endforeach;?>


<!--<div class="box">
	<h2>General settings</h2>
	<ul class="nav">
		<li><?=anchor("admin/settings/website_settings","Website settings");?></li>
	</ul>
</div>

<div class="box">

	<h2>Users</h2>
	<ul class="nav">
		<li><?=anchor("admin/settings/add_user","Add user");?></li>
		<li><?=anchor("admin/settings/users","Users overview");?></li>
		<li><?=anchor("admin/settings/user_roles","User roles");?></li>
		<li><?=anchor("admin/settings/permissions","Permissions");?></li>
	</ul>

</div>-->