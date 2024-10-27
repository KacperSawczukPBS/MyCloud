<?php declare(strict_types=1); 
 include 'scripts/session_check.php';	 /* Ta linia musi być pierwsza */ ?>
<header>
<div class="container">
<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top mt-0 mb-0 ms-0 me-0 pt-0 pb-0 ps-0 pe-0">
	<div class="container-fluid">
		<div class="collapse navbar-collapse" id="main_nav">
			<?php
				$user_avatar = $_SESSION['user_avatar'];
				echo "<form method=\"post\" action=\"index.php\">
				<button class=\"btn\"><img src=\"$user_avatar\" height=\"18\">Strona główna</button>
				</form>";
			?>
			<ul class="navbar-nav">
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Polecenia 1.x</a>
					<ul class="dropdown-menu">
						<li><a class="dropdown-item" href="polecenie1_1.php"> <img src="media/menu_icons/info.svg" height="18"> Wyświetlenie wizyt</a></li>
						<li><a class="dropdown-item" href="polecenie1_2.php"> <img src="media/menu_icons/help.svg" height="18"> Sprawdzenie pojedynczego hosta </a></li>
					</ul>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Monitoring hostów</a>
					<ul class="dropdown-menu">
						<li><a class="dropdown-item" href="monitoring.php">Monitoring</a></li>
						<li><a class="dropdown-item" href="add_host_form.php">Dodaj hosta</a></li>
						<li><a class="dropdown-item" href="remove_host_form.php">Usuń hosta</a></li>
					</ul>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Polecenia 3.x</a>
					<ul class="dropdown-menu">
						<li><a class="dropdown-item" href="polecenie3_1.php"> Polecenie 3.1 </a></li>
						<li><a class="dropdown-item" href="polecenie3_2.php"> Polecenie 3.2 </a></li>
						<li><a class="dropdown-item" href="polecenie3_3.php"> Polecenie 3.3 </a></li>
					</ul>
				</li>
			</ul> 

			<form method="post" action="logout.php">
			<button class="btn"><img src="media/menu_icons/box-arrow-right.svg" height="18"> Wyloguj</button>
			</form>
		</div> 
		
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main_nav"  aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		
	</div> 
</nav>		
		
</div>
</header>