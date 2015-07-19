<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

$DB_SERVER="localhost";
$DB_USERNAME="root";
$DB_PASSWORD="";
$DB_DATABASE="userdatadelta";

$db = mysqli_connect( "$DB_SERVER" ,"$DB_USERNAME","$DB_PASSWORD","$DB_DATABASE")or die("Cannot connect");

echo "connected?";

if(isset($_POST["submit"]))
{
echo "inside isset!";
$name = $_POST["name"];
$roll_number = $_POST["rollno"];
$department = $_POST["department"];
$year = $_POST["year"];
$email = $_POST["email"];
$password = $_POST["password"];
$filename=$_FILES['userpic']['name'];
$filetype=$_FILES['userpic']['type']; 

$name = mysqli_real_escape_string($db, $name);
$roll_number = mysqli_real_escape_string($db, $roll_number);
$department = mysqli_real_escape_string($db, $department);
$year = mysqli_real_escape_string($db, $year);
$email = mysqli_real_escape_string($db, $email);
$password = mysqli_real_escape_string($db, $password);
$password = md5($password);

$newfilename= $roll_number;

if($filetype=='image/jpeg' or $filetype=='image/png' or $filetype=='image/gif')
 {
echo "file type checking!";
move_uploaded_file($_FILES['userpic']['tmp_name'],'upload/'.$newfilename);
$filepath="upload/".$newfilename;
 }


$sql = "SELECT email FROM users WHERE email='$email'";
$result = mysqli_query($db,$sql);
$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
 
if(mysqli_num_rows($result) == 1)
{
 echo "An account has been created with this email ID already. We regret the inconvenience";
}
else
{
  $query = mysqli_query($db, "INSERT INTO users (name, rollno, department, year, email, password, imagepath)VALUES ( $name,$roll_number, $department, $year, $email, $password, $filepath)");
  echo "Hey you!";
  if($query)
   {
    echo "Thank You! You have completed registration and are now registered.";
   }
}
}
echo "Hey!";
?>
