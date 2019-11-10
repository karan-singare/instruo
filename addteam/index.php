<?php include '../connection/db.php';?>
<?php if (!isset($_SESSION['username'])) header("location: ../index.php"); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Admin</title>
    <link rel="stylesheet" href="user.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="../assets/js/jquery.min.js" charset="utf-8"></script>
  <style>
    h1,.dropdown{
      margin:40px 0px 0px 100px;
    }
    body{
      background-image: url("https://media.giphy.com/media/Y2QOhZlWhe0AE/giphy.gif");
      background-repeat:no-repeat;
      background-size: cover;
      background-position: center;
    }
    #error {
      color: red;
    }
  </style>
  </head>
  <body>
    <nav class="navbar navbar-expand-sm navbar-light bg-light custom-nav">
  <div class="container">
    <a href="../" class="navbar-brand">Home</a>
    <button type="button" class="navbar-toggler" data-target="#mynav" data-toggle="collapse">
      <span class="navbar-toggler-icon"></span>

    </button><!-- button -->
    <div class="collapse navbar-collapse" id="mynav">

       <ul class="navbar-nav ml-auto">
        <li class="nav-item">

        
        </li>
                <li><a href="../profile/logout.php" class="navbar-brand">Logout</a></li>
       </ul>
    </div><!-- collapse -->
  </div><!-- container -->
</nav><!-- nav close -->
    <h1>Create Team</h1>
    <div id="error" style="margin:20px 0 0 100px;">

    </div>
    <input type="text" name="team-name" id="group" placeholder="Team name" style="margin:20px 0 0 100px;">
    <div class="dropdown">
      <button onclick="myFunction()" class="dropbtn">Add Users</button>
      <div id="myDropdown" class="dropdown-content">
        <input type="text" placeholder="Type atleast 3 letters.." id="myInput" onkeyup="filterFunction()">
        <div id='users'></div>
      </div>
      <div id="add contacts" style="float:right;margin-left:300px;">
        <h3 style="margin-left:50px;color:white;">Your Team List</h3>
        <ul id="list">
        </ul>
        <button type="button"  class="dropbtn1" name="button" onclick="createTeam()">Create Team</button>
      </div>

    </div>



  </body>
  <script type="text/javascript">
        var event_size=<?php echo $_SESSION['event_size'];?>;
        var temp_size=event_size;
        //event size php
        var arr=[];
        var mohit="<?php echo $_SESSION['username'];?>";
        addmeindex(mohit);
        //append $session['own id'];
        function myFunction()
        {
            document.getElementById("myDropdown").classList.toggle("show");

        }
        function filterFunction()
        {
            var t=document.getElementById('myInput').value;
            var x=document.getElementById('users');
            console.log(t);
            let html='';
            if(t.length>=3)
            {
              var url="getuser.php?users='"+t+"%'";
              var data=add_user(url);
              console.log(data);
              data.then(a=>
              {
                console.log(a);
                a.forEach(k=>
                {
                  var value=k['username'];
                  var ki=0;
                  if(arr.indexOf(value)==-1)
                  {
                    if (value=="No Record Found!!")
                    {
                      html+=`<a href="#">${value}</a>`;
                    }
                    else {
                        html+=`<a href="#" onclick="addme(this)">${value}</a>`;
                    }
                  }
                  
                });
                x.innerHTML=html;
              }
          ).catch(kl => { console.log("Error URL")});
              var input, filter, ul, li, a, i;
              input = document.getElementById("myInput");
              filter = input.value.toUpperCase();
              div = document.getElementById("myDropdown");
              a = div.getElementsByTagName("a");
              for (i = 0; i < a.length; i++) {
                txtValue = a[i].textContent || a[i].innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                  a[i].style.display = "";
                } else {
                  a[i].style.display = "none";
                }
              }
            }
            else {
              console.log('No data');
            }
        }
      async function add_user(url)
      {
          const data=await fetch(url);
          const text=await data.json();
          return text;
      }
      function addme(t)
      {
        if(event_size>0)
        {
          t=t.innerHTML;
          console.log(t);
          var h=document.getElementById('list');
          var html=document.createElement('li');
          html.innerHTML=t+"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src='download.jpeg' width=20px height=20px; onclick='remove(this.parentNode)'>";
          html.style="font-size:25px;text-decoration:bold;";
          //let html=`<li style="font-size:25px;text-decoration:bold;">${t}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src='download.jpeg' width=20px height=20px; onclick="remove(this.parentNode)"></li>`;
          h.appendChild(html);
          event_size=event_size-1;
          arr.push(t);
          console.log(arr);
          var xt=document.getElementById('myInput');
          xt.value="";
          var xy=document.getElementById('users');
          xy.innerHTML='';
        }
        else
        {
          alert('List FULL');
        }
      }
      function addmeindex(t)
      {
        if(event_size>0)
        {
          console.log(t);
          var h=document.getElementById('list');
          var html=document.createElement('li');
          html.innerHTML=t+"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
          html.style="font-size:25px;text-decoration:bold;";
          //let html=`<li style="font-size:25px;text-decoration:bold;">${t}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src='download.jpeg' width=20px height=20px; onclick="remove(this.parentNode)"></li>`;
          h.appendChild(html);
          event_size=event_size-1;
          arr.push(t);
          console.log(arr);
          var xt=document.getElementById('myInput');
          xt.value="";
          var xy=document.getElementById('users');
          xy.innerHTML='';
        }
        else
        {
          alert('List FULL');
        }
      }
      
      function remove(t)
      {
        var x=t.innerHTML;
        var y=x.slice(0,x.indexOf('&'));
        var k=arr.indexOf(y);
        delete arr[k];
        t.remove();
        event_size=event_size+1;
      }
      async function createTeam()
      {
        var xyz=temp_size-event_size;
        var name=document.getElementById('group').value;
        let error = document.getElementById('error');

        if(name.length==0)
        {
          alert('Should have a Group Name');
        }
        else {
          if(xyz==0)
          {
              error.innerHTML="Select any user";
          }
          else {
                const data=await fetch("store_team.php?user=["+arr+"]&groupname='"+name+"'");
                if(data.ok)
       		{
          					const value=await data.text();
                    // console.log(error);
                    error.innerHTML = value;
			if(value!='Existed')
			{
				var eve="<?php echo $_SESSION['event_id'];?>";
                  		var eve="../Events?event_id="+eve;	
			}
			
                    
		}
	else {
                  error.innerHTML="Some database Error";
                }
          }
      }
    }
  </script>

</html>
