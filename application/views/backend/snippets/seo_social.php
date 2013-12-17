<?
	$desc 		= "";
	$keywords 	= "";
	$follow     = "";
	$index      = "";
	$revisit    = "";

	if(isset($item)):
		$desc 		= $item->meta_description;
		$keywords 	= $item->meta_keywords;
		$follow 	= $item->follow;
		$index  	= $item->index;
		$revisit 	= $item->revisit;
	endif;
?>
<div class="form-seo">
	<p>
		<label for="meta_description">Description</label>
		<span class="info">What will be the description in the search results of Google etc.</span>
		<textarea name="meta_description" id="meta_description"><?=$desc;?></textarea>
	</p>
	<p>
		<label for="meta_keywords">Keywords</label>
		<textarea name="meta_keywords" id="meta_keywords"><?=$keywords;?></textarea>
	</p>
</div>
<div class="form-inline">
	<p>
		<label for="follow">Follow</label>
		<select name="follow" id="follow">
			<option value="follow" <?=($follow == "follow") ? "selected='selected'" : "";?>>Follow</option>
			<option value="nofollow" <?=($follow == "nofollow") ? "selected='selected'" : "";?>>No follow</option>
		</select>
	</p>
	<p>
		<label for="index">Index</label>
		<select name="index" id="index">
			<option value="index" <?=($index == "index") ? "selected='selected'" : "";?>>Index</option>
			<option value="noindex" <?=($index == "noindex") ? "selected='selected'" : "";?>>No index</option>
		</select>
	</p>
	<p>
		<label for="revisit">Revisit</label>
		<select name="revisit" id="revisit">
			<option <?=($revisit == "1 day") ? "selected='selected'" : "";?> value="1 day">After 1 day</option>
			<option <?=($revisit == "2 days") ? "selected='selected'" : "";?> value="2 days">After 2 days</option>
			<option <?=($revisit == "7 days") ? "selected='selected'" : "";?> value="7 days">After 7 days</option>
			<option <?=($revisit == "14 days") ? "selected='selected'" : "";?> value="14 days">After 14 days</option>
		</select>
	</p>
</div>