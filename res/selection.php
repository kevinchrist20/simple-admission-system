<?php
    session_start();
    require_once("../inc/handler.php");

    if(!check_user_session('serial_no')) {
        header('Location: index.php');
        exit();
    }

    // $sql = "SELECT `faculty`.`name`, course_name FROM `course` INNER JOIN `faculty` ON course.faculty_id = `faculty`.id";
    // $query = mysqli_query($conn, $sql) or die(ip_logger(mysqli_error($conn)));

    $response = array();
    if(isset($_GET['faculty_id']) && !empty($_GET['faculty_id'])) {
        $faculty_id = filter_var($_GET['faculty_id'], FILTER_SANITIZE_NUMBER_INT);

        $sql = "SELECT * FROM `course` WHERE faculty_id = '$faculty_id'";
        $query = mysqli_query($conn, $sql) or die(ip_logger(mysqli_error($conn)));

        while($frow = mysqli_fetch_assoc($query)) {
            $response['courses'][] = array(
                'id' =>$frow['id'],
                'name' => $frow['course_name']
            );
        }

        $response['success'] = true;
        echo json_encode($response);
        exit();
    }

    else if(isset($_POST['first_choice']) && isset($_POST['second_choice']) && isset($_POST['third_choice'])) {
        $first_choice = sanitize($_POST['first_choice']);
        $second_choice = sanitize($_POST['second_choice']);
        $third_choice = sanitize($_POST['third_choice']);
        $serial_no = get_user_session("serial_no");

        $sql = "INSERT INTO `courses_taken`(`user_id`, `course_id`, `choice`) VALUES
            ((SELECT `id` FROM `student` WHERE serial_no = '$serial_no'), 
            (SELECT `id` FROM `course` WHERE course_name = '$first_choice'), 'first'),
            ((SELECT `id` FROM `student` WHERE serial_no = '$serial_no'), 
            (SELECT `id` FROM `course` WHERE course_name = '$second_choice'), 'second'),
            ((SELECT `id` FROM `student` WHERE serial_no = '$serial_no'),
            (SELECT `id` FROM `course` WHERE course_name = '$third_choice'), 'third')";
        $query = mysqli_query($conn, $sql) or die(ip_logger(mysqli_error($conn)));

        if($query) {
            $response['success'] = true;
            $response['msg'] = "Courses submitted successfully";
            $response['redirect-url'] = "results.php";

            echo json_encode($response);
            exit();
        }

        $response['success'] = false;
        $response['msg'] = "Internal server error!";
        echo json_encode($response);
        exit();
    }
?>