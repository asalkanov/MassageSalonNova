<?php
session_start();
header("Content-Type: text/html; charset=UTF-8");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Rezervacija</title>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <!-- jQuery i Moment.js potrebni za Date/Time picker -->
   <link rel="stylesheet" type="text/css" media="screen" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <link href="prettify-1.0.css" rel="stylesheet">
        <link href="base.css" rel="stylesheet">
        <link href="https://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
        <!-- WEB FONTS -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700,800|Dosis:300,400" rel="stylesheet" type="text/css" />
	
		<!-- THEME CSS -->
		<link href="layout.css" rel="stylesheet" type="text/css" />

        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
       
            <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
            <script src="https://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js"></script>

      <!-- font na web stranici -->
      <style type="text/css">
		body {
			color:#666;
			background-color:#fff;

			font-family:'Open Sans', sans-serif;
			font-size:17px;  line-height:1.5;
			font-style:normal;
			font-weight:300;
		}
		.uzmiFont {
			font-family:'Open Sans', sans-serif;
			font-size:17px;  line-height: 1.5;
			font-style:normal;
			font-weight:300;
			margin: 0 auto;
			padding-bottom: 10px;
		}
		.popraviSelectDropdown {
			overflow: hidden;
			float: left;
		     height: auto;
		     position: relative;
		     top: 0;
		}
		.center-block {
		  display: block;
		  margin-left: auto;
		  margin-right: auto;
		}
      </style>

<!-- Spajanje na bazu podataka -->
<?php
    $servername = "localhost";
    $username = "DB_USERNAME";
    $password = "DB_PASSWORD";
    $dbname = "DB_NAME";

    // Stvaranje veze s bazom podataka
    $veza = new mysqli($servername, $username, $password, $dbname);
    // Provjera je li veza uspjesna
    if ($veza->connect_error) {
        die("Pogreska spajanja na bazu: " . $veza->connect_error);
    } 
   mysqli_set_charset($veza,"utf8");
?>
    </head>
</head>
<body>


<!-- navigacijska traka s izbornicima -->
<header id="header">
			<nav class="navbar navbar-inverse" role="navigation"><!-- add "white" class for white nav bar -->
				<div class="container">

					<!-- Mobile Menu Button -->
					<button id="mobileMenu" class="fa fa-bars" type="button" data-toggle="collapse" data-target=".navbar-collapse"></button>

					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header">
						<a class="navbar-brand" href="index.php">
							<img src="logo.png" alt="" height="40" /> 
						</a>
					</div>

					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

						<ul class="nav navbar-nav navbar-right">
							<li><a href="index.php">Naslovna</a></li>
							<li><a href="onama.php">O nama</a></li>
							<li><a href="usluge.php">Naše usluge</a></li>
							<li class="active"><a href="rezervacija.php">Rezervacija</a></li>
							<li><a href="kontakt.php">Kontakt</a></li>
						</ul>

		</div><!-- /.navbar-collapse -->
	</div>
</nav>
</header>


<header>
<section id="middle" class="container">
	<a name="vrhStranice"></a>
	<h1 class="uppercase text-center">Rezervacija termina</h1>
	<span class="lead">Na ovoj stranici možete rezervirati termin za ponuđene usluge. Ukoliko je termin zauzet, pojavit će se tablica s listom već rezerviranih termina. Svi termini koji se ne nalaze u tablici su slobodni. Trajanje pojedinih usluga izraženo je u minutama.</span>
	<div class="divider"><!-- linije u sredini ekarana, divideri --></div>
</section>
</header>


 <form action="" method="GET">
    <div class="container">
        <div class="row">
            <div class='col-xs-4'>
            Odaberite termin:
                <div class="form-group">
                    <div class='input-group date' id='datetimepicker2'>
                   
                        <!-- input u kojem se pojave datum i vrijeme nakon odabira korisnika -->
                        <input type='text' name="datumVrijeme" class="form-control" />
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
            </div>
            <script type="text/javascript">
                $(function () {
                    $('#datetimepicker2').datetimepicker({
                        locale: 'hr',
                        showClose: true,
                        stepping: 5,
                        sideBySide: false,
                        useCurrent: true,
                        enabledHours: [9, 10, 11, 12, 13, 14, 15, 16],
                        icons: {
                            close: "glyphicon glyphicon-ok"
                        }
                    });
                });
            </script>
      

	    <div class='col-xs-4'>
	     Odaberite vrstu usluge:
	        <?php
	        // ispis svih usluga iz baze u dropdown menu (select)
	            $upit = "SELECT * FROM usluge";
	            $rezultat = $veza->query($upit);

	            if ($rezultat->num_rows > 0) {
	                // izlazni podatci svakog retka u tablici Usluge
	                echo "<select class='form-control uzmiFont' name='usluge'>";
	                while($redak = $rezultat->fetch_assoc()) {
	                    // option value='idUsluge' jer trebamo znati koju je tocno uslugu korisnik izabrao iz dropdown izbornika.
	                    echo "<option class='uzmiFont' value='" . $redak['idUsluge'] . "'>" . $redak['naziv'] . " - " . $redak['trajanje'] . " minuta" . "</option>";
	                }
	                echo "</select>";
	            } else {
	                echo "Trenutno nema ponuđenih usluga.";
	            }
	        ?>
	    </div>
</div>


<div class='col-xs-4'>
	<div class='row'>
		<div class="form-group">
		  Ime:
		  <input type="text" class="form-control" placeholder="potrebno *" required="true" oninput="setCustomValidity('')"  oninvalid="this.setCustomValidity('Molimo unesite Vaše ime.')" id="ime" name="ime" value="<?php if (isset($_REQUEST['ime'])) echo $_REQUEST['ime'];?>">
		</div>
		<div class="form-group">
		  Prezime:
		  <input type="text" class="form-control" placeholder="potrebno *" required="true" oninput="setCustomValidity('')"  oninvalid="this.setCustomValidity('Molimo unesite Vaše prezime.')" id="prezime" name="prezime" value="<?php if (isset($_REQUEST['prezime'])) echo $_REQUEST['prezime'];?>">
		</div>
		<div class="form-group">
		  Kontakt:
		  <input placeholder="broj mobitela ili e-mail (potrebno *)" required="true" oninput="setCustomValidity('')"  oninvalid="this.setCustomValidity('Molimo unesite Vaše kontakt informacije.')" class="form-control" id="kontakt" name="kontakt" value="<?php if (isset($_REQUEST['kontakt'])) echo $_REQUEST['kontakt'];?>">
		</div>
		<br/>
		<!-- vratiti u col-xs-3 -->
		<div class='col-xs-6'>
		    <div class ="row">
		            <input class='btn btn-info btn-rounded' type="submit" onclick="location.href='#dnoStranice';" name="rezerviraj" value="Rezerviraj termin">
		    </div>
		</div>
		<div class='col-xs-6'>
		    <div class ="row">
		            <input class='btn btn-warning btn-rounded hidden' type="submit" onclick="location.href='pregled.php';" name="rezerviraj" value="Izmjena termina (nadopuniti)">
		    </div>
		</div>
	</div>
</div>


    <br/>
    <br/>   
    <br/>
 

</div>

</div>

</form>

<br/>   
<br/>


<div class="container">

<?php
    if ( (isset($_REQUEST["datumVrijeme"]) and $_REQUEST["datumVrijeme"]!="") and (isset($_REQUEST["usluge"]) and $_REQUEST["usluge"]!="" ) ) {
        // Razdvoji dobiveni termin na datum i vrijeme, spremanje u bazu
        $datumVrijeme = $_REQUEST["datumVrijeme"];

        // trajanje ovisi o vrsti usluge koju koirsnik odabere
        $tempIDtrajanje = $_REQUEST['usluge'];
        $upitTrajanjaUsluge = "SELECT trajanje FROM usluge WHERE '$tempIDtrajanje' = idUsluge";
        $rez = $veza->query($upitTrajanjaUsluge);
         while ($redak = mysqli_fetch_array($rez)) {
        	$trajanjeUsluge = $redak['trajanje'];
        }


        date_default_timezone_set('Europe/Zagreb');
        $trenutnoVrijemeDatum = date('Y-m-d', time());
        $trenutnoVrijeme = date('H:i', time());
        //echo $trenutnoVrijemeDatum;
        //echo "vr" . $trenutnoVrijemeDatum;

        
        
        echo "Odabrani termin: " . $datumVrijeme . ", trajanje: " . $trajanjeUsluge . " minuta." . "<br/>";

        
        list($dan, $mjesec, $godina, $pocetakTerminaVrijeme) = explode(' ', $datumVrijeme);
        $pocetakTerminaDatum = $godina . "-" . $mjesec . "-" . $dan;
        $pocetakTerminaDatum = str_replace(".", "", $pocetakTerminaDatum);
     
        //echo "poec" . $pocetakTerminaDatum;

  
        $datumVrijemeNoSpace =  $godina . "-" . $mjesec . "-" . $dan 
        . " " . $pocetakTerminaVrijeme;
        $datumVrijemeNoSpace = str_replace(".", "", $datumVrijemeNoSpace);
       
          $krajTerminaDatum = new DateTime($datumVrijemeNoSpace);
          $krajTerminaDatum->add(new DateInterval('PT' . $trajanjeUsluge . 'M'));

          $krajTerminaVrijeme = $krajTerminaDatum->format('H:i');
          $krajTerminaDatum = $krajTerminaDatum->format('Y-m-d');

          //echo "krajTer " . $krajTerminaDatum . "trnVrij" . $trenutnoVrijemeDatum;
        // provjera ukoliko je odabran datum jucer, prekjucer, prekprejucer,...
          $vrijemeProsloIstiDatum = 0;
          $vrijemeProslo = 0;

        if ($krajTerminaDatum < $trenutnoVrijemeDatum) {
                $vrijemeProsloIstiDatum = 1;
        } else {
                $vrijemeProsloIstiDatum = 0;
        }

        if ($krajTerminaDatum == $trenutnoVrijemeDatum) {
              //echo $pocetakTerminaVrijeme . "........." . time();
             if (strtotime($pocetakTerminaVrijeme) < strtotime($trenutnoVrijeme)) {
                 $vrijemeProslo = 1;
             }
        } else {
                $vrijemeProslo = 0;
        }


        $sviPodaciUneseni = 0;
        // provjera jesu li uneseni svi potrebni podaci (ime, prezime, kontakt)
        if ( (isset($_REQUEST["ime"]) and $_REQUEST["ime"]!="") and (isset($_REQUEST["prezime"]) and $_REQUEST["prezime"]!="") ) {
        	$unesenoIme = $_REQUEST["ime"];
        	$unesenoPrezime = $_REQUEST["prezime"];
        	$sviPodaciUneseni = 1;
        }

        if ( (isset($_REQUEST["kontakt"]) and $_REQUEST["kontakt"]!="")  ) {
       		 $uneseniKontakt = $_REQUEST["kontakt"];
       	} else {
       		$uneseniKontakt = "";
       	}


          $pocetakRadnogVremena = "09:00:00";
          $krajRadnogVremena = "17:00:00";


            // provjera ukoliko vec postoji termin u bazi, prikazi poruku da se termin ne moze rezervirati...
            $upitPreklapanja = "SELECT *
                                FROM rezervacija
                                WHERE
                                pocetakTerminaDatum = '$pocetakTerminaDatum' AND
                                (
                                   TIME('$pocetakTerminaVrijeme') BETWEEN pocetakTerminaVrijeme and krajTerminaVrijeme
                                   OR
                                   TIME('$krajTerminaVrijeme') BETWEEN pocetakTerminaVrijeme and krajTerminaVrijeme
                                ); ";
                          	

         $rez = $veza->query($upitPreklapanja);
         //ako je veci od 0, znaci da taj termin vec postoji
         if ($rez->num_rows > 0) {
           
            // upit za ispis svih preklapanja u izabranom datumu
            $upitSvihPreklapanja = "SELECT * FROM rezervacija WHERE pocetakTerminaDatum = '$pocetakTerminaDatum' ORDER BY pocetakTerminaVrijeme";

            $rezSve = $veza->query($upitSvihPreklapanja);
    

               if ($vrijemeProslo != 1 and $vrijemeProsloIstiDatum != 1) {
                    echo "Termin NIJE slobodan, molimo izaberite drugo vrijeme!<br/><br/>";
               } else {
                    echo "Izabrano vrijeme termina ne moze biti u proslosti!<br/>";
               }

               if ($vrijemeProslo != 1 and $vrijemeProsloIstiDatum != 1) {
                   echo "Lista zauzetih termina za datum: " . $pocetakTerminaDatum . "<br/>";
                   echo "<div class='table-responsive col-md-3'>";
                   echo "<table class='table'>";
                   // printing table rows
                   while ($redak = mysqli_fetch_array($rezSve)) {
                
                        echo "<tr class='danger'>";

                        echo "<td>$redak[2]</td>";
                        echo "<td>$redak[5]</td>";

                        echo "</tr>\n";
                    }
                    echo "</table>";
                    echo "</div>";   
                }
	        
               
          } else {
                // spremanje odabranog termina rezervaije u bazu ukoliko je slobodan i vrijeme nije u proslosti.
                if ($krajTerminaVrijeme < $krajRadnogVremena and $vrijemeProslo != 1 and $vrijemeProsloIstiDatum != 1 and $sviPodaciUneseni == 1) {
	                	$ajdiUsluge = $_REQUEST['usluge'];
	                	// ako je bilo izmjene podataka za rezervaciju
	                	 /*if (isset($_GET['poslanoUpdate'])) {
	                	 	$ime = $_GET['ime']; $prezime = $_GET['prezime']; $kontakt = $_GET['kontakt'];
	                	 	$idRezervacije = $_GET['idRezervacije'];
	                	 	$izmjeniDatum = "UPDATE rezervacija SET pocetakTerminaDatum='$pocetakTerminaDatum', pocetakTerminaVrijeme='$pocetakTerminaVrijeme', trajanje='$trajanjeUsluge', krajTerminaDatum='$krajTerminaDatum', krajTerminaVrijeme='$krajTerminaVrijeme', ime='$ime', prezime='$prezime', kontakt='$kontakt', idUsluge='$ajdiUsluge' WHERE idRezervacija='$idRezervacije'";
	                	 	$veza->query($izmjeniDatum);
	                        echo "Termin je dostupan, rezervacija uspjesno izmjenjena!";
	                	}*/
	                		if (isset($_GET['poslanoUpdate'])) {
	                			$idRezervacije = $_GET['idRezervacije'];
	                			$izbrisi = "DELETE FROM rezervacija WHERE idRezervacija='$idRezervacije'";
	                			$veza->query($izbrisi);
	                		}


	                	 	$spremiDatum = "INSERT INTO rezervacija (pocetakTerminaDatum, pocetakTerminaVrijeme, trajanje, krajTerminaDatum, krajTerminaVrijeme, ime, prezime, kontakt, idUsluge) VALUES ('$pocetakTerminaDatum', '$pocetakTerminaVrijeme', '$trajanjeUsluge', '$krajTerminaDatum', '$krajTerminaVrijeme', '$unesenoIme', '$unesenoPrezime', '$uneseniKontakt', '$ajdiUsluge')";
	                     echo "Termin je dostupan, rezervacija uspjesna!";
	                     if ($veza->query($spremiDatum) === TRUE) {
	                        //echo "Rezervacija uspjesno zaprimljena!";
	                        // session potreban za spremanje datuma i prikaz na sljedecoj stranici o uspjesnoj rezervaciji
	                        $_SESSION["pocetakTerminaDatum"] = $pocetakTerminaDatum;
	                        $_SESSION["pocetakTerminaVrijeme"]= $pocetakTerminaVrijeme;
	                        // ne radi!  header("Location: uspjesnaRezervacija.php");
	                        echo "<meta http-equiv='refresh' content='0;url=uspjesnaRezervacija.php'>";
	                        exit();
	                    } else {
	                        echo "Pogreska rezervacije: " . $spremiDatum . "<br>" . $veza->error;
	                    }
	                	 
	                     
                } else {
	                    if ($vrijemeProslo == 1 or $vrijemeProsloIstiDatum == 1) {
	                        echo "Izabrano vrijeme termina ne moze biti u proslosti!";
	                    } else {
	                    	echo "Odabrani termin prelazi radno vrijeme!";
	                    }
                }
        
    }
}
?>
</div>
<a name="dnoStranice"></a>
<a name="dnoStranice"></a>
<!-- JAVASCRIPT FILES -->
    <script type="text/javascript" src="assets/plugins/scripts.js"></script>
</body>

</br>
</br>


<!-- FOOTER -->
		<footer>


			<!-- SCROOL TO TOP -->
			<a href="#toTop" class="fa fa-arrow-up toTop"></a>

			<div class="container">

				<div class="row">

					<div class="col-md-6 copyright">
						Salon masaže Nova<br />
						2017 &copy;
					</div>

					<div class="col-md-6 text-right">
						<a href="#" class="social fa fa-facebook"></a>
						<a href="#" class="social fa fa-twitter"></a>
						<a href="#" class="social fa fa-google-plus"></a>
						<a href="#" class="social fa fa-linkedin"></a>
					</div>

				</div>

			</div>
		</footer>
		<!-- /FOOTER -->


</html>