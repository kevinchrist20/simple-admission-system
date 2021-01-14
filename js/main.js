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
    // $('#selectFaculty1').change(() => {
    //     let facultyID = $(this).find(":selected").val()
    //     getCourses(facultyID, "selectProgramme1")
    // })

    // Second Choice Courses
    $('#selectFaculty2').change(() => {
        let facultyID = $(this).find(":selected").val()
        console.log(`Here: ${$(this).find(":selected").val()}`)
        getCourses(facultyID, "selectProgramme2")
    })

    // Third Choice Courses
    $('#selectFaculty3').change(() => {
        let facultyID = $(this).find(":selected").val()
        getCourses(facultyID, "selectProgramme3")
    })

})

// Redirect
function redirect(link) {
    setTimeout(function() {
        window.location.href = link
    }, 300);
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