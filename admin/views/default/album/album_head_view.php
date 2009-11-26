<link href="<?=FORMPREFIX.'/views/'.THEME?>/_css/jqueryFileTree.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="<?=FORMPREFIX.'/views/'.THEME?>/_css/jquery.simplemodal.css" />
<link rel="stylesheet" type="text/css" href="<?=FORMPREFIX.'/views/'.THEME?>/_css/jquery.simplemodal.confirm.css" />
<style>

table#album {
	width: 100%;
	height: 490px;
	overflow: auto;
	font-size : 11px;
	margin : 0px;
}

table#album input {
	font-size : 11px;
}

table#album tbody tr {
	overflow: auto;
}
table#album tbody td {
	width: 50%;
	overflow: auto;
}
#album_list {
	height: 400px;
	overflow: auto;
	background-color: #444;
	border: 1px solid #555;
}

#album_edit_area form{
	margin : 0;
	margin-top: 11px;
}

#album_edit_area fieldset{
	margin : 0;
	padding-top : 0;
}

.filename {
	font-size: smaller;
	margin-bottom : 0.7em;
	margin-left : 40px;
}
.ghost {
	position: absolute;
	filter:alpha(opacity=50);
	-moz-opacity: 0.5;
	opacity: 0.5;
	background-color: #CCF;
	border-color: #AAD;
	color: #AAD;
	border-width: 1px;
}

#album_list .outline {
	background-color: #FCC;
	border-color: #DAA;
	border-style: dashed;
	color: #DAA;
	border-width: 1px;
}
#album_list .active {
	border-width: 1px;
	background-color: #CFC;
	border-color: #ADA;
}
#album_list .selected {
	background-color: #0091d1;
}
	
div#loader {
  border: 1px solid #ccc;
  width: 300px;
  height: 225px;
  margin-left : 40px;
}
div#loader.loading {
  background: url(<?=FORMPREFIX.'/views/'.THEME?>/_img/jft/spinner.gif) no-repeat center center;
}


div#album_edit_area .metadata {
	font-size : 11px;
	margin : 0;
}

div#album_edit_area.public_access{
	vertical-align : bottom;
}

input#public {
	margin-left: 30px;
}

div#album_edit_area table td {
	vertical-align : top;
}

div#album_edit_area input#name {
	width: 200px;
}
div#album_edit_area textarea#caption {
	width: 200px;
	font-size : 11px;
}

table#user-mod {
	font-size: 11px;
	width: 100%;
	min-height: 2em;
	overflow: auto;
	border : 1px solid;
}
table#user-mod tbody tr td {
}

table#user-mod .user-group {
	border: 1px solid #555555;
}

table#user-mod .user-group-header {
	border: none;
	font-style : italic;
	padding-left : 5px;
}

table#album .user-group-comment{
	border: none;
	font-style : italic;
	padding-left : 5px;
	font-size : 10px;
}

.user {
	display: block;
	cursor: pointer;
}
#user-mod .outline {
	background-color: #0091D1;
	border-color: #ffffff;
	border-style: dashed;
	color: #ffffff;
	border-width: 1px;
}
#user-mod .active {
	border-width: 1px;
	border-color: #ADA;
}
#user-mod .selected {
	background-color: #0091d1;
}
#user-mod.disabled {
	border: 1px solid;
	background-color: none;
	color: #aaa;
	cursor: default;
}

.user.ghost {
	position: absolute;
	filter:alpha(opacity=50);
	-moz-opacity: 0.5;
	opacity: 0.5;
	background-color: #EEF;
	border-color: #AAD;
	color: #77A;
	cursor: crosshair;
	border-width: 1px;
}
</style>
<script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME?>/_js/jqueryFileTree.js"></script>
<script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME?>/_js/jquery.event.drag.js"></script>
<script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME?>/_js/jquery.event.drop.js"></script>
<script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME?>/_js/jquery.timers.js"></script>
<script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME?>/_js/jquery.simplemodal.js"></script>
<script type="text/javascript" src="<?=FORMPREFIX.'/views/'.THEME?>/_js/jquery.simplemodal.confirm.js"></script>
