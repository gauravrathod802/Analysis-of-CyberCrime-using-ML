
<?php

    $servername= "localhost:3306";
    $usernamed = "root";
    $passwords = "12345";
    $dbname = "FinalProject";
	
    // $conn = new mysqli($servername, $usernamed, $passwords, $dbname);

    $FirstName=$_POST['FirstName'];
    $LastName=$_POST['LastName'];
    $Email=$_POST['Email'];
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


    $query="INSERT INTO SignUp (FirstName,LastName, Email, PhoneNumber, DOB, City,State) VALUES ('$FirstName','$LastName','$Email','$PhoneNumber','$DOB','$City','$State')";


    if(mysqli_query($conn,$query)){
        echo "reccords added";

    }
    else{
        echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
    }
    //$stmt=mysqli_query($conn,$query);
mysqli_close($conn);

?>