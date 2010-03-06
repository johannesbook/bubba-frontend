<p style="font-size: large; text-align: center; "><?=t('Welcome to Bubba mini server')?>.</p>
<fieldset><legend><i><?=t('Info')?></i></legend>
<table border="0" cellspacing="0" cellpadding="1">
<tr><td><?=t('Total disk size')?></td><td><?=$totalspace?> MB</td></tr>
<tr><td><?=t('Free disk space')?></td><td><?=$freespace?> MB</td></tr>
<tr><td></td><td>
<table cellpadding="0" cellspacing="0" border="0" style="margin: 0px; padding: 0px; width: 100px; ">
<tr style="height: 17px; "><td style="width: <?=$percentused?>%;" bgcolor="#1E90FF"></td><td style="width: <?=100-$percentused?>%;" bgcolor="#8FC4FD"></td></tr>
</table>
</td>
</tr>
<tr><td colspan="2"><hr/></td></tr>
<tr><td><?=t('Uptime')?></td><td>
<? if($uptime[0]>0) print($uptime[0]." ".t('days')." "); ?>
<? printf("%02d",$uptime[1])?>:<? printf("%02d",$uptime[2])?>:<? printf("%02d",$uptime[3])?>
</td></tr>
</table>
</fieldset>
<?php if ($this->session->userdata('user')=="admin") {?>
<br/>
<form action="shutdown" method="post"><fieldset >
<table>
<tr><td><?=t('Press button to shut down Bubba Server now')?>.</td></tr>
<tr><td><input class='submitbutton' type='submit' name='powerdown' value='<?=t('Power down')?>'/></td></tr>
</table>
</fieldset></form>
<?php } ?>
