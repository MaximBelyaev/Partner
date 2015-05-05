jQuery(document).ready(function($) {
	
	var $lw = $('.last_quater');
	var date_start = $lw.data('start');
	var date_end   = $lw.data('end');
	var plot;
	loadRangeData(date_start, date_end);

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
		console.log(ans);
		plot = $.plot("#chart", [
			{ data: ans.requests },
			{ data: ans.referrals },
			{ data: ans.payed },
		],
		{
			xaxis: {
				mode: "time",
				timeformat: "%d/%m/%y",
			}
		});
		//plot.setData(ans.data);
		//plot.draw();
		console.log("success");
	})
	.fail(function(ans) {
		console.log("error");
		console.log(ans.responseText);
	})
	.always(function(ans) {
	});
	
	console.log(start);
	console.log(end);
}