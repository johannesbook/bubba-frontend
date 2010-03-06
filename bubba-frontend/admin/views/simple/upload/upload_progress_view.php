<?php
		header("content-Type: application/xml");
		header("Cache-Control: no-cache, must-revalidate");
		header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		print"<?xml version=\"1.0\" encoding=\"UTF-8\" ?>\n\n";
?>
<? if($res==NULL){?>
<error>
<message><?=t('Download not found')?></message>
<user><?=$user?></user>
<uuid><?=$uuid?></uuid>
</error>
<? }else{ ?>
<download>
   <adress><?= $res["adress"] ?></adress>
   <user><?= $res["user"] ?></user>
   <url><?= $res["url"] ?></url>
   <name><?= $res["name"] ?></name>
   <info><?= $res["info"] ?></info>
   <status><?= $res["status"] ?></status>
   <size><?= $res["size"] ?></size>
   <downloaded><?= $res["downloaded"] ?></downloaded>
</download>
<? } ?>
