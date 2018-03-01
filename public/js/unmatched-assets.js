
$(document).ready(function(){
    $(".details-unmatched-asset").click(function () {

        $('#match-asset-form').attr('action', '/match-asset/' + $(this).data('unmatched-asset-model').replace(/\//g, '[slash]'));
        $('#not-found').prop('checked', false);
        $('#product-model').val("");
        $('#details-unmatched-asset-modal #modal-title').text('Select the product to match the assets with the model ' + "'" + $(this).data('unmatched-asset-model').toUpperCase() + "'");
    });

    $.ajax({
        url: "/ajax/products",
        type: "get"
    })
    .done(function(response)
    {
        products = response;
        $(function() {
            $('input.autocomplete').autocomplete({
                data : response,
            })
        })

    });


})
