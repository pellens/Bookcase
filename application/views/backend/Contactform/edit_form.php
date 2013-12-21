<div class="left">

	<div class="tabs">

		<ul class="links">
			<li class="active" data-pane="edit">Edit contactform</li>
		</ul>

		<div class="panes">
			<div class="pane active" data-pane="edit">
				<? print_r($item);?>

				<div class="form-inline">
					<p>
						<label for="inputtype">Inputtype</label>
						<select name="inputtype">
							<option value="text">Text</option>
							<option value="email">E-mail</option>
							<option value="textarea">Textarea</option>
							<option value="select">Select</option>
						</select>
					</p>
					<p><label for="label">Label</label><input type="text" name="label" id="label"></p>
				</div>
				<ul class="form_fields">
					<li><a href="#" class="add">Add a field</a></li>
					<li>
						
					</li>
				</ul>
			</div>
		</div>

	</div>

</div>

<div class="right">
	<div class="box">
		<p>
			<label for="save_submit">Save submissions?</label>
			<select name="save_submit" id="save_submit">
				<option <?=($item["save_submit"]==1)?"selected":"";?> value="1">Yes</option>
				<option <?=($item["save_submit"]==0)?"selected":"";?> value="0">No</option>
			</select>
		</p>
		<p>
			<label for="save_contact">Save contacts?</label>
			<select name="save_contact" id="save_contact">
				<option <?=($item["save_contact"]==1)?"selected":"";?> value="1">Yes</option>
				<option <?=($item["save_contact"]==0)?"selected":"";?> value="0">No</option>
			</select>
		</p>
		<p>
			<label for="send_mail">Email notifications?</label>
			<select name="send_mail" id="send_mail">
				<option <?=($item["send_mail"]==1)?"selected":"";?> value="1">Yes</option>
				<option <?=($item["send_mail"]==0)?"selected":"";?> value="0">No</option>
			</select>
		</p>

		<p><input type="submit" value="Save contactform" class="button blue"/></p>
	</div>
</div>