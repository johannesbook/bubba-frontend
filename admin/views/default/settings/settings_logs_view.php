<form action="<?=FORMPREFIX?>/settings/logs" method="post">

	<table>
	   <tr><td colspan="4" class="ui-state-default ui-widget-header"><?=t('Show logs')?></td></tr>
	</table>
		<select name="log" id="settings_log">
			<?foreach( $logs as $name => $path ):?>
				<?if(is_array($path)):?>
				<optgroup label="<?=$name?>">
					<?foreach( $path as $inner_name => $inner_path ):?>
					<option <?if(isset($log_name)&& $log_name == $inner_path){echo "selected=\"selected\"";}?> label="<?=$inner_name?>" value="<?=$inner_path?>"> <?=$inner_name?> </option>
					<?endforeach?>
				</optgroup>
				<?else:?>
				<option <?if(isset($log_name)&& $log_name == $path){echo "selected=\"selected\"";}?> label="<?=$name?>" value="<?=$path?>"> <?=$name?> </option>
				<?endif?>
			<?endforeach?>
		</select>
		<input type="submit" value="<?=t('Show')?>"/>
	</fieldset>
</form>
<?if(isset($log_name)):?>
<fieldset>
	<legend><i><?=$log_name?></i></legend>
	<div class="log">
		<?$n=0;foreach( $content as $line):?>
		<div class="line<?=$n++%2?>"><?=htmlspecialchars($line)?></div>
		<?endforeach?>
	</div>
<?endif?>
