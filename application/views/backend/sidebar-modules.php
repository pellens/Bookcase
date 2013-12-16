<?
	$data["nav"]     = array();
	$data["modules"] = $this->core->libraries(true);
	foreach($data["modules"] as $module):
		include(APPPATH."/libraries/".ucwords($module["title"])."/config.php");
		if(isset($nav)) $data["nav"][$module["title"]] = $nav;
	endforeach;

	foreach($data["nav"] as $lib => $array):

?>

<div class="box">
	<h2><?=$lib;?></h2>

	<ul class="nav">
		<? foreach($array["nav"]["General"] as $title => $link):?>
		<li <?=($link==uri_string())?"class='active'":"";?>><?=anchor($link,$title);?></li>
		<? endforeach;?>
	</ul>

</div>

<? endforeach;?>