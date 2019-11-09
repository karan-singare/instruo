<?php
include '../connection/db.php';



function check_username(){
  GLOBAL $db;
  if(isset($_POST['check_username'])){
  	$username = $_POST['check_username'];
  	$Query = $db->prepare("SELECT username FROM users WHERE username = ?");
  	$Query->execute(array($username));

  	if($Query->rowCount() == 0){
        echo json_encode(array('error' => 'username_success'));
  	}else{
        echo json_encode(array('error' => 'username_fail', 'message' => 'Sorry this username is already exist'));
  	}
  }
}//close check email method
check_username();


function check_email(){
  GLOBAL $db;
  if(isset($_POST['check_email'])){
  	$email = $_POST['check_email'];
  	$Query = $db->prepare("SELECT email FROM users WHERE email = ?");
  	$Query->execute(array($email));
  	if($Query->rowCount() == 0){
    echo json_encode(array('error' => 'email_success'));
  	}else{
    echo json_encode(array('error' => 'email_fail', 'message' => 'Sorry this email is already exist'));
  	}
  }
}//close check email method
check_email();

function singup_submit(){
  GLOBAL $db;
  if(isset($_GET['signup']) && $_GET['signup'] == 'true')
  {
   $name     = $_POST['name'];
   $username     = $_POST['username'];
   $email    = $_POST['email'];
   $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
   $Query    = $db->prepare("INSERT INTO users (name, username,  email, password) VALUES (?,?,?,?)");
   $result = $Query->execute([$name, $username, $email, $password]);
   if($result != false){
        $_SESSION['user_name'] = $name;
        echo json_encode(['error' => 'success', 'msg' => 'profile/index.php']);
   }

  }
}
singup_submit();

 ?>
