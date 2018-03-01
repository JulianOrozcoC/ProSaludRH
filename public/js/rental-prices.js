
var currency = "MXN";
$(document).ready(function(){
    $(".product-record").click(function () {
        $('#rental-prices-modal #modal-title').text($("#model-" + (this).id).text());
        $('#rental-prices-modal #modal-currency').text(currency);
        $('#rental-prices-modal-form').attr("action", "/rental-prices/" + currency + "/" + (this).id);
        $('#rental-prices-modal').modal('open');
        $('#rental-prices-modal #weekly').val($("#" + currency + "-weekly-" +(this).id).data("price"));
        $('#rental-prices-modal #monthly_1_6').val($("#" + currency + "-monthly-1-6-" +(this).id).data("price"));
        $('#rental-prices-modal #monthly_7_10').val($("#" + currency + "-monthly-7-10-" +(this).id).data("price"));
        $('#rental-prices-modal #monthly_10_plus').val($("#" + currency + "-monthly-10-plus-" +(this).id).data("price"));
        Materialize.updateTextFields();
    });

    $("#MXN").click(function(){
        currency = "MXN";
    });
    
    $("#USD").click(function(){
        currency = "USD";
    });
})
