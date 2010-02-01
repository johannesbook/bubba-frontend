<script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME?>/_js/jquery.progress.js?v='<?=$this->session->userdata('version')?>'"></script>
<style>

div.hotfix {
	margin-top : 10px;
	vertical-align : middle;
}
div.hotfix *{
	vertical-align : middle;
	margin-right : 10px;
}

fieldset.update {
	min-height : 135px;
}

#package_versions td {
	font-size : 0.8em;
}

.notifications {
width: 600px;
}

</style>
<script>

function print_versions() {
	
	$.post("/admin/settings/fwupdate",{ action: 'get_versions' },function(data) {
		
		$("#package_versions_body").empty();
		jQuery.each(data, function(package_name,package_version) {
			
			var tr = $("<tr />").addClass("package_row");
			tr.append(
				$("<td>").addClass("packagename").text(package_name)
			);
			tr.append(
				$("<td>").addClass("packageversion").text(package_version)
			);
			$("#package_versions_body").append(tr);
		})
	}
	,"json");
	
}

$(document).ready(function(){
	
		print_versions();
		
    $("#update").submit(function(){
        action = $('#apt_type').val();
        package = $('#apt_package').val();
		hotfix_enabled = $('#hotfix_enabled').is(':checked');
        data = { action: action };
        if( action == 'install' ) {
          data.package = package;
        }
        meter = new $.progress();
        meter.update( 0, '<?=t('Preparing to')?> <?=$action=='install'?t("install $package"):t("update system")?>' );
        $("#updater").remove();
		$("#progress").append( meter.root() );
		function upgrade() {
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: "/admin/settings/fwupdate",
            data: data ,
            timeout: 20000,
            success: function( data ) {
              waiting = false;
              tim = setInterval(
                function() {
                  if( waiting ) return;
                  waiting = true;
                  $.ajax({
                      type: 'POST',
                      url: "/admin/settings/fwupdate",
                      data: { action: 'progress' },
                      timeout: 5000,
                      dataType: 'json',
                      success: function(data) {
                        meter.update( data.progress, data.statusMessage);
                        meter.poke();
                        if( data.done ) {
                          meter.update( data.progress, "");
                          meter.is_done();
                          clearInterval( tim );

						  if( ! data.logs['ERROR'] ) {
							  $('#results').append(
								  $('<tr/>')
								  .addClass('notification notification-DONE')
								  .append( 
									  $('<td/>').addClass('notification-type').html("<img src='<?=FORMPREFIX.'/views/'.THEME?>/_img/upgrade_complete.png' />")
								  )
								  .append(
									  $('<td/>').addClass('notification-content')
									  .append(
										  $('<div/>').addClass('notification-desc').html( data.statusMessage )
									  )
								  )
							  );
							  print_versions();
						  }

                          order = [
                            'DONE',
                            'ERROR',
                            'WARN',
                            'NOTE',
                            'DEBUG'
                          ];

                          typemap = {
                            'DONE' : 'Completed',
                            'ERROR': 'Error!',
                            'WARN' : 'Warning',
                            'NOTE' : 'Note',
                            'DEBUG': 'Debug'
                          };
                          iconmap = {
                            'DONE' : "<?=FORMPREFIX.'/views/'.THEME?>/_img/upgrade_complete.png",
                            'ERROR': "<?=FORMPREFIX.'/views/'.THEME?>/_img/upgrade_error.png",
                            'WARN' : "<?=FORMPREFIX.'/views/'.THEME?>/_img/upgrade_warning.png",
                            'NOTE' : "<?=FORMPREFIX.'/views/'.THEME?>/_img/upgrade_note.png",
                            'DEBUG': "<?=FORMPREFIX.'/views/'.THEME?>/_img/upgrade_note.png"
                          };
                          

                          if( data.logs ) {
                            for( var i = 0; i < order.length; ++i ) {
                              cur = data.logs[order[i]];
                              if( ! cur ) {
                                continue;
                              }
                              for( var j = 0; j < cur.length; ++j ) {
                                td = $('<td/>');
                                img = $('<img/>').attr({src: iconmap[order[i]], alt:typemap[order[i]]});
                                $('#results').append(
                                  $('<tr/>')
                                  .addClass('notification notification-'+order[i])
                                  .append( 
                                    $('<td/>').addClass('notification-type')
                                    		.append(img)
                                  )
                                  .append(
                                    td.addClass('notification-content')
                                    .append(
                                      $('<div/>').addClass('notification-desc').html( cur[j].Desc )
                                    )
                                  )
                                );
                                if( cur[j].Data ) {
                                  pre = $('<pre/>').addClass('').text( cur[j].Data ).hide();
                                  img = $('<img/>').attr({src:"<?=FORMPREFIX.'/views/'.THEME?>/_img/plus16.png", alt:"toggle"});
                                  outer = $('<div/>').addClass('notification-data-outer');
                                  inner = $('<div/>');
                                  inner.addClass('notification-data').append($('<div/>').append(pre));
                                  td.children(".notification-desc").prepend(img);
                                  outer.append(inner);
                                  (function(img,pre){
                                      img.click(function(){
                                          if(pre.is(':hidden')) {
                                            img.attr( 'src', "<?=FORMPREFIX.'/views/'.THEME?>/_img/minus16.png" );
                                          } else {
                                            img.attr( 'src', "<?=FORMPREFIX.'/views/'.THEME?>/_img/plus16.png" );
                                          }
                                          pre.slideToggle();
                                        })})(img,pre);
                                  td.append(outer);
                                }
                              }
                            }
                          }
                        }
                        waiting = false;
                      },
                      error: function( xhr, textStatus, errorThrown ) {
                        errHandler = function( secs ) {
                          if( secs <= 0 ) {
                            meter.status('Retrying querying...');
                            waiting = false;
                          } else {
                            meter.notice('Was unable to connect to server; This is probably due to temporary shutdown of the webserver during upgrade. Please be patient. Will retry communication in ' + secs + ' seconds...');
                            window.setTimeout( function() { errHandler( secs - 1 ) }, 1000 );
                          }
                        }
                        errHandler( 5 );
                      }
                    });
                }, 500);
            },
            error: function( xhr,  textStatus, errorThrown ) {
              meter.error('Error: ' + textStatus );
              meter.is_done();
            }
          });
		}
		if( action != 'install' ) {
		  $.ajax({
            type: 'POST',
            dataType: 'json',
            url: "/admin/settings/fwupdate",
            data: { action: 'hotfix_run', hotfix_enabled: hotfix_enabled } ,
            timeout: 20000,
			success: function( data ) {
              waiting = false;
			  nbr_errors = 0;
			  if( data.done ) {
				  upgrade();
				  return;
			  }
              tim = setInterval(
                function() {
                  if( waiting ) return;
                  waiting = true;
                  $.ajax({
                      type: 'POST',
                      url: "/admin/settings/fwupdate",
                      data: { action: 'hotfix_progress' },
                      timeout: 10000,
                      dataType: 'json',
					  success: function(data) {
						nbr_errors = 0;
                        meter.update( 0, data.statusMessage);
                        meter.poke();
						if( data.done ) {
							clearInterval( tim );
							// We'll continue normal upgrade here
							if( ! data.stop ) {
								upgrade();
							}
                        }
                        waiting = false;
                      },
                      error: function( xhr, textStatus, errorThrown ) {
						  meter.warning('Warning: ' + textStatus );
						  if( ++nbr_errors >= 20 ) {
							  clearInterval( tim );
							  upgrade();
						  } else {
							  waiting = false;
						  }
                      }
                    });
                }, 500);
			},
			error: function( xhr, textStatus, errorThrown ) {
				meter.warn('Warning: ' + textStatus );
				upgrade();
            }
          });
		} else {
			upgrade();
		}
        return false;
      });
  });


</script>
<form id="update" method="post">
<fieldset>
	<legend>
		<i><?=$action=='install'?t("Install $package"):t('Update software')?></i>
	</legend>
	<div id="updater" style="width: 100%">
	<?if($action == 'install'):?>
		<ul>
			<input type="submit" value="<?=t('Install') . ' ' . $package ?>"/>
		</ul>
		<input type="hidden" name="apt_package" id="apt_package" value="<?=$package?>"/>
		<input type="hidden" name="apt_type" id="apt_type" value="install"/>
	<?else:?>
			<input type="submit" value="<?=t('Update system')?>"/>
			<div class="hotfix">
			<input type="checkbox" class="checkbox_radio" name="hotfix_enabled" id="hotfix_enabled" <?if($hotfix_enabled):?>checked="checked" <?endif?>/>
				<span><?=t("Include hotfixes and system specific updates.")?></span><span class="help"><a href="/manual/<?=t("help_hotfix")?>" target="_blank">(<?=t('Explain')?>)</a></span>
			</div>
		<input type="hidden" name="apt_type" id="apt_type" value="upgrade"/>
	<?endif?>
	</div>
	<div id="progress"></div>
	<table id="results" class="notifications"></table>
	<pre id="tmp"></pre>
</fieldset>
</form>

<fieldset>
	<legend><?=t("Current package versions")?></legend>
	<table id="package_versions">
		<thead>
			<tr>
				<td><?=t("Package name")?></td>
				<td><?=t("Package version")?></td>
			</tr>
		</thead>
		<tbody id="package_versions_body" />
			<tr>
				<td colspan="2"><?=t("Retreiving package information")?>...</td>
			</tr>
	</table>
</fieldset>
