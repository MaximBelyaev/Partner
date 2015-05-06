jQuery(document).ready(function($) {
	
	var $lw = $('.last_quater');
	var date_start = $lw.data('start');
	var date_end   = $lw.data('end');
	var plot;
	loadRangeData(date_start, date_end);

	$('#stats').on('click', '.month_header', function(event) {
		$(this).toggleClass("open");
	});




	$('.input-daterange').datepicker({
		endDate: '27-04-2015',
		startDate: '01-01-2014',
		format: 'dd-mm-yyyy',
		language: 'ru',
		todayBtn: true,
		todayHighlight: true,
		//startDate: ''
	}).on('changeDate', function(e){
    });

	$('.chart_buttons').find('button').on('click', function(event) {
		event.preventDefault();
		var start = $(this).data('start');
		var end   = $(this).data('end');
		loadRangeData(start, end);		
	});

	$('#show_range').on('click', function(event) {
    	event.preventDefault();
		var start = $('.range_start').val();
		var end   = $('.range_end').val();
		loadRangeData(start, end);
    	/* Act on the event */
    });
});


function loadRangeData(start, end) {

	$.ajax({
		url: '/user/user/range',
		type: 'GET',
		dataType: 'json',
		data: {start: start, end: end},
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

		console.log("success");
	})
	.fail(function(ans) {
		console.log("error");
		console.log(ans.responseText);
	})
	.always(function(ans) {
		console.log(ans);
	});
}


function generateStatsHtml(stats) {
	var $stats = $('<div>');
	$.each(stats.stats, function(index, val) {
		
			var $month = $('<div>').addClass('month');
			var $h3 = $('<h3>').addClass('month_header').text(val.rus_date);

			if( val.stat.length ) {
				console.log(index);
				var $month_stat = $('<div>').addClass('month_stat');
				
				var $stat_header = $('<div>').addClass('stat_row stat_header day');
				
				$stat_header.append($('<div>').text('Дата'));
				$stat_header.append($('<div>').text('Переходы'));
				$stat_header.append($('<div>').text('Заявки'));
				$stat_header.append($('<div>').text('Заказы'));
				$stat_header.append($('<div>').text('Прибыль'));
				
				$month_stat.append($stat_header) 
				
				$.each(val.stat, function(i, st) {
					var $stat_row = $('<div>').addClass('stat_row day');
					$stat_row.append($('<div>').text(st.date));
					$stat_row.append($('<div>').text(st.requests));
					$stat_row.append($('<div>').text(st.referrals));
					$stat_row.append($('<div>').text(st.payed));
					$stat_row.append($('<div>').text(st.profit));
					$month_stat.append($stat_row);
				});

				var $stat_total = $('<div>').addClass('stat_row day month_total');
					$stat_total.append($('<div>').text("Всего"));
					$stat_total.append($('<div>').text(val.total.requests));
					$stat_total.append($('<div>').text(val.total.referrals));
					$stat_total.append($('<div>').text(val.total.payed));
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
	$all_time.append($('<div>').text(stats.all_time_total.referrals));
	$all_time.append($('<div>').text(stats.all_time_total.payed));
	$all_time.append($('<div>').text(stats.all_time_total.profit));
	$total_month_stat.append($all_time);
	$stats.append($total_month_stat);
	
	return $stats.html();
}