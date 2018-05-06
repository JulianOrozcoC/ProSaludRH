$(document).ready(function () {
    $(".delete-user").click(function () {
        $('#delete-user-modal form').attr('action', '/staff/delete/' + $(this).data('user-id'));
    });
})