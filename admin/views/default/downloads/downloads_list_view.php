<table  class="ui-table-outline" id="ui-downloads-list">
<?	foreach($dls as $dl):
		if($dl["size"]==0){
			$dld=0;
		}else{
			$dld=($dl["downloaded"]/$dl["size"])*100;
		}
		if(!($dl["policy"]&&DLP_HIDDEN)):
?>
<tr><td>
	<table class="ui-downloads-listitem">
		<tr>
			<td style=""><b><?=substr($dl["name"], 0, 50)?></b></td>
			<td colspan="2" style="text-align: right; width: 50%"><div class="progress-main"><div class="progress-meter" style="width: <?=$dld?>%"><b><?printf("%d%%",$dld)?></b></div></div></td>
		</tr>
		<tr>
			<td style="width: 80%;">
		<? 	if($dl["info"]["type"]=="torrent"){
					$dt=$dl["info"];
					if($dt["state"]=="downloading"){ ?>
			<small><b><?=t('Downloading')?></b> (<?=$dt["num_seeds"]?> <?=t('seeds')?> <?=$dt["num_peers"]?> <?=t('peers')?>)<br/>
			DL: <?=sizetohuman($dt["download_payload_rate"])?>B/s (<?=sizetohuman($dt["total_payload_download"])?>B) UL: <?=sizetohuman($dt["upload_payload_rate"])?>B/s (<?=sizetohuman($dt["total_payload_upload"])?>B) </small>			
		<?			}elseif($dt["state"]=="queued_for_checking"){ ?>
			<small><b><?=t('Queued for checking')?></b></small>
		<?			}elseif($dt["state"]=="checking_files"){ ?>
			<small><b><?=t('Checking existing files')?></b></small>
		<?			}elseif($dt["state"]=="connecting_to_tracker"){ ?>
			<small><b><?=t('Connecting to tracker')?></b> (<?=$dt["num_seeds"]?> <?=t('seeds')?> <?=$dt["num_peers"]?> <?=t('peers')?>)<br/>
			DL: <?=sizetohuman($dt["download_payload_rate"])?>B/s (<?=sizetohuman($dt["total_payload_download"])?>B) UL: <?=sizetohuman($dt["upload_payload_rate"])?>B/s (<?=sizetohuman($dt["total_payload_upload"])?>B) </small>
		<?			}elseif($dt["state"]=="finished"){ ?>
			<small><b><?=t('Done downloading (But missing data)')?></b></small>
		<?			}elseif($dt["state"]=="seeding"){ ?>
			<small><b><?=t('Seeding')?></b> (<?=$dt["num_seeds"]?> <?=t('seeds')?> <?=$dt["num_peers"]?> <?=t('peers')?>)<br/>
			DL: <?=sizetohuman($dt["download_payload_rate"])?>B/s (<?=sizetohuman($dt["total_payload_download"])?>B) UL: <?=sizetohuman($dt["upload_payload_rate"])?>B/s (<?=sizetohuman($dt["total_payload_upload"])?>B) </small>
		<?			}elseif($dt["state"]=="allocating"){ ?>
			<small><b><?=t('Allocating disk')?></b></small>
		<?			}elseif($dt["state"]=="unknown"){ ?>
			<small><b><?=t('Unknown state')?></b></small>
		<?			}elseif($dt["state"]=="failed"){ ?>
			<small><b><?=t('Download failed')?></b> - <?=$dt["errmsg"]?></small>
		<?			}elseif($dt["state"]=="no_info"){ ?>
			<small><b><?=t('No info')?></b></small>
		<?			}else{ ?>
		<?			}?>
		<?	} elseif($dl["info"]["type"]=="curl"){ ?>
			<small><?=t('Download speed')?>: <?=sizetohuman($dl["info"]["speed"])?>B/s</small>
		<? 	} else { ?>
		<? 	} ?>
			</td>
			<td style="text-align: right;"><?=t("Size")?>: <?=sizetohuman($dl["size"])?></td>
			<td style="width: 15%;text-align: right; padding: 0px; vertical-align: top; ">
				<form action="<?=FORMPREFIX?>/downloads/remove" method="post">
					<input type="hidden" name="url" value="<?=$dl["url"]?>"/>
					<input type="hidden" name="uuid" value="<?=$dl["uuid"]?>"/>
					<input type="submit" name="do" value="<?=t('Cancel')?>"/>
				</form>
			</td>
		</tr>
	</table>
</td></tr>
<? 	endif;
endforeach;
?>
</table>

