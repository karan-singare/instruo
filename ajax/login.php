<?php include '../connection/db.php'; ?>
<?php

function login(){
	GLOBAL $db;
	if($_GET['login_form'] && $_GET['login_form'] == 'true'){
		$email = $_POST['login_email'];
		$password = $_POST['login_password'];
		$Query = $db->prepare("SELECT * FROM users WHERE email = ? OR username= ?");
		$Query->execute(array($email, $email));
		if($Query->rowCount() != 0){
        $r = $Query->fetch(PDO::FETCH_OBJ);
        $db_password = $r->password;
        if(password_verify($password, $db_password)){
        	$_SESSION['username'] = $r->username;
        	echo json_encode(['error' => 'success', 'msg' => 'profile/index.php']);
        }else{
        	echo json_encode(['error' => 'no_password', 'msg' => 'Please Enter Correct Password!']);
        }
		}else{
			echo json_encode(['error' => 'no_email', 'msg' => 'Please Enter Correct Email Or Username!']);
		}
	}
}
login();

 ?>
