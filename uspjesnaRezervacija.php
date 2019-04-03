<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Uspjesna rezervacija</title>
	 <!-- WEB FONTS -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700,800|Dosis:300,400" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" type="text/css" media="screen" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <link href="prettify-1.0.css" rel="stylesheet">
        <link href="base.css" rel="stylesheet">

        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"></script>

        <style type="text/css">
			body {
				color:#666;
				background-color:#fff;

				font-family:'Open Sans', sans-serif;
				font-size:17px;  line-height:1.5;
				font-style:normal;
				font-weight:300;
			}
		</style>
</head>
<body>

<div class='container'>
	<?php
		if (isset($_SESSION["pocetakTerminaDatum"]) and isset($_SESSION["pocetakTerminaVrijeme"])) {
			$datum = $_SESSION["pocetakTerminaDatum"];
			#format oblika dan.mjesec.godina za prikaz na stranici
			$formatDMG = date("d-m-Y", strtotime($datum));
			$formatDMG = str_replace("-", ".", $formatDMG);
			echo "Uspjesno ste rezervirali termin za datum " . "<b>" .
			$formatDMG . "</b>" . " u " . "<b>" . $_SESSION["pocetakTerminaVrijeme"] . "</b>" . ".";
			// pobrisi sve session varijable do sada
			session_unset(); 
			// unisti sjednicu
			session_destroy(); 
		} else {
			 //header("Location: rezervacija.php");
			 echo("<script>location.href = 'rezervacija.php';</script>");

		}
	?>
</div>

<div class='container'>
     <a href='https://salon-masaze-nova.000webhostapp.com/'> <button onClick="location.href='rezervacija.php'" class='btn btn-default btn-rounded'>Povratak</button> </a>
</div>

</body>
</html>