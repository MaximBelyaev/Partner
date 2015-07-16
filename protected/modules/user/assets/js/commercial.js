var $client = new ZeroClipboard( $(".copy_button") ), 
	$tt = $("#tooltip");
$client.on( "ready", function( readyEvent ) {

	$client.on( "aftercopy", function( event ) {
		var $target = $(event.target),
			target_pos = $target.offset();

		$tt.css( { top: target_pos.top - $target.height(), left: target_pos.left } ).fadeIn( 200 );
		window.setTimeout(function() {
			$tt.fadeOut();
		}, 2000);
	} );
} );



$('.banner-block').find('img').on('error', function(){
	var new_img = $('<div>')
		.addClass('no-adblock')
		.width(this.width)
		.height(this.height)
		.html('<div>Здесь должен быть баннер.' +
				'Возможно у вас включена блокировка рекламы.' +
				'Отключите ее, чтобы посмотреть изображение</div>');
	$(this).parent().html(new_img);
});