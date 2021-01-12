<?php
  require_once("inc/head.php");
?>

  <title>GTUC Student - Login</title>
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.min.css" rel="stylesheet">
</head>

<body class="bg-dark">

  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Login</div>
      <div class="card-body">
        <form>
          <div class="form-group">
            <div class="form-label-group">
              <input type="number" id="inputEmail" name="serial_no" class="form-control" placeholder="Student ID" required="required" autofocus="autofocus">
              <label for="inputEmail">Serial Number</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Pin" required="required">
              <label for="inputPassword">Password</label>
            </div>
          </div>
          <input type="submit" class="btn btn-primary btn-block" value="Login">
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="index.php">Register an Account</a>
          <!-- <a class="d-block small" href="forgot-password.html">Forgot Password?</a> -->
        </div>
      </div>
    </div>
  </div>

<?php
    require_once("inc/footer.php");
?>  
