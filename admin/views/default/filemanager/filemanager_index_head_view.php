<script src="<?=FORMPREFIX.'/views/'.THEME?>/_js/jquery.dataTables.js" type="text/javascript"></script>
<script src="<?=FORMPREFIX.'/views/'.THEME?>/_js/jquery.ba-serializeobject.js" type="text/javascript"></script>
<script src="<?=FORMPREFIX.'/views/'.THEME?>/_js/jquery.ui.filemanager.js" type="text/javascript"></script>

<script>
album_add_access=<?=json_encode($this->Auth_model->policy("album","add"))?>;
path=<?=json_encode($path)?>;
</script>

<script>

dialog_pre_open_callbacks = {
	'rename': function() {
		var files = $("#filetable").filemanager('getSelected');
		$("#fn-filemanager-rename-name").val(files[0].replace(/^.*\//, ''));
	},
	'perm': function() {
		var files = $("#filetable").filemanager('getSelected');
		$.throbber.show();
		$.post(config.prefix+"/filemanager/perm/json/get", {files:files}, function(data){
			$.throbber.hide();
			if( (data.permissions & 00600) == 0600 ) {
				$("#fn-filemanager-perm-permission-owner option[value='rw']").attr("selected",true);
			}else if( (data.permissions & 00400) == 0400 ) {
				$("#fn-filemanager-perm-permission-owner option[value='r']").attr("selected",true);
			}else{
				/* Owner should always be able to read */
				$("#fn-filemanager-perm-permission-owner option[value='r']").attr("selected",true);
			}

			if( (data.permissions & 00060) == 00060 ) {
				$("#fn-filemanager-perm-permission-group option[value='rw']").attr("selected",true);
			}else if( (data.permissions & 00040) == 00040 ) {
				$("#fn-filemanager-perm-permission-group option[value='r']").attr("selected",true);
			}else if( (data.permissions & 00070) == 00000){
				$("#fn-filemanager-perm-permission-group option[value='n']").attr("selected",true);
			}


			if( (data.permissions & 00006) == 00006 ) {
				$("#fn-filemanager-perm-permission-other option[value='rw']").attr("selected",true);
			}else if( (data.permissions & 00004) == 00004 ) {
				$("#fn-filemanager-perm-permission-other option[value='r']").attr("selected",true);
			}else if( (data.permissions & 00007) == 00000){
				$("#fn-filemanager-perm-permission-other option[value='n']").attr("selected",true);
			}
		}, 'json');
		
	}
};

dialog_callbacks = {
	'default_close': function() {
		$(this).dialog('close');
	},
	'mkdir': function() {
		$.throbber.show();
		var self = this;
		var params = $("#fn-filemanager-mkdir").serializeObject();
		params.root = $("#filetable").filemanager('option','root');
		params.files = $("#filetable").filemanager('getSelected');
		$.post(config.prefix+"/filemanager/mkdir/json", params, function(data){
			$.throbber.hide();
			$(self).dialog('close');
			update_status( data.success, data.error ? data.html : $.message("filemanager-success-mkdir"));
			if( ! data.error ) {
				$("#filetable").filemanager('reload');
			}
		}, 'json');
	},
	'rename': function() {
		$.throbber.show();
		var self = this;
		var params = $("#fn-filemanager-rename").serializeObject();
		params.path = $("#filetable").filemanager('getSelected')[0];
		params.root = $("#filetable").filemanager('option','root');
		$.post(config.prefix+"/filemanager/rename/json", params, function(data){
			$.throbber.hide();
			$(self).dialog('close');
			update_status( data.success, data.error ? data.html : $.message("filemanager-success-rename"));
			if( ! data.error ) {
				$("#filetable").filemanager('reload');
			}
		}, 'json');
	},
	'perm': function() {
		$.throbber.show();
		var self = this;
		var params = $("#fn-filemanager-perm").serializeObject();
		params.files = $("#filetable").filemanager('getSelected');
		$.post(config.prefix+"/filemanager/perm/json/set", params, function(data){
			$.throbber.hide();
			$(self).dialog('close');
			update_status( data.success, data.error ? data.html : $.message("filemanager-success-perm"));
			if( ! data.error ) {
				$("#filetable").filemanager('reload');
			}
		}, 'json');
	},
	'delete': function() {
		$.throbber.show();
		var self = this;
		var files = $("#filetable").filemanager('getSelected');
		$.post(config.prefix+"/filemanager/delete/json", {files: files}, function(data){
			$.throbber.hide();
			$(self).dialog('close');
			update_status( data.success, data.error ? data.html : $.message("filemanager-success-delete"));
			if( ! data.error ) {
				$("#filetable").filemanager('reload');
			}
		}, 'json');		
	},
	'album': function() {
		$.throbber.show();
		var files = $("#filetable").filemanager('getSelected');
		var self = this;
		$.post(config.prefix+"/filemanager/album/json", {files: files}, function(data){
			$.throbber.hide();
			update_status( data.success, data.error ? data.html : $.message("filemanager-success-album"));
			if( ! data.error ) {
				var count = 0;
				$.each( data.files_added, function( key, value ) {
					if( value ) {
						++count;
					}
				});
				$.alert($.message("filemanager-success-album-message", count), $.message("filemanager-success-album-title") , $.message('button-label-close'));
			}
			$(self).dialog('close');
		}, 'json');		
	}
};

copymove_yesbutton = null;
copymove_isactive = false;

copymove_callback = function( type ) {
	var filetable = $("#filetable");

	var panel = $("#fn-filemanager-information-panel");
	var action = $("#fn-filemanager-action-panel");
	var main_toolbar = filetable.prev().children(".ui-filemanager-buttonbar");
	var filemanager = $("#filemanager");
	var files = filetable.filemanager('getSelected');

	var speed = 750;

	copymove_isactive = true;
	filetable.filemanager('disableButtons');


	action.empty();
	panel.empty();

	var button_no = $("<button/>", {text: $.message("filemanager-"+type+"-no")}).appendTo(action)
		.button({text: false, icons: { primary: 'ui-icon-close' } }).click(function(){
			action.hide('drop', {direction: 'right'}, speed);
			filetable.filemanager('disableButtons', false );
			panel.hide('drop', {direction: 'down'}, speed);
			copymove_yesbutton = null;
			copymove_isactive = false;
		});

	copymove_yesbutton = $("<button/>", {id: 'fn-filemanager-button-copymove', text: $.message("filemanager-"+type+"-yes")}).appendTo(action)
		.button({text: false, icons: { primary: 'ui-icon-check ui-filemanager-buttonbar-last' } }).click(function(){
			action.hide('drop', {direction: 'right'}, speed);
			$.throbber.show();
			$.post(config.prefix+"/filemanager/"+type+"/json", {files: files, path: filetable.filemanager('option','root') }, function(data){
				$.throbber.hide();
				update_status( data.success, data.error ? data.html : $.message("filemanager-"+type+"-success") );


				filetable.filemanager('disableButtons', false );

				panel.hide('drop', {direction: 'down'}, speed);

				if( ! data.error ) {
					filetable.filemanager('reload');
				}
				copymove_yesbutton = null;
				copymove_isactive = false;
				$(window).unbind('resize.filemanager-action');
			}, 'json');		
		});


	action.buttonset();
    
	panel.css({top: -30, left: 0});
	$(window).bind('resize.filemanager-action', function(){
		action.css({top: 0, left: main_toolbar.position().left - action.width() });
		panel.css({width: filetable.innerWidth() - (panel.outerWidth(true)-panel.innerWidth())});
	}).triggerHandler( 'resize.filemanager-action' );

	panel.html($.message("filemanager-"+type+"-notice", files.length));
	panel.show('drop', {direction: 'down'}, speed);
//	setTimeout(function(){panel.stop(false,false)},600);
	action.show('drop', {direction: 'right'}, speed);
};
dialogs = {};
buttons = [
    {
		'id': 'fn-filemanager-button-create',
		'disabled': false,
		'type': 'ui-icons ui-icon-plusthick',
		'alt': $.message('filemanager-buttonbar-create'),
		'callback': function() {
			hide_status();
			dialogs["mkdir"].dialog("open");
		}
	},
	{
		'id': 'fn-filemanager-button-upload',
		'disabled': false,
		'type': 'ui-icons ui-icon-upload',
		'alt': $.message('filemanager-buttonbar-upload'),
		'callback': function() {
			hide_status();
			window.open(config.prefix + "/upload/index" + $("#filetable").filemanager('option','root'), "", "width=500,height=250.menubar=no,toolbar=no,location=no,directories=no,personalbar=no,status=no,dialog=yes");
		}
	},
	{
		'id': 'fn-filemanager-button-download',
		'disabled': true,
		'type': 'ui-icons ui-icon-download',
		'alt': $.message('filemanager-buttonbar-download'),
		'callback': function() {
			hide_status();
			var files = $("#filetable").filemanager('getSelected');

			var input = $("<input/>", { type: 'hidden', 'name': 'files[]' });
			var form = $("<form/>", {
				'action': config.prefix+"/filemanager/downloadzip",
				'method': 'POST'
			}).appendTo("body");
			$.each(files, function(index,value) {
				form.append($("<input/>", { 'type': 'hidden', 'name': 'files[]', 'value': value }));
			});
			$("<input/>", { 'type': 'hidden', 'name': 'path', 'value': $("#filetable").filemanager('option','root') }).appendTo(form);
			form.submit().remove();
		}
	},	
	{
		'id': 'fn-filemanager-button-move',
		'disabled': true,
		'type': 'ui-icons ui-icon-move',
		'alt': $.message('filemanager-buttonbar-move'),
		'callback': function() { 
			hide_status();
			copymove_callback.apply(this,['move']);
		}
	},
	{
		'id': 'fn-filemanager-button-copy',
		'disabled': true,
		'type': 'ui-icons ui-icon-copy',
		'alt': $.message('filemanager-buttonbar-copy'),
		'callback': function() {
			hide_status();
			copymove_callback.apply(this,['copy']);
		}
	},
	{
		'id': 'fn-filemanager-button-rename',
		'disabled': true,
		'type': 'ui-icons ui-icon-pencil',
		'alt': $.message('filemanager-buttonbar-rename'),
		'callback': function() {
			hide_status();
			dialogs["rename"].dialog("open");
		}
	},
	{
		'id': 'fn-filemanager-button-perm',
		'disabled': true,
		'type': 'ui-icons ui-icon-unlocked',
		'alt': $.message('filemanager-buttonbar-perm'),
		'callback': function() {
			hide_status();
			dialogs["perm"].dialog("open");
		}
	},
	{
		'id': 'fn-filemanager-button-album',
		'disabled': true,
		'type': 'ui-icons ui-icon-album',
		'alt': $.message('filemanager-buttonbar-album'),
		'callback': function() {
			hide_status();
			dialogs["album"].dialog("open");
		}
	},
	{
		'id': 'fn-filemanager-button-delete',
		'disabled': true,
		'type': 'ui-icons ui-icon-trash ui-filemanager-buttonbar-last',
		'alt': $.message('filemanager-buttonbar-delete'),
		'callback': function() {
			hide_status();
			dialogs["delete"].dialog("open");
		}
	}
];

writable = true;
readable = true;

update_toobar_button_callback = function( count ) {
	var required_selected = [ 'delete', 'copy', 'move', 'download', 'perm', 'album' ];
	var required_single = [ 'rename' ];
	var required_write = [ 'delete', 'rename', 'move', 'perm', 'upload', 'create', 'copymove' ];
	var required_read = [ 'download', 'copy', 'album', 'delete', 'rename', 'move', 'perm', 'upload', 'create' ];
	var required_album = [ 'album' ];

	var states = {
		'download': true,
		'copy': true, 
		'album': true,
		'delete': true,
		'rename': true,
		'move': true,
		'perm': true,
		'upload': true,
		'create': true,
		'copymove': true
	};

	if( !readable ) {
		$.each( required_read, function() { states[this] = false } );
	}

	if( !writable ) {
		$.each( required_write, function() { states[this] = false } );
	}

	if( count == 0 ) {
		$.each( required_selected, function() { states[this] = false } );
		$.each( required_single, function() { states[this] = false } );
	} else if( count == 1 ) {
		$.each( required_selected, function() { states[this] &= true } );
		$.each( required_single, function() { states[this] &= true } );
	} else {
		$.each( required_selected, function() { states[this] &= true } );
		$.each( required_single, function() { states[this] = false } );
	}

	if( !album_add_access || $("#filetable").filemanager('value').search('^/home/storage/pictures(/|$)') != 0 ) {
		$.each( required_album, function() { states[this] &= false } );
	}

	$.each( states, function( key, value ) {
		var id = "#fn-filemanager-button-" + key;
		$(id).button( value ? 'enable' : 'disable' ).data('is_disabled', !value);
	});
}
update_toolbar_buttons = function() {
	var length = $("#filetable").filemanager('length');
	update_toobar_button_callback( length );

}

after_open_dir_callback = function(json) {
	hide_status();
	writable = json.meta.writable;
	readable = !json.meta.permission_denied;
	update_toobar_button_callback( 0 );
	if( !readable ) {
		$(".ui-filemanager-permission-denied").show();
	} else {
		$(".ui-filemanager-permission-denied").hide();
	}
}

file_download_callback = function( row, options ){
	hide_status();
	$("<form/>", {
		'action': config.prefix+"/filemanager/download",
		'method': 'POST',
		'html': $('<input/>', { type: 'hidden', 'name': 'path', value: options.path }) 
		}
	).appendTo("body").submit().remove();
}

$(document).ready(function() {

	filemanager_obj = $("#filetable");
	// All dialogs can be somewhat generic in buildup

	$.each( ['mkdir', 'delete', 'perm', 'rename', 'album'], function( index, value ) {

		var options = { "width" : "400px", "autoOpen": false,
			"open": function(event,ui) {
				var current	= $("#fn-filemanager-" + value + "");
				current.trigger("reset");
				if(typeof dialog_pre_open_callbacks[value] != "undefined") {
					dialog_pre_open_callbacks[value].apply(this, arguments);
				}
				$(".fn-primary-field", current).focus();
			}
		};
		dialogs[value] = $.dialog( 
			$("#fn-filemanager-" + value + "-dialog"),
			"",
			[
				{
					'label': $.message("filemanager-" + value + "-dialog-button-label"),
					'callback': function(){dialog_callbacks[value].apply(dialogs[value], arguments)},
					options: { id: 'fn-' + value + '-dialog-button', 'class':'ui-element-width-100'  }
				}
			],
			options	
		);
				

		$("#fn-filemanager-" + value + "-dialog").submit(function() {
			$(this).closest('.ui-dialog').find('.ui-dialog-buttonpane').children('button.ui-button').button("disable");
			dialog_callbacks[value].apply(dialogs[value]);
			
			return false;
		});
	});

	filemanager_obj.filemanager({
		root: path,
		fileDoubleClickCallback: file_download_callback,
		dirDoubleClickCallback: update_toolbar_buttons,
		mouseDownCallback: update_toolbar_buttons,
		dirPostOpenCallback: after_open_dir_callback,
		ajaxSource: config.prefix+"/filemanager/index/json"
	});

	filemanager_obj.filemanager( 'setButtons', buttons );

});

</script>
