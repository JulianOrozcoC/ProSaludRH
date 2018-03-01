var products;
$(document).ready(function(){
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

    $('#product-model').on("change", function(event,ui) {
        if(products.hasOwnProperty($(this).val()))
        {

            $.ajax({
                url: "/ajax/assets/" + $(this).val().replace(/ /g,'').replace(/\//g, '[slash]'),
                type: "get"
            })
            .done(function(data)
            {
                $("#container-data").empty();
                
                if(data.html !== ""){
                    $("#container-data").append(data.html);
                    $(".details-asset").click(function () {
                        event.preventDefault();
                        $.ajax({
                            method: 'GET', // Type of response and matches what we said in the route
                            url: '/ajax/assets/details/' + $(this).data('asset-id'), // This is the url we gave in the route
                            success: function(response){ // What to do if we succeed
                                var assetsData = JSON.parse(response);
                                $('#details-asset-modal #quote-btn').attr("href", "/quote/" + assetsData.e_number);
                                $('#details-asset-modal #modal-title').text(assetsData.product.model);
                                $('#details-asset-modal #modal-alias').text(assetsData.serial_no);
                                $('#details-asset-modal #modal-link-asset').text(assetsData.e_number);
                                $('#details-asset-modal #modal-import').text(assetsData.price);
                                $('#details-asset-modal #modal-year').text(assetsData.year);
                                $('#details-asset-modal #modal-location').text(assetsData.location);
                                $('#details-asset-modal #modal-depreciated-months').text(assetsData.depreciated_months);
                                $('#details-asset-modal #modal-hour-count').text(assetsData.hour_count);
                                
                            },
                            error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                                $('#details-assets-modal').modal('close');
                                Materialize.toast("Asset not found. Try refreshing the page", 7000);
                                x.remove();
                            }
                        });
                    });
                }

            });
        }
    });
})
