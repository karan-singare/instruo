<?php
session_start();
$userid=$_SESSION['username'];
$event_id=$_SESSION['event_id'];
$db = 'Instruo';
$user = 'admin';
$pass = 'Admin@123';
$host = 'localhost';
$con = mysqli_connect($host, $user, $pass, $db);
if(!$con){
   echo "error";
}
$q="insert into user_register values($event_id,'$userid');";
$chec=mysqli_query($con,$q);
if ($chec){
	echo "Registration Succesful";
	$_SESSION['register']=1;
}
else
	echo "Failed";
?>
