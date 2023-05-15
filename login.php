<?php
// define variables and set to empty values
$EmailErr = $passwordErr = "";
$Email = $password = "";
$errorMsg = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["Email"])) {
    $EmailErr = "Email is required";
  } else {
    $Email = test_input($_POST["Email"]);
  }
  
  if (empty($_POST["password"])) {
    $passwordErr = "Password is required";
  } else {
    $password = test_input($_POST["password"]);
  }
  
  if (!empty($Email) && !empty($password) && $EmailErr == "" && $passwordErr == "") {
    $servername= "localhost:3306";
    $usernamed = "root";
    $passwords = "12345";
    $dbname = "FinalProject";

    $conn = mysqli_connect($servername, $usernamed, $passwords, $dbname);

    if(!$conn)
      die("could not connect".mysqli_connect_error());

    $sql = "SELECT * FROM SignUp WHERE Email='$Email' AND Password='$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
      // login successful
      session_start();
      $_SESSION['Email'] = $Email;
      $_SESSION["loggedin"] = true;
      header('Location: welcome.php'); // redirect to home page
    } else {
      // login failed
      $errorMsg = "Invalid Email or password";
    }

    $conn->close();
  }
  else{
    $errorMsg = 'Email or password is incorrect.';
  }
}
 
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login Page</title>
<link rel="stylesheet" href="login.css">
</head>
<body>
<h1>Login Page</h1>
<div id="login-form">
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <label for="Email">Email:</label>
    <input type="text" id="Email" name="Email" required>
    <span class="error"><?php echo $EmailErr;?></span>
    
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
    <span class="error"><?php echo $passwordErr;?></span>
    
    <input type="submit" value="Submit" id="submit-btn">
  </form>
  <div id="error"><?php echo $errorMsg; ?></div>

  <p class="para-2">Not have an account? <a href="signUp.html">SignUp here</a></p>
</div>
</body>
</html>
