<ul class="jqueryFileTree" style="display: none">
	<?foreach( $albums as $album ):?>
		<li class="directory collapsed" id="album_<?=$album['id']?>" >
			<a href="#" rel="<?=$album['id']?>"><?=$album['name']?></a>
		</li>
	<?endforeach?>
	<?foreach( $images as $image ):?>
		<li class="file ext_jpg" id="image_<?=$image['id']?>" >
			<a href="#" rel="<?=$image['id']?>"><?=$image['name']?></a>
		</li>
	<?endforeach?>
</ul>
