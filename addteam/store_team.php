<?php include '../connection/db.php';?>
<?php
$event_id=$_SESSION['event_id'];
//Here put your session variable
$arr=(isset($_GET['user']))?$_GET['user']:0;
$gpname=(isset($_GET['groupname']))?$_GET['groupname']:0;
$l=strlen($arr);
$arr=substr($arr,1,$l-2);
$str_arr = explode (",", $arr);
//print_r($str_arr);
//echo $gpname;
$database='Instruo';
$user='admin';
$pass='Admin@123';
$connect=mysqli_connect('localhost',$user,$pass);
mysqli_select_db($connect,$database);
$q="select * from teams where teamname=$gpname and event_id=$event_id";
$chec=mysqli_query($connect,$q);
$row=mysqli_num_rows($chec);
if($row>0)
{
  echo "Existed";
}
else if($row==0)
{
  $q1="insert into teams(teamname,event_id) values($gpname,$event_id)";
  $chec1=mysqli_query($connect,$q1);
  $q2="select team_id from teams where teamname=".$gpname."and event_id=".$event_id;
  $chec2=mysqli_query($connect,$q2);
  $rw=mysqli_num_rows($chec2);
  //echo $rw;
  if($rw==1)
  {
    $a=mysqli_fetch_all($chec2,MYSQLI_ASSOC);
    $val=$a[0]['team_id'];
    foreach ($str_arr as $value) {
      $q3="insert into user_team values($val,'$value',$event_id)";
      $chec3=mysqli_query($connect,$q3);
    }
    echo "Created";
  }
  else {
    echo "SomeError";
  }
}
