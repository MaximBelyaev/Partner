$(document).ready(function() {


/* =========== Статистика ================ */
    var $lw = $('.current_range'); // получаем выбранный по-умолчанию отрезок времени для получения статистики
    var date_start = $lw.data('start'),
        date_end   = $lw.data('end'),
        type       = $('.current_type').data('type'), // тип графика
        $daterange = $('.input-daterange'),
        plot;
	loadRangeData(date_start, date_end, type, 'chart');
	loadRangeData(date_start, date_end, '', 'table'); 

    $('body').on('click', function(event) {
        if(($(event.target).prop('id') != 'date_icon')) {
            if(!(
                event.target.classList.contains('input-daterange') || 
                $(event.target).parents('.input-daterange').length || 
                event.target.classList.contains('datepicker') || 
                event.target.classList.contains('day') || 
                $(event.target).parents('.datepicker').length))
            {
                $('.stats_block .input-daterange').hide();
            }
        } else {
            $('.stats_block .input-daterange').toggle();     
        }


        if(($(event.target).prop('id') != 'date_table')) {
            if(!(
                event.target.classList.contains('input-daterange') || 
                $(event.target).parents('.input-daterange').length || 
                event.target.classList.contains('datepicker') || 
                event.target.classList.contains('day') || 
                $(event.target).parents('.datepicker').length))
            {
                $('.table_wrap .input-daterange').hide();
            }
        } else {
            $('.table_top_buttons .input-daterange').toggle();     
        }
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
        loadRangeData(start, end, type, 'chart');      
    });

    $('.table_top_buttons').find('button').not('#date_table').not('#table_show_range').on('click', function(event) {
    	event.preventDefault();
        $('.table_top_buttons').find('button').removeClass('current_range');
        $(this).addClass('current_range');
        var start = $(this).data('start');
        var end   = $(this).data('end');

        loadRangeData(start, end, 'none', 'table');
    });

    $('.top_buttons').find('button').not('#date_icon').not('#show_range').on('click', function(event) {
        event.preventDefault();
        $('.top_buttons').find('button').removeClass('current_range');
        $(this).addClass('current_range');
        var start = $(this).data('start');
        var end   = $(this).data('end');
        var type  = $('.current_type').data('type');
        loadRangeData(start, end, type, 'chart');
    });

    $('#show_range').on('click', function(event) {
        event.preventDefault();
        var di = document.getElementById('date_icon');
        $('.top_buttons').find('button').removeClass('current_range');
        var start = $('.top_buttons .range_start').val();
        var end   = $('.top_buttons .range_end').val();
        $(di).addClass('current_range');
        di.setAttribute('data-start', start);
        di.setAttribute('data-end', end);
        var type  = $('.current_type').data('type');
        loadRangeData(start, end, type, 'chart');
    });

    $('#table_show_range').on('click', function(event) {
        event.preventDefault();
        var di = document.getElementById('date_table');
        $('.top_buttons').find('button').removeClass('current_range');
        var start = $('.table_top_buttons .range_start').val();
        var end   = $('.table_top_buttons .range_end').val();
        $(di).addClass('current_range');
        di.setAttribute('data-start', start);
        di.setAttribute('data-end', end);
        loadRangeData(start, end, '', 'table');
    });

    Object.size = function(obj) {
        var size = 0, key;
        for (key in obj) {
            if (obj.hasOwnProperty(key)) size++;
        }
        return size;
    };

	$("#chart").on("plothover", function (event, pos, item) {
        if (item) {
            var landsString = '', // добавляем под общим числом уточнение для каждого лендинга
                lines = Object.size(item.series.data[item.dataIndex].land) + 1, // количество строк, которое занимает подсказка
                ct    = document.querySelector('.chart_buttons .current_type') // выбранный тип статистики (заявки, партнеры и т.д)
            $.each(item.series.data[item.dataIndex].land, function(i, val) {
                // добавляем уточнение, для всех типов, кроме "партнеры"
                if( ct && ct.dataset.type!='undefined' && ct.dataset.type!='user') {
                    if (val != undefined) {
                        landsString += (val['name'] + ": "
                        + val['value'] + "<br>");
                    }
                }
            });
			var y = item.datapoint[1].toFixed(2),
                $stat_block_offset = $('.stats_block').offset(),
                $tt = $("#tooltip").html( "Всего" + ": " + Math.round(y) + "<br>" + landsString ),
				ttX = item.pageX - $stat_block_offset.left - ($tt.width()/2 )-parseInt( $tt.css('padding-left') ) + 1,
				ttY = item.pageY - $stat_block_offset.top-lines*25;

                $tt.css( { top: ttY, left: ttX } ).fadeIn( 200 );
		} else {
			$("#tooltip").hide();
		}
	});

});


function loadRangeData(start, end, type, output_type) {
	
	/**
	* start - время начала графика
	* end   - время конца графика
	* type  - тип статистики(заказы, заяки, переходы и т.д.)
	* output_type - виды данных на выходе:
	* 		chart - график
	*		table - таблица 
	*		both  - оба вида 
	**/
	$.ajax({
		url: '/admin/statistics/range',
		type: 'GET',
		dataType: 'json',
		data: {start: start, end: end, type: type, output_type: output_type},
		beforeSend: function() {
			// перед отправкой данных, затемняем график и/или таблицу
			if (output_type == 'chart' || output_type == undefined || output_type == 'both') {
				$('.stats_block .preloader').add('.stats_block .preloader_wrap').fadeIn('200');
			} 
			if(output_type == 'table' || output_type == 'both') {
				$('#stats .preloader').add('#stats .preloader_wrap').fadeIn('200');
			} 
		}
	})
	.done(function(ans) {
		// console.log(ans);
		if (output_type == 'chart' || output_type == undefined || output_type == 'both') {
			var dataArray = [];
			
			$.each(ans.charts, function(index, val) {
				dataArray.push({data:val});
			});

			plot = $.plot("#chart", dataArray,
			{
				xaxis: {
					mode: "time",
					timeformat: "%d.%m.%y",
					ticks: 5,
				},
				series: {
					lines: {
						show: true,
						fill: 0.2,
					},
					points: {
						show: true
					}
				},
				grid: {
					hoverable: true,
					clickable: true,
					borderWidth: 0,
				},
				colors: [ '#fe974b', '#63bb67', '#3bace2' ],
			});
		} 

		if(output_type == 'table' || output_type == 'both') {
			if (ans.stats) {
				$('.stats_content').html(generateStatsHtml(ans.stats));
			};
		}

	})
	.fail(function(ans) {
		console.log(ans.responseText);
	})
	.always(function(ans) {
        $('.stats_block .preloader')
            .add('.stats_block .preloader_wrap')
            .add('#stats .preloader')
            .add('#stats .preloader_wrap')
            .fadeOut('200');
	});
}


function generateStatsHtml(stats) {
    var $stats_row = $('<div>').addClass('stats_row');
    $stats_row.append('<p>' + stats.new_partners + '</p> ');
    $stats_row.append('<p>' + stats.referrals + '</p> ');
    $stats_row.append('<p>' + stats.requests + '</p> ');
    $stats_row.append('<p>' + stats.payed + '</p> ');
    $stats_row.append('<p>' + stats.profit + '</p> ');
    return $stats_row;
}