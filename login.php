<?php

include 'includes/functions.php';
include 'classes/User.php';

if(User::isLoggedIn()){
  header("Location: index");
}


if(isset($_POST['login'])){  
  $username = clean($_POST['username']);
  $password = clean($_POST['password']);

  $errors = array();

  if(empty($password)){
    $errors['password'] = '<p><label class="text-danger font-weight-bold text-uppercase">Please Enter Passowrd.</label></p>';
  }

  if(empty($username)){
    $errors['username'] = '<p><label class="text-danger font-weight-bold text-uppercase">Please Enter Email.</label></p>';
  }

  if(count($errors) == 0){
    $data = array(
      "password" => $password,
      "username" => $username,
    );

    if(User::login($data)){
      $_SESSION['login_success_message'] = "Logged In Successfully";
      header("Location: index");

      exit;
    }else{
      $errors['wrong_combination'] = '<div class="alert alert-dismissible alert-danger">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      Username And Password Do Not Match.
    </div>';
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
          <h1 class="mt-5">LOGIN</h1>

          <?php echo $errors['wrong_combination'] ?? ""; ?>

          <form method="POST" class="mb-5">
            <fieldset>

              <div class="form-group">
                <label for="username">Username</label>
                <input type="username" name="username" class="form-control" id="username" placeholder="Unesite username" value="<?php echo $username ?? ""; ?>">             
                <?php echo $errors['username'] ?? ""; ?>
              </div>

              <div class="form-group">
                <label for="password">Passowrd</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Enter password" value="<?php echo $password ?? ""; ?>">             
                <?php echo $errors['password'] ?? ""; ?>
              </div>

              <button id="login-btn" type="submit" name="login" class="btn btn-primary d-block w-100">LOGIN</button>
            </fieldset>
          </form>
        </div>
      </div>
    </div>
  </section>
  <!-- -------- PRIJAVE ---------- -->

  <?php include 'includes/footer.php'; ?>
