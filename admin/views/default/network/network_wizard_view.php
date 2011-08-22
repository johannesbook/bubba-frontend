<script type="text/javascript">

$(document).ready(function(){


	$("#en_easyfind").change(function() {
		if($(this).attr('checked')) {
			$("#easyfind_name").removeAttr("disabled");
			$("#easyfind_name").select();
		} else {
			$("#easyfind_name").attr("disabled","true");
			if($("#easyfind_name").val() == "") {
				$("#easyfind_name").val(easyfind_name);
			}
		}	
	})

	$("#easyfind_name").bind("keyup", function() {
    $("#mybubba").html($("#easyfind_name").val());
  });
	
	// do not use validator here at the moment.
	/* 
	var validator = $('#fn-network-wizard-form').validate({
		rules: {
			'wiz_data[easyfind_name]': {
				'required': true
			}
		}
	});
	*/
});
	
</script>


	<? if(isset($confirmed)): ?>
	<h1 class="wizard-header">
		<?=_('Setup complete')?>
	</h1>
	<form action="<?=FORMPREFIX?>/network/wizard" method="post" >
		<table id="wizard">
			<tr><td colspan="2"><?=sprintf(_("Enjoy %s"), NAME)?></td></tr>
			<tr><td><input class='submitbutton' type='submit' name='wiz_data[cancel]' value='<?=_('Finish setup')?>'/></td></tr>
		</table>
	</form>
		
	<?else:?>
	<h1 class="wizard-header"><?=_("Step 4/4: Network setup")?></h1>

	<form action="<?=FORMPREFIX?>/network/wizard" method="post" id="fn-network-wizard-form">
		<table id="wizard">
			<thead>
				<tr><th class="ui-wizard-label-header"><h2><?=_("Easyfind")?></h2></th></tr>
			</thead>
			<tbody>
				<tr class="ui-header">
					<td><?=sprintf(_("To locate %s from the internet, use 'Easyfind' location service"), NAME)?></td>
					<td><input id="en_easyfind" name="wiz_data[en_easyfind]" type="checkbox" class="slide" <?=(isset($wiz_data['easyfind']['name'])&&$wiz_data['easyfind']['name']) || (isset($wiz_data['err_easyfind']) && $wiz_data['err_easyfind'])?"checked='checked'":""?>/></td>
				</tr>


				<?
				/*
				<tr class="ui-header">
					<td colspan="2"><?=print_r($wiz_data)?></td>
				</tr>
				*/
				?>
				<tr class="ui-header">
					<td colspan="2">
					<input
						<?=(isset($wiz_data['err_easyfind'])&&$wiz_data['err_easyfind'])?"class='highlight'":""?>
						id="easyfind_name" 
						name="wiz_data[easyfind_name]" 
						type="text" 
						value="<?=(isset($wiz_data['easyfind']['name'])
									&& $wiz_data['easyfind']['name']) 
									|| (isset($wiz_data['err_easyfind']) && $wiz_data['err_easyfind'])
								?$wiz_data['easyfind']['name']:_("your-easyfind-name")?>"
						<?=(isset($wiz_data['easyfind']['name'])
							&&$wiz_data['easyfind']['name']) 
							|| (isset($wiz_data['err_easyfind']) && $wiz_data['err_easyfind'])
													?"":" disabled='disabled' "?>/>
					    (http://<span id="mybubba"><?=isset($wiz_data['easyfind']['name'])
					    								&&$wiz_data['easyfind']['name']
												?$wiz_data['easyfind']['name']:_("your-easyfind-name")?></span>.<?=$wiz_data['easyfind']['domain']?>)
					    <?if(isset($wiz_data['err_easyfind']) && $wiz_data['err_easyfind']):?>
					 	<br>
					 		<?if(isset($wiz_data['err_easyfind_empty']) && $wiz_data['err_easyfind_empty']):?>
								<span class='ui-state-error-text'><?=_("Empty name not allowed")?></span>
					 		<?else:?>
					 			<span class='ui-state-error-text'><?=$wiz_data['err_easyfind']?></span>
					 		<?endif?>
					 <?endif?>
					</td>
				</tr>
			</tbody>
		</table>
		<div class="ui-wizard-controls">
			<input class='submitbutton' type='submit' id="wizard_back" name='wiz_data[back]' value='<?=_("Back")?>'/>
			<span class="wiz_spacer">&nbsp;</span>
			<input class='submitbutton' type='submit' id="wizard_next" value='<?=_("Next")?>'/>
			<input type="hidden" value="0" name="wiz_data[postingpage]" id="post_value"/>
		</div>
	</form>


<?endif?>
