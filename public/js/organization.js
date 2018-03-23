$(".delete-organization").click(function () {
  $('#delete-organization-modal form').attr('action', '/deleteOrganization/' + $(this).data('organization-id'));
});
