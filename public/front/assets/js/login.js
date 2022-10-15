$('#user-login').on("submit", function (e) {
    e.preventDefault();
    this_form = $(this);
    show_miniloading(this_form);
    $('#login-popup').addClass('hidden');
    $('#login-message').html('');
    this_form.find('.custom-error').html("");
    $.ajax({
        url: BASE_URL + "user_login/check_login",
        data: $(this).serialize(),
        dataType: "json",
        type: "post",
        success: function (res) {
            hide_miniloading(this_form);
            if (res.error == true) {
                $.each(res.display_errors, function (error_id, html) {
                    $('#' + error_id).html(html);
                });
            } else {
                window.location.assign(res.redirect_url);
            }
        },
        error: function (data) { // 500 Status Header
            var data = $.parseJSON(data);
            $.each(data.errors, function (index, value) {
//                console.log(value);
            });
            hide_miniloading(this_form);
        },
    });
});
$('#forgot-password-link').on("click", function (e) {
    e.preventDefault();
    $('#forgot-password').removeClass('hidden');
    $('#user-login').addClass('hidden');
    $('#reset-email').val($('#username').val());
    var obj = {Page: 'Forgot password', Url: BASE_URL+'user_login/#forgot-password'};
    history.pushState(obj, obj.Page, obj.Url);
});
$('#login-link').on("click", function (e) {
    e.preventDefault();
    $('#user-login').removeClass('hidden');
    $('#forgot-password').addClass('hidden');
    var obj = {Page: 'Login', Url: BASE_URL+'user_login'};
    history.pushState(obj, obj.Page, obj.Url);    
});
$('#activate-user').on("submit", function (e) {
    e.preventDefault();
    this_form = $(this);
    this_form.find('.custom-error').html("");
    $.ajax({
        url: BASE_URL + "user_login/check_activation_link",
        data: $(this).serialize(),
        dataType: "json",
        type: "post",
        success: function (res) {
            if (res.error == true) {
                $.each(res.display_errors, function (error_id, html) {
                    $('#' + error_id).html(html);
                });
            } else {
                window.location.assign(res.activation_link);
            }
        }
    });
});
$('#reset-password').on("submit", function (e) {
    e.preventDefault();
    this_form = $(this);
    this_form.find('.custom-error').html("");
    $.ajax({
        url: BASE_URL + "user_login/submit_reset_password",
        data: $(this).serialize(),
        dataType: "json",
        type: "post",
        success: function (res) {
            if (res.error == true) {
                $.each(res.display_errors, function (error_id, html) {
                    $('#' + error_id).html(html);
                });
            } else {
                window.location.assign(BASE_URL + "user_login");
            }
        }
    });
});

$('#forgot-password').on("submit", function (e) {
    e.preventDefault();
    this_form = $(this);
    show_miniloading(this_form);
    this_form.find('.custom-error').html("");
    $.ajax({
        url: BASE_URL + "user_login/reset_password",
        data: $(this).serialize(),
        dataType: "json",
        type: "post",
        success: function (res) {
            hide_miniloading(this_form);
            if (res.error == true) {
                $.each(res.display_errors, function (error_id, html) {
                    $('#' + error_id).html(html);
                });
            } else {
                $('#user-login').removeClass('hidden');
                $('#forgot-password').addClass('hidden');
                $('#login-message').html(res.message);
                $('#login-popup').removeClass('hidden');
            }
        }
    });
});
$(document).ajaxError(function (event, jqxhr, settings, thrownError) {
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

$(document).ready(function () {
    var url = window.location.href;
    console.log(window.location);
    var pathname_array = window.location.pathname.split('/');

    if (url.indexOf('#forgot-password') >= 0) {
        $('#forgot-password-link').click();
    }
});