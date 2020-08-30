<script src="https://cdn.rawgit.com/PascaleBeier/bootstrap-validate/v2.2.0/dist/bootstrap-validate.js"></script>

<script type="text/javascript">

	function isEmpty(str) {
		return (!str || 0 === str.length);
	}

</script>

<script type="text/javascript">

	bootstrapValidate(['#price', '#old_price'], 'regex:^([0-9]{1,})([\.]{1,1}[0-9]{2,2})$:Допускается только число с плавующей точкой');
	bootstrapValidate('#quantity', 'regex:^[0-9]{1,}$:Допускаются только числа');

</script>

<script>
	$(".upload-main").upload({
		action: "/admin/products/ajax-image-upload",
		label: false,
		maxQueue: '1',
		maxConcurrent: '1',
		beforeSend: mainBeforeSend
	}).on("filestart", mainStart).on("filecomplete", fileComplete).on("fileerror", fileError);

	$(".upload-gallery").upload({
		action: "/admin/products/ajax-image-upload",
		label: false,
		maxQueue: '1',
		maxConcurrent: '1',
		beforeSend: galleryBeforeSend
	}).on("filestart", galleryStart).on("filecomplete", fileComplete).on("fileerror", fileError);

	function galleryBeforeSend(formdata) {
		formdata.append('type', 'gallery');
		return formdata;
	}

	function mainBeforeSend(formdata) {
		formdata.append('type', 'main');
		return formdata;
	}

	function mainStart (e, file) {
		$('#loading-main').css('display', 'inherit');
	}

	function galleryStart (e, file) {
		$('#loading-gallery').css('display', 'inherit');
	}

	function fileComplete (e, file, response) {
		if($.parseJSON(response).error == 'error') {
			Swal.fire({
				icon: 'error',
				title: 'Ошибка!',
				text: $.parseJSON(response).message,
			});
			$('#loading-main').css('display', 'none');
			$('#loading-gallery').css('display', 'none');
		}
		if($.parseJSON(response).type == 'main') {
			var img = '<div data-filename="' + $.parseJSON(response).filename + '"><a href="{{ asset('/uploads/main/') }}/'+ $.parseJSON(response).filename +'" data-lightbox="image-2"><img width="50%" height="50%" src="{{ asset('/uploads/main/') }}/'+ $.parseJSON(response).filename +'"></a></div>';
			$('#preview_main').html(img);
			$('#loading-main').css('display', 'none');
		}
		if($.parseJSON(response).type == 'gallery') {
			var img = '<div class="col-sm-3 img" data-filename="' + $.parseJSON(response).filename + '" data-key="' + $.parseJSON(response).key + '"><span class="close_pic" onclick="removeImage(this)">×</span><a href="{{ asset('/uploads/gallery/') }}/'+ $.parseJSON(response).filename +'" data-lightbox="image-1"><img class="img-fluid" src="{{ asset('/uploads/gallery/') }}/'+ $.parseJSON(response).filename +'"></a></div>';
			$('#preview_gallery').append(img);
			$('#loading-gallery').css('display', 'none');
		}

	}

	function fileError (e, file, response) {
		Swal.fire({
			icon: 'error',
			title: 'Ошибка!',
			text: response.errors
		});
		$('#loading-main').css('display', 'none');
		$('#loading-gallery').css('display', 'none');
	}

	$('#remove_main').on('click', function () {
		var href = $('#preview_main').find('a').attr('href');
		if(typeof href !== typeof undefined && href !== false) {
			$('#loading-main').css('display', 'inherit');
			Swal.fire({
				title: 'Вы точно хотите удалить эту картинку?',
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#28a745',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Да',
				cancelButtonText: 'Нет'
			}).then((result) => {
				if (result.value) {
					var form_data = new FormData();
					form_data.append('_method', 'DELETE');
					var filename = $('#preview_main').find('a').parent().data('filename');
					$.ajax({
						url: '{{ url('/admin/products/ajax-remove-image') }}' + '/' + 'main' + '/' + filename + '/' + '0',
						data: form_data,
						type: 'POST',
						contentType: false,
						processData: false,
						success: function (data) {
							$('#preview_main').html('');
						},
						error: function (xhr, status, error) {
							Swal.fire({
								icon: 'error',
								title: 'Ошибка!',
								text: xhr.responseText
							});
						}
					});
				}
				$('#loading-main').css('display', 'none');
			})
		}
		return false;
	});

	function removeImage(item) {
		$('#loading-gallery').css('display', 'inherit');
		Swal.fire({
			title: 'Вы точно хотите удалить эту картинку?',
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#28a745',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Да',
			cancelButtonText: 'Нет'
		}).then((result) => {
			if (result.value) {
				var form_data = new FormData();
				form_data.append('_method', 'DELETE');
				var filename = $(item).parent().data('filename');
				if($(item).parent().data('key')) {
					var key = $(item).parent().data('key');
					$.ajax({
						url: '{{ url('/admin/products/ajax-remove-image') }}' + '/' +  'gallery' + '/' + filename + '/' + key,
						data: form_data,
						type: 'POST',
						contentType: false,
						processData: false,
						success: function (data) {
							$(item).parent().remove();
						},
						error: function (xhr, status, error) {
							Swal.fire({
								icon: 'error',
								title: 'Ошибка!',
								text: xhr.responseText
							});
						}
					});
				}
				else {
					var id = $(item).parent().data('id');
					$.ajax({
						url: '{{ url('/admin/products/ajax-remove-image') }}' + '/' +  'deleted_img' + '/' + filename + '/' + id,
						data: form_data,
						type: 'POST',
						contentType: false,
						processData: false,
						success: function (data) {
							$(item).parent().remove();
						},
						error: function (xhr, status, error) {
							Swal.fire({
								icon: 'error',
								title: 'Ошибка!',
								text: xhr.responseText
							});
						}
					});
				}
			}
			$('#loading-gallery').css('display', 'none');
		})
		return false;
	}

	$('#addProductForm').on('submit', function(e) {

		if(isEmpty($('#preview_main').find('a').length)) {
			Swal.fire({
				title: 'Нет главного изображения!',
				icon: 'warning',
			})

			e.preventDefault();
		}

	});

</script>