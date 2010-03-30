
<script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME?>/_js/periodicalUpdate.js?v='<?=$this->session->userdata('version')?>'"></script>
<script type="text/javascript">
$(document).ready(function(){
	$("#downloadcontent").PeriodicalUpdate(
		{
		url:'<?=FORMPREFIX?>/downloads/dolist',
		delay:2000,
		delayed:true
		}
	);
		
	$("#download-addurl").focus();		
	});
</script>

<div class="ui-state-default ui-div-header"><?=t('Downloads')?></div>
<div style="height: 300px; overflow: auto; " id="downloadcontent"></div>

<div class="ui-state-default ui-div-header"><?=t('Add new download')?></div>
<form action="<?=FORMPREFIX?>/downloads/add" method="post" id="add_download">
<table class="ui-table-outline">
<tr>
   <td style="width: 10%; text-align: left; "><?=t('Location')?></td>
   <td style="width: 90%; text-align: center; "><input id="download-addurl" type="text" name="url" size="40"/></td>
</tr>
<tr>
<td>
	<input type="hidden" name="uuid" value="<?=$uuid?>" />
	<input type="submit" name="add_download" value="<?=t('Add')?>" />
</td>
</tr>
</table>
</form>
