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
        $sql = "INSERT INTO `student`(`serial_no`, `password`) VALUES ('$serial_no', '$password')";
        $query = mysqli_query($conn, $sql) or die(ip_logger(mysqli_error($conn)));
        
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
    } else if(isset($_POST['serial_no']) && isset($_POST['pass'])) {
        $serial_no = sanitize($_POST['serial_no']);
        $password = sanitize($_POST['pass']);

        $sql = "SELECT * FROM `student` WHERE serial_no = '$serial_no'";
        $query = mysqli_query($conn, $sql) or die(ip_logger(mysqli_error($conn)));
        
        if(mysqli_num_rows($query) > 0) {
            session_destroy();
            $frow = mysqli_fetch_array($query);

            if(verify_password($password, $frow['password'])) {
                session_start();
                store_session("serial_no", $serial_no);
                
                $response['success'] = true;
                $response['msg'] = "Login successfully";
                $response['redirect-url'] = "dashboard.php";
    
                echo json_encode($response);
                exit();
            }

            $response['success'] = false;
            $response['msg'] = "Incorrect login credentials";
            echo json_encode($response);
            exit();

        } else {
            $response['success'] = false;
            $response['msg'] = "Student not Found";
            echo json_encode($response);
            exit();
        }
    }
?>