$(document).ready(function() {
    $('#auth-form').validate({
        errorClass: "my-error",
        rules: {
            serial_no: {
                required: true,
                minlength: 10
            }, 
            password: {
                required: true,
                minlength: 5
            },
            pass: {
                required: true,
                minlength: 5
            }
        },

        submitHandler: function(form) {
            $('.server-feedback').addClass('text-center alert alert-info').html(`<span>Authenticating...</span>`)
            $.ajax({
                url:'res/auth.php',
                method: 'POST',
                dataType: 'json',
                data: $(form).serialize(),

                success: function(data) {
                    if(data['success']) {
                        $('.server-feedback').addClass('text-center alert alert-success')
                        .html(`<span>${data['msg']}  Redirecting...</span>`)
                        window.location.href = data['redirect-url']
                    } else {
                        $('.server-feedback').addClass('text-center alert alert-danger').html(`<span>${data['msg']}</span>`)
                    }
                }, 
                error: function(err) {
                    $('.server-feedback').addClass('text-center alert alert-danger').html("<span> Internal Server Error<span>")
                    console.log(`Error: ${err}`)
                }
            })
          }        
    })

    $('#copyright').html(`&copy ${new Date().getUTCFullYear()}. My Project.`)
})