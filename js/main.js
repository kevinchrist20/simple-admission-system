$(document).ready(function() {

    // Login and Sign up validation and request 
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
                url: 'res/auth.php',
                method: 'POST',
                dataType: 'json',
                data: $(form).serialize(),

                success: function(data) {
                    if (data['success']) {
                        $('.server-feedback').addClass('text-center alert alert-success')
                            .html(`<span>${data['msg']}  Redirecting...</span>`)
                        window.location.href = data['redirect-url']
                    } else {
                        $('.server-feedback').addClass('text-center alert alert-danger').html(`<span>${data['msg']}</span>`)
                    }
                },
                error: function(err) {
                    $('.server-feedback').addClass('text-center alert alert-danger').html("<span> Internal Server Error<span>")
                }
            })
        }
    })

    // Admissions Request and validation
    $('#admission').validate({
        errorClass: "my-error",
        rules: {
            firstName: {
                required: true,
                minlength: 3,
                maxlength: 10
            },
            lastName: {
                required: true,
                minlength: 3,
                maxlength: 10
            },
            otherName: {
                maxlength: 10
            },
            dob: {
                required: true,
                date: true
            },
            gender: {
                required: true
            },
            address: {
                required: true,
                minlength: 5
            },
            postal_ad: {
                required: true,
                minlength: 5
            },
            nationality: {
                required: true,
                minlength: 5
            },
            id_card: {
                required: true,
                digits: true
            },
            father_name: {
                required: true,
                minlength: 5
            },
            mother_name: {
                required: true,
                minlength: 5
            },
            qualification: {
                required: true,
                minlength: 4
            },
            declare: {
                required: true
            }
        },

        submitHandler: function(form) {
            $.ajax({
                url: 'res/application-form.php',
                method: 'POST',
                dataType: 'json',
                data: $(form).serialize(),

                success: function(data) {
                    if (data['success']) {
                        $('.server-feedback').addClass('text-center alert alert-success')
                            .html(`<span>${data['msg']}</span>`)
                        window.location.href = data['redirect-url']
                    } else {
                        $('.server-feedback').addClass('text-center alert alert-danger').html(`<span>${data['msg']}</span>`)
                        console.log(`My error: ${data}`)
                    }
                },
                error: function(xhr, status, error) {
                    $('.server-feedback').addClass('text-center alert alert-danger').html("<span> Internal Server Error<span>")
                    console.log(`Error: ${xhr.status} : ${xhr.statusText}`)
                }
            })
        }
    })

    $('#copyright').html(`&copy ${new Date().getUTCFullYear()}. My Project.`)
})