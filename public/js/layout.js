$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })
    $(".button-collapse").sideNav();
    $('.modal').modal();
    $('ul.tabs').tabs();
    $('select').material_select();
    $('.collapsible').collapsible();
    $('.grid').masonry({
		itemSelector: '.grid-item',
        columnWidth: '.grid-item',
		isAnimated: true
	});

    $('#search-button').click(function() {
        $('#staff-search-form').show(400);
    });

    $(".button-collapse").click(function(){
        $(".drag-target").css("width", $(window).width() - $("#slide-out").width());
    });

    var page = 1;
    $("#load-more").click(function() {
        page++;
        loadMoreData(page);
    });

    function loadMoreData(page){
        if(query != "")
            url = '?query=' + query + '&page=' + page;
        else
            url = '?page=' + page;

      $.ajax(
        {
            url: url,
            type: "get",
            beforeSend: function()
            {
                $('.preloader').show();
                $('#load-more').hide();
            }
        })
        .done(function(data)
        {
            if(data.html !== ""){
                $("#container-data").append(data.html);
            }
            $('.preloader').hide();
            $('#load-more').show();

            if(data.lastPage == page)
                $('#load-more').remove();
        })
        .fail(function(jqXHR, ajaxOptions, thrownError)
        {
              alert('server not responding...');
        });
    }

});
