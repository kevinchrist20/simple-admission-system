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
            <a href="#">Admission</a>
          </li>
          <li class="breadcrumb-item active">Overview</li>
        </ol>

        <!-- Page Content-->
        <div class="mb-5">
        <div class="server-feedback"></div>
          <form id="admission" method="POST">
            <div class="form-group">
                <div class="form-row">
                    <div class="col-md-4">
                        <div class="form-label-group">
                        <input type="text" name="firstName" id="firstName" class="form-control" placeholder="First name" required="required" autofocus="autofocus">
                        <label for="firstName">First name</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-label-group">
                        <input type="text" name="lastName" id="lastName" class="form-control" placeholder="Last name" required="required">
                        <label for="lastName">Last name</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-label-group">
                            <input type="text" id="OtherName" name="otherName" class="form-control" placeholder="Other name">
                            <label for="OtherName">Other name(s)</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-label-group">
                            <input type="date" id="inputDate" name="dob" class="form-control" placeholder="DOB" required="required">
                            <label for="inputDate">Date of birth</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-label-group">
                            <select form="admission" id="selectGender" class="custom-select form-control" name="gender" required>
                                <option value="" selected disabled hidden>Select Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select> 
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="form-row">
                <div class="col-md-6">
                    <div class="form-label-group">
                    <input type="text" name="address" id="inputAddress" class="form-control" placeholder="Residential Address" required="required">
                    <label for="inputAddress">Residential Address</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-label-group">
                    <input type="text" name="postal_ad" id="inputPostalAddress" class="form-control" placeholder="Postal Address" required="required">
                    <label for="inputPostalAddress">Postal Address</label>
                    </div>
                </div>
                </div>
            </div>
            <div class="form-group">
                <div class="form-row">
                <div class="col-md-6">
                    <div class="form-label-group">
                    <input type="text" name="nationality" id="inputNationality" class="form-control" placeholder="Nationality" required="required">
                    <label for="inputNationality">Nationality</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-label-group">
                    <input type="number" name="id_card" id="inputIDCard" class="form-control" placeholder="ID Number" required="required">
                    <label for="inputIDCard">ID Number</label>
                    </div>
                </div>
                </div>
            </div>
            <div class="form-group">
                <div class="form-row">
                <div class="col-md-6">
                    <div class="form-label-group">
                    <input type="text" name="father_name" id="inputFatherName" class="form-control" placeholder="Father's Name" required="required">
                    <label for="inputFatherName">Father's Name</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-label-group">
                    <input type="text" name="mother_name" id="inputMotherName" class="form-control" placeholder="Mother's Name" required="required">
                    <label for="inputMotherName">Mother's Name</label>
                    </div>
                </div>
                </div>
            </div>
            <div class="form-group">
                <div class="form-label-group">
                <input type="text" name="qualification" id="inputQualification" class="form-control" placeholder="Email address" required="required">
                <label for="inputQualification">Education Qualification</label>
                </div>
            </div>
            <div class="form-group text-center">
                <input type="checkbox" name="declare" id="inputDeclare" required="required">
                <label for="inputDeclare">I hereby state that the facts mentioned above are true to the best of my knowledge</label>
            </div>
            <input type="submit" class="btn btn-primary float-right" value="Continue">
          </form>
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