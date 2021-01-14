<?php
    session_start();
    require_once("../inc/handler.php");

    if(!check_user_session('serial_no')) {
        header('Location: index.php');
        exit();
    }

    if(isset($_POST['result_type']) && isset($_FILES['file'])) {
        $result_type = sanitize($_POST['result_type']);
        $serial_no = get_user_session("serial_no");
        $path = "../uploads/";
        
        if($_FILES['file']['error'] != UPLOAD_ERR_OK) {
            $response['success'] = false;
            $response['msg'] = "Internal Server Error. Try again later!";
            echo json_encode($response);
            exit();
        }
        if($_FILES['file']['size'] > $file_size) {
            $response['success'] = false;
            $response['msg'] = "File size > 20 MB";
            echo json_encode($response);
            exit();
        }
        if (!check_file_type($_FILES['file']['name'])) {
            $response['success'] = false;
            $response['msg'] = "File must be of type pdf.";
            echo json_encode($response);
            exit();
        }

        $file_name = $serial_no . "." . get_file_type($_FILES['file']['name']);
        if(move_uploaded_file($_FILES['file']['tmp_name'], $path . $file_name)) {
            $file_url = "uploads/" . $file_name;
            $sql = "INSERT INTO `result_upload`(`student_id`, `result_type`, `file_url`) VALUES 
                    ((SELECT `id` FROM `student` WHERE serial_no = '$serial_no'), '$result_type', '$file_url')";
            $query = mysqli_query($conn, $sql) or die(ip_logger(mysqli_error($conn)));

            if($query) {
                $response['success'] = true;
                $response['msg'] = "Results submitted successfully";
                $response['redirect-url'] = "summary.php";
    
                echo json_encode($response);
                exit();
            }
    
            $response['success'] = false;
            $response['msg'] = "Internal server error!";
            echo json_encode($response);
            exit();
        }

        $response['success'] = false;
        $response['msg'] = "Sorry, file upload unsuccessful!";
        echo json_encode($response);
        exit();
    }
?>