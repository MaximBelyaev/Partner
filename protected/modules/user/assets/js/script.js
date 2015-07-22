jQuery(document).ready(function($) {
	
	var $lw = $('.last_quater').addClass('current_range');
	var date_start = $lw.data('start'),
		date_end   = $lw.data('end'),
		$daterange = $('.input-daterange'),
		plot;
	if ($('#stats').length) {
		loadRangeData(date_start, date_end);
	};

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
        });
    });


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

	$('.input-daterange').datepicker({
		startDate: $daterange.data('startdate'),
		endDate: $daterange.data('enddate'),
		format: 'dd-mm-yyyy',
		language: 'ru',
		todayBtn: true,
		todayHighlight: true,
		//startDate: ''
	}).on('changeDate', function(e){  });

	$('.top_buttons').find('button').not('#date_icon').on('click', function(event) {
		event.preventDefault();
		$('.top_buttons').find('button').removeClass('current_range');
		$(this).addClass('current_range');
		var start = $(this).data('start');
		var end   = $(this).data('end');
		loadRangeData(start, end);
	});

	$('#show_range').on('click', function(event) {
    	event.preventDefault();
		$('.chart_buttons').find('button').removeClass('current_range');
		$(this).addClass('current_range');
		var start = $('.range_start').val();
		var end   = $('.range_end').val();
		loadRangeData(start, end);
    	/* Act on the event */
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
			console.log(item);
			var landsString = '';
			for (var i = 1; i<=Object.size(item.series.data[item.dataIndex].land); i++)
			{
				landsString += (item.series.data[item.dataIndex].land[i]['name'] + ": "
				+ item.series.data[item.dataIndex].land[i]['value'] + "<br>");
			}
			if (item.seriesIndex === 0) {
				var series_heading = 'Переходы';
			} else if(item.seriesIndex === 1) {
				var series_heading = 'Клиенты';
			} else if(item.seriesIndex === 2) {
				var series_heading = 'Заказы';
			}
			var y = item.datapoint[1].toFixed(2),

                $stat_block_offset = $('.stats_block').offset(),
                $tt = $("#tooltip").html( series_heading + ": " + Math.round(y) + "<br>" + landsString ),
				ttX = item.pageX - $stat_block_offset.left - ($tt.width()/2 )-parseInt( $tt.css('padding-left') ) + 1,
				ttY = item.pageY - $stat_block_offset.top- 40;
                $tt.css( { top: ttY, left: ttX } ).fadeIn( 200 );
		} else {
			$("#tooltip").hide();
		}
	});

});


function loadRangeData(start, end) {

	$.ajax({
		url: '/user/user/range',
		type: 'GET',
		dataType: 'json',
		data: {start: start, end: end},
		beforeSend: function() {
			$('.stats_block .preloader').add('.stats_block .preloader_wrap').fadeIn('200'); 
		}
	})
	.done(function(ans) {
			console.log(ans);
		var dataArray = [];
		if (ans.charts.requests != undefined) {
			dataArray[0] = { data: ans.charts.requests, stat: ans.charts.requests.land };
		} 
		if (ans.charts.referrals != undefined) {
			dataArray[1] = { data: ans.charts.referrals, stat: ans.charts.referrals.land };
		}
		if (ans.charts.payed != undefined) {
			dataArray[2] = { data: ans.charts.payed, stat: ans.charts.payed.land };
		}
		if (ans.charts.aweead != undefined) {
			dataArray[3] = { data: ans.charts.aweead, stat: ans.charts.aweead.land };
		}
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
		if (ans.stats) {
			$('#stats .stats_content').html(generateStatsHtml(ans.stats));
			$(".month_header").click(function(){
				$(this).toggleClass("opened");
			});	
		};
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
	var $stats = $('<div>');
	var $month_stat = $('<div>').addClass('month_stat');
	$.each(stats.stats, function(index, val) {
		
			var $month = $('<div>').addClass('month');
			var $h3 = $('<h3>').addClass('month_header').text(val.rus_date);

			if( val.stat.length ) {
				var $month_stat = $('<div>').addClass('month_stat');

				$.each(val.stat, function(i, st) {
					var $stat_row = $('<div>').addClass('stats_row day');
					$stat_row.append($('<p>').text(st.date));
					$stat_row.append($('<p>').text(st.requests));
					// if (stats.use_click_pay != '1') {	
						$stat_row.append($('<p>').text(st.referrals));
						$stat_row.append($('<p>').text(st.payed));
					// };
					$stat_row.append($('<p>').text(st.profit));
					$month_stat.append($stat_row);
				});

				// подведение итога за месяц
				/*var $stat_total = $('<div>').addClass('stats_row day month_total');
					$stat_total.append($('<div>').text("Всего"));
					$stat_total.append($('<div>').text(val.total.requests));
					if (stats.use_click_pay != '1') {	
						$stat_total.append($('<div>').text(val.total.referrals));
						$stat_total.append($('<div>').text(val.total.payed));
					}
					$stat_total.append($('<div>').text(val.total.profit));
					$month_stat.append($stat_total);*/
			};

			$month.append($h3).append($month_stat);
			$stats.append($month);
	});
	
	console.log(stats.all_time_total);
	// подведение итога за все время
	var $total_month_stat = $( '<div>' ).addClass( 'month_stat total_month_stat' );
	var $all_time = $( '<div>' ).addClass( 'stats_row day' );
	$all_time.append( $( '<p>' ).text( "За все время" ) );
	$all_time.append( $( '<p>' ).text( stats.all_time_total.requests ) );
	$all_time.append( $( '<p>' ).text( stats.all_time_total.referrals ) );
	$all_time.append( $( '<p>' ).text( stats.all_time_total.payed ) );
	$all_time.append( $( '<p>' ).text( stats.all_time_total.profit ) );
	$total_month_stat.append( $all_time );
	$stats.append( $total_month_stat );
	
	return $stats.html();
}