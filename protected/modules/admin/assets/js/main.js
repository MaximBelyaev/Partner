var blocks_margin = 40;

var setContentHeight = function() {
    var $block = $('.full-page-block'),
        block_of = $block.offset();

    if (block_of != undefined) {
        var block_top = block_of.top;
        $block.css(
            'min-height',
            $(window).height() - block_top - blocks_margin
        );

    };
}

$( document ).ready(function() {
    
    setContentHeight();
    $(window).on('resize', setContentHeight );

    var btn = $('#add-size'),
        $mob_menu_trigger = $('#mob-menu-trigger'),
        menu_trigger_width = 900;
    btn.click(function(){
        var spanForCount = $('#count');
        var count = parseInt(spanForCount.html())+1;
        $('<div class="row">' +
            '<label class="required" for="Sizes_name">Размер<span class="required">*</span></label>' +
            '<input type="text" value="" name="Sizes['+count+'][name]" maxlength="100" size="45">' +
            '<label class="required" for="Sizes_name">Колличество<span class="required">*</span></label>' +
            '<input type="text" value="" name="Sizes['+count+'][count]" maxlength="100" size="45">' +
            '</div>').appendTo("#sizes-row");
        spanForCount.html(count);
    });

	$mob_menu_trigger.on( 'click', function() {
		if ($(window).width() <= menu_trigger_width) {
            if ($mob_menu_trigger.data('for')) {
				$($('#' + $mob_menu_trigger.data('for'))).toggleClass('opened');
			};
		};

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
            url: '/admin/landings/change',
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

