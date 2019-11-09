<?php include '../connection/db.php';?>
<?php
$userid=$_SESSION['username'];
$event_id=$_GET['event_id'];
$db = 'Instruo';
$user = 'admin';
$pass = 'Admin@123';
$host = 'localhost';
$con = mysqli_connect($host, $user, $pass, $db);
if(!$con){
   echo "error";
}
$q="select event_name,size from events where event_id=$event_id";
$chec=mysqli_query($con,$q);
$check=mysqli_num_rows($chec);
$row=mysqli_fetch_assoc($chec);
$event_name=$row["event_name"];
$size=$row["size"];
$q="select * from user_register where username='$userid' and event_id=$event_id";
$chec=mysqli_query($con,$q);
$check=mysqli_num_rows($chec);
//$q="select * from user_team where event_id='$event_id' and username='$userid'";
$q="select user_team.team_id,teamname from user_team,teams where user_team.event_id='$event_id' and username='$userid' and user_team.team_id=teams.team_id";
$chec=mysqli_query($con,$q);
$check1=mysqli_num_rows($chec);
$row=mysqli_fetch_assoc($chec);
if ($check)
	$registered=1;
else
	$registered=0;
if ($check1)
{
	$registered=2;
	$teamname=$row['teamname'];
}
$_SESSION['event_id']=$event_id;
$_SESSION['event_size']=$size;
$_SESSION['register']=$registered;
?>
<?php if (!isset($_SESSION['username'])) header("location: ../index.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $event_name;?></title>
    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/album/">

    <!-- Bootstrap core CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="../assets/css/style.css">
	<link rel="stylesheet" href="../assets/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="../assets/css/profile.css">
	<style>

	table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 50%;
  text-align: center;
  align:center;
}

td, th {
  border: 1px solid #dddddd;
  text-align: center;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
</head>
<body >


    <video autoplay muted loop id="myvideo">
    <source src="../assets/img/video.mp4" type="video/mp4">
    </video>
	<?php include '../parts/nav.php'; ?>


    <div class="container contents" >

          <div class="signup-cover">
			<div class="card">
				<div class="card-header">

				</div><!-- card-header -->
				<div class="card-body">
					<form id="signup_submit">
						<div class="form-group show-progress">

						</div>

						<div class="form-group">
							<p> <strong>Max Team Size: <?php echo $size;?></strong></p>
							<?php
							if ($registered==2)
								{
									echo "<p align='center' style='margin-bottom:5px;'><strong>Team Name-".$teamname."</strong></p>";
									$q="select users.username,email from users join user_team on users.username=user_team.username  where user_team.team_id=(SELECT team_id from user_team where username='$userid' and event_id='$event_id')";
									/*$q="select users.username,email,teamname from users join user_team join teams on users.username=user_team.username and
										user_team.team_id=teams.team_id
										where user_team.team_id=(SELECT team_id from user_team where username='$userid' and event_id=$event_id)";*/
									$chec=mysqli_query($con,$q);

									echo "<table align='center'>";

									echo "<tr><td><strong>Username</strong></td><td><strong>Email</strong></td></tr>";
									while($row = mysqli_fetch_assoc($chec))
									{
   										echo "<tr>";
   										echo "<td>".$row['username']."</td><td>".$row['email']."</td></tr>";
									}
									echo "</table>";


								}
							?>
							<p id='status'></p>
							<?php if ($registered!=2)
								echo '<button type="button" id="submit" class="btn btn-success btn-block form-btn" onclick="register()">';

							 if ($registered==1){echo "Create Team";}
							elseif($registered==0){echo "Register";}

								echo "</button>";
							?>


						</div><!-- form-group -->
					</form><!-- form -->
				</div><!-- card-body -->
				<div class="form-icon">
					<div class="label-heading"><h5><?php echo $event_name?></h5></div>
				</div>
			</div><!-- card -->
            </div><!-- signup-cover-->
    </div><!-- container -->

	<script type="text/javascript" src="../assets/js/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
	<script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/profile.js"></script>

    <script type="text/javascript">
    $(document).ready(function(){
        setTimeout(function(){
        $(".all-msg").fadeOut("slow");
        },2000);
    })
    function register()
    {
    	var registered=<?php echo $_SESSION['register']; ?>;

    	if (!registered)
    	{
    		var request = $.ajax({
  				url: "register.php",
  				type: "POST",
				});

			request.done(function(msg) {
  				$("#status").html( msg );
				$("#submit").html("Create Team");
				location.reload();

			});

			request.fail(function(jqXHR, textStatus) {
  				alert( "Request failed: " + textStatus );
			});
    	}
    	if (registered==1)
    	{
    		window.location="../addteam/";
    	}

    }
</script>
</body>
</html>
