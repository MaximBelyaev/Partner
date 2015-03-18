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
});
