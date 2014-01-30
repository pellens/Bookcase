<div class="full">

	<h2>Message</h2>

	<? $fields = unserialize($item->fields);?>

	<h3><?=$fields["subject"];?></h3>

	<?
		$date = time_elapsed_string($fields["date"]);
		$name = $fields["name"];
		$email = $fields["email"];

		unset($fields["subject"]);
		unset($fields["date"]);
		unset($fields["name"]);
		unset($fields["email"]);
		unset($fields["contactform_post"]);
		unset($fields["website"]);
		unset($fields["tel"]);
	?>

	<div class="block">
		
	<? foreach($fields as $key => $value):?>
		<p><strong><?=$key;?>:</strong></p>
		<p><?=$value;?></p>
	<? endforeach;?>

	</div>

	<h3>About <?=$name;?></h3>
	<div class="block">
		<? $person = $this->contactform->submitter($email);?>
		<p><strong>Name:</strong> <?=anchor("admin/lib/contactform/contact/".$person->id,$person->name);?></p>
		<p><strong>E-mail:</strong> <?=$person->email;?></p>
		<p><strong>Telephone:</strong> <?=$person->tel;?></p>
		<p><strong>Website:</strong> <?=$person->website;?></p>
	</div>

	<h3>Other messages from <?=$name;?></h3>
	<div class="block">
		<table class="table table-striped">
			<thead>
				<tr>
					<th width="1%"><input type="checkbox"/></th>
					<th>Subject</th>
					<th>Date</th>
				</tr>
			</thead>
			<? foreach($this->contactform->submitter_submissions($email) as $mes):?>
				<? $fields = unserialize($mes->fields);?>
				<tr class="<?=($mes->read==0)?"unread":"";?>">
					<td><input type="checkbox"/></td>
					<td><?=anchor("admin/lib/contactform/submission/".$mes->id,$mes->subject);?></td>
					<td><?=time_elapsed_string($fields["date"]);?></td>
				</tr>
			<? endforeach;?>
		</table>
	</div>

</div>