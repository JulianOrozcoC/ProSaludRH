$(".details-customer").click(function () {
    event.preventDefault();
    var x = $(this);
    $.ajax({
        method: 'GET', // Type of response and matches what we said in the route
        url: '/ajax/customers/details/' + $(this).data('customer-id'), // This is the url we gave in the route
        success: function(response){ // What to do if we succeed
            var customerData = JSON.parse(response);
            $('#details-customer-modal #modal-title').text(customerData.name);
            $('#details-customer-modal #modal-alias').text('(' + customerData.alias + ')');
            $('#details-customer-modal #modal-link-customer').text(customerData.link_customer);
            $('#details-customer-modal #modal-factor').text(customerData.factor);
            $('#details-customer-modal #modal-import').text(customerData.import_and_freight);
        },
        error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
            $('#details-customer-modal').modal('close');
            Materialize.toast("Customer not found. Try refreshing the page", 7000);
            x.remove();
        }
    });
});
