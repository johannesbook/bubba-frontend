<div>
    <h3><?=_("Select language (step 1 of 5)")?></h3>
    <select
        name="language"
        id="fn-wizard-language"
        >
        <?foreach($official_languages as $lang):?>

        <option
        id="option_<?=$lang['short_name']?>"
        value="<?=$lang['short_name']?>"
        <?if(isset($lang['default']) && $lang['default']):?>selected="selected"<?endif?>
        >
        <?=$lang['long_name']?>
        </option>

        <?endforeach?>

        <?if(sizeof($user_languages)):?>
        <optgroup label="<?=_("User contributed languages")?>">

            <?foreach($user_languages as $lang):?>

            <option
            id="language_option_<?=$lang['short_name']?>"
            value="<?=$lang['short_name']?>"
            <?if(isset($lang['default']) && $lang['default']):?>selected="selected"<?endif?>
            >
            <?=$lang['long_name']?>
            </option>

            <?endforeach?>

        </optgroup>
        <?endif?>

    </select>
</div>
