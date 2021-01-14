<?php
    session_start();
    require_once('inc/head.php');

    if(!check_user_session('serial_no')) {
      header('Location: index.php');
      exit();
    }

    $serial_no = get_user_session("serial_no");
    $application_progress = array();

    // Admissions table
    $ad_sql = "SELECT `id` FROM `student_info` WHERE student_id = (SELECT `id` FROM student WHERE serial_no = '$serial_no')";
    $ad_query = mysqli_query($conn, $ad_sql) or die(ip_logger(mysqli_error($conn)));
    $ad_results = mysqli_num_rows($ad_query);

    // Programme table
    $prog_sql = "SELECT `id` FROM `courses_taken` WHERE `user_id` = (SELECT `id` FROM student WHERE serial_no = '$serial_no')";
    $prog_query = mysqli_query($conn, $prog_sql) or die(ip_logger(mysqli_error($conn)));
    $prog_results = mysqli_num_rows($prog_query);

    // Upload table
    $file_sql = "SELECT `id` FROM `result_upload` WHERE `student_id` = (SELECT `id` FROM student WHERE serial_no = '$serial_no')";
    $file_query = mysqli_query($conn, $file_sql) or die(ip_logger(mysqli_error($conn)));
    $file_results = mysqli_num_rows($file_query);

    // Not Good
    $total = $file_results + $prog_results + $ad_results;
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
          <li class="breadcrumb-item active">Overview</li>
        </ol>

        <!-- Icon Cards-->
        <div class="mb-3">
        <?php if($total > 2): ?>
          <div class="card border-success border-darken-4 pulse mb-4">
            <div class="card-content p-2">
            <img src="https://apply.ug.edu.gh/admissions/assets/images/checkmarkbig.png" alt="" style="display:block;margin:auto;max-width:100px;margin-top:10px;margin-bottom:8px">
            <h4 class="text-center text-uppercase">
              Application Completed
            </h4><br>
            </div>
          </div>
        <?php else:?>
          <div class="card border-success border-darken-4 pulse mb-4">
            <div class="card-content p-2">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/97/Dialog-error-round.svg/768px-Dialog-error-round.svg.png"
             alt="" style="display:block;margin:auto;max-width:100px;margin-top:10px;margin-bottom:8px">
            <h4 class="text-center text-uppercase">
              Application Not Completed
            </h4><br>
            <a href="admissions.php" class="btn btn-info btn-lg box-shadow-2 pulse" 
            style="display:block;margin:auto;">Start Application</a>
            </div>
          </div>
        <?php endif; ?>
        <div class="card">
          <div class="card-header">
            <h6 class="card-title">APPLICATION PROGRESS/STATUS</h6>
          </div>
          <div class="card-content collapse show">
            <div class="card-body">
              <form>
                <h6 class="form-section"><i class="la la-check"></i> YOUR CURRENT APPLICATION STATUS</h6>
                <div class="row">
                  <div class="col-md-12">
                    <ul class="list-group">
                      <a href="admissions.php">
                        <li class="list-group-item">
                          <span class="badge badge-pill  border-success success badge-glow float-right">
                            <?php echo $ad_results > 0 ? "SUBMITTED" :  "NOT SUBMITTED" ?>
                          </span> 
                          <span class="badge badge-danger badge-pill">1</span>&nbsp;&nbsp;Student Info
                        </li>
                      </a> 
                      <a href="programmes.php">
                        <li class="list-group-item">
                          <span class="badge badge-pill  border-success success badge-glow float-right">
                            <?php echo $prog_results > 0 ? "SUBMITTED" :  "NOT SUBMITTED" ?>
                          </span> 
                          <span class="badge badge-danger badge-pill">2</span>&nbsp;&nbsp;Programme Option
                        </li>
                      </a>  
                      <a href="results.php">
                        <li class="list-group-item">
                          <span class="badge badge-pill  border-success success badge-glow float-right">
                            <?php echo $file_results > 0 ? "SUBMITTED" :  "NOT SUBMITTED" ?>
                          </span> 
                          <span class="badge badge-danger badge-pill">3</span>&nbsp;&nbsp;Result Upload
                        </li>
                      </a>
                      <li class="list-group-item">
                          <span class="badge badge-pill  border-success success badge-glow float-right">
                            <?php echo $total > 3 ? "COMPLETED" :  "NOT COMPLETED" ?>
                          </span> 
                          <span class="badge badge-danger badge-pill">4</span>&nbsp;&nbsp;Application Progress
                        </li>  
                    </ul>
                  </div>
                </div>
              </form>
            </div>
          </div>
			   </div>
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