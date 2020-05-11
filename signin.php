<?php

$name = $_POST['name'];
$pass = $_POST['pass'];


if (!empty($name) ||!empty($pass)  )
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
//  $SELECT = "SELECT email From register Where email = ? Limit 1";
  $INSERT = "INSERT Into loginn (name ,pass )values(?,?)";

    $s="select name,pass from register where name='$name' &&pass='$pass'";
    $result= mysqli_query($conn,$s);

    $num=mysqli_num_rows($result);
    if($num==1)
    {
        $stmt = $conn->prepare($INSERT);
        $stmt->bind_param("ss", $name,$pass);
        $stmt->execute();
        echo"Login Success";
        header("location:home.html");
    } 
    else
    {
        echo"Login Failure";
        header("location:index.html");
    }   
    }
} 
else 
{
 echo "All field are required";
 die();
}
?>