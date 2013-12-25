<?
	$data["nav"]     = array();
	$data["modules"] = $this->core->libraries(true);
	foreach($data["modules"] as $module):
		include(APPPATH."/libraries/".ucwords($module["title"])."/config.php");
		if(isset($nav)) $data["nav"][$module["title"]] = $nav;
	endforeach;

	foreach($data["nav"] as $lib => $array):

		if(isset($array["nav"]["General"])):

?>

<div class="box">
	<h2><?=$array["title"];?></h2>

	<ul class="nav">
		<? foreach($array["nav"]["General"] as $title => $link):?>
		<li <?=($link==uri_string())?"class='active'":"";?>><?=anchor($link,$title);?></li>
		<? endforeach;?>
		<? foreach($array["nav"]["Administrators"] as $title => $link):?>
		<li <?=($link==uri_string())?"class='active'":"";?>><?=anchor($link,'<i class="icon-star"></i> '.$title);?></li>
		<? endforeach;?>
	</ul>

</div>
<? endif;?>

<? endforeach;?>