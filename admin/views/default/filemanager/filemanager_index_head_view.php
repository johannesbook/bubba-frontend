<script src="<?=FORMPREFIX.'/views/'.THEME?>/_js/jquery.dataTables.js?v='<?=$this->session->userdata('version')?>" type="text/javascript"></script>
<script src="<?=FORMPREFIX.'/views/'.THEME?>/_js/jquery.ba-serializeobject.js?v='<?=$this->session->userdata('version')?>" type="text/javascript"></script>
<script src="<?=FORMPREFIX.'/views/'.THEME?>/_js/jquery.ui.filemanager.js?v='<?=$this->session->userdata('version')?>" type="text/javascript"></script>
<script src="<?=FORMPREFIX.'/views/'.THEME?>/_js/filemanager.js?v='<?=$this->session->userdata('version')?>" type="text/javascript"></script>

<script>
album_add_access=<?=json_encode($this->Auth_model->policy("album","add"))?>;
path=<?=json_encode($path)?>;
</script>

<script>

</script>
