<?php
 require_once 'inc/db.php';
 $username = $password = "";
 $username_err = $password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
   // Check if username is empty
   if(empty(trim($_POST["username"]))){
       $username_err = 'Please enter username.';
   } else{
       $username = trim($_POST["username"]);
   }

   // Check if password is empty
   if(empty(trim($_POST['password']))){
       $password_err = 'Please enter your password.';
   } else{
       $password = trim($_POST['password']);
   }
   if(empty($username_err) && empty($password_err)){
       // Prepare a select statement
       $sql = "SELECT id, username, password FROM users WHERE username = :username";

       if($stmt = $pdo->prepare($sql)){
           // Bind variables to the prepared statement as parameters
           $stmt->bindParam(':username', $param_username, PDO::PARAM_STR);

           // Set parameters
           $param_username = trim($_POST["username"]);

           // Attempt to execute the prepared statement
           if($stmt->execute()){
               // Check if username exists, if yes then verify password
               if($stmt->rowCount() == 1){
                   if($row = $stmt->fetch()){
                       $hashed_password = $row['password'];
                       if(password_verify($password, $hashed_password)){
                           /* Password is correct, so start a new session and
                           save the username to the session */
                           session_start();
                            $_SESSION['username'] = $username;
                            $_SESSION['user_id'] = $row['id'];
                            $_SESSION['email'] = $row['email'];
                           header("location: dashboard.php");
                       } else{
                           // Display an error message if password is not valid
                           $password_err = 'The password you entered was not valid.';
                       }
                   }
               } else{
                   // Display an error message if username doesn't exist
                   $username_err = 'No account found with that username.';
               }
           } else{
               echo "Oops! Something went wrong. Please try again later.";
           }
       }

       // Close statement
       unset($stmt);
   }

   // Close connection
   unset($pdo);
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Visionads Login</title>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
     <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
     <link rel="stylesheet" href="css/login.css">
</head>
<body>
<section id="videoheader" style="height: 16px;">
    <video class="video-sample visible" autoplay="" loop="" muted="">
        <source src="img/Vacay_Mode.mp4" type="video/mp4">
        <source src="img/Vacay_Mode.webm" type="video/webm">
    </video>
    <div class="container-fluid">
        <div class="row mx-auto mt-5">
      <div class="col-4 mx-auto">
            <div class="card mt-5">
              <div class="card-header">
               <h3 class="card-title">Login Now </h3>
                <span class="text-warning">Please fill in your username and Password.</span>
              </div>
              <div class="card-body">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                  <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control">
                  </div>
                  <div class="form-group">
                    <input class="btn btn-success" type="submit" name="submit" value="Log In">
                    <p>Don't have an account?
                    <a href="register.php" class="text-warning">Sign up now</a>.</p>
                    <a href="index.php" class="text-warning">Return to Home</a>.</p>
                  </div>
                </form>
              </div>
            </div>

            </div>
        </div>
    </div>
</section>
</body>
</html>
