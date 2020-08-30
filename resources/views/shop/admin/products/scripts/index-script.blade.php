<script>

	function confirmation(e) {

		e.preventDefault();

		var urlToRedirect = e.currentTarget.getAttribute('href');

		Swal.fire({
			title: 'Вы действительно хотите удалить данный товар?',
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