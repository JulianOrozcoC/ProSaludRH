$(document).ready(function () {
    $(".delete-organization").click(function () {
        $('#delete-organization-modal form').attr('action', '/organization/delete/' + $(this).data('organization-id'));
    });
})