<div class="full">

	<h2>Jobs <?=anchor("admin/lib/jobs/add_job","New job","class='button light'");?></h2>

	<div class="block">
		
		<table class="table table-bordered">
			<thead>
				<tr>
					<td><input type="checkbox"/></td>
					<th>Job title</th>
					<th>Description</th>
					<th>Added</th>
					<th>&nbsp;</th>
				</tr>
			</thead>
			<tbody>
				<? foreach($list as $job):?>
					<tr>
						<td width="1%"><input type="checkbox"/></td>
						<td><?=anchor("admin/lib/jobs/edit_job/".$job->id,$job->title);?></td>
						<td><?=character_limiter(strip_tags($job->description),40);?></td>
						<td><?=date("d M Y",$job->date);?></td>
						<td class="actions">
							<?=anchor("admin/lib/jobs/del_job/".$job->id,"<i class='fa fa-times'></i>","class='del' data-alert='Are you sure you want to delete this job?'");?>
						</td>
					</tr>
				<? endforeach;?>
			</tbody>
		</table>

	</div>

	<div class="block stats">
		<ul>
			<li><i class="fa fa-bullhorn"></i> <?=count($list);?> jobs</li>
		</ul>
	</div>

</div>