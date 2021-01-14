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
?>