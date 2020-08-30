<script>

	function confirmationDelete(e) {

		e.preventDefault();

		var urlToRedirect = e.currentTarget.getAttribute('href');

		Swal.fire({
			title: 'Вы действительно хотите удалить данный заказ?',
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#28a745',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Да',
			cancelButtonText: 'Нет'
		}).then((result) => {
			if (result.value) {
				window.location.href = urlToRedirect;
			}
		})


	}

	function confirmationDelivered(e) {

		e.preventDefault();

		var urlToRedirect = e.currentTarget.getAttribute('href');

		Swal.fire({
			title: 'Вы уверены, что заказ доставлен?',
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#28a745',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Да',
			cancelButtonText: 'Нет'
		}).then((result) => {
			if (result.value) {
				window.location.href = urlToRedirect;
			}
		})

	}

	function confirmationApproved(e) {

		e.preventDefault();

		var urlToRedirect = e.currentTarget.getAttribute('href');

		Swal.fire({
			title: 'Вы уверены, что заказ одобрен?',
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#28a745',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Да',
			cancelButtonText: 'Нет'
		}).then((result) => {
			if (result.value) {
				window.location.href = urlToRedirect;
			}
		})

	}

	function confirmationReturnToRevision(e) {

		e.preventDefault();

		var urlToRedirect = e.currentTarget.getAttribute('href');

		Swal.fire({
			title: 'Вы уверены, что хотите вернуть заказ на доработку?',
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#28a745',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Да',
			cancelButtonText: 'Нет'
		}).then((result) => {
			if (result.value) {
				window.location.href = urlToRedirect;
			}
		})

	}

</script>