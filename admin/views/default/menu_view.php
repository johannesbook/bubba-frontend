    <div id="menu" style="display:none">      
        <a class="default-icon default-icon-mail">
            <span class="" style="display:none"><?=t("menubar_pim")?></span>    
        </a>   
        <a class="default-icon default-icon-music">
            <span class="" style="display:none"><?=t("menubar_music")?></span>    
        </a> 
        <a class="default-icon default-icon-help">
            <span class="" style="display:none"><?=t("menubar_photos")?></span>
        </a>      
        <a class="default-icon default-icon-filemanager">
            <span class="" style="display:none"><?=t("menubar_filemanager")?></span>    
        </a> 
        <a class="default-icon default-icon-filemanager">
            <span class="" style="display:none"><?=t("menubar_backup")?></span>    
        </a>       
        <a class="default-icon default-icon-filemanager <?=$ui_login_user_lock?>">
            <span class="" style="display:none"><?=t("menubar_usersettings")?></span>    
        </a>      
        <a class="default-icon default-icon-logout">
             <span class="" style="display:none">Logout</span>
        </a>     
        <a id="menu_close" class="ui-icon ui-icon-closethick" onclick="$('#home').toggle()"></a>
    </div>
