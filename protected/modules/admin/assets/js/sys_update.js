jQuery(document).ready(function($) {
	$('#sys_update').on('click', function(event) {
		event.preventDefault();
		$('.preloader').css('display', 'inline-block');
		$.ajax({
			url: '/admin/default/downloadAndUpdate',
			type: 'POST',
			dataType: 'json',
			data: {},
		})
		.done(function(xhr) {
			console.log(xhr);
			if (xhr.status == 'ok') {
				$('.upd_msg').text(xhr.msg);
				$('.preloader').fadeOut('300');
			};
			console.log("success");
		})
		.fail(function(xhr) {
			console.log(xhr.responseText);
			console.log("error");
		})
		.always(function(xhr) {
			console.log("complete");
		});
		
	});
});