<nav class="navbar navbar-expand-sm navbar-light bg-light custom-nav">
	<div class="container">
		<?php
					if (isset($_SESSION['username'])) {
						echo "<a href='../' class='navbar-brand'>Instruo</a>";
					} else {
						echo "<a href='.' class='navbar-brand'>Instruo</a>";
					}
		 ?>
		<!-- <a href="." class="navbar-brand">Instruo</a> -->
		<button type="button" class="navbar-toggler" data-target="#mynav" data-toggle="collapse">
			<span class="navbar-toggler-icon"></span>

		</button><!-- button -->
		<div class="collapse navbar-collapse" id="mynav">

			 <ul class="navbar-nav ml-auto">
			 	<li class="nav-item" style="margin-right: 10px">

				<?php
					if (isset($_SESSION['username'])) {
						echo "<a href='#' class='nav-link btn-success logout-btn'>".$_SESSION['username']."</a>";
					}
				 ?>
			 	</li>
			 	<li class="nav-item">

				<?php
					if (isset($_SESSION['username'])) {
						echo "<a href='../profile/logout.php' class='nav-link btn-success logout-btn' style='float:left'>Logout</a>";
					}
				 ?>
			 	</li>

			 </ul>
		</div><!-- collapse -->
	</div><!-- container -->
</nav><!-- nav close -->
