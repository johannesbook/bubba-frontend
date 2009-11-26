
<script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME?>/_js/periodicalUpdate.js"></script>
<script type="text/javascript">
$(document).ready(function(){
		$("#downloadcontent").PeriodicalUpdate(
			{
			url:'<?=FORMPREFIX?>/downloads/dolist',
			delay:2000,
			delayed:true
			}
		);
		}
	);
</script>

<fieldset><legend><i><?=t('Downloads')?></i></legend>
<div style="height: 300px; overflow: auto; " id="downloadcontent">
</div>
</fieldset>

<fieldset><legend><?=t('Add new download')?></legend>
<form action="<?=FORMPREFIX?>/downloads/add" method="post" id="add_download">
<table>
<tr>
   <td style="width: 10%; text-align: left; "><?=t('Location')?></td>
   <td style="width: 90%; text-align: center; "><input type="text" name="url" size="40"/></td>
</tr>
<tr>
<td>
	<input type="hidden" name="uuid" value="<?=$uuid?>" />
	<input type="submit" name="add_download" value="<?=t('Add')?>" />
</td>
</tr>
</table>
</form>
</fieldset>
