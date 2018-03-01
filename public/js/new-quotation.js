$(document).ready(function(){
    $("#ok-potential-customer").click(function(){
        $("#potential-customer").prop("checked", true);
    });
    
    $("#cancel-potential-customer").click(function(){
        $("#potential-customer").prop("checked", false);
    });
});
