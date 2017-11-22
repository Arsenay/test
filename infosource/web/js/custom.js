$('body').on('click', 'a[href="#modal"]', function(event) {
	modal = $('#myModal');

	modal.modal('show');

	var csrfToken = $('meta[name="csrf-token"]').attr("content");

	$.ajax({
		url: form_href,
		type: 'post',
		dataType: 'json',
		data: {_csrf : csrfToken},
		beforeSend: function() {
			modal.find('.modal-content').empty();
		},
		success: function(json){
			if(json.html) {
				modal.find('.modal-content').html(json.html);
			}
		},
		error: function(xhr, ajaxOptions, thrownError) {
			console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});

	event.preventDefault();
});

$('body').on('submit', '#myForm', function(event) {
	modal = $('#myModal');
	form = modal.find('form');

	modal.modal('show');

	data = form.serialize();

	$.ajax({
		url: form_href,
		type: 'post',
		dataType: 'json',
		data: data,
		success: function(json){
			if(json.html) {
				modal.find('.modal-content').html(json.html);
			}
		},
		error: function(xhr, ajaxOptions, thrownError) {
			console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
	event.preventDefault();
});