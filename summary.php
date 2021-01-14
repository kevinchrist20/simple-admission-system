<?php
    session_start();
    require_once('inc/head.php');

    if(!check_user_session('serial_no')) {
      header('Location: index.php');
      exit();
    }

    $serial_no = get_user_session("serial_no");
    $info_sql = "SELECT `fullname`, `dob`, `gender`, `nationality`, `qualification` FROM `student_info` WHERE 
                student_id = (SELECT `id` FROM student WHERE serial_no = '$serial_no')";
    $info_query = mysqli_query($conn, $info_sql) or die(ip_logger(mysqli_error($conn)));
    $info_row = mysqli_fetch_assoc($info_query);

    $prog_sql = "SELECT `course`.course_name FROM `courses_taken` INNER JOIN `course` ON courses_taken.course_id = 
    `course`.id WHERE `courses_taken`.`user_id` = (SELECT `id` FROM student WHERE serial_no = '$serial_no')";
    $prog_query = mysqli_query($conn, $prog_sql) or die(ip_logger(mysqli_error($conn)));
    $course_count = 1;
?>

  <title>GTUC | Student Dashboard</title>

</head>

<body id="page-top">

  <?php require_once("inc/nav.php"); ?>

  <div id="wrapper">

    <?php require_once("inc/sidebar.php"); ?>

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Summary</li>
        </ol>

        <!-- Icon Cards-->
        <div class="mb-3">
        <div id="summary" class="card"><div class="card-header">
        <h4 class="card-title">APPLICATION SUMMARY</h4></div> 
        <div class="card-content collapse show"><div class="card-body">
        <div>
        <h2 class="center" style="margin: auto; text-align: center;">Undergraduate Online Application</h2>
            <span class="badge badge-pill  border-success success badge-glow reducesize">
            <i class="la la-check" style="font-size: 0.8rem; font-weight: bolder;"></i></span></h4></td> <td>
            <h5 class="changefont">Serial: <?php echo $serial_no; ?></h5> <h5 class="changefont">
            Name: <span style="text-transform: capitilize;"> <?php echo $info_row['fullname']; ?></span></h5> 
            <h5 class="changefont">Date of Birth: <?php echo $info_row['dob']; ?></h5> 
            <h5 class="changefont text-capitalize">Gender: <?php echo $info_row['gender']; ?></h5>
            <h5 class="changefont">Nationality: <?php echo $info_row['nationality']; ?></h5>
                <tr><td><h4 class="mt-2">ENTRY INFORMATION
            <span class="badge badge-pill  border-success success badge-glow reducesize">
            <i class="la la-check" style="font-size: 0.8rem; font-weight: bolder;"></i></span></h4></td> 
            <td><h5 class="changefont">ENTRY TYPE:  <?php echo $info_row['qualification']; ?></h5></td></tr> 
            <tr><td><h4 class="mt-2">PROGRAMME INFORMATION 
            <span class="badge badge-pill  border-success success badge-glow reducesize">
            <i class="la la-check" style="font-size: 0.8rem; font-weight: bolder;"></i></span></h4></td> 
            <td><span>
            <?php while($frow = mysqli_fetch_assoc($prog_query)) :?>
                <h5 class="changefont">
                    <span class="badge badge-info badge-pill"><?php echo $course_count++; ?></span>
                    <?php echo $frow['course_name']; ?>
                </h5><br>
            <?php endwhile;?>
            </span> 
            <!----> <!----> <!----></td></tr></tbody></table></div><br><br><br><br> 
            </div></div></div>
        </div>

      </div>
      <!-- /.container-fluid -->

      <!-- Sticky Footer -->
      <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span id="copyright"></span>
          </div>
        </div>
      </footer>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
    </div>
  </div>

<?php
    require_once("inc/footer.php");
?>  