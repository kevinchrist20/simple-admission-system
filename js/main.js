$(document).ready(function() {
    $('#copyright').html(`&copy ${new Date().getUTCFullYear()}. My Project.`)

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
            console.log(form)
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
                        redirect(data['redirect-url'])
                    } else {
                        $('.server-feedback').addClass('text-center alert alert-danger').html(`<span>${data['msg']}</span>`)
                    }
                },
                error: function(xhr, status, error) {
                    $('.server-feedback').addClass('text-center alert alert-danger').html("<span> Internal Server Error<span>")
                }
            })
        }
    })

    // First Choice Courses
    $('#selectFaculty1').change(() => {
        let facultyID = $(this).find(":selected").val()
        getCourses(facultyID, "selectProgramme1")
    })

    // Second Choice Courses
    $('#selectFaculty2').change(() => {
        let facultyID = $('#selectFaculty2').find(":selected").val()
        getCourses(facultyID, "selectProgramme2")
    })

    // Third Choice Courses
    $('#selectFaculty3').change(() => {
        let facultyID = $('#selectFaculty3').find(":selected").val()
        getCourses(facultyID, "selectProgramme3")
    })

    // Programme Selection request and validation
    $('#programme').validate({
        errorClass: "my-error",
        rules: {
            first_choice: {
                required: true,
            },
            second_choice: {
                required: true,
            },
            third_choice: {
                required: true,
            }
        },

        submitHandler: function(form) {
            let first_choice = $('#selectProgramme1').find(":selected").text()
            let second_choice = $('#selectProgramme2').find(":selected").text()
            let third_choice = $('#selectProgramme3').find(":selected").text()

            $.ajax({
                url: 'res/selection.php',
                method: 'POST',
                dataType: 'json',
                data: { first_choice: first_choice, second_choice: second_choice, third_choice: third_choice },

                success: function(data) {
                    if (data['success']) {
                        $('.server-feedback').addClass('text-center alert alert-success')
                            .html(`<span>${data['msg']}</span>`)
                        redirect(data['redirect-url'])
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

    // File upload validation and request
    $('#upload-file').validate({
        errorClass: "my-error",
        rules: {
            result_type: {
                required: true,
            },
            file: {
                required: true,
            }
        },

        submitHandler: function(form) {
            let data = new FormData(form)
            $.ajax({
                url: 'res/file-upload.php',
                method: 'POST',
                dataType: 'json',
                data: data,
                mimeType: "multipart/form-data",
                processData: false,
                contentType: false,

                success: function(data) {
                    if (data['success']) {
                        $('.server-feedback').addClass('text-center alert alert-success')
                            .html(`<span>${data['msg']}</span>`)
                        redirect(data['redirect-url'])
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
})

// Redirect
function redirect(link) {
    setTimeout(function() {
        window.location.href = link
    }, 1000);
}

// Fetch courses in faculty
function getCourses(id, courseSelectID) {
    $.ajax({
        url: 'res/selection.php',
        method: 'GET',
        dataType: 'json',
        data: { faculty_id: id },

        success: function(response) {
            if (response['success']) {
                addOption(response['courses'], courseSelectID)
            } else {
                console.log("Error")
            }
        },
        error: function(xhr) {
            console.log(`Error ${xhr}`)
        }
    })
}

// Added courses to option tag
function addOption(courses, id) {
    $(`#${id} option:enabled`).remove()
    for (i = 0; i < courses.length; i++) {
        $(`#${id}`).append(`<option value="${courses[i].id}">${courses[i].name}</option>`);
    }
}
