<?php
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$country = $_POST['country'];


if (!empty($firstname)|| !empty($lastname)||($email)||(country)){
	$host ="localhost";
	$dbUsername="klei";
	$dbPassword="";
	$dbname="register";



}elseif (condition) {
	# code...
	echo "All field are required";
	die();
}

$conn = new mysqli($host,$dbUsername,$dbPassword, $dbname);
 if (mysqli_connect_error()) {
     die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());	
} 
else {
	$SELECT = "SELECT email From register Where email=? Limit 1";
	$INSERT = " INSERT Into register (firstname, lastname, country ,email) values(?, ,? ,? ,? )";
//Prepare statement
     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $email);
     $stmt->execute();
     $stmt->bind_result($email);
     $stmt->store_result();
     $rnum = $stmt->num_rows;
     if ($rnum==0) {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("ssssii", $firstname, $lastname, $email, $country);
      $stmt->execute();
      echo "New record inserted sucessfully";
     } else {
      echo "Someone already register using this email";
     }
     $stmt->close();
     $conn->close();
    }


?>