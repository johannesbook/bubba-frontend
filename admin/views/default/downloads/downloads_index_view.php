
<script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME?>/_js/periodicalUpdate.js?v='<?=$this->session->userdata('version')?>'"></script>
<script type="text/javascript">
$(document).ready(function(){
    $("#downloadcontent").PeriodicalUpdate(
        {
            url:'<?=FORMPREFIX?>/downloads/dolist',
            delay:2000,
            delayed:true
        }
    );

    $("#download-addurl").focus();
});
</script>

<?if(!$enabled):?>
<div class="ui-information-panel">
    <?=_("Download service disabled")?>
</div>
<?endif?>

<div class="ui-state-default ui-div-header"><?=_("Downloads")?></div>
<div style="height: 300px; overflow: auto; " id="downloadcontent"></div>

<div class="ui-state-default ui-div-header"><?=_('Add new download')?></div>
<form action="<?=FORMPREFIX?>/downloads/add" method="post" id="add_download">
    <table class="ui-table-outline">
        <tr>
            <td>
                <label for="downloads-addurl">
                    <?=_("Location"):?>
                </label>
                <input
                    id="download-addurl"
                    type="text"
                    name="url"
                    <?if(!$enabled):?>disabled="disabled"<?endif?>
                />
            </td>
        </tr>
        <tr>
            <td>
                <input
                    type="hidden"
                    name="uuid"
                    value="<?=$uuid?>"
                    <?if(!$enabled):?>disabled="disabled"<?endif?>
                />
                <input
                    type="submit"
                    name="add_download"
                    value="<?=_("Add")?>"
                    <?if(!$enabled):?>disabled="disabled"<?endif?>
                />
            </td>
        </tr>
    </table>
</form>
