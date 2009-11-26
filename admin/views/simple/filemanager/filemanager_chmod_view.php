<fieldset><legend><i><?=t('Change permissions')?></i></legend>
<form method="post" action="<?=FORMPREFIX?>/filemanager/dochmod">
<? if (0 == $cnt) {?>
   <table>
	<tr><td><?=t('No files checked')?></td></tr>
	<tr><td><input type="submit" name="md_cancel" value="<?=t('Cancel')?>"></td></tr>
   </table>
<? }else{ ?> 
	   <fieldset><legend><?=t('Items')?></legend>
	   <div style="height: 250px; overflow: auto; ">
      <table>   
       <?for ($i = 0; $i < $cnt; $i++) {
            $name = urldecode($file_name[$file_id[$i]]);?>
            <tr>
            <td>
				<input type=hidden name="file_list[]" value="<?=$file_name[$file_id[$i]]?>"/>
				<?=$name?>
            </td>				
				</tr>
			<?}?>
		</table>
      </div>
      </fieldset>
   <hr/> 
   <table>
   <tr><td><b><?=t('Permissions')?></b></td><td><b><?=t('Read')?></b></td><td><b><?=t('Write')?></b></td><td></td></tr>
   <tr>
      <td><?=t('Owner')?></td>
      <td><input type="checkbox" name="ow_read" checked="checked" disabled="disabled"/></td>
      <td><input type="checkbox" name="ow_write" checked="checked" disabled="disabled"/></td>
      <td width="50%"></td>
   </tr>
   <tr>
      <td><?=t('Users')?></td>
      <td><input type="checkbox" name="u_read" checked="checked"/></td>
      <td><input type="checkbox" name="u_write" checked="checked"/></td>
      <td width="50%"></td>
   </tr>
   <tr>
      <td><?=t('Other')?></td>
      <td><input type="checkbox" name="o_read"/></td>
      <td><input type="checkbox" name="o_write"/></td>
      <td width="50%"></td>
   </tr>
   <tr>
   	<td><input type="submit" name="md_cancel" value="<?=t('Cancel')?>"/></td>
   	<td><input type="submit" name="perm_confirm" value="<?=t('Change')?>"/></td>
   	<td colspan="2"></td>
   </tr>
   </table>
   <? } ?>   
   <input type="hidden" name="path" value="<?=$path?>"/>
   </form>
   </fieldset>   
