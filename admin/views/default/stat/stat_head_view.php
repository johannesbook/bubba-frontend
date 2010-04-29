<script type="text/javascript">
function piechart(chart_canvas) {
  var chart = chart_canvas[0];
  var percentage = chart_canvas.attr('rel');
  if(chart.getContext)
  {
    var x = Math.PI/50;
    var ctx = chart.getContext('2d');
    ctx.scale(1.5,0.6);

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

	$('button.fn-ack').bind( 'click', function(e) {
		var self = this;
		e.preventDefault();
		uuid=$(this).parent().find('input.uuid').val();
		$.throbber.show();
		$.ajax({
			type: 'POST',
				dataType: 'json',
				url: "/admin/ajax_notify/ack",
				data: {uuid: uuid} ,
				timeout: 20000,
				success: function( data ) {
					$.throbber.hide();
					if( data.error ) {
						update_status( false, data.html );
					} else {
						var table = $(self).closest('table.notifications');
						$(self).closest('tr.notification').remove();
						if( table.find('tr').length == 0 ) {
							table.append(
								$('<tr/>',{
									'html':
										$('<td/>',{
											'text': $.message('stat-notify-no-more-messages')
										})
								})
							);
						}
					}
				}
		});
		return false;
	});
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
