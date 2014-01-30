<div class="full">

	<h2><?=ucwords(strtolower($item->name));?></h2>

	<ul class="tabs"></ul>

	<div class="block" data-pane="Contact">
		<p><label>Name:</label> <input type="text" name="name" value="<?=ucwords(strtolower($item->name));?>"/></p>
		<p><label>E-mail:</label> <input type="email" name="email" value="<?=$item->email;?>"/></p>
		<p><label>Telephone:</label> <input type="tel" name="tel" value="<?=$item->tel;?>"/></p>
		<p><label>Website:</label> <input type="url" name="website" value="<?=$item->website;?>"/></p>
	</div>

	<div class="block" data-pane="Messages">
		<table class="table table-striped">
			<thead>
				<tr>
					<th width="1%"><input type="checkbox"/></th>
					<th>Subject</th>
					<th>Date</th>
				</tr>
			</thead>
			<? foreach($this->contactform->submitter_submissions($item->email) as $mes):?>
				<? $fields = unserialize($mes->fields);?>
				<tr class="<?=($mes->read==0)?"bold":"";?>">
					<td><input type="checkbox"/></td>
					<td><?=anchor("admin/lib/contactform/submission/".$mes->id,$mes->subject);?></td>
					<td><?=time_elapsed_string($fields["date"]);?></td>
				</tr>
			<? endforeach;?>
		</table>
	</div>

</div>