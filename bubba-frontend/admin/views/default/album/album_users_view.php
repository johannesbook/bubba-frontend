<script type="text/javascript">
$(document).ready( function() {
	$.post( '<?=site_url("ajax_album/get_users")?>',
		{}, function( data ) {
			row = $('<tr />');
			for( var i = 0; i < data.users.length; ++i ) {
				cur_row = row.clone();
				cur_row.appendTo('#user-table');
				cur_row.append(
					$('<td />')
					.text( data.users[i].username )
					.attr('id', 'username_' + data.users[i].id)
				)
				.append(
					$('<td />').append(
						$('<a />')
						.attr('rel', data.users[i].id)
						.attr('href', '#')
						.addClass('delete')
						.text('<?=t("Delete")?>')
					)
				)
				.append(
					$('<td />').append(
						$('<a />')
						.attr('rel', data.users[i].id)
						.attr('href', '#')
						.addClass('modify')
						.text('<?=t("Modify")?>')
					)
				);

			}

			$('#add-user').click(
				function(e) { 
					$.modal(
						$('<form />')
						.append(
							$('<div class="header"><span><?=t("Add user")?></span></div>')
						)
						.append(
							$('<table />')
							.append(
								$('<tr />')
								.append(
									$('<td />').append($('<label for="username" type="text">Username: </label>'))
								)
								.append(
									$('<td />').append($('<input id="username" type="text"/>'))
								)
							)
							.append(
								$('<tr />')
								.append(
									$('<td />').append($('<label for="password" type="text">Password: </label>'))
								)
								.append(
									$('<td />').append($('<input id="password" type="password"/>'))
								)
							)
							.append(
								$('<tr />')
								.append(
									$('<td />').append($('<label for="password2" type="text">Confirm: </label>'))
								)
								.append(
									$('<td />').append($('<input id="password2" type="password"/>'))
								)
							)
						)

						.append(
							$('<div class="buttons" />')
							.append($("<input type='button' class='no simplemodal-close' value='<?=t("Cancel")?>' />"))
							.append($("<input type='button' value='<?=t("Add user")?>' />").click(function(e) {
								pw1 = $('#password').val();
								pw2 = $('#password2').val();
								username = $('#username').val();
								if( pw1 != pw2 ) {
									alert("<?=t("Passwords do not match")?>");
									return false;
								}
								if( pw1.length < 2 ) {
									alert( '<?=t("Password is too short (min 2 characters)")?>' );
									return false;
								}
								$.post(  '<?=site_url("ajax_album/add_user")?>',
								{
									username: username,
									password: pw1
								}, function(data) {
									if( data.error ) {
										update_status("fail","<?=t("Failed to add user")?>");
										return;
									}
									cur_row = row.clone();
									cur_row.appendTo('#user-table');
									cur_row.append(
										$('<td />')
										.text( username )
										.attr('id', 'username_' + data.uid)
									)
									.append(
										$('<td />').append(
											$('<a />')
											.attr('rel', data.uid)
											.attr('href', '#')
											.addClass('delete')
											.text('<?=t("Delete")?>')
										)
									)
									.append(
										$('<td />').append(
											$('<a />')
											.attr('rel', data.uid)
											.attr('href', '#')
											.addClass('modify')
											.text('<?=t("Modify")?>')
										)
									);
									$.modal.close();
								}, 'json' );
							}))
							)
						);
					$('#username').focus();
				}
			);

			$('#user-table .delete').live( 'click',
				function(e) { 
					uid = $(this).attr('rel');
					that = $(this).closest('tr');
					uname = $(this).closest("td").siblings("[id^=username_]").text();
					$.confirm( "<?=t("Remove photo album user")?> '" + uname + "'?", function() {
						$.post( '<?=site_url("ajax_album/remove_user")?>', { uid: uid }, function(data) {
							update_status("success","<?=t("User removed")?>");
							that.remove();
						}, 'json' );
					},"<?=t("Remove user")?>","<?=t("Cancel")?>","<?=t("Remove user")?>");
				}
			);

			$('#user-table .modify').live( 'click',
				function(e) { 
					uid = $(this).attr('rel');
					username = $('#username_' + uid ).text();
					that = $(this).closest('tr');
					$.modal(
						$('<form />')
						.append(
							$('<div class="header"><span><?=t("Modify user ")?>\''+username+'\'</span></div>')
						)
						.append(
							$('<table />')
							.append(
								$('<tr />')
								.append(
									$('<td />').append($('<label for="username" type="text">Username: </label>'))
								)
								.append(
									$('<td />').append($('<input id="username" type="text"/>').val(username))
								)
							)
							.append(
								$('<tr />')
								.append(
									$('<td />').append($('<label for="password" type="text">Password: </label>'))
								)
								.append(
									$('<td />').append($('<input id="password" type="password"/>'))
								)
							)
							.append(
								$('<tr />')
								.append(
									$('<td />').append($('<label for="password2" type="text">Confirm: </label>'))
								)
								.append(
									$('<td />').append($('<input id="password2" type="password"/>'))
								)
							)
						)
						.append(
							$('<div class="buttons" />')
							.append($("<input type='button' class='no simplemodal-close' value='<?=t("Cancel")?>' />"))
							.append($("<input type='button' class='yes' value='<?=t("Update")?>' />").click(function(e) {
								pw1 = $('#password').val();
								pw2 = $('#password2').val();
								username = $('#username').val();
								if( pw1 != pw2 ) {
									alert("<?=t("Passwords do not match")?>");
									return false;
								}
								if( pw1.length < 2 && pw1.length != 0 ) {
									alert( '<?=t("Password is too short (min 2 characters)")?>' );
									return false;
								}
								$.post(  '<?=site_url("ajax_album/modify_user")?>',
								{
									uid: uid,
									username: username,
									password: pw1
								}, function(data) {

									if( data.error ) {
										update_status("fail","<?=t("Failed to modify user")?>");
										return;
									} else {
										update_status("success","<?=t("User information updated")?>");
									}

									$('#username_' + uid ).text(username);
									$.modal.close();
								}, 'json' );
							}))
							)
						);

					$('#username').focus();
				}
			);
		}, 'json' );
});
</script>

<table id="user-table" title="User list">
	<tr>
		<td><?=t("Existing users")?></td>
		<td />
		<td />
	</tr>
</table>
<input type="button" id="add-user" value="<?=t("Add user")?>" />

<div id="tmp"/>

