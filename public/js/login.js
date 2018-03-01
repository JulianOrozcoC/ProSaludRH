$('.password-label').click(function() {
    if(!$('.hidden').is(':visible'))
    {
        $('.hidden').show(400);
        $('.password-label span').text('Use email only')
        $('.password-label i').text('keyboard_arrow_up')
        $('#password').focus();
    }
    else{
        $('.hidden').hide(400);
        $('.password-label span').text('Use password')
        $('.password-label i').text('keyboard_arrow_down')
        $('#email').focus();
    }
});
