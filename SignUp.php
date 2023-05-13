<?php
// define variables and set to empty values
$FirstNameErr = $LastNameErr = $EmailErr = $PhoneNumberErr = $DOBErr  = $CityErr = $StateErr="";
$FirstName = $LastName = $Email = $PhoneNumber = $DOB = $City = $State = "";
$successMsg = $errorMsg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["FirstName"])) {
    $FirstNameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      $FirstNameErr = "Only letters and white space allowed"; 
    }
  }
  
  if (empty($_POST["LastName"])) {
    $LastNameErr = "Lastname is required";
  } else {
    $LastName = test_input($_POST["LastName"]);
    // check if LastName only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$LastName)) {
      $LastNameErr = "Only letters and white space allowed"; 
    }
  }
  
  if (empty($_POST["Email"])) {
    $EmailErr = "Email is required";
  } else {
    $Email = test_input($_POST["Email"]);
    // check if Email only contains letters and whitespace
    /*if (!preg_match("/^[a-zA-Z0-9 ]*$/",$Email)) {
      $EmailErr = "Only letters, numbers and white space allowed"; 
    }*/

    if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
      $EmailErr = "Invalid email format"; 
    }
  }
  
  if (empty($_POST["PhoneNumber"])) {
    $PhoneNumberErr = "number is required";
  } else {
    $PhoneNumber = test_input($_POST["PhoneNumber"]);
    
  }
  



  if (empty($_POST["DOB"])) {
    $DOBErr = "Pincode is required";
  } else {
    $DOB = test_input($_POST["DOB"]);
    // check if DOB only contains letters and whitespace
    // if (!preg_match("/^[0-9]*$/",$DOB)) {
      $DOBErr = "Only numbers allowed"; 
    // }
  }
  
  // if (empty($_POST["email"])) {
  //   $emailErr = "Email is required";
  // } else {
  //   $email = test_input($_POST["email"]);
  //   // check if e-mail PhoneNumber is well-formed
  //   if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  //     $emailErr = "Invalid email format"; 
  //   }
  // }
  
  if (empty($_POST["City"])) {
    $CityErr = "city is required";
  } else {
    $City = test_input($_POST["City"]);
  }
  
  if (empty($_POST["State"])) {
    $StateErr = "state is req";
  } else {
    $State = test_input($_POST["State"]);
  }

}

if (!empty($_POST["FirstName"]) && !empty($_POST["LastName"]) && !empty($_POST["Email"]) && !empty($_POST["PhoneNumber"]) && !empty($_POST["DOB"]) && !empty($_POST["City"]) && !empty($_POST["State"]) && $FirstNameErr == "" && $LastNameErr == "" && $EmailErr == "" && $DOBErr == "" && 
$CityErr = "" && $StateErr="")
{
	$servername= "localhost:3306";
    $usernamed = "root";
    $passwords = "12345";
    $dbname = "FinalProject";
	
    // $conn = new mysqli($servername, $usernamed, $passwords, $dbname);

    $conn = mysqli_connect($servername, $usernamed, $passwords, $dbname);
    // if ($conn->connect_error) {
    // die("Connection failed: " . $conn->connect_error);
    //  }

    if(!$conn)
      die("could not connect".mysqli_connect_error());
    
    $sql = "INSERT INTO SignUp (FirstName,LastName, Email, PhoneNumber, DOB, City,State) VALUES ('$FirstName','$LastName','$Email','$PhoneNumber','$DOB','$City','$State')";
    if ($conn->query($sql) === TRUE) {
    $successMsg = "Registration Successful. Click on BACK button at the top to LOGIN.";
    } 
	else {
    $errorMsg = "Username $LastName already exists. Please enter another LastName.";
    }
	$conn->close();
}
 
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
