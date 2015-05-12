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


/* =========== Статистика ================ */
    var $lw = $('.current_range');
    var date_start = $lw.data('start'),
        date_end   = $lw.data('end'),
        type       = $('.current_type').data('type'),
        $daterange = $('.input-daterange'),
        plot;
    loadRangeData(date_start, date_end, type);

    $('body').on('click', function(event) {
        if(($(event.target).prop('id') != 'date_icon')) {
            if(!(
                event.target.classList.contains('input-daterange') || 
                $(event.target).parents('.input-daterange').length || 
                event.target.classList.contains('datepicker') || 
                event.target.classList.contains('day') || 
                $(event.target).parents('.datepicker').length))
            {
                $('.input-daterange').hide();
            }
        } else {
            $('.input-daterange').toggle();     
        }
    });

    $('#stats').on('click', '.month_header', function(event) {
        $(this).toggleClass("open");
    });

    $('.input-daterange').datepicker({
        startDate: $daterange.data('startdate'),
        endDate: $daterange.data('enddate'),
        format: 'dd-mm-yyyy',
        language: 'ru',
        orientation: 'left',
        todayBtn: true,
        todayHighlight: true,
    });

    $('.chart_buttons').find('button').on('click', function(event) {
        event.preventDefault();
        $('.chart_buttons').find('button').removeClass('current_type');
        $(this).addClass('current_type');
        var start = $('.current_range').data('start');
        var end   = $('.current_range').data('end');
        var type  = $(this).data('type');
        loadRangeData(start, end, type);      
    });


    $('.top_buttons').find('button').not('#date_icon').not('#show_range').on('click', function(event) {
        event.preventDefault();
        $('.top_buttons').find('button').removeClass('current_range');
        $(this).addClass('current_range');
        var start = $(this).data('start');
        var end   = $(this).data('end');
        var type  = $('.current_type').data('type');
        loadRangeData(start, end, type);
    });

    $('#show_range').on('click', function(event) {
        event.preventDefault();
        var di = document.getElementById('date_icon');
        $('.top_buttons').find('button').removeClass('current_range');
        var start = $('.range_start').val();
        var end   = $('.range_end').val();
        $(di).addClass('current_range');
        di.setAttribute('data-start', start);
        di.setAttribute('data-end', end);
        var type  = $('.current_type').data('type');
        loadRangeData(start, end, type);
    });
});


function loadRangeData(start, end, type) {
	$.ajax({
		url: '/admin/statistics/range',
		type: 'GET',
		dataType: 'json',
		data: {start: start, end: end, type: type},
		beforeSend: function() {
			$('.preloader').add('.preloader_wrap').fadeIn('200');
		}
	})
	.done(function(ans) {
		var dataArray = [];
		$.each(ans.charts, function(index, val) {
			dataArray.push({data:val});
		});

		plot = $.plot("#chart", dataArray,
		{
			xaxis: {
				mode: "time",
				timeformat: "%d/%m/%y",
			}
		});
		if (ans.stats) {
			$('#stats').html(generateStatsHtml(ans.stats));
		};
		$('.preloader').add('.preloader_wrap').fadeOut('200');
    })
    .fail(function(ans) {
    })
    .always(function(ans) {
    });
}


function generateStatsHtml(stats) {
    var $stats = $('<div>');
    var $month_stat = $('<div>').addClass('month_stat');

    $.each(stats.stats, function(index, val) {
        
            var $month = $('<div>').addClass('month');
            var $h3 = $('<h3>').addClass('month_header').text(val.rus_date);

            if( val.stat.length ) {
                var $month_stat = $('<div>').addClass('month_stat');
                
                /*
                var $stat_header = $('<div>').addClass('stat_row stat_header day');
                
                $stat_header.append($('<div>').text('Дата'));
                $stat_header.append($('<div>').text('Переходы'));
                $stat_header.append($('<div>').text('Заявки'));
                $stat_header.append($('<div>').text('Заказы'));
                $stat_header.append($('<div>').text('Прибыль'));
                
                $month_stat.append($stat_header) 
                */
                $.each(val.stat, function(i, st) {
                    var $stat_row = $('<div>').addClass('stat_row day');
                    $stat_row.append($('<div>').text(st.date));
                    $stat_row.append($('<div>').text(st.requests));
                    if (stats.use_click_pay != '1') {   
                        $stat_row.append($('<div>').text(st.referrals));
                        $stat_row.append($('<div>').text(st.payed));
                    };
                    $stat_row.append($('<div>').text(st.profit));
                    $month_stat.append($stat_row);
                });

                var $stat_total = $('<div>').addClass('stat_row day month_total');
                    $stat_total.append($('<div>').text("Всего"));
                    $stat_total.append($('<div>').text(val.total.requests));
                    if (stats.use_click_pay != '1') {   
                        $stat_total.append($('<div>').text(val.total.referrals));
                        $stat_total.append($('<div>').text(val.total.payed));
                    }
                    $stat_total.append($('<div>').text(val.total.profit));
                    $month_stat.append($stat_total);
            };

            $month.append($h3).append($month_stat);
            $stats.append($month);
        

    });
    
    var $total_month_stat = $('<div>').addClass('month_stat total_month_stat');         
    var $all_time = $('<div>').addClass('stat_row day');
    $all_time.append($('<div>').text("За все время"));
    $all_time.append($('<div>').text(stats.all_time_total.requests));
    if (stats.use_click_pay != '1') {   
        $all_time.append($('<div>').text(stats.all_time_total.referrals));
        $all_time.append($('<div>').text(stats.all_time_total.payed));
    }
    $all_time.append($('<div>').text(stats.all_time_total.profit));
    $total_month_stat.append($all_time);
    $stats.append($total_month_stat);
    
    return $stats.html();
}

