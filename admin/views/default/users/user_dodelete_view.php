<fieldset><legend><?=t('Delete user')?></legend>
<? if($delusersuccess){?>
<?=t('User')?> '<?=$uname?>' <?=t('deleted')?><br/>
	<? if($deluserdata){
			if($deldatasuccess){?>
<?=t('Deleted userdata')?>
			<?}else{?>
<?=t('Failed to delete userdata')?>
			<?}?>
	<?}?>
<? } else { ?>
<?=t('Failed to delete user')?> '<?=$uname?>'<br/>
<?=t('This could be due to this user being currently logged in')?><br/>
<? } ?>
<form action="<?=FORMPREFIX?>/users" method="post">
<input type="submit" value="<?=t('Back')?>"/>
</form>
</fieldset>