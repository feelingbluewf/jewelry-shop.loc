<script type="text/javascript">
  $('#changeTitle').on('click', function(e) {

    e.preventDefault();

      Swal.fire({
        title: 'Вы точно хотите поменять название Категории?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#28a745',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Да',
        cancelButtonText: 'Нет'
      }).then((result) => {
        if (result.value) {
          $('#addProductForm').submit();
        }
      })
  });

</script>