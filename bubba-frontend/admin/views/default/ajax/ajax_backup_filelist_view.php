<ul class="jqueryFileTree" style="display: none">
	<?foreach( $dirs as $dir ):?>
		<li class="directory collapsed" >
			<a href="#" rel="<?=htmlspecialchars("$root/$dir")?>"><?=htmlspecialchars($dir)?></a>
		</li>
	<?endforeach?>
</ul>
