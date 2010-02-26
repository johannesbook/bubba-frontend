<script src="<?=FORMPREFIX.'/views/'.THEME?>/_js/jquery.dataTables.js" type="text/javascript"></script>
<script src="<?=FORMPREFIX.'/views/'.THEME?>/_js/jquery.fake.js" type="text/javascript"></script>
<style>
.type-file {
border-left: 2px solid #3232aa;
}
.type-dir {
border-left: 2px solid #aa3232;
}
#filetable tbody .row-selected * {
background: #881212;
}
#filetable:not(.clone) { 
	cursor: pointer
}
#filetable:not(.clone) tbody tr:hover * {
	background: #aa7676
}
#filetable:not(.clone) tbody tr.row-selected:hover * {
	background: #a25656 !important
}

.ui-action-dblclick {
	background: #ee6622 !important; 
}

.ui-path-link {
	cursor: pointer;
	color: blue;
}
</style>
<script>


$.fn.dataTableExt.oApi.fnReloadAjax = function ( oSettings, sNewSource, aoData, bRedraw, fnCallback )
{
	if ( typeof sNewSource != 'undefined' )
	{
		oSettings.sAjaxSource = sNewSource;
	}
	this.oApi._fnProcessingDisplay( oSettings, true );
	var that = this;
	
	oSettings.fnServerData( oSettings.sAjaxSource, aoData, function(json) {
		/* Clear the old information from the table */
		that.oApi._fnClearTable( oSettings );
		
		/* Got the data - add it to the table */
		for ( var i=0 ; i<json.aaData.length ; i++ )
		{
			that.oApi._fnAddData( oSettings, json.aaData[i] );
		}
		
		oSettings.aiDisplay = oSettings.aiDisplayMaster.slice();
		if( typeof bRedraw == 'undefined' || bRedraw ) {
			that.fnDraw( that );
		}
		that.oApi._fnProcessingDisplay( oSettings, false );
		
		/* Callback user function - for event handlers etc */
		if ( typeof fnCallback == 'function' )
		{
			fnCallback( oSettings );
		}
	} );
}
dir_opening_callback = function( dataTable, filetable, options ){
	options = $.extend({direction: "left", path: "/", speed: 750},options);
	fake_overlay = fileTable.fake();
	dataTable.fnClearTable();
	done_animate = false;
	fileTable.hide().show('slide', {direction: options.direction == "left" ? 'right' : 'left'}, options.speed, function() { dataTable.fnDraw(); done_animate = true });
	fake_overlay.hide('slide', {direction: options.direction == "left" ? 'left' : 'right' }, options.speed, function() {fake_overlay.remove() });
	dataTable.fnReloadAjax( "<?=(FORMPREFIX)?>/filemanager/index/test", { path: options.path }, false, function() {
		if( done_animate ) {
			// if we lag, and animation is done befoer ajax load, then we redraw
			dataTable.fnDraw();
		}
	} );
}

$.fn.dataTableExt.aoFeatures.push( {
	"fnInit": function( oSettings ) {
		return $('<div/>', {'class': 'ui-datatables-paths', id: oSettings.sTableId + "_paths" }).get(0);
	},
	"cFeature": "P",
	"sFeature": "Paths"
} );

$(document).ready(function() {
	fileTable = $("#filetable");

	dataTable = fileTable.dataTable({
		"oLanguage": {
			'sZeroRecords': ''
		},
		"sDom": '<"H"Pr>t',
		"bJQueryUI": true,
		"bFilter": false,
		"bInfo": false,
		"bPaginate": false,
		"bProcessing": true,
		"sAjaxSource": "<?=(FORMPREFIX)?>/filemanager/index/test",
		"aaSorting": [[0, "asc"],[1,"asc"]],
		"aaSortingFixed": [[0, "asc"]],
		"bAutoWidth": false,
		"aoColumns": [
			{ "sWidth": "5%", "bSortable": false, "aaSorting": [ "asc" ] },
			{ "sWidth": "60%", "aaSorting": [ "asc" ] },
			{ "sWidth": "25%" },
			{ "sWidth": "10%" },
		],
		"fnServerData": function ( sSource, aoData, fnCallback ) {
			$.ajax( {
				"dataType": 'json', 
				"type": "POST", 
				"url": sSource, 
				"data": aoData, 
				"success": function(data){
					fileTable.data('root', data.root);
					fnCallback.apply(this, [data]);

					current = '/';
					$("#filetable_paths").html("");
					divider = $('<span/>', {text: '/', 'class': 'ui-path-divider'});
					$.each( $.trim(data.root).split('/'), function(index, value) {
						if(!value){
						$("#filetable_paths").append( divider.clone() );
							return;
						}
						current += value;
						a = $('<span/>', {data: {path:current}, html: value, 'class': "ui-path-link"}).click(function(){
							dataTable.fnReloadAjax( "<?=(FORMPREFIX)?>/filemanager/index/test", { path: $(this).data('path') } );
						});
						current += '/';
						$("#filetable_paths").append( a ).append( divider.clone() );
					});
					divider.remove(); // the last one
					arr = $.trim(data.root).split('/');
					arr.pop();
					updir = arr.join('/');
					$('.ui-fake-updir', fileTable).html($('<a/>',{
						text: '..',
						click: function() {
							dir_opening_callback.apply( this, [dataTable, fileTable, {path:updir, direction: 'right'}  ] );
						} 
					}));
				}
			} );
		},		
		"fnRowCallback": function( nRow, aData, iDisplayIndex ) {
			$(nRow).data({
				'foo': 'bar',
				'type': aData[0],
				'path': fileTable.data('root') + "/" + aData[1]
			});

			if( aData[0] == "dir" ) {
				$(nRow).addClass("type-dir");
				$("td:eq(3)",nRow).html(""); // size irrelevant
				$("td:eq(0)",nRow).html($("<a/>",{
					text: "dir", 
					click: function() {
						dir_opening_callback.apply( this, [dataTable, fileTable, {path:$(nRow).data('path')} ] );
					} 
				})).data('path', fileTable.data('root') + "/" + aData[1] );
			} else if( aData[0] == "file" ) {
				$(nRow).addClass("type-file");
			}
			
			return nRow;
		}


	});

	$("tbody", fileTable).delegate( 'tr', 'mousedown', function(event) {
		$(this).siblings().andSelf().removeClass("ui-action-dblclick");
		if( event.ctrlKey ) {
			fileTable.data('multiselect', true);
			$(this).toggleClass('row-selected');
			fileTable.data('last_selected', this);
		} else {
			if( fileTable.data('multiselect') ) {
				// We where in multi-select mode, 
				// thus we should act as there wasn't anything selected in the first place
				fileTable.data('multiselect', false);
				fileTable.data('last_selected', this);
				$("#filetable tr").removeClass('row-selected');
				$(this).addClass('row-selected');
			} else {
				last = fileTable.data('last_selected');
				if( last ) {
					if( last == this ) {
						$(this).toggleClass('row-selected');
					} else {
						$(last).removeClass('row-selected');
						$(this).addClass('row-selected');
						fileTable.data('last_selected', this);
					}
				} else {
					$(this).addClass('row-selected');
					fileTable.data('last_selected', this);
				}
			}

		}
		return false;

	});


	$("tbody", fileTable).delegate( 'tr', 'dblclick', function() {
		$(this).addClass("ui-action-dblclick");
		if( $(this).data('type') == 'dir' ) {
			dir_opening_callback.apply( this, [dataTable, fileTable, {path:$(this).data('path')} ] );
		}
		return false;
	});
});

</script>
