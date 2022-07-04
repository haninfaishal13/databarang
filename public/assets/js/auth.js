$('#register-password').keyup(function() {
    confirm_password();
})

$('#register-confirm-password').keyup(function() {
    confirm_password();
})

$('#registerform').on('submit', function(event) {
    event.preventDefault();
    let data = {
        'email': $('#register-email').val(),
        'name': $('#register-name').val(),
        'password': $('#register-password').val(),
    };
    console.log(data);
    $.ajax({
        url: base_url+'/api/auth/register',
        type: 'post',
        contentType: "application/json",
        dataType:'json',
        data:JSON.stringify(data),
    })
    .done(function(resp) {
        set_token(resp.token)
        $('#register-modal').modal('hide');
        window.location.replace(base_url+'/product')
    })
    .fail(function(resp) {
        let err_message, err_key;
        $.each(resp.responseJSON.errors, function(idx, value) {
            err_message = JSON.stringify(value[0]);
            err_key = JSON.stringify(idx[0]);
            return false;
        });
    })
})

$('#logform').on('submit', function(event) {
    event.preventDefault();
    let data = {
        'email':$('#email').val(),
        'password':$('#password').val(),
    }
    $.ajax({
        url: base_url+'/api/auth/login',
        type: 'post',
        contentType: "application/json",
        dataType:'json',
        data: JSON.stringify(data),
    })
    .done(function(resp) {
        set_token(resp.token)
        $('#register-modal').modal('hide');
        window.location.replace(base_url+'/product')
    })
    .fail(function(resp) {
        alert('Login fail, '+resp.responseJSON.message);
    })
})

function confirm_password() {
    if($('#register-confirm-password').val() != $('#register-password').val()) {
        $('#warning-confirm-password').removeClass('d-none');
        $('#register-submit').addClass('disabled');
    }
    else {
        $('#warning-confirm-password').addClass('d-none');
        $('#register-submit').removeClass('disabled');
    }
}

function set_token(token) {
    let token_get = token.split("|").pop()
    localStorage.setItem('token', token_get);
}

function check_status_status() {

}
