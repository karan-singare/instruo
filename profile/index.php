<?php include '../connection/db.php';?>
<?php if (!isset($_SESSION['username'])) header("location: ../index.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Profile</title>
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
</head>
<body>


    <video autoplay muted loop id="myvideo">
    <source src="../assets/img/video.mp4" type="video/mp4">
    </video>
	<?php include '../parts/nav.php'; ?>


    <div class="container contents" >
        <div class='row' id='event'>
        </div>

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
</script>
<script>
        async function value()
        {
          const data=await fetch('Dash.php');
          return data;
        }
        var add;
        window.onload=function()
        {
          var data=value();
          var event=document.getElementById('event');
          console.log(event);
          var html='';
          data.then(a=>
            {
              var k=a.json();
              k.then(l=>{
                //console.log(l);
                l.forEach(kl=>{
                  var data=kl['event_name'];
                  var data1=kl['size'];
                  var data2=kl['event_id'];
                  html+=`<div class="col-md-4">
          <a href='../Events?event_id=${data2}' style="text-decoration:none; color:black;"><div class="card mb-4 shadow-sm">
            <!--<svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img"  aria-label="Placeholder: Thumbnail"><title>Placeholder</title>-->
            
            <!--<rect width="100%" height="100%" fill="#55595c"></rect>--><img src="lanza.gif" width="100%";height="20%;">
            <!--<text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>-->
            <div class="card-body" style="background: -webkit-linear-gradient(left,#f93d67,#7047d7) !important;height:80px; padding-top:15px;">
              <p class="card-text" style="color:white;"><strong>${data}</strong><br>Maximum Group Size:${data1}</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  
                  
                  
                </div>
                
              </div>
            </div>
          </div></a>
        </div>`;
      });
                event.innerHTML=html;
                console.log(html);
              });
            }).catch(kl=>{
              console.log('Error');
            })
        };






      </script>
</body>
</html>
