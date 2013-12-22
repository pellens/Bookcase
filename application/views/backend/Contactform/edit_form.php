<?=form_open();?>

<div class="left">

	<div class="tabs">

		<ul class="links">
			<li class="active" data-pane="edit">Edit contactform</li>
			<li data-pane="reply">E-mail settings</li>
		</ul>

		<div class="panes">
			<div class="pane active" data-pane="edit">

				<div class="form-contact-fields">
					<? if(isset($item["fields"])):?>

					<ul class="fields">

						
						<? foreach($item["fields"] as $field):?>
						
						<li id="field_<?=$field->id;?>">
							<i class="icon-reorder handle"></i>
							<span class="field_label"><?=$field->label;?></span>
							<span class="field_type"><?=$field->type;?></span>
							<span class="required"><?=($field->required==1)?"Required":"";?></span>
							<span class="actions">
								<?=anchor("admin/lib/contactform/edit_field/".$field->id,"Edit");?>
								<a href="#" data-id="<?=$field->id;?>" onclick='return deleteField(<?=$field->id;?>);' class"delete_field">Delete</a>
							</span>
						</li>

						<? endforeach;?>

					</ul>
					<? else: ?>
					<p class="empty">There are no fields assigned to this form...</p>
					<ul class="fields">
					</ul>
					<? endif;?>
				</div>

				<div class="form-contact-fields">
					<ul>
						<li>
							<i class="icon-plus handle"></i>
							<span class="field_label"><input type="text" id="label"></span>
							<span class="field_type">
								<select id="inputtype">
									<option value="text">Text</option>
									<option value="email">E-mail</option>
									<option value="textarea">Textarea</option>
									<option value="select">Select</option>
									<option value="checkbox">Checkbox</option>
									<option value="radio">Radiobutton</option>
								</select>
							</span>
							<span class="required">
								<input type="checkbox" id="required"/>Required
							</span>
							<span class="actions">
								<a href="#" class="add_field button green">Add field</a>
							</span>
						</li>
						<li class="option input">
							<i class="icon-angle-right handle"></i>
							<span class="field_label"><input type="text" id="option"></span>
							<span class="required">
							<a href="#" class="add_option button blue">Add option</a>
							</span>
						</li>
					</ul>
				</div>

			</div>

			<div class="pane" data-pane="reply">
			<input type="hidden" name="form_id" value="<?=$item["id"];?>"/>
				<p>
					<label for="reply_message">Reply message</label>
					<textarea name="reply_message" class="email-message" id="reply_message"><?=$item["messages"]["reply_message"];?></textarea>
				</p>
				<p class="info">If the user fills in the form, what message will they receive as confirmation?</p>

				<p>
					<label for="notification_message">Notfication message</label>
					<textarea name="notification_message" class="email-message" id="notification_message"><?=$item["messages"]["notification_message"];?></textarea>
				</p>
				<p class="info">What message will the form-administrator(s) receive?</p>

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

<?=form_close();?>

<script>

function deleteField(id)
{
	var answer = confirm("Are you sure?");
	if(answer)
	{
		$.post( "<?=base_url(lang().'/admin/lib/contactform/ajax_delete_field');?>", { id : id }).done(function( data ) {
			$("#field_"+id).remove();
		});
	}
	return false;
}

$(document).ready(function(){

	$("#inputtype").bind("change",function(){

		switch($(this).val())
		{
			case "radio" :
			case "checkbox" :
			case "select" : $("li.option").slideDown(75); break;
			default : $("li.option").slideUp(75); break;
		}

	});

	$(".add_option").bind("click",function(){

		var val = $("li.option.input #option").val();
		if(val != "" || val != " ")
		{
			var row = "<li class='option show'>";
				row+= "<i class='icon-angle-right handle'></i>";
				row+= "<span class='field_label'>"+val+"</span>";
				row+= "<span class='field_type'><a href='#' class='button red'>Delete</a></span>";
				row+= "</li>";
			$("li.option.input #option").val("");
			$(this).closest("ul").append(row);

		}

		return false;

	});

	$(".add_field").bind("click",function(){

		var fields 				= new Array();
			fields["options"]   = {};
			fields["label"] 	= $("#label").val();
			fields["inputtype"] = $("#inputtype").val();
			fields["required"]  = ($("#required").is(":checked")) ? 1 : 0;

		switch(fields["inputtype"])
		{
			case "radio" :
			case "checkbox" :
			case "select" :

				var i = 0;
				$("li.option.show").each(function(){
					fields["options"][i] = $(this).children(".field_label").html();
					i++;
				});

				break;
		}

		var field = {
  			0: {
  				form_id     : '<?=$item["id"];?>',
    			inputtype	: fields["inputtype"],
    			label 		: fields["label"],
    			required 	: fields["required"],
    			options     : fields["options"]
    		}
    	}

    	var fields = JSON.stringify(field);
    	$.post( "<?=base_url(lang().'/admin/lib/contactform/ajax_add_field');?>", { field: fields }).done(function( data ) {

    		var req = ($("#required").is(":checked")) ? "Required" : "&nbsp;";
    		console.log(req);
    		var row = "<li id='field_"+data+"'>";
    			row+= '<i class="icon-reorder handle"></i>';
    			row+= '<span class="field_label">'+$("#label").val()+'</span>';
    			row+= '<span class="field_type">'+$("#inputtype").val()+'</span>';
    			row+= '<span class="required">'+req+'</span>';
				row+= '<span class="actions">';
				row+= '<?=anchor("admin/lib/contactform/edit_field/'+data+'","Edit");?>';
				row+= '<a href="#" onclick="return deleteField('+data+');"" class="delete_field">Delete</a>';
				row+= '</span>';
				row+= '</li>';
    		$("ul.fields").append(row);

    		$("li.option.show").remove();
    		$("li.option").slideUp();
    		$("#label").val("");
    		$("p.empty").remove();

  		});


		return false;

	});

});

</script>