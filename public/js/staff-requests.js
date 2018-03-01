$(".accept-request").click(function () {
    var x = $(this);
    $.ajax({
        method: 'POST', // Type of response and matches what we said in the route
        url: '/staff-requests/accept/' + $(this).data('request-id'), // This is the url we gave in the route
        success: function(response){ // What to do if we succeed
            x.closest('.request').slideUp();
            Materialize.toast("Request accepted", 7000);
        },
        error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
            Materialize.toast("Could not accept request. Try reloading the page or try again later", 7000);
        }
    });
});

$(".deny-request").click(function () {
    var x = $(this);
    $.ajax({
        method: 'POST', // Type of response and matches what we said in the route
        url: '/staff-requests/deny/' + $(this).data('request-id'), // This is the url we gave in the route
        success: function(response){ // What to do if we succeed
            x.closest('.request').slideUp();
            Materialize.toast("Request denied", 7000);
        },
        error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
            Materialize.toast("Could not deny request. Try reloading the page or try again later", 7000);
        }
    });
});
