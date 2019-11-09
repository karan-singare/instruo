<?php include '../connection/db.php';?>
<?php
//change event+id using session
$event_id=$_SESSION['event_id'];
$name=(isset($_GET['users']))?$_GET['users']:0;
$database='Instruo';
$user='admin';
$pass='Admin@123';
$connect=mysqli_connect('localhost',$user,$pass);
mysqli_select_db($connect,$database);
$q="select users.username from user_register join users on user_register.username=users.username where users.username like ".$name." and event_id=".$event_id;
// echo $q;
$chec=mysqli_query($connect,$q);
$row=mysqli_num_rows($chec);
$a=[[]];
if($row>0)
{
  $i=0;
  while ($ro = mysqli_fetch_assoc($chec))
  {
    $value=$ro["username"];
    $quer="select team_id from user_team where username='$value' and event_id='$event_id'";
    // echo $quer;
    $ans=mysqli_query($connect,$quer);
    $kl=mysqli_num_rows($ans);
    if($kl==0)
    {
      $a[$i]['username']=$value;
      $i+=1;
    }
  }
  if($i==0)
  {
    $a[0]["username"]="No Record Found!!";
    print_r(json_encode($a));
  }
  else {
    print_r(json_encode($a));
  }
}
else {
  $a[0]["username"]="No Record Found!!";
  print_r(json_encode($a));
}

?>
