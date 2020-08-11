jQuery(document).ready(function () {
    var $ = jQuery.noConflict();
    $("#adduser").on('submit', function (e) {
        // display loading message while the request is sending;
        $('#registerModal').modal('hide');
        var spinner = $('<div class="spinner" id="spinner"><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Loading...</span></div>');
        $('body').append(spinner);
        $.ajax({
            type: "POST",
            url: registrationInfo.ajaxurl,
            dataType: "json",
            data: {
                action: "registerUser",
                "username": $("#username").val(),
                "password": $("#userpassword").val(),
                "email": $("#useremail").val(),
                "firstname": $("#firstname").val(),
                "lastname": $("#lastname").val(),
                "confirmpassword": $("#confirmpassword").val(),
                "security": $("#security").val()
            },
            success: function (data) {
                spinner.remove();
                if (data.success) {
                    location.reload(true);
                }
                if (data.errors.length > 0 || !data.success) {
                    $('#registerModal').modal('show');
                    var error_container = $('#errorsContainer').empty();// empty will remove any child or content if exist 
                    error_container.addClass("d-block");
                    insert_errors_messages(error_container, data.errors);
                }

            },
            error: function (jqXHR, exception) {
                spinner.remove();
                var msg = ajax_error(jqXHR, exception);
                var alert = '<div class="alert alert-warning text-danger alert-dismissible fade show ajax-responce" role="alert">' + msg + ' .<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
                $('body').append(alert);
            }
        })
        e.preventDefault();
    })

    // login process
    $("#loginuserform").on('submit', function (e) {
        // display loading message while the request is sending;
        $('#loginmodal').modal('hide');
        var spinner = $('<div class="spinner" id="spinner"><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Loading...</span></div>');
        $('body').append(spinner);
        $.ajax({
            type: "POST",
            url: registrationInfo.ajaxurl,
            dataType: "json",
            data: {
                action: "loginUser",
                "login": $("#login").val(),
                "loginpassword": $("#loginpassword").val(),
                "security": $("#loginSecurity").val()
            },
            success: function (data) {
                spinner.remove();
                if (data.success) {
                    location.reload(true);
                }
                if (data.errors.length > 0 || !data.success) {
                    $('#loginmodal').modal('show');
                    var error_container = $('#loginerrorsContainer').empty();// empty will remove any child or content if exist 
                    error_container.addClass("d-block");
                    insert_errors_messages(error_container, data.errors);
                }

            },
            error: function (jqXHR, exception) {
                spinner.remove();
                var msg = ajax_error(jqXHR, exception);
                var alert = '<div class="alert alert-warning text-danger alert-dismissible fade show ajax-responce" role="alert">' + msg + ' .<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
                $('body').append(alert);
            }
        })
        e.preventDefault();
    })
    // end login process

})

// for handling of error callback of the ajax request;
function ajax_error(jqXHR, exception) {
    var msg = '';
    if (jqXHR.status === 0) {
        msg = 'Not connect.\n Verify Network.';
    } else if (jqXHR.status == 404) {
        msg = 'Requested page not found. [404]';
    } else if (jqXHR.status == 500) {
        msg = 'Internal Server Error [500].';
    } else if (exception === 'parsererror') {
        msg = 'Requested JSON parse failed.';
    } else if (exception === 'timeout') {
        msg = 'Time out error.';
    } else if (exception === 'abort') {
        msg = 'Ajax request aborted.';
    } else {
        msg = 'Uncaught Error.\n' + jqXHR.responseText;
    }
    return msg;

}



// function to insert errors messages
function insert_errors_messages(container, errors) {
    errors.forEach(errMess => {
        container.append('<div class="alert alert-warning" role="alert">' + errMess + '</div>');
    });
}



// form validation in the front end ;
function validateRegisterData(password, username, email, firstname, lastname, confirmpassword) {
    var errors = [];
    if (!username.match(/^[a-zA-Z0-9@]+$/) || username.length < 3) {
        errors.push("username contains letters, numbers and @ and > 2 char");
    }
    if (password.length < 6) {
        errors.push("password must be > 6 character");
    }
    if (password != confirmpassword) {
        errors.push("confirmed password does not match");
    }
    if (!email.match(/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/)) {
        errors.push("email is not valid");
    }
    if (!firstname.match(/^[a-z0-9]+$/i) || firstname.length == 0) {
        errors.push("firstname should contains letters only");
    }
    if (!lastname.match(/^[a-z]+$/i) || lastname.length == 0) {
        errors.push("lastname should contains letters only");
    }


    if (errors.length > 0) {
        return errors;
    } else {
        return false;
    }
}

