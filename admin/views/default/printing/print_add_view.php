<fieldset><legend><i><?=t('Add printer')?></i></legend>
<? if(count($printers)){ ?>
<table border="1" cellspacing="0" cellpadding="1">
<tr><th><?=t('Name')?></th><th><?=t('Action')?></th></tr>
<?      foreach($printers as $url=>$name){ ?>
<tr>
   <form action="<?=FORMPREFIX?>/printing/askadd" method="post">
      <input type="hidden" name="url" value="<?=$url?>"/>
      <input type="hidden" name="name" value="<?=trim($name," \"")?>"/>
      <td><?=$name?></td>
      <td><input type="submit" value='<?=t('Add')?>' name='printeradd'/></td>
	</form>
</tr>
<?    }?>
</table>
<?  }else{ ?>

<?=t('No printers attached')?><br/>
<form method="post" action="<?=FORMPREFIX?>/printing">
<input type="submit" value="<?=t('Back')?>"/>
</form>
<? } ?>
</fieldset>
