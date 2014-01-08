<div class="uploadholder"><?=$this->media->upload_form("uploads")?></div>
<div id="test"></div>
<div class="divider"></div>

<script>
function triggerPopup(file)
{
	window.open("<?=base_url('admin/crop?image="+file+"');?>", "_blank", "width=600,height=300,scrollbars=no,toolbar=no, status=no,location=no,resizable=yes,screenx=0,screeny=0"); return false;
}
</script>