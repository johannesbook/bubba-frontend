<html>
<head>
<title><?=t('Upload')?>: <?= $path ?></title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<script type="text/javascript">
<!--

var isIE=false;

function getTextContent(name){
   var xmldoc;
   if(isIE){
        xmldoc=new ActiveXObject("Microsoft.XMLDOM");
        xmldoc.async="false";
        xmldoc.loadXML(req.responseText);
   }else{
        xmldoc=req.responseXML;
   }

   var item=xmldoc.getElementsByTagName(name);

   if(item.length>0){
        if(item[0].childNodes.length > 1){
                return item[0].childNodes[1].nodeValue;
        }else{
                return item[0].firstChild.nodeValue;
        }
   }else{
      return null;
   }
}

var startdate;
function calcuploadrate(dlnow){
   var dnow=new Date;
   var diffsec=(dnow.getTime()-startdate)/1000;
   return Math.floor((dlnow/diffsec)/1024);
}


var timer = 0;
var state = 0;
function processReqChange()
{
   if (req.readyState == 4 && req.status == 200 && req.responseText != null){

      var name=getTextContent('info');
      var size=getTextContent('size');
      var dld=getTextContent('downloaded');

      
      if(name!=null){
         if(state==1){
            setsize(Math.floor(size/1024)+" KB");
            state=2;
         }
         var done=Math.floor(100*dld/size);
         setprogress(done);
         setspeed(calcuploadrate(dld)+" KB/S");
         setitem("<?=t('Uploading')?>: "+name);
      }else{
         if(state==0){
            state=1;
            setprogress(0);
            setitem("<?=t('Initializing')?>");
         }
         if(state==2){
            state=3;
            setprogress(100);
            enable("b_close",true);
            setitem("<?=t('Upload complete')?>");
         }
      }   
   
      if (timer){
         clearTimeout(timer);
      }
      if(state<3){
         var url='loadXMLDoc("<?=FORMPREFIX?>/upload/progress/';
         url+=escape(document.getElementsByName("uuid")[0].value);
         url+='")';
      
         timer=setTimeout(url,500);
      }else{
         state=0;
      }
   }
}

function loadXMLDoc( url )
{
   req = false;
   if(window.XMLHttpRequest) {
      try {
         req = new XMLHttpRequest();
      } catch(e) {
         req = false;
      }
   }else if(window.ActiveXObject){
      isIE=true;
      try {
         req = new ActiveXObject("Msxml2.XMLHTTP");
      } catch(e) {
         try {
            req = new ActiveXObject("Microsoft.XMLHTTP");
         } catch(e) {
            req = false;
         }
      }
   }
   if(req) {
      req.onreadystatechange = processReqChange;
      req.open("GET", url, true);
      req.setRequestHeader( "If-Modified-Since", "Sat, 1 Jan 2000 00:00:00 GMT" );
      req.send("");
   }
}




function showhidediv(dv,vis){
   var upl=document.getElementById(dv);
   if(vis){
      upl.style.display="block";
   }else{
      upl.style.display="none";
   }   
}

var index=2;
function addupload(){
   var body=document.getElementsByTagName("body")[0];
   var upl=document.getElementById('uploads');
   var inp=document.createElement("input");
   var br=document.createElement("br");   
   inp.type="file";
   inp.name="file"+index;
   inp.size="40";
   index++;

   var bSize=body.offsetHeight;   
 
   upl.appendChild(inp);
   upl.appendChild(br);

   var aSize=body.offsetHeight;   

   window.resizeBy(0,aSize-bSize);
}

function addupploadbutton(){
   var add=document.getElementById('pg_adder');

   var inp=document.createElement("input");
   inp.type="button";
   inp.value="<?=t('Add entry')?>";
   inp.onclick=addupload;
   add.appendChild(inp);
}

function monitorupload(){
   showhidediv("uploaddiv",false);
   showhidediv("progressbar",true);
   startdate=new Date().getTime();
   var uuid=document.getElementsByName("uuid")[0];
   loadXMLDoc("<?=FORMPREFIX?>/upload/progress/"+escape(uuid.value));
}

function doInit(){
   showhidediv("uploaddiv",true);
   addupploadbutton();
   showhidediv("progressbar",false);
   
   setitem("");
   enable("b_close",false);

   window.focus();
}

function enable(item,state){
   var enable=document.getElementById(item);
   enable.disabled=!state;
}

// -->
</script>
</head>
<body onload="doInit()">

<div style="display: block; " id="uploaddiv">
<fieldset><legend><?=t('Upload to')?>: <?= $path ?></legend>
<form action="/cgi-bin/upload.cgi" method="post" enctype="multipart/form-data" target="uploadframe"  id="uploadform"> 
<input type="hidden" name="uuid" value="<? echo uniqid("upl");  ?>" />
<input type="hidden" name="uploadpath" value='<?= rawurlencode($path) ?>'/>
<div id="pg_adder"></div>
<div id="uploads">
<input type="file" name="file1" size="40"/><br/>
</div>
<input type="submit" value="<?=t('Start upload')?>" onclick="monitorupload()"/>
<input type="button" value="<?=t('Close')?>" onclick="window.close()"/>
</form>
<div id="progress"></div>
</div>
<iframe name="uploadframe" style="border: 0;width: 1px;height: 1px;"></iframe>
<div id="progressbar">
<script type="text/javascript">

function setprogress(p){
   var done=document.getElementById('pg_done');
   var left=document.getElementById('pg_left');
   if(p==0){
      done.style.visible="none";
      left.style.visible="block";
      left.width="100%";
   }else if(p==100){
      left.width="1px";
      left.style.visible="none";
      done.style.visible="block";
      done.width="100%";
   }else{   
      done.style.visible="block";
      left.style.visible="block";
      done.width=p+"%";
      left.width=(100-p)+"%";
   }
}

function setitem(item){
   var pg_item=document.getElementById('pg_item');
   pg_item.innerHTML=item;
}

function setsize(size){
   var pg_size=document.getElementById('pg_size');
   pg_size.innerHTML=size;
}

function setspeed(speed){
   var pg_speed=document.getElementById('pg_speed');
   pg_speed.innerHTML=speed;
}


</script>
<fieldset><legend><?=t('Uploading to')?>: <?= $path ?></legend>
<table border="0" cellspacing="0" width="100%">
<tr><td style="font-size: smaller; font-weight: bold;"><?=t('Total Upload')?></td><td style="text-align: left;" id="pg_size"></td></tr>
<tr><td style="font-size: smaller; font-weight: bold;"><?=t('Total Speed')?></td><td style="text-align: left;" id="pg_speed"></td></tr>
</table>
<table border="0" cellspacing="0" width="100%">
<tr><td id="pg_done" height="20" width="0%" bgcolor="#6754D7"></td><td  id="pg_left" width="100%" bgcolor="#99959A"></td></tr>
<tr><td colspan="2" style="font-size: smaller; font-weight: bold; text-align: center; " id="pg_item"></td></tr>
<tr><td colspan="2"><input type="button" value="<?=t('Close')?>" id="b_close" onclick="window.close()"/></td></tr>
</table>
</fieldset>
</div>

</body>
</html>
