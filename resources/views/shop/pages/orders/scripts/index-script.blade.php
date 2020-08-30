<script>

	$('.order').on('click', function() {

		var id = $(this).data('id');

		window.location.href = "{{ asset('/orders') }}/" + id;

	});

</script>