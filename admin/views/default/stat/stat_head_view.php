<script type="text/javascript">
function piechart(chart_canvas) {
  var chart = chart_canvas[0];
  var percentage = chart_canvas.attr('rel');
  if(chart.getContext)
  {
    var x = Math.PI/50;
    var ctx = chart.getContext('2d');
    ctx.scale(1,0.45);

    if (x*percentage - Math.PI/2 > 0)
    {
      ctx.fillStyle = '#506AB2';
      ctx.beginPath();
      var angle = x*percentage-Math.PI/2 > Math.PI ? Math.PI : x*percentage-Math.PI/2;
      ctx.arc(55,60,55, 0, angle, false);
      ctx.arc(55,85,55, angle, 0, true);
      ctx.fill();
    }

    if (x*percentage - Math.PI/2 < Math.PI)
    {
      ctx.fillStyle = '#1a1a1a';
      ctx.beginPath();
      var startangle = x*percentage - Math.PI/2 > 0 ? x*percentage - Math.PI/2 : 0;
      ctx.arc(55,60,55, startangle, Math.PI, false);
      ctx.arc(55,85,55, Math.PI, startangle, true);
      ctx.fill();
    }

    ctx.fillStyle = '#506AB2';
    ctx.beginPath();
    ctx.arc(55,60,55, -Math.PI/2, x*percentage-Math.PI/2, false);
    ctx.lineTo(55,60);
    ctx.fill();
    
    ctx.fillStyle = '#656565';
    ctx.beginPath();
    ctx.arc(55,60,55, x*percentage-Math.PI/2, -Math.PI/2, false);
    ctx.lineTo(55,60);
    ctx.fill();
    
    var gradient = ctx.createLinearGradient(0,0,0,130);
    gradient.addColorStop(0,'rgba(255,255,255,0)');
    gradient.addColorStop(1,'rgba(255,255,255,0.2)');
    ctx.strokeStyle = gradient;
    ctx.beginPath();
    ctx.arc(55,60,55, 0, Math.PI*2, false);
    ctx.stroke();
  }
}

$(window).load(function() {
	piechart($('#piechart'));
});

$(document).ready( function() {


	$("#stat-shutdown input[type='submit']").click(function() {
		var buttons = {};
		var action = $(this).attr("name");
		var button_label;
		var message;
		var title;
		if(action == "shutdown") {
			button_label = $.message("stat-shutdown-button-continue");
			message = $.message("stat-shutdown-confirm-message");
			title = $.message("stat-shutdown-confirm-title");
		} else {
			button_label = $.message("stat-reboot-button-continue");
			message = $.message("stat-reboot-confirm-message");
			title = $.message("stat-reboot-confirm-title");			
		}
		buttons[button_label] =  function()  {
			$("#fn-stat-shutdown-action").val(action);
			$("#stat-shutdown").submit();
			};
		$.confirm( 
				message,
				title,
				buttons
		);
		return false;
	});
		
});

</script>
