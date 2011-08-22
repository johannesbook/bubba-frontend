<script src="<?=FORMPREFIX.'/views/'.THEME?>/_js/login.js?v='<?=$this->session->userdata('version')?>" type="text/javascript"></script>

<script>
redirect_uri=<?=json_encode(isset($redirect_uri) ? $redirect_uri : null)?>;
required_user=<?=json_encode(isset($required_user) ? $required_user : null)?>;
authenticated=<?=json_encode($this->Auth_model->CheckAuth("web_admin"))?>;
show_login=<?=json_encode(isset($show_login) ? $show_login : false)?>;
</script>
