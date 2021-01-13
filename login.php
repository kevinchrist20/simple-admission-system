<?php
  require_once("inc/head.php");
?>

  <title>GTUC Student - Login</title>

</head>

<body class="bg-dark">

  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="server-feedback"></div>
      <div class="card-header">Login</div>
      <div class="card-body">
        <form id="auth-form" method="POST">
          <div class="form-group">
            <div class="form-label-group">
              <input type="number" id="inputEmail" name="serial_no" class="form-control" placeholder="Student ID" required="required" autofocus="autofocus">
              <label for="inputEmail">Serial Number</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="password" id="inputPassword" name="pass" class="form-control" placeholder="Password" required="required">
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
