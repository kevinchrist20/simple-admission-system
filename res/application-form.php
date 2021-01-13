<?php
    session_start();
    require_once("../inc/handler.php");

    if(!check_user_session('serial_no')) {
        header('Location: index.php');
        exit();
    }

    $response = array();
    if(isset($_POST['firstName']) && isset($_POST['lastName']) && isset($_POST['otherName']) && isset($_POST['dob']) 
        && isset($_POST['gender']) && isset($_POST['address']) && isset($_POST['postal_ad']) && isset($_POST['nationality'])
        && isset($_POST['id_card']) && isset($_POST['father_name']) && isset($_POST['mother_name']) && isset($_POST['qualification'])
        && isset($_POST['declare'])) {
            $firstName = sanitize($_POST['firstName']);
            $lastName = sanitize($_POST['lastName']);
            $otherName = sanitize($_POST['otherName']);
            $gender = sanitize($_POST['gender']);
            $address = sanitize($_POST['address']);
            $postal_address = sanitize($_POST['postal_ad']);
            $nationality = sanitize($_POST['nationality']);
            $father_name = sanitize($_POST['father_name']);
            $mother_name = sanitize($_POST['mother_name']);
            $qualification = sanitize($_POST['qualification']);
            $id_card = filter_var($_POST['id_card'], FILTER_SANITIZE_NUMBER_INT);
            $dob = $_POST['dob'];
                
            if(!validate_date($dob)) {
                $response['success'] = false;
                $response['msg'] = "Invalid birth date";
                echo json_encode($response);
                exit();
            }

            $fullName = join_name($firstName, $lastName, $otherName);
            $serial_no = get_user_session("serial_no");

            $sql = "INSERT INTO student_info (`student_id`, `fullname`, `dob`, `address`, `p_address`, `gender`, `nationality`,
            `card_id`, `father_name`, `mother_name`, `qualification`) 
            VALUES((SELECT `id` FROM `student` WHERE serial_no = '$serial_no'), '$fullName', '$dob', '$address', '$postal_address',
            '$gender', '$nationality', '$id_card', '$father_name', '$mother_name', '$qualification')";
            $query = mysqli_query($conn, $sql) or die(ip_logger(mysqli_error($conn)));

            if($query) {
                $response['success'] = true;
                $response['msg'] = "Application submitted successfully";
                $response['redirect-url'] = "programmes.php";

                echo json_encode($response);
                exit();
            }

            $response['success'] = false;
            $response['msg'] = "Internal server error!";
            echo json_encode($response);
            exit();
        }
?>