<script type="text/javascript">
<!--

$(document).ready(function(){

	$("#ntp").change(function() {
		if($(this).attr('checked')) {
			$(".timedate").attr("disabled","true");
		} else {
			$(".timedate").removeAttr("disabled");
		}	
	})

});

// -->
</script>

<?
if($this->session->userdata("run_wizard")): // wizard is running
?>
	<h1 class="wizard-header"><?=t('wizard-title-lang')?></h1>

		<form action="<?=FORMPREFIX?>/settings/wizard_lang" method="post">
		<div id="ui-wizard-language">
			<table>
				<thead>
				  <tr><th colspan="4"><h2><?=t('Default system language')?></h2></th></tr>
			  </thead>
			  <tbody>

				<tr class="ui-header">
				   <td>
				   	<label for="system_language">
						<?
						print t('system_language');
						?>
			   	   	</label>
			   	   </td>
				   <td>
				   	  <select name="wiz_data[lang]"> 
				   	  	
				   	  	<?
				   	  	print_r($wiz_data['available_languages']);
			   	  		foreach($wiz_data['available_languages'] as $lang) {
			   				if($lang['status'] != 'official') {
			   	  				$user_languages[] = $lang;
			   	  				continue;
			   	  			}
					 		print "<option id='option_".$lang["short_name"]."' value='".$lang["short_name"]."'";
					 		print (isset($lang['default']) && $lang['default'])?" selected='SELECTED'":"";
					 		print ">";
					 		print $lang["long_name"];
					 		print "</option>\n";
			   	  						   	  			
			   	  		}
			     		if(sizeof($user_languages)) {
			     			print "<optgroup label='".t("User contributed languages")."'>";
			     			
				     		foreach($user_languages as $lang) {
				     			if($lang['status'] != 'user') continue;
					 		print "<option id='option_".$lang["short_name"]."' value='".$lang["short_name"]."'";
					 		print (isset($lang['default']) && $lang['default'])?" selected='SELECTED'":"";
					 		print ">";
					 		print $lang["long_name"];
					 		print "</option>\n";
				     			
				     		}
			     			print "</optgroup>";
			     		}?>
					  </select>
				   
				   </td>
				</tr>
				<tr ><td colspan="2"><span class="wiz_spacer">&nbsp;</span><input class='submitbutton' type='submit' id="wizard_next" name="wiz_data[postingpage]" value='<?=t('Next')?>'/></td></tr>
			</tbody>		
			</table>
		</div>
		
		</form>
<?
  else : // show start wizard page
?>
		<form action="<?=FORMPREFIX?>/settings/wizard_lang" method="post">
			<table class="ui-table-outline">
				<thead>
			    <tr><td colspan="4" class="ui-state-default ui-widget-header"><?=t('Setup wizard')?></td></tr>
				</thead>
			</table>
			<table>
				<tbody>
				<tr><td>
					<?=t('settings-start-wizard')?>					
				</td></tr>
				</tbody>
				<tfoot>
				<tr><td>
					<input type="submit" class="submitbutton"  name='wiz_data[start]' value="<?=t('Start setup wizard')?>"/>
				</td></tr>
				</tfoot>
			</table>
		</form>
<? endif ?>
