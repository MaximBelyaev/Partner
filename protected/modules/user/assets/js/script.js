jQuery(document).ready(function($) {
	
	var $lw = $('.last_week');
	var date_start = $lw.data('start');
	var date_end   = $lw.data('end');
	loadRangeData(date_start, date_end);

	$.plot("#chart", [
		{ data: [[1420114607000, 12], [1422793007000, 55], [1425212207000, 45], [1427458607000, 0], [1430137007000, 85]] },
		{ data: [[1420114607000, 32], [1422793007000, 25], [1425212207000, 105], [1427458607000, 20], [1430137007000, 45]] }
	],
	{
		xaxis: {
			mode: "time",
			timeformat: "%d/%m/%y",
		}
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
		console.log("success");
	})
	.fail(function() {
		console.log("error");
	})
	.always(function(ans) {
		console.log(ans);
	});
	
	console.log(start, end);
}