$(".edit-test").click(function () {
  $('#edit-test-modal form').attr('action', '/editTest/' + $(this).data('test-id'));
});

