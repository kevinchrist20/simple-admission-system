<?php
    session_start();
    require_once("../inc/handler.php");

    $response = array();
    $sql = "SELECT `faculty`.`name`, course_name FROM `course` INNER JOIN `faculty` ON course.faculty_id = `faculty`.id";
    $query = mysqli_query($conn, $sql) or die(ip_logger(mysqli_error($conn)));
?>