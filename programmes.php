<?php
    session_start();
    require_once('inc/head.php');

    if(!check_user_session('serial_no')) {
      header('Location: index.php');
      exit();
    }

    $sql = "SELECT * FROM `faculty`";
    $query = mysqli_query($conn, $sql) or die(ip_logger(mysqli_error($conn)));
    $frow = mysqli_fetch_all($query, MYSQLI_ASSOC);
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
            <a href="#">Courses</a>
          </li>
          <li class="breadcrumb-item active">Programme Selection</li>
        </ol>

        <!-- Icon Cards-->
        <div class="row">
          <div class="col-md-8">
            <form id="programme" method="POST">
            <!-- First Choice -->
              <div class="card card-register mx-auto mt-5">
                <div class="card-header">
                  First Choice
                </div>
                <div class="card-body">
                  <div class="form-label-group mb-4">
                    <select form="programme" id="selectFaculty" class="custom-select form-control" name="faculty" required>
                      <option value="" selected disabled hidden>Select Faculty</option>
                      <?php foreach($frow as $row): ?>
                        <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                      <?php endforeach; ?>
                    </select> 
                  </div>
                  <div class="form-label-group">
                    <select form="programme" id="selectProgramme" class="custom-select form-control" name="first_choice" required>
                      <option value="" selected disabled hidden>Select Programme</option>
                      <option value="male">Male</option>
                    </select> 
                  </div>
                </div>
              </div>
              <!-- Second Choice -->
              <div class="card card-register mx-auto mt-5">
                <div class="card-header">Second Choice</div>
                <div class="card-body">
                  <div class="form-label-group mb-4">
                    <select form="programme" id="selectFaculty" class="custom-select form-control" name="faculty" required>
                      <option value="" selected disabled hidden>Select Faculty</option>
                      <?php foreach($frow as $row): ?>
                        <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                      <?php endforeach; ?>
                    </select> 
                  </div>
                  <div class="form-label-group">
                    <select form="programme" id="selectProgramme" class="custom-select form-control" name="second_choice" required>
                      <option value="" selected disabled hidden>Select Programme</option>
                      <option value="male">Male</option>
                    </select> 
                  </div>
                </div>
              </div>
              <!-- Third Choice -->
              <div class="card card-register mx-auto mt-5 mb-4">
                <div class="card-header">Third Choice</div>
                <div class="card-body">
                  <div class="form-label-group mb-4">
                    <select form="programme" id="selectFaculty" class="custom-select form-control" name="faculty" required>
                      <option value="" selected disabled hidden>Select Faculty</option>
                      <?php foreach($frow as $row): ?>
                        <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                      <?php endforeach; ?>
                    </select> 
                  </div>
                  <div class="form-label-group">
                    <select form="programme" id="selectProgramme" class="custom-select form-control" name="third_choice" required>
                      <option value="" selected disabled hidden>Select Programme</option>
                      <option value="male">Male</option>
                    </select> 
                  </div>
                </div>
              </div>

              <input type="submit" class="btn btn-primary float-right mb-2" value="Save and continue">
            </form>
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