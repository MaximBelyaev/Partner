jQuery(document).ready(function($) {
	$('#update-check').on('click', function(event) {
		event.preventDefault();
		var mode  = this.dataset['mode'],
			that  = this;
			
		if (mode == 'check') {
			var url	= that.dataset['checkurl'];
		} else {
			var url	= that.dataset['updateurl'];
		}

		$.ajax({
			url: url,
			type: 'POST',
			dataType: 'json',
		})
		.done(function(xhr) {
			
			if (mode == 'check' && xhr.status == 'has_upd') {
				that.dataset.mode = 'update';
				$(that).text('Обновить');
			} else if (mode == 'update' && xhr.status == 'updated') {
				that.dataset.mode = 'updated';
			}

			$('.upd_msg').text(xhr.msg);

		})
		.fail(function(xhr) {
			console.log("error");
		})
		.always(function(xhr) {
		});
		
	});
});