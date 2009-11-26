<ul>
<li class="<?=$this->uri->segment(2) == 'albums' ? 'active': '';?>"><a href="<?=FORMPREFIX?>/album/albums"><?=t('Albums')?></a></li>
<li class="<?=$this->uri->segment(2) == 'users' ? 'active': '';?> last"><a href="<?=FORMPREFIX?>/album/users"><?=t('Users')?></a></li>
</ul>
