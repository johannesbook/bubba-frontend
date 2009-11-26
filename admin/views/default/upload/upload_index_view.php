<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="<?=FORMPREFIX.'/views/'.THEME?>/_css/screen.css" />
<link rel="stylesheet" type="text/css" href="<?=FORMPREFIX.'/views/'.THEME?>/_css/admin.css" />
<script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME?>/_js/jquery.js"></script>

<title><?=t('Upload')?>: <?= $path ?></title>
<script type="text/javascript">
var index=1;

function monitorupload(){
	// Only Mozilla Firefox handles file size check without any security prohibitions
	if( $.browser.mozilla && $.browser.version.substr(0,3) == "1.9" ) {
		elems = $(':file');
		max = 2 * 1024 * 1024 * 1024 - 1; // 2GiB - 1 ( I never trust that last byte )
		total = 0;
		$(':file').each(function(i) {
			if( this.type != 'file' || this.files.length <= 0 ) {
				return;
			}
			inner: for( j = 0; j < this.files.length; ++j ) {
				file = this.files[j];
				size = typeof( file.size ) == 'number' ? file.size : file.fileSize;
				if( ! size ) {
					continue inner;
				}
				total += size;
			}
		});

		if( total >= max ) {
			$('#progress').html('Upload exceeding maximum size of <strong>2GB</strong>. ( Tried upload <strong>' + total + '</strong> )');
			return false;
		}
	}
    $("#uploaddiv").toggle(false);
	$("#progressbar").toggle(true);

	queryProgress( $('#uuid').val(), new Date() );
}

function queryProgress( uuid, startdate ) {
	$.ajax({ url:"<?=FORMPREFIX?>/ajax_upload/progress", 
		data: { 'uuid': uuid }, 
		type: 'POST',
		dataType: 'json',
		error: function (XHR, textStatus, errorThrown) {
			$("#pg_item").html( "Got XMLHttpRequest error \"<em>" + textStatus + "</em>\", retrying in 2 seconds..." );			
				if((queryProgress.FAIL_COUNT += 3) > queryProgress.MAX_FAIL_COUNT) {
					if ( queryProgress.TIMER ){
						clearTimeout( queryProgress.TIMER );
					}
					$("#pg_item").html("<?=t('Failed to upload file(s), aborting.')?>");
					$("#b_close").removeAttr( 'disabled' );
					return;
				}

			if ( queryProgress.TIMER ){
				clearTimeout( queryProgress.TIMER );
			}
			if( queryProgress.STATE != queryProgress.STATE_FINISH ){
				queryProgress.TIMER = setTimeout( function() { 
					$("#pg_item").html( "retrying..." );			

					queryProgress( uuid, startdate ) } , 2000 );
			}else{
				queryProgress.STATE = queryProgress.STATE_START;
			}
		},
		success: function(data) {
			if( data.error ) {
				if(++queryProgress.FAIL_COUNT > queryProgress.MAX_FAIL_COUNT) {
					if ( queryProgress.TIMER ){
						clearTimeout( queryProgress.TIMER );
					}
					$("#pg_item").html("<?=t('Failed to upload file(s), aborting.')?>");
					$("#b_close").removeAttr( 'disabled' );
					return;
				}
				if( queryProgress.STATE == queryProgress.STATE_START ){
					queryProgress.STATE  = queryProgress.STATE_INIT;
					$("#styledprogress").width(0+"%");
					$("#pg_item").html("<?=t('Initializing')?>");
				}
				if( queryProgress.STATE == queryProgress.STATE_UPLOADING ){
					queryProgress.STATE = queryProgress.STATE_FINISH;
					$("#styledprogress").width(100+"%");
					$("#b_close").removeAttr( 'disabled' );
					$("#pg_item").html("<?=t('Upload complete')?>");
				}
			} else {
				if( queryProgress.STATE == queryProgress.STATE_START || queryProgress.STATE == queryProgress.STATE_INIT ){
					$("#pg_size").html(Math.floor(data.size/1024)+" KB");
					queryProgress.STATE = queryProgress.STATE_UPLOADING;
				}
				$("#styledprogress").width( Math.floor( 100 * data.downloaded / data.size ) + "%" );
				$("#pg_speed").html( Math.floor( ( 1000 * data.downloaded / ( (new Date()).getTime() - startdate.getTime() ) ) / 1024 ) + " KB/s" );
				$("#pg_item").html("<?=t('Uploading')?>: "+data.info);
			}
			if ( queryProgress.TIMER ){
				clearTimeout( queryProgress.TIMER );
			}
			if( queryProgress.STATE != queryProgress.STATE_FINISH ){
				queryProgress.TIMER = setTimeout( function() { queryProgress( uuid, startdate ) } , 1000 );
			}else{
				queryProgress.STATE = queryProgress.STATE_START;
			}
		}
	});
}
queryProgress.STATE_START = 0;
queryProgress.STATE_INIT = 1;
queryProgress.STATE_UPLOADING = 2;
queryProgress.STATE_FINISH = 3;
queryProgress.STATE = queryProgress.STATE_START;
queryProgress.FAIL_COUNT = 0;
queryProgress.MAX_FAIL_COUNT = 15;

$(document).ready( function(){
	$('#addmore').click( function() {
		++index;
		box = $('<div/>');
		input = $('<input type="file"/>');
		box.append( input );
		input.attr( { name: 'file' + index, id: 'file' + index, size: 40 } );
		$('#uploads').append( box );
		window.resizeBy( 0 , box.outerHeight() );
	});
	$('#file1').change( function() {
		$('#submitbutton').removeAttr( 'disabled' );
	});
	$('#uploadform').submit( function() { return monitorupload() } );
	$('#b_close').click( function() { window.close() } );
	window.focus();
} );
</script>
</head>
<body>

<div id="uploaddiv">
<fieldset><legend><?=t('Upload to')?>: <?= $path ?></legend>
<form action="/cgi-bin/upload.cgi" method="post" enctype="multipart/form-data" target="uploadframe"  id="uploadform"> 
	<input type="hidden" name="uuid"  id="uuid" value="<? echo uniqid("upl");  ?>" />
	<input type="hidden" name="uploadpath" value='<?= rawurlencode($path) ?>'/>
	<div id="pg_adder">
		<input type="button" id="addmore" value="<?=t('Add entry')?>"/>
	</div>
	<div id="uploads">
		<div><input type="file" name="file1" id="file1" size="40"/></div>
	</div>
	<div><?=t("Maximum total upload (of all files) is 2GByte.")?></div>
	<input type="submit" id="submitbutton" value="<?=t('Start upload')?>" disabled="disabled" />
	<input type="button" value="<?=t('Close')?>" onclick="window.close()"/>
</form>
<div id="progress"></div>
</div>

<iframe name="uploadframe" style="border: 0;width: 1px;height: 1px;"></iframe>

<div id="progressbar" style="display: none;">
<fieldset><legend><?=t('Uploading to')?>: <?= $path ?></legend>
<table border="0" cellspacing="0" width="100%">
	<tr>
		<td style="font-size: smaller; font-weight: bold;"><?=t('Total Upload')?></td>
		<td style="text-align: left;" id="pg_size"></td>
	</tr>
	<tr>
		<td style="font-size: smaller; font-weight: bold;"><?=t('Total Speed')?></td>
		<td style="text-align: left;" id="pg_speed"></td>
	</tr>
</table>
<table border="0" cellspacing="0" width="100%">
	<tr>
		<td width="100%">
			<div class="space-indicator">
				<div id="styledprogress" style="width: 0%"></div>
			</div>
		</td>
	</tr>
	<tr>
		<td style="font-size: smaller; font-weight: bold; text-align: center; " id="pg_item"></td>
	</tr>
	<tr>
		<td><input type="button" value="<?=t('Close')?>" id="b_close" disabled="disabled"/></td>
	</tr>
</table>
</fieldset>
</div>

</body>
</html>
