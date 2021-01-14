<?php
    session_start();
    require_once('inc/head.php');

    if(!check_user_session('serial_no')) {
      header('Location: index.php');
      exit();
    }
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
            <a href="#">Results</a>
          </li>
          <li class="breadcrumb-item active">Upload Document</li>
        </ol>

        <!-- Icon Cards-->

        <div class="server-feedback"></div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-register mx-auto mt-5">
                    <div class="card-header">
                        Upload Results
                    </div>
                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data" id="upload-file">
                            <div class="form-label-group mb-4">
                                <select form="upload-file" id="resultType" class="custom-select form-control" name="result_type" required>
                                    <option value="" selected disabled hidden>Select result type</option>
                                    <option value="WASSCE">WASSCE</option>
                                    <option value="SSSCE">SSSCE</option>
                                </select> 
                            </div>
                            <div class="form-group">
                                <div class="custom-file">
                                    <input type="file" accept=".pdf" class="custom-file-input" name="pdf_file" required>
                                    <label class="custom-file-label" for="validatedCustomFile">Results PDF</label>
                                </div>
                            </div>
                            <input type="submit" class="btn btn-primary float-right mb-2" value="Upload">
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