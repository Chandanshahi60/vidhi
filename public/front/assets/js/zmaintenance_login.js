$(document).on("submit", '#zsociety-user-login', function(e) {
    e.preventDefault();
    this_form = $(this);
    show_miniloading(this_form);
    $('#zlogin-popup').addClass('hidden');
    $('#zlogin-message').html('');
    this_form.find('.custom-error').html("");
    $.ajax({
        url: this_form.attr('action'),
        data: $(this).serialize(),
        dataType: "json",
        type: "post",
        success: function(res) {
            hide_miniloading(this_form);
            if (res.error == true) {
                $.each(res.display_errors, function(error_id, html) {
                    $('#' + error_id).html(html);
                });
            } else {
                window.location.assign(res.redirect_url);
            }
        },
        error: function(data) { // 500 Status Header
            var data = $.parseJSON(data);
            $.each(data.errors, function(index, value) {
//                console.log(value);
            });
            hide_miniloading(this_form);
        },
    });
});
$(document).on("click", "#zforgot-password-link", function(e) {
    e.preventDefault();
    $('#zforgot-password').removeClass('hidden');
    $('#zsociety-user-login').addClass('hidden');
    $('#zreset-email').val($('#username').val());
});
$(document).on("click", '#zlogin-link', function(e) {
    e.preventDefault();
    $('#zsociety-user-login').removeClass('hidden');
    $('#zforgot-password').addClass('hidden');
});

$(document).on("submit", '#zforgot-password', function(e) {
    e.preventDefault();
    this_form = $(this);
    this_form.find('.custom-error').html("");
    show_miniloading(this_form);
    $.ajax({
        url: BASE_URL + "maintenance_bill/reset_password",
        data: $(this).serialize(),
        dataType: "json",
        type: "post",
        success: function(res) {
            hide_miniloading(this_form);
            if (res.error == true) {
                $.each(res.display_errors, function(error_id, html) {
                    $('#' + error_id).html(html);
                });
            } else {
                $('#zsociety-user-login').removeClass('hidden');
                $('#zforgot-password').addClass('hidden');
                $('#zlogin-message').html(res.message);
                $('#zlogin-popup').removeClass('hidden');
            }
        }
    });
});
$(document).on("submit", '#z-reset-password', function(e) {
    e.preventDefault();
    this_form = $(this);
    this_form.find('.custom-error').html("");
    $.ajax({
        url: BASE_URL + "maintenance_bill/submit_reset_password",
        data: $(this).serialize(),
        dataType: "json",
        type: "post",
        success: function(res) {
            if (res.error == true) {
                $.each(res.display_errors, function(error_id, html) {
                    $('#' + error_id).html(html);
                });
            } else {
                window.location.assign(BASE_URL + "maintenance_bill/user_login");
            }
        }
    });
});

$(document).ajaxError(function(event, jqxhr, settings, thrownError) {
    if (settings.type == "GET") {
        $('#main-content').html("");
    } else {
        $('button').removeAttr('disabled');
        $('button').find('img').remove();
    }
    new PNotify({
        title: 'Something Wrong',
        text: 'Something went wrong, Try Again',
        type: 'error'
    });
});