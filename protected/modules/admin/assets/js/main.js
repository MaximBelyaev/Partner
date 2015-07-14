$( document ).ready(function() {
    var btn = $('#add-size');
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

    $('.modal-content').find('input[data-placeholder]').focus(function(event){
        console.log(this);
        this.placeholder = '';
    });

    $('.modal-content').find('input[data-placeholder]').blur(function(event){
        console.log(this.dataset);
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

