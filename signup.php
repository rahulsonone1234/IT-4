<?php

$name = $_POST['name'];
$email  = $_POST['email'];
$pass = $_POST['pass'];
$re_pass = $_POST['re_pass'];




if (!empty($name) || !empty($email) || !empty($pass) || !empty($re_pass) )
{

$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "it-4";



// Create connection
$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);

if (mysqli_connect_error()){
  die('Connect Error ('. mysqli_connect_errno() .') '
    . mysqli_connect_error());
}
else{
  $SELECT = "SELECT email From register Where email = ? Limit 1";
  $INSERT = "INSERT Into register (name , email ,pass, re_pass )values(?,?,?,?)";
//  $INSERT1 = "INSERT Into loginn (name ,pass)values(?,?)";


//Prepare statement
     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $email);
     $stmt->execute();
     $stmt->bind_result($email);
     $stmt->store_result();
     $rnum = $stmt->num_rows;

     //checking username
      if ($rnum==0) {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("ssss", $name,$email,$pass,$re_pass);
      $stmt->execute();
      echo "Signed-up sucessfully";
      header("location:home.html");
     } else {
      echo "Someone already register using this email";
      header("location:index.html");
     }
     $stmt->close();
     $conn->close();
    }
} else {
 echo "All field are required";
 die();
}
?>