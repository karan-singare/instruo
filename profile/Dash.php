<?php
  $db = 'Instruo';
  $user = 'admin';
  $pass = 'Admin@123';
  $host = 'localhost';
  $con = mysqli_connect($host, $user, $pass, $db);
  if(!$con){
      echo "error";
  }
  $q='select * from events';
  $chec=mysqli_query($con,$q);
  $check=mysqli_num_rows($chec);
  if($check>0)
  {
    $a=mysqli_fetch_all($chec,MYSQLI_ASSOC);
    // print_r($a);
    print_r(json_encode($a));
  }
  else
  {
    echo "No data Found";
  }

?>
