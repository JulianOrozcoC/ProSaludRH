$("#delete-quotation").click(function () {
    $('#delete-quotation-modal form').attr('action', '/quotations/delete/' + $(this).data('quotation-id'));
});

$("#archive-quotation").click(function () {
    $('#archive-quotation-modal form').attr('action', '/quotations/archive/' + $(this).data('quotation-id'));
});

$("#unarchive-quotation").click(function () {
    $('#unarchive-quotation-modal form').attr('action', '/quotations/unarchive/' + $(this).data('quotation-id'));
});
