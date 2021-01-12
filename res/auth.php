<?php
    session_start();
    require_once("../inc/handler.php");

    $response = array();
    if(isset($_POST['serial_no']) && isset($_POST['password'])) {
        $serial_no = sanitize($_POST['serial_no']);
        $password = sanitize($_POST['password']);

        if(record_exists("student", "serial_no", $serial_no)) {
            session_destroy();

            $response['success'] = false;
            $response['msg'] = "Account already exist. Login";
            echo json_encode($response);
            exit();
        }

        $password = encrypt_password($password);
        $query = "INSERT INTO `student`(`serial_no`, `password`) VALUES ('$serial_no', '$password')";
        $sql = mysqli_query($conn, $query) or die(ip_logger(mysqli_error($conn)));
        
        session_destroy();
        if($sql) {
            session_start();
            store_session("serial_no", $serial_no);
            
            $response['success'] = true;
            $response['msg'] = "Account created successfully";
            $response['redirect-url'] = "dashboard.php";

            echo json_encode($response);
            exit();
        } else {
            $response['success'] = false;
            $response['msg'] = "Internal server error!";
            echo json_encode($response);
            exit();
        }
    }
?>