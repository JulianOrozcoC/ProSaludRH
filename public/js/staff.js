$(".delete-staff").click(function () {
    $('#delete-staff-modal form').attr('action', '/staff/delete/' + $(this).data('staff-id'));
});
