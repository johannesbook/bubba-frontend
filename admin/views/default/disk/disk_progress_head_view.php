<script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME?>/_js/jquery.progress.js?v='<?=$this->session->userdata('version')?>'"></script>

<script type="text/javascript">
title=<?=json_encode($title)?>;
type=<?=json_encode($type)?>;
initial_progress=<?=json_encode($progress)?>;
is_running=<?=json_encode($is_running)?>;
</script>

<script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME?>/_js/disk_progress.js?v='<?=$this->session->userdata('version')?>'"></script>
