<?
	$data["nav"]     = array();
	$data["modules"] = $this->core->libraries(true);

	foreach($data["modules"] as $module):
		include(APPPATH."/libraries/".strtolower($module["title"])."/config.php");
		if(isset($nav)) $data["nav"][$module["title"]] = $nav;
	endforeach;

	asort($data["nav"]);

	foreach($data["nav"] as $lib => $array):

		if(isset($array["nav"]["Settings"]) && count($array["nav"]["Settings"]) > 0):

?>

<div class="box">

	<h2><i class="fa <?=$array["icon"];?>"></i> <?=$array["title"];?></h2>

	<ul class="nav <?=($this->uri->segment(4) == strtolower($lib)) ? "active":"";?>">
		<? foreach($array["nav"]["Settings"] as $title => $link):?>
		<li <?=($link==uri_string())?"class='active'":"";?>><?=anchor($link,$title);?></li>
		<? endforeach;?>
	</ul>

</div>
<? endif;?>

<? endforeach;?>