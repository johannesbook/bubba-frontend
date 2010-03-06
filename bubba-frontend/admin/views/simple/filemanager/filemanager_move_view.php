<fieldset><legend><i><?=t('Move items')?></i></legend>
<script type="text/javascript">
	function doChange(path){
		var mv_path=document.getElementById("mv_path");
		var sel=document.getElementById("sel_add_item");
		if(sel){
			sel.disabled=true;
		}
		if(mv_path){
			mv_path.value=path;
			var inp=document.createElement("input");
			inp.type="hidden";
			inp.name="action";
			inp.value="move";
			var frm=document.getElementById("moveform");
			frm.appendChild(inp);
			frm.submit();
		}
	}

	function doAddDir(){
		var sel=document.getElementById("sel_add_item");
		if(sel){
			if(sel.selectedIndex>0){
				var inp=document.createElement("input");
				inp.type="hidden";
				inp.name="adddir";
				inp.value="do";
				var frm=document.getElementById("moveform");
				frm.appendChild(inp);
				frm.submit();
			}
		}
	}	
</script>
<form id="moveform" method="post" action="<?=FORMPREFIX?>/filemanager/move">
	<input type="hidden" name="path" value="<?=$path?>"/>
	<input id="mv_path" type="hidden" name="mv_path" value="<?=b_enc($mv_path)?>"/>
	<fieldset><legend><?=t('Items')?></legend>
	<div style="height: 270px; overflow: auto; ">
	<table>
	<? foreach($mv_items as $item) {
		$name = urldecode($item);?>
		<tr>
		<td>
			<input type=hidden name="mv_item[]" value="<?=$item?>">
			<?=basename($name)?>
		</td>
		</tr>			
	<?}?>
	</table>
	</div>
	</fieldset>
	<hr/>
	<fieldset><legend><i><?=t('Destination')?></i></legend>
	<table>
	<tr>
		<td><?=$pathlink?></td>
	</tr>
	<tr>
<? if(count($dirs)>0){ ?>
	<td>
		<select id="sel_add_item" name="add_item" onChange="doAddDir()">
			<option><?=t('Folders in')?> <?=basename($bpath)?></option>
<?		foreach($dirs as $line){ ?>
			<option value="<?=b_enc($line[3])?>"><?=$line[3]?></option>
<?		}?>
		</select>
	</td>
<? }?>            
</tr>			
</table>
</fieldset>
<hr/>
<input type="submit" name="mv_cancel" value="<?=t('Cancel')?>"/>
<input type="submit" name="mv_confirm" value="<?=t('Move items')?>"/>
</form>
</fieldset>
