<div class="full">

	<h2>Jobs</h2>

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
						<td><?=strip_tags($job->description);?></td>
						<td><?=date("d M Y",$job->date);?></td>
						<td class="actions">
							<?=anchor("admin/lib/jobs/del_job/".$job->id,"<i class='fa fa-times'></i>","class='del' data-alert='Are you sure you want to delete this job?'");?>
						</td>
					</tr>
				<? endforeach;?>
			</tbody>
		</table>

	</div>

	<div class="block">

		<div class="stats">
			<ul>
				<li><?=count($list);?> jobs</li>
			</ul>
		</div>

	</div>

</div>