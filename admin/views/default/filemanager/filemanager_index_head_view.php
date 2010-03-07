<script src="<?=FORMPREFIX.'/views/'.THEME?>/_js/jquery.dataTables.js" type="text/javascript"></script>
<script src="<?=FORMPREFIX.'/views/'.THEME?>/_js/jquery.fake.js" type="text/javascript"></script>
<script src="<?=FORMPREFIX.'/views/'.THEME?>/_js/jquery.appendLinear.js" type="text/javascript"></script>
<script src="<?=FORMPREFIX.'/views/'.THEME?>/_js/jquery.ba-serializeobject.js" type="text/javascript"></script>
<script src="<?=FORMPREFIX.'/views/'.THEME?>/_js/jquery.ui.filemanager.js" type="text/javascript"></script>
<style>


</style>

<script>

buttons_requiring_selected_files_selectors = $.map( [ 'delete', 'copy', 'move', 'download', 'perm' ], function(value) { return "#fn-filemanager-button-" + value } ).join(', ');
buttons_requiring_single_selected_file_selectors = $.map( [ 'rename' ], function(value) { return "#fn-filemanager-button-" + value } ).join(', ');

dialog_pre_open_callbacks = {
	'perm': function() {
		var files = $("#filetable").filemanager('getSelected');
		$.post(config.prefix+"/filemanager/perm/json/get", {files:files}, function(data){
			if( data.permissions & 00400 ) {
				$("#fn-filemanager-perm-permission-owner-read").attr("checked","checked");
			}
			if( data.permissions & 00200 ) {
				$("#fn-filemanager-perm-permission-owner-write").attr("checked","checked");
			}
			if( data.permissions & 00100 ) {
				$("#fn-filemanager-perm-permission-owner-execute").attr("checked","checked");
			}

			if( data.permissions & 00040 ) {
				$("#fn-filemanager-perm-permission-group-read").attr("checked","checked");
			}
			if( data.permissions & 00020 ) {
				$("#fn-filemanager-perm-permission-group-write").attr("checked","checked");
			}
			if( data.permissions & 00010 ) {
				$("#fn-filemanager-perm-permission-group-execute").attr("checked","checked");
			}

			if( data.permissions & 00004 ) {
				$("#fn-filemanager-perm-permission-other-read").attr("checked","checked");
			}
			if( data.permissions & 00002 ) {
				$("#fn-filemanager-perm-permission-other-write").attr("checked","checked");
			}
			if( data.permissions & 00001 ) {
				$("#fn-filemanager-perm-permission-other-execute").attr("checked","checked");
			}
		}, 'json');
		
	}
};

dialog_callbacks = {
	'default_close': function() {
		$(this).dialog('close');
	},
	'mkdir': function() {
		var params = $("#fn-filemanager-mkdir").serializeObject();
		params.root = $("#filetable").filemanager('option','root');
		params.files = $("#filetable").filemanager('getSelected');
		$.post(config.prefix+"/filemanager/mkdir/json", params, function(data){
			update_status( data.success, data.error ? data.html : "<?=t("filemanager-success-mkdir")?>");
			if( ! data.error ) {
				$("#filetable").filemanager('reload');
			}
		}, 'json');
		$(this).dialog('close');
	},
	'rename': function() {
		var params = $("#fn-filemanager-rename").serializeObject();
		params.path = $("#filetable").filemanager('getSelected')[0];
		params.root = $("#filetable").filemanager('option','root');
		$.post(config.prefix+"/filemanager/rename/json", params, function(data){
			update_status( data.success, data.error ? data.html : "<?=t("filemanager-success-rename")?>");
			if( ! data.error ) {
				$("#filetable").filemanager('reload');
			}
		}, 'json');
		$(this).dialog('close');
	},
	'perm': function() {
		var params = $("#fn-filemanager-perm").serializeObject();
		params.files = $("#filetable").filemanager('getSelected');
		$.post(config.prefix+"/filemanager/perm/json/set", params, function(data){
			update_status( data.success, data.error ? data.html : "<?=t("filemanager-success-perm")?>");
			if( ! data.error ) {
				$("#filetable").filemanager('reload');
			}
		}, 'json');
		$(this).dialog('close');
	},
	'delete': function() {
		var files = $("#filetable").filemanager('getSelected');
		$.post(config.prefix+"/filemanager/delete/json", {files: files}, function(data){
			update_status( data.success, data.error ? data.html : "<?=t("filemanager-success-delete")?>");
			if( ! data.error ) {
				$("#filetable").filemanager('reload');
			}
		}, 'json');		
		$(this).dialog('close');
	}
};

copymove_callback = function( type ) {
	var filetable = $("#filetable");

	var panel = $("#fn-filemanager-information-panel");
	var action = $("#fn-filemanager-action-panel");
	var main_toolbar = filetable.prev().children(".ui-filemanager-buttonbar");
	var filemanager = $("#filemanager");
	var files = filetable.filemanager('getSelected');

	var speed = 750;

	filetable.filemanager('disableButtons');


	action.empty();
	panel.empty();

	var button_yes = $("<button/>", {text: $.message("filemanager-"+type+"-yes")}).appendTo(action)
		.button({text: false, icons: { primary: 'ui-icon-check' } }).click(function(){
			action.hide('drop', {direction: 'right'}, speed);
			$.post(config.prefix+"/filemanager/"+type+"/json", {files: files, path: filetable.filemanager('option','root') }, function(data){
				update_status( data.success, data.error ? data.html : $.message("filemanager-"+type+"-success") );


				filetable.filemanager('disableButtons', false );

				panel.hide('drop', {direction: 'down'}, speed);

				if( ! data.error ) {
					filetable.filemanager('reload');
				}
			}, 'json');		
		});

	var button_no = $("<button/>", {text: $.message("filemanager-"+type+"-no")}).appendTo(action)
		.button({text: false, icons: { primary: 'ui-icon-close' } }).click(function(){
			action.hide('drop', {direction: 'right'}, speed);
			filetable.filemanager('disableButtons', false );
			panel.hide('drop', {direction: 'down'}, speed);
		});

	action.buttonset();

	panel.position({
		'my': 'bottom',
			'at': 'top',
			'of': filemanager,
			'offset': 0
	});
	action.position({
		'my': 'right',
			'at': 'left',
			'of': main_toolbar,
			'offset': "-30 0"
	});

	panel.show('drop', {direction: 'down'}, speed);
	action.show('drop', {direction: 'right'}, speed);
	panel.html($.message("filemanager-"+type+"-notice", files.length));
};
dialogs = {};
buttons = [
	{
		'id': 'fn-filemanager-button-upload',
		'disabled': false,
		'type': 'ui-icon-arrowthickstop-1-n',
		'alt': 'Upload File',
		'callback': function() {
			window.open(config.prefix + "/upload/index" + $("#filetable").filemanager('option','root'), "", "width=500,height=250.menubar=no,toolbar=no,location=no,directories=no,personalbar=no,status=no,dialog=yes");
		}
	},
	{
		'id': 'fn-filemanager-button-download',
		'disabled': true,
		'type': 'ui-icon-arrowthickstop-1-s',
		'alt': 'Download as ZIP',
		'callback': function() {
			var files = $("#filetable").filemanager('getSelected');
			var input = $("<input/>", { type: 'text', 'name': 'files[]' });
				var form = $("<form/>", {
				'action': config.prefix+"/filemanager/downloadzip",
				'method': 'POST'
			});
			$.each(files, function(index,value) {
				var e = input.clone();
				e.attr('value',value);
				form.append(e);
			});
			form.appendTo("body").submit().remove();
		}
	},
	{
		'id': 'fn-filemanager-button-create',
		'disabled': false,
		'type': 'ui-icon-plusthick',
		'alt': 'Create Folder',
		'callback': function() {
			dialogs["mkdir"].dialog("open");
		}
	},
	{
		'id': 'fn-filemanager-button-move',
		'disabled': true,
		'type': 'ui-icon-transferthick-e-w',
		'alt': 'Move files',
		'callback': function() { 
			copymove_callback.apply(this,['move']);
		}
	},
	{
		'id': 'fn-filemanager-button-copy',
		'disabled': true,
		'type': 'ui-icon-copy',
		'alt': 'Copy files',
		'callback': function() {
			copymove_callback.apply(this,['copy']);
		}
	},
	{
		'id': 'fn-filemanager-button-rename',
		'disabled': true,
		'type': 'ui-icon-pencil',
		'alt': 'Rename',
		'callback': function() {
			dialogs["rename"].dialog("open");
		}
	},
	{
		'id': 'fn-filemanager-button-perm',
		'disabled': true,
		'type': 'ui-icon-unlocked',
		'alt': 'Change permissions',
		'callback': function() {
			dialogs["perm"].dialog("open");
		}
	},
	{
		'id': 'fn-filemanager-button-delete',
		'disabled': true,
		'type': 'ui-icon-trash',
		'alt': 'Delete',
		'callback': function() {
			dialogs["delete"].dialog("open");
		}
	}
];

update_toolbar_buttons = function() {
	var length = $("#filetable").filemanager('length');
	if( length == 0 ) {
		$(buttons_requiring_selected_files_selectors).button("disable").data("is_disabled", true);
		$(buttons_requiring_single_selected_file_selectors).button("disable").data("is_disabled", true);
	} else if(length == 1) {
		$(buttons_requiring_selected_files_selectors).button("enable").data("is_disabled", false);
		$(buttons_requiring_single_selected_file_selectors).button("enable").data("is_disabled",false);
	} else {
		$(buttons_requiring_single_selected_file_selectors).button("disable").data("is_disabled", true);
		$(buttons_requiring_selected_files_selectors).button("enable").data("is_disabled", false);
	}
}

file_download_callback = function( options ){
	$("<form/>", {
		'action': config.prefix+"/filemanager/download",
		'method': 'POST',
		'html': $('<input/>', { type: 'text', 'name': 'path', value: options.path }) 
		}
	).appendTo("body").submit().remove();
}

$(document).ready(function() {

	filemanager_obj = $("#filetable");
	// All dialogs can be somewhat generic in buildup

	$.each( ['mkdir', 'delete', 'perm', 'rename'], function( index, value ) {

		var options = { "autoOpen": false,
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
			$.message("filemanager-" + value + "-dialog-title"),
			[
				{
					'label': $.message("filemanager-" + value + "-dialog-button-label"),
					'callback': function(){dialog_callbacks[value].apply(dialogs[value], arguments)},
					options: { id: 'fn-' + value + '-dialog-button' }
				}
			],
			options	
		);

		$("#fn-filemanager-" + value + "-dialog").submit(function() {
			dialog_callbacks[value].apply(dialogs[value]);
			return false;
		});
	});

	filemanager_obj.filemanager({
		fileDoubleClickCallback: file_download_callback,
		dirDoubleClickCallback: update_toolbar_buttons,
		mouseDownCallback: update_toolbar_buttons,
		prevDirIcon: 'ui-icons ui-icon-back',
        nextDirIcon: 'ui-icons ui-icon-next',
		ajaxSource: config.prefix+"/filemanager/index/json"
	});

	filemanager_obj.filemanager( 'setButtons', buttons );

});

</script>
