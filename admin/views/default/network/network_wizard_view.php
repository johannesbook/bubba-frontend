<script type="text/javascript">
<!--

$(document).ready(function(){


	$("#en_easyfind").change(function() {
		if($(this).attr('checked')) {
			$("#easyfind_name").removeAttr("disabled");
      if($("#easyfind_name").val() == <?="\"".t("Set easyfind name")."\""?>) {
			  $("#easyfind_name").val("");
			  $("#mybubba").text("");
			}
		} else {
			$("#easyfind_name").attr("disabled","true");
      if($("#easyfind_name").val() == "") {
			  $("#easyfind_name").val(<?="\"".t("Set easyfind name")."\""?>);
			}
		}	
	})

	$("#easyfind_name").bind("keyup", function() {
    $("#mybubba").html($("#easyfind_name").val());
  })

});
	
// -->
</script>


	<? if(isset($confirmed)) { ?>
	<h1 class="wizard-header">
		<?=t('Setup complete')?>
	</h1>
	<form action="<?=FORMPREFIX?>/network/wizard"" method="post">
		<table id="wizard">
			<tr><td colspan="2"><?=t('Setup is now complete.')?></td></tr>
			<tr><td colspan="2"><?=t('Enjoy Bubba|2.')?></td></tr>
			<tr><td><input class='submitbutton' type='submit' name='wiz_data[cancel]' value='<?=t('Finish setup')?>'/></td></tr>
	</form>
		
	<?	
	} else {
		// ----   Default page  ------
	?>
	<h1 class="wizard-header"><?=t('Step 3/3: Network setup')?></h1>
	<? /*
	print "<pre>";
	print_r($wiz_data);
	print "</pre>"; */
	?>
	<form action="<?=FORMPREFIX?>/network/wizard"" method="post">
		<table id="wizard">
		  <tr><td class="ui-wizard-label-header"><h2><?=t("Easyfind")?></h2></td></tr>
			<tr class="ui-header"><td><?=t("To locate Bubba|2 from the internet, use 'Easyfind' location service")?> <input id="en_easyfind" name="wiz_data[en_easyfind]" type="checkbox" class="slide" <?=isset($wiz_data['en_easyfind'])?"CHECKED":""?>/></td></tr>
			<tr class="ui-header"><td>
				<input
					<?=(isset($wiz_data['err_easyfind'])&&$wiz_data['err_easyfind'])?"class='highlight'":""?>
					id="easyfind_name" 
					name="wiz_data[easyfind_name]" 
					type="text" 
					value="<?=isset($wiz_data['easyfind_name'])?$wiz_data['easyfind_name']:t("Set easyfind name")?>" <?=isset($wiz_data['en_easyfind'])?"":"DISABLED"?>/>
				 (http://<span id="mybubba"><?=isset($wiz_data['easyfind_name'])?$wiz_data['easyfind_name']:t("mybubba")?></span>.bubbaserver.com)
				 <?if(isset($wiz_data['err_easyfind']) && $wiz_data['err_easyfind']):?>
				 	<br><span class='ui-state-error-text'><?=t("Name not available or failed to validate request")?></span>
				 <?endif?>
			</td></tr>
		
			<tr>
				<td>
					<input class='submitbutton' type='submit' id="wizard_back" name='wiz_data[back]' value='<?=t('Back')?>'/>
					<span class="wiz_spacer">&nbsp;</span>
					<input class='submitbutton' type='submit' id="wizard_next" value='<?=t('Next')?>'/>
					<input type="hidden" value="0" name="wiz_data[postingpage]" id="post_value"/>
				</td>
			</tr>
		</table>
	</form>


<? } ?>
