messages = {
	// Generic
	"button-label-close": "Close",
	"button-label-cancel": "Cancel",
	"button-label-edit": "Edit",
	"text-yes": "Yes",
	"text-no": "No",
    "next": "Next",
    "back": "Back",
	
	// Topnav
	"topnav-login": "Login",

	// Filemanager
	// Filemangaer buttonbar
	"filemanager-buttonbar-create" : "Create folder",	
	"filemanager-buttonbar-upload" : "Upload file",
	"filemanager-buttonbar-download" : "Download as zip",
	"filemanager-buttonbar-move" : 'Move files',
	"filemanager-buttonbar-copy" : 'Copy files',
	"filemanager-buttonbar-rename" : 'Rename files',
	"filemanager-buttonbar-perm" : 'Change permissions',
	"filemanager-buttonbar-album" : 'Add to album',
	"filemanager-buttonbar-delete" : 'Delete',
	"filemanager-label-name" : "Folder name", 
	
	// Filemanager dialogs
	"filemanager-mkdir-dialog-button-label" : "Create folder",	
	"filemanager-album-dialog-button-label" : "Add to album",	
	"filemanager-rename-dialog-button-label" : "Rename",	
	"filemanager-perm-dialog-button-label" : "Change permissions",
	"filemanager-delete-dialog-button-label" : "Delete",
	"filemanager-delete-dialog-title" : "Delete files and folders",

	// Filemanager messages
	"filemanager-delete-fail-message" : "Failed to delete following files and folders: %s",
	"filemanager-delete-dialog-message" : "Are you certain that you want to delete selected files and folders?",
	"filemanager-move-notice" : "You are about to move %d items. Go to the desired folder and press <span class=\"ui-icon ui-icon-check ui-helper-inline\"></span> to confirm move",
	"filemanager-move-yes" : "Move",
	"filemanager-move-no" : "Abort",
	"filemanager-move-success" : "Succeeded to move the files and folders",
	"filemanager-copy-notice" : "You are about to copy %d items. Go to the desired folder and press <span class=\"ui-icon ui-icon-check ui-helper-inline\"></span> to confirm copy",
	"filemanager-copy-yes" : "Copy",
	"filemanager-copy-no" : "Abort",
	"filemanager-copy-success" : "Succeeded to copy the files and folders",
	"filemanager-success-album" : "Sucessfully added pictures to the album",
	"filemanager-success-album-title" : "Pictures added",
	"filemanager-success-album-message" : "Sucessfully added %d pictures to the album",
	"filemanager-success-delete" : "Successfully deleted the files/folders",
	"filemanager-success-perm" : "Successfully changed permission on the given files/folders",
	"filemanager-success-rename" : "Successfully renamed the file/folder",
	"filemanager-success-mkdir" : "Successfully created a folder",
	"filemanager-perm-fail-message" : "Failed to change permission for the file/folder",

    // Backup
    "backup-job-remove-button-label" : "Remove",
    "backup-job-restore-button-label" : "Restore",
    "backup-job-run-now-button-label" : "Run now",    
    "backup-create-button-finish": "Complete",
    "backup-edit-button-finish": "Complete",
    "backup-job-dialog-remove-message": "Are you sure you want to permanently remove this backup job?",
    "backup-job-dialog-remove-header": "Remove backup job",
    "backup-job-dialog-remove-button-label": "Remove backup job",
    "backup-job-remove-success-message": "Backup job was removed from the system",
    "backup-job-dialog-run-message": "Are you sure you want to run this backup job now?",
    "backup-job-dialog-run-header": "Run backup job now",
	"backup-job-dialog-run-button-label": "Run backup job",
    "backup-job-run-success-message": "Backup job has been initialized to be executed at this particlular moment in time.",
	"backup-dialog-restore-title": "Restore backed up data",
	"backup-dialog-restore-label": "Restore selected files and directories",
    'backup-restore-overwrite-confirm-message': 'Are you sure? Any existing files will be overwritten.',
    'backup-restore-overwrite-confirm-header': 'Confirm restore',
	'backup-job-failed-label': 'Failed',
	'backup-job-failed-why-label': 'why?',
	'backup-job-failed-alert-title': 'Backup job %s failed',
	// Mail
	"mail-dialog-delete-foruser" : "Delete account for user '",
	"mail-dialog-delete-onserver" : "' on server '",
	"mail-dialog-button-delete" : "Delete account",
	"mail-dialog-delete-title" : "Delete mail account"	,
	
	// Logout
	"logout-dialog-title" : "Proceed with logout?",
	"logout-dialog-message" : "",
	"logout-dialog-button-logout" : "Logout",

	// Login
	"login-dialog-continue" : "Login",

	// Mail
	"mail-retrieve-edit-dialog-button-label": "Update",
	"mail-retrieve-edit-dialog-delete-button-label": "Delete",
	"mail-retrieve-edit-dialog-delete-message": "",
	"mail-retrieve-edit-dialog-delete-header": "Delete email account?",
	"mail-retrieve-add-dialog-button-label": "Add email account",
	"mail-retrieve-add-dialog-header": "Add new email account",
	"mail-retrieve-add-success-message": "Successfully added new email account",
	"mail-retrieve-edit-success-message": "Email account updated",
	"mail-retrieve-edit-dialog-header": "Edit email account information for host <em>%s</em>",
	"mail-retrieve-delete-success-message" : "Successfully deleted email account",

	// Users
	"users-list-add-dialog-button-label" : "Add new user",
	"users-list-edit-dialog-button-label" : "Update",
	"users-list-edit-dialog-delete-button-label" : "Delete user",
	"users-list-add-dialog-header" : "Add new user to the system",
	"users-list-edit-dialog-header" : "Edit user",
	"users-edit-single-button-label" : "Update settings",
	"users-list-edit-dialog-delete-header":"Delete user",
	"users-list-edit-dialog-delete-userdata-label":"Delete userdata?",
	"users-list-edit-dialog-delete-message":"Delete this user from the system?",
	"users-list-delete-success-message":"User deleted",
	"users-delete-account-error":"Failed to delete user account",
	"users-list-add-success-message":"Successfully added new user",
	"users-list-edit-success-message":"User information updated",
	
	// Stat
	"stat-shutdown-button-continue" : "Shut down",
	"stat-shutdown-confirm-message" : "Proceed to shut down "+config.name+"?",
	"stat-shutdown-confirm-title" : "Shut down",
	"stat-reboot-button-continue" : "Restart",
	"stat-reboot-confirm-message" : "Proceed to restart "+config.name+"?",
	"stat-reboot-confirm-title" : "Restart",
	"stat-notify-no-more-messages" : "No more system messages available",

	// Album
	"album-users-add-dialog-button-label" : "Add new viewer",
	"album-users-edit-dialog-button-label" : "Update viewer",
	"album-users-edit-dialog-delete-button-label" : "Delete viewer",
	"album-users-add-dialog-header" : "Add new viewer to the photo album",
	"album-users-edit-dialog-header" : "Edit album viewer",
	"album-users-edit-dialog-delete-header":"Delete photo album viewer",
	"album-users-edit-dialog-delete-message":"Delete this photo album viewer?",
	"album-users-delete-success-message":"Viewer deleted",
	"album-users-add-success-message":"Viewer added",
	"album-users-edit-success-message":"Viewer updated"
}
