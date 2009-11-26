$('.notification-img').live( 'click', function() {
		img=$(this);
		msg=img.parent().parent().find( '.notification-msg' );
		if( ! msg ) return;
		if(msg.is(':hidden')) {
			img.attr( 'src', "/admin/views/default/_img/minus16.png" );
		} else {
			img.attr( 'src', "/admin/views/default/_img/plus16.png" );
		}
		msg.slideToggle();
	}
);

