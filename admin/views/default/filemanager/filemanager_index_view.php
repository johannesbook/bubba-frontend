<fieldset><legend><b><?=$pathlink?></b></legend>
<? if($success){ 
	$k=0;
	$disabled=$writable?'':'disabled="disabled" ';
?>
<table cellpadding="2" cellspacing="4" border="0" style="width: 700px;">
<tr>
	<th width="3%"></th>
	<th width="3%"></th>
	<th width="57%" align="left" colspan="2"><?=t('Name')?></th>
	<th width="10%" align="center"><?=t('Size')?></th>
	<th width="27%" align="center"><?=t('Date')?></th>
</tr>
</table>
<form id="filemanagerform" method="post" action="<?=FORMPREFIX?>/filemanager">
<div style="height: 350px; overflow: auto; " id="filecontents">
<table cellpadding="2" cellspacing="4" border="0" style="width: 700px;">
<? foreach($dirs as $dir){?>
<tr>
	<td width="3%">
		<input type="hidden" name="file_name[]" value="<?=b_enc($path."/".$dir[3])?>"/>
		<input type="checkbox" class="file checkbox_radio" name="file_id[]" value="<?=$k++?>"/>
	</td>
	<td width="3%">[DIR]</td>
	<td width="57%">
		<a href="<?=FORMPREFIX?>/filemanager/cd<?=$path."/".($dir[3])?>"><? print substr($dir[3], 0, 50)?></a>
	</td>
	<td width="10%"align="right">&nbsp;</td>
	<td width="27%" align="right"><?=str_replace(' ','&nbsp;',$dir[2])?></td>
</tr>
<? } ?>
<? foreach($files as $file){?>
<tr>
	<td width="3%">
		<input type="hidden" name="file_name[]" value="<?=b_enc($path)?>/<?=b_enc($file[3])?>"/>
		<input type="checkbox" class="file checkbox_radio" name="file_id[]" value="<?=$k++?>"/>
	</td>
	<td width="3%">[FILE]</td>
	<td width="57%">
	<a href="<?=FORMPREFIX?>/filemanager/download<?=$path."/".($file[3])?>"><? print substr($file[3], 0, 50)?></a>
	</td>
	<td width="10%"align="right"><?=$file[1]?></td>
	<td width="27%" align="right"><?=str_replace(' ','&nbsp;',$file[2])?></td>
</tr>
<? } ?>
</table>
</div>
<tr><td colspan="3"><hr width="100%"/></td></tr>
<tr>
<td><input type="submit" title="<?=t('Make new folder in current folder')?>" <?=$disabled?>name="mkdir" value="<?=t('Create folder')?>"/></td>
<td>
	<? if($ftd_running){?>
		<script type="text/javascript">
			var index=0;
			function pop(name,width,height){
				var size="width="+width+",height="+height;
				window.open(name,"",size);
			}
		</script>
		<input type="button" title="<?=t('Upload files to current folder')?>" <?=$disabled?>value="Upload files" onclick="pop('<?=FORMPREFIX?>/upload/index<?=$path?>',500,250)" />
	<? } ?>
</td>
<td>
	<script type="text/javascript">
		function doChange(){
			var sel=document.getElementById("sel_action");
			if(sel){
					if(sel.selectedIndex>0){
						document.getElementById("filemanagerform").submit();
						document.getElementById("filemanagerform").reset();
					}
			}
		}
	</script>
	<select id="sel_action" name="action" onChange="doChange()">
		<option><?=t('Other actions')?></option>
		<option value="download" title="<?=t('Download selected files and folders in a zip archive')?>"><?=t('Download as zip')?></option>
		<option <?=$disabled?>value="move" title="<?=t('Move selected files and folders')?>"><?=t('Move')?></option>
		<option <?=$disabled?>value="permissions" title="<?=t('Change permissions on selected files and folders')?>"><?=t('Change permissions')?></option>
		<option <?=$disabled?>value="delete" title="<?=t('Delete selected files and folders')?>"><?=t('Delete')?></option>
<?if($pictures):?>
		<option value="album" title="<?=t('Add selected items to album')?>"><?=t('Add to album')?></option>
<?endif?>
		
	</select>           
	<input type="hidden" name="path" value="<?=b_enc($path)?>"/>
</td>
</tr>           
</table>
</form> 
<? }else{ ?>
<? if($err_perm){?>
<? printf(t('Invalid path or access denied for user \'%s\''),$user); ?><br/>
<? } ?>
<? } ?>
</fieldset>
