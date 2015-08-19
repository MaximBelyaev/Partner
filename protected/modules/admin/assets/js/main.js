var blocks_margin = 20; // отступы между блоками
   

/* функция устанавливает блоку с классом full-page-block
*  минимальную высоту равную высоте экрана
*/
var setContentHeight = function() {
    var $block = $('.full-page-block'),
        block_of = $block.offset();

    if (block_of != undefined) {
    	// block_top - отступ блока от верха окна
        var block_top = block_of.top;
        $block.css(
            'min-height',
            $(window).height() - block_top - blocks_margin
        );

    };
}

$( document ).ready(function() {

		// кнопка открытия бокового меню    
    var $mob_menu_trigger = $('#mob-menu-trigger'),
    	// выпадающий список - верхнее меню(появляется только на маленьких экранах) 
        $top_menu_mobile = $('#top_menu_mobile'), 
        // темная заливка экрана при открытом боковом меню
        $sidebar_overlay = $('#sidebar-overlay');

    setContentHeight();
    $(window).on('resize', setContentHeight );

    $top_menu_mobile.on('change', function(event) {
        if(this.value){
            window.location.href = this.value;
        }
    });

	$mob_menu_trigger.on( 'click', function() {
		if ($mob_menu_trigger.data('for')) {
			$($('#' + $mob_menu_trigger.data('for'))).toggleClass('opened');
		};
	});

	$sidebar_overlay.on( 'click', function(event) {
		$($('#' + $mob_menu_trigger.data('for'))).removeClass('opened');
	});

    $('.modal-content').find('input[data-placeholder]').focus(function(event){
        this.placeholder = '';
    });

    $('.modal-content').find('input[data-placeholder]').blur(function(event){
        this.placeholder = this.dataset['placeholder'];
    });

    $('#landing_select').on('change', function(event) {
        event.preventDefault();
        $.ajax({
            url: '/user/user/change',
            type: 'POST',
            dataType: 'json',
            data: {land: $(this).val()},
        })
        .done(function(x) {
            console.log("success");
            window.location.reload();
        })
        .fail(function() {
            console.log("error");
        })
        .always(function(x) {
            console.log(x);
            console.log("complete");
        });
    });

});

