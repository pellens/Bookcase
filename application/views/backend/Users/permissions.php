<div class="full">

	<h2>User permissions</h2>

	<?=form_open();?>

	<div class="block">

		<table class="table table-bordered">

		<?
	
			$data["nav"]     = array();
			$data["modules"] = $this->core->libraries(true);
		
			foreach($data["modules"] as $module):
				include(APPPATH."/libraries/".ucwords($module["title"])."/config.php");
				if(isset($nav)) $data["nav"][$module["title"]] = $nav;
				if(isset($admin)) $data["admin"][$module["title"]] = $admin;
			endforeach;
		
			foreach($data["nav"] as $lib => $array):
	
	
			if(isset($data["admin"][$lib]["fn"]) && count($data["admin"][$lib]["fn"]) > 0):
		?>

			<thead>
				<tr>
					<th><?=$array["title"];?></th>
					<? foreach($roles as $role):?>
					<th style="text-align:center;" width="1%"><?=$role->title;?></th>
					<? endforeach;?>
				</tr>
			</thead>

			<tbody>

				<? foreach($data["admin"][$lib]["fn"] as $key => $adm):?>
				
					<? if(substr($key,0,4) != "ajax"):?>
						<tr>
							<td><?=@$adm["desc"];?></td>

							<? foreach($roles as $role):?>
							<? $checked = (isset($permissions[$role->id][$key]) && $permissions[$role->id][$key] == 1) ? "checked" : "";?>
							<td style="text-align:center;"><input type="checkbox" <?=$checked;?> name="func[<?=$key;?>][<?=$role->id;?>]"/></td>
							<? endforeach;?>

						</tr>
					<? endif;?>
				
				<? endforeach;?>
			
			</tbody>	

			<? endif;?>


		<? endforeach;?>

		</table>

	</div>

	<div class="actions">
		<input type="submit" value="Save permissions"/>
	</div>

	<?=form_close();?>

</div>