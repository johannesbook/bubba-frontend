$(function() {

	$('.remove_raid_disk').click(function(e) {
		$.post(config.prefix + "/ajax_disk/remove_raid_disk", {
			disk: $(e.target).attr('rel')
		},
		function(data) {
			if (data.error) {
				update_status(false, data.html);
			} else {
				location.reload();
			}
		});
	});
	$('#recover_md').click(function() {
		var dialog_element = $.dialog("", _("Recover RAID array"), {});
		dialog_element.text(_("Examining existing disks"));
		$.post(config.prefix + "/ajax_disk/get_raid_disks", {},
		function(data) {
			dialog_element.empty();
			if (data.internal) {
				if (data.clean_disks.length > 0) {
					// we got disks that can be used in RAID array
					dialog_element.html($('<p/>', {
						html: _("Select external disk to add to RAID array")
					}));

					// Creating the dropdown of all available external disks
					var select = $('<select/>', {
						id: 'external'
					});
					for (i = 0; i < data.clean_disks.length; ++i) {
						select.append(
						$("<option />", {
							value: data.clean_disks[i],
							html: data.clean_disks[i]
						}));
					}
					dialog_element.append(select);

					// Updating the buttons in the dialog
					dialog_element.dialog('option', 'buttons', [{
						"text": _("Add disk to RAID array"),
						"click": function() {
							// Callback when choosing to create RAID
							var external_device = select.val();

							// The warning that now we are going to destroy any data on external disk
							dialog_element.html($("<h2/>", {
								'class': "ui-warning-highlight",
								html: _("Warning")
							}));
							dialog_element.append($('<p/>', {
								html: _("Recovering the RAID array will <strong>destroy all content</strong> on the selected extenal disk")
							})).append($('<p/>', {
								html: _("Continue to recover RAID?")
							}));

							// Updating the buttons in the dialog
							dialog_element.dialog('option', 'buttons', [{
								"text": _("Add disk to RAID array"),
								"click": function() {
									// Callback when confirming creation of RAID
									dialog_element.dialog('option', 'title', _("Recovering external disk in RAID array"));
									dialog_element.dialog('option', 'buttons', {}); // remove buttons
									dialog_element.dialog('option', 'beforeclose', function() {
										return false;
									}); // prevent closing of dialog
									dialog_element.html($("<p/>", {
										html: _("Please wait...")
									}));

									// calling the actual RAID recovery, point of no return
									$.post(config.prefix + "/ajax_disk/recover_raid_broken_external", {
										external: external_device
									},
									function(data) {
										location.assign("/admin/disk/progress");
									},
									'json');
								}
							}]);
						}
					}]);
				} else {
					// We have no disks to use as RAID array
					dialog_element.html($("<p/>", {
						html: _("There are no usable external disks attached, please add an external e-SATA disk and try again")
					}));
					dialog_element.dialog('option', 'buttons', [{
						"text": _("Close"),
						"click": function() {
							dialog_element.dialog('close');
						}
					}]);
				}

			} else if (data.disks.length > 0) {
				if (data.internal_got_mounts) {
					// There exists mounts under /home
					dialog_element.html($("<p/>", {
						html: _("There seem to be disks mounted, please unmount these and try again")
					}));
					dialog_element.dialog('option', 'buttons', [{
						"text": _("Close"),
						"click": function() {
							dialog_element.dialog('close');
						}
					}]);
				} else {
					// we got disks that can be used in RAID array
					dialog_element.html($('<p/>', {
						html: _("Select which external disk to recover RAID data from")
					}));

					// Creating the dropdown of all available external disks
					var select_obj = $('<select/>', {
						id: 'external'
					});
					for (i = 0; i < data.disks.length; ++i) {
						select_obj.append(
						$("<option />", {
							value: data.disks[i],
							html: data.disks[i]
						}));
					}
					dialog_element.append(select_obj);

					// Updating the buttons in the dialog
					dialog_element.dialog('option', 'buttons', [{
						"text": _("Recover internal disk"),
						"click": function() {
							// Callback when choosing to create RAID
							var external_device = select_obj.val();

							// The warning that now we are going to destroy any data on external disk
							dialog_element.html($("<h2/>", {
								'class': "ui-warning-highlight",
								html: _("Warning")
							}));
							dialog_element.append($('<p/>', {
								html: _("Recovering the RAID array will <strong>destroy all content</strong> on your internal disk (/home&nbsp;-&nbsp;including&nbsp;'storage')")
							})).append($('<p/>', {
								html: _("Continue to recover RAID?")
							}));

							// Updating the buttons in the dialog
							dialog_element.dialog('option', 'buttons', [{
								"text": _("Recover internal disk"),
								"click": function() {
									// Callback when confirming creation of RAID
									dialog_element.dialog('option', 'title', _("Recovering internal disk in RAID array"));
									dialog_element.dialog('option', 'buttons', {}); // remove buttons
									dialog_element.dialog('option', 'beforeclose', function() {
										return false;
									}); // prevent closing of dialog
									dialog_element.html($("<p/>", {
										html: _("Please wait...")
									}));

									// calling the actual RAID recovery, point of no return
									$.post(config.prefix + "/ajax_disk/recover_raid_broken_internal", {
										external: external_device
									},
									function(data) {
										location.assign("/admin/disk/progress");
									},
									'json');
								}
							}]);
						}
					}]);
				}
			} else {
				// We have no disks to use as RAID array
				dialog_element.html($("<p/>", {
					html: _("No disks with RAID data found")
				}));
				dialog_element.dialog('option', 'buttons', [{
					"text": _("Close"),
					"click": function() {
						dialog_element.dialog('close');
					}
				}]);
			}
		},
		'json');
	});

	$('#create_md_internal_external_mirror').click(function() {
		var dialog_element = $.dialog("", _("Create RAID array"), {});
		dialog_element.text(_("Examining existing disks"));

		$.post(config.prefix + "/ajax_disk/get_external_disks", {
			removable: ! false,
			raid: false,
			usb: false
		},
		function(data) {
			dialog_element.empty();
			if (data.internal_got_mounts) {
				// There exists mounts under /home
				dialog_element.html($("<p/>", {
					html: _("There seem to be disks mounted, please unmount these and try again")
				}));
				dialog_element.dialog('option', 'buttons', [{
					"text": _("Cancel"),
					"click": function() {
						dialog_element.dialog('close');
					}
				}]);
			} else {
				if (data.disks.length) {
					// we got disks that can be used in RAID array
					dialog_element.html($('<p/>', {
						html: _("Select which external disk to include in the array. An external disk with the same size is recommended")
					}));

					// Creating the dropdown of all available external disks
					var select = $('<select/>', {
						id: 'external'
					});
					for (i = 0; i < data.disks.length; ++i) {
						select.append(
						$("<option />", {
							value: data.disks[i],
							html: data.disks[i]
						}));
					}
					dialog_element.append(select);

					// Updating the buttons in the dialog
					dialog_element.dialog('option', 'buttons', [{
						"text": _("Create RAID"),
						"click": function() {
							// Callback when choosing to create RAID
							external_device = select.val();

							// The warning that now we are going to destroy any data on external disk
							dialog_element.html($("<h2/>", {
								'class': "ui-warning-highlight",
								html: _("Warning")
							}));
							dialog_element.append($('<p/>', {
								html: _("Creating the RAID array will <strong>destroy all content</strong> on your internal disk (/home&nbsp;-&nbsp;including&nbsp;'storage') and erase the selected external disk")
							})).append($('<p/>', {
								html: _("Please make sure that you have backup of all files")
							})).append($('<p/>', {
								html: _("Continue to create RAID?")
							}));

							// Updating the buttons in the dialog
							dialog_element.dialog('option', 'buttons', [{
								"text": _("Create RAID"),
								"click": function() {
									// Callback when confirming creation of RAID
									dialog_element.dialog('option', 'title', _("Creating RAID array"));
									dialog_element.dialog('option', 'buttons', {}); // remove buttons
									dialog_element.dialog('option', 'beforeclose', function() {
										return false;
									}); // prevent closing of dialog
									dialog_element.html($("<p/>", {
										html: _("Please wait...")
									}));

									// calling the actual RAID creation, point of no return
									$.post(config.prefix + "/ajax_disk/create_raid_internal_lvm_external", {
										level: 1,
										external: external_device
									},
									function(data) {
										location.assign("/admin/disk/progress");
									},
									'json');
								}
							}]);
						}
					}]);

				} else {
					// We have no disks to use as RAID array
					dialog_element.html($("<p/>", {
						html: _("No usable disk found")
					}));
					dialog_element.dialog('option', 'buttons', [{
						"text": _("Close"),
						"click": function() {
							dialog_element.dialog('close');
						}
					}]);
				}
			}

		},
		'json');
	});

});
