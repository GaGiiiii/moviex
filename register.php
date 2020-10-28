<?php

include 'includes/clean.php';
include 'classes/User.php';

if(User::isLoggedIn()){
  header("Location: index");
}

if(isset($_POST['register'])){  
  $email = clean($_POST['email']);
  $password = clean($_POST['password']);
  $password2 = clean($_POST['password2']);
  $username = clean($_POST['username']);

  $errors = array();
  $fail = false;

  if(empty($email)){
    $errors['email'] = '<p class="mb-0"><label class="text-danger font-weight-bold text-uppercase mb-0">Please Enter Email.</label></p>';
    $fail = true;
  }else{
      if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
          $errors['email'] = '<p class="mb-0"><label class="text-danger font-weight-bold text-uppercase mb-0">Invalid Email Format.</label></p>';
          $fail = true;
      }
  }

  if(empty($password)){
    $errors['password'] = '<p><label class="text-danger font-weight-bold text-uppercase">Please Enter Passowrd.</label></p>';
    $fail = true;
  }else{
    if($password != $password2){
      $errors['password_confirm'] = '<p><label class="text-danger font-weight-bold text-uppercase">Passwords Do Not Match.</label></p>';
    }
  }

  if(empty($password2)){
    $errors['password2'] = '<p><label class="text-danger font-weight-bold text-uppercase">Please Confirm Password.</label></p>';
    $fail = true;
  }

  if(empty($username)){
    $errors['username'] = '<p><label class="text-danger font-weight-bold text-uppercase">Please Enter Email.</label></p>';
    $fail = true;
  }

  if(count($errors) == 0){
    $data = array(
      "email" => $email,
      "password" => $password,
      "username" => $username,
    );

    if(User::register($data)){
      $_SESSION['register_success_message'] = "<div class='container-fluid'>
                                        <div class='row'>
                                            <div class='col-md-10 col-sm-10 offset-sm-1 offset-md-1 p-0 mt-5'>
                                                <div class='alert alert-dismissible alert-success'>
                                                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                                                    <strong>Successfully Registerd.</strong>.
                                                </div>
                                            </div>
                                        </div>
                                    </div>";

      header("Location: index");
      exit;
    }

  } // COUNT errors CLOSE
} // POST REQ CLOSE
?>

<?php include 'includes/header.php'; ?>

<!-- -------- PRIJAVE ---------- -->
  <section id="prijave">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-6 col-sm-8 col-8">
          <h1 class="mt-5">REGISTER</h1>

          <form method="POST" class="mb-5">
            <fieldset>

              <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="Enter e-mail" value="<?php echo $email ?? ""; ?>">       
                <?php echo $errors['email'] ?? ""; ?>      
                <small id='emailHelp' class='form-text text-left text-black mt-0'>We'll never share your email with anyone else.</small>
              </div>

              <div class="form-group">
                <label for="password">Passowrd</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Enter password" value="<?php echo $password ?? ""; ?>">             
                <?php echo $errors['password'] ?? ""; ?>
                <?php echo $errors['password_confirm'] ?? ""; ?>
              </div>

              <div class="form-group">
                <label for="password2">Confirm Password</label>
                <input type="password" name="password2" class="form-control" id="password2" placeholder="Confirm password" value="">             
                <?php echo $errors['password2'] ?? ""; ?>
              </div>

              <div class="form-group">
                <label for="username">Username</label>
                <input type="username" name="username" class="form-control" id="username" placeholder="Unesite username" value="<?php echo $username ?? ""; ?>">             
                <?php echo $errors['username'] ?? ""; ?>
              </div>


              <button id="register-btn" type="submit" name="register" class="btn btn-primary d-block w-100">REGISTER</button>
            </fieldset>
          </form>
        </div>
      </div>
    </div>
  </section>
  <!-- -------- PRIJAVE ---------- -->

  <?php include 'includes/footer.php'; ?>
