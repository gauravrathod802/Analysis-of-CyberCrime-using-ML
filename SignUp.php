
<?php

    $servername= "localhost:3306";
    $usernamed = "root";
    $passwords = "12345";
    $dbname = "FinalProject";
	

    $errorMsg = $successMsg= "";


    // $conn = new mysqli($servername, $usernamed, $passwords, $dbname);

    $FirstName=$_POST['FirstName'];
    $LastName=$_POST['LastName'];
    $Email=$_POST['Email'];
    $Password=$_POST['Password'];
    $PhoneNumber=$_POST['PhoneNumber'];
    $DOB=$_POST['DOB'];
    $City=$_POST['City'];
    $State=$_POST['State'];


    $conn = mysqli_connect($servername, $usernamed, $passwords, $dbname);
    // if ($conn->connect_error) {
    // die("Connection failed: " . $conn->connect_error);
    //  }

    if(!$conn)
      die("could not connect".mysqli_connect_error());
   

    // $query="INSERT INTO SignUp (FirstName,LastName, Email, PhoneNumber, DOB, City,State) VALUES ('gau','rathod','gaurav@gmail.com','864556845','4/5/2000','yavatmal','maha')"; 


    $query="INSERT INTO SignUp (FirstName,LastName, Email, Password,PhoneNumber, DOB, City,State) VALUES ('$FirstName','$LastName','$Email','$Password','$PhoneNumber','$DOB','$City','$State')";


    //need to change here for  the account that should not redirect to new page and say record added
    if(mysqli_query($conn,$query)){
      session_start();

        $successMsg = "reccords added";

        $_SESSION['FirstName'] = $FirstName;
        $_SESSION["loggedin"] = true;

    }
    else{
        $errorMsg = "ERROR: Could not able to execute. " . mysqli_error($conn);
    }
    //$stmt=mysqli_query($conn,$query);
mysqli_close($conn);

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Sign up </title>
    <link rel="stylesheet" href="Signup.css" />
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap"
      rel="stylesheet"
    />
  </head>
  <body>
    <div class="container">
      <div class="signup-image">
        <img src="\img\signUp.jpeg"  height="725"  width="1000">
      </div>
      <div class="signup-box">
        <h1>SIGN UP</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
          <label>First Name</label>
          <input type="text" placeholder="" id="FirstName" name="FirstName" />

          <label>Last Name</label>
          <input type="text" placeholder="" id="LastName" name="LastName" />

          <label>Email</label>
          <input type="email" placeholder="" id="Email" name="Email" />
          
          <label>Password</label>
          <input type="Password" placeholder="" id="Password" name="Password" />

          <label>Phone Number</label>
          <input type="tel" placeholder="" id="PhoneNumber" name="PhoneNumber"/>

          <label>DOB</label>
          <input type="date" placeholder="" id="DOB" name="DOB"/>

          <label>City</label>
          <input type="text" placeholder="" id="City" name="City"/>

          <label>State</label>
          <input type="text" placeholder="" id="State" name="State" />

          <input type="submit" id="signup" value="Submit" />

        </form>
        <div id="error1" style="color:red;"><?php echo $errorMsg; ?></div>
        <div id="error1" style="color:green;"><?php echo $successMsg; ?></div>

        <p class="para-2">Already have an account? <a href="login.html">Login here</a></p>


      </div>
    </div>
  </body>
</html>
