<?=t('Please confirm shutdown of Bubba Server')?><p/>

<form action="<?=FORMPREFIX?>/shutdown/confirm" method="post"><fieldset class="bform">
<input class='submitbutton' type='submit' name='cancel' value='<?=t('Cancel')?>'/>
<input class='submitbutton' type='submit' name='shutdown' value='<?=t('Power down')?>'/>
</fieldset></form>
