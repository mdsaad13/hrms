<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/styles.css">
  <link rel="stylesheet" href="assets/css/particles_style.css">

  <title>Login</title>
</head>
<style>
  .main {
    top: 20%;
    left: 30%;
    position: absolute;
  }

  .invalid-feedback {
    font-size: 14px;
    margin-left: 10%;
  }

  p {
    font-size: 18px;
    color: red;
    text-align: center;
  }
</style>

<body>
  <div id="particles-js"></div>
  <div class="container main">
    <center>
      <img src="assets/img/hrms.jpg" alt="" style="height: 100px;">
    </center>

    <h1 style="font-size: 2.5rem;margin-bottom: .5rem;font-weight: 500;">Login</h1>
    <?php
    if (isset($_REQUEST['2'])) { ?>
      <p>Incorrect Password</p>
    <?php } else if (isset($_REQUEST['3'])) { ?>
      <p>Invalid Email</p>
    <?php } ?>

    <form class="needs-validation" novalidate action="controllers/login.php" method="post">
      <div class="form-row" style="margin: 15px 0;">
        <div class="col-md-12 mb-12">
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroupPrepend">
                <img src="assets/img/person.png" alt="" style="height: 26px;">
              </span>
            </div>
            <input type="email" class="form-control" id="validationCustomUsername" placeholder="Enter your Email" aria-describedby="inputGroupPrepend" required name="email">
            <div class="invalid-feedback">
              Please enter your email.
            </div>
          </div>
        </div>
      </div>
      <div class="form-row" style="margin: 15px 0;">
        <div class="col-md-12 mb-12">
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroupPrepend">
                <img src="assets/img/vpn_key.png" alt="" style="height: 26px;">
              </span>
            </div>
            <input type="password" class="form-control" id="validationCustomUsername" placeholder="Enter your Password" aria-describedby="inputGroupPrepend" required name="password">
            <div class="invalid-feedback">
              Please enter password.
            </div>
          </div>
        </div>
      </div>
      <div class="form-row center" style="margin: 15px 20%;">
        <button class="btn btn-primary" type="submit" style=" width: 100%;">LOGIN</button>
      </div>
    </form>
  </div>
</body>
<script src="assets/js/particles.min.js"></script>
<script src="assets/js/app.js"></script>
<script>
  // Example starter JavaScript for disabling form submissions if there are invalid fields
  (function() {
    'use strict';
    window.addEventListener('load', function() {
      // Fetch all the forms we want to apply custom Bootstrap validation styles to
      var forms = document.getElementsByClassName('needs-validation');
      // Loop over them and prevent submission
      var validation = Array.prototype.filter.call(forms, function(form) {
        form.addEventListener('submit', function(event) {
          if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
          }
          form.classList.add('was-validated');
        }, false);
      });
    }, false);
  })();
</script>

</html>