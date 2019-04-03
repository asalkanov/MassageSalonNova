<!DOCTYPE html>
<!--[if IE 8]>			<html class="ie ie8"> <![endif]-->
<!--[if IE 9]>			<html class="ie ie9"> <![endif]-->
<!--[if gt IE 9]><!-->	<html> <!--<![endif]-->
	<head>
		<meta charset="utf-8" />
		<title>Kontakt</title>
		<meta name="keywords" content="" />
		<meta name="description" content="" />
		<meta name="" content="" />

		<!-- postavke za smartphone -->
		<meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />

		<!-- font -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700,800|Dosis:300,400" rel="stylesheet" type="text/css" />

		<!-- css -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
		<link href="assets/plugins/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<link href="assets/plugins/font-awesome.css" rel="stylesheet" type="text/css" />
		<link href="assets/plugins/owl.carousel.css" rel="stylesheet" type="text/css" />
		<link href="assets/plugins/owl.theme.css" rel="stylesheet" type="text/css" />
		<link href="assets/plugins/owl.transitions.css" rel="stylesheet" type="text/css" />
		<link href="assets/plugins/magnific-popup.css" rel="stylesheet" type="text/css" />

		<!-- tema -->
		<link href="assets/css/layout.css" rel="stylesheet" type="text/css" />

		<!-- Morenizr -->
		<script type="text/javascript" src="assets/plugins/modernizr.min.js"></script>


	<style>
      /* velicina Google mape */
      #map {
        height: 40%;
      }
      
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>

	</head>
	<body>



		<!-- navigacijska traka s izbornicima -->
<header id="header">
			<nav class="navbar navbar-inverse" role="navigation">
				<div class="container">

					<!-- meni za mobilne uredaje -->
					<button id="mobileMenu" class="fa fa-bars" type="button" data-toggle="collapse" data-target=".navbar-collapse"></button>

					<!-- logo stranice, link -->
					<div class="navbar-header">
						<a class="navbar-brand" href="index.php">
							<img src="logo.png" alt="" height="40" /> 
						</a>
					</div>

					<!-- toogle navbar-a -->
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

						<ul class="nav navbar-nav navbar-right">
							<li><a href="index.php">Naslovna</a></li>
							<li><a href="onama.php">O nama</a></li>
							<li><a href="usluge.php">Naše usluge</a></li>
							<li><a href="rezervacija.php">Rezervacija</a></li>
							<li  class="active"><a href="kontakt.php">Kontakt</a></li>
						</ul>

		</div><!-- /.navbar-collapse -->
	</div>
</nav>
</header>


	

    <script>
      var customLabel = {
        restaurant: {
          label: 'R'
        },
        bar: {
          label: 'B'
        },
        salon: {
        	label: 'N'
        }
      };

        function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: new google.maps.LatLng(45.790472, 15.944911),
          zoom: 12
        });
        var infoWindow = new google.maps.InfoWindow;

          // marker s lokacijama na mapi
          downloadUrl('mapmarker.xml', function(data) {
            var xml = data.responseXML;
            var markers = xml.documentElement.getElementsByTagName('marker');
            Array.prototype.forEach.call(markers, function(markerElem) {
              var id = markerElem.getAttribute('id');
              var name = markerElem.getAttribute('name');
              var address = markerElem.getAttribute('address');
              var type = markerElem.getAttribute('type');
              var point = new google.maps.LatLng(
                  parseFloat(markerElem.getAttribute('lat')),
                  parseFloat(markerElem.getAttribute('lng')));

              var infowincontent = document.createElement('div');
              var strong = document.createElement('strong');
              strong.textContent = name
              infowincontent.appendChild(strong);
              infowincontent.appendChild(document.createElement('br'));

              var text = document.createElement('text');
              text.textContent = address
              infowincontent.appendChild(text);
              var icon = customLabel[type] || {};
              var marker = new google.maps.Marker({
                map: map,
                position: point,
                label: icon.label
              });
              marker.addListener('click', function() {
                infoWindow.setContent(infowincontent);
                infoWindow.open(map, marker);
              });
            });
          });
        }



      function downloadUrl(url, callback) {
        var request = window.ActiveXObject ?
            new ActiveXObject('Microsoft.XMLHTTP') :
            new XMLHttpRequest;

        request.onreadystatechange = function() {
          if (request.readyState == 4) {
            request.onreadystatechange = doNothing;
            callback(request, request.status);
          }
        };

        request.open('GET', url, true);
        request.send(null);
      }

      function doNothing() {}
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=INSERT_API_KEY_HERE&callback=initMap">
    </script>


		<!-- sadrzaj stranice -->
		<section id="middle" class="container">
			<header>
				<h1 class="text-center"><strong>Kontakirajte nas!</strong></h1>
				<p class="lead text-center">Ostavite Vaše podatke te nas kontaktirajte kako biste se dodatno informirali o našim proizvodima i uslugama.</p>
				<p></p>
			</header>
				<a name="vrh"></a>


			<div class="divider"><!-- divider --></div>


			<div class="row">

				<!--stupac kontakt -->
				<div class="col-md-5">
					<h3>Kontakt</h3>

					<!-- kontakt forma -->
					<form id="contactForm" action="kontakt.php" method="post" class="block form-inline">
						<div class="row">
							<div class="col-md-12"><input name="ime" required="" class="form-control fullwidth" type="text" id="name" value="" placeholder="Ime i prezime *" title="Name"></div>
							<div class="col-md-12"><input name="mejl" required="" class="form-control fullwidth" type="email" id="email" value="" placeholder="Email adresa *" title="Email"></div>
							<div class="col-md-12"><input class="form-control fullwidth" type="text" name="contact_subject" id="contact_subject" value="" placeholder="Naslov" title="Subject"></div>
						</div>

						<div class="row">
							<div class="col-md-12"><textarea name="poruka" required="" class="form-control fullwidth" rows="5" id="message" placeholder="Sadržaj poruke *"></textarea></div>
							<div class="col-md-12">

								<div style="visibility: hidden;" id="sent_ok" class="alert alert-success fsize14 hide">
									<i class="fa fa-check"></i> 
									<strong>Zahvaljujemo!</strong> Vaša je poruka uspješno poslana!
								</div>

								
								
								<!-- Modal za usjesno poslan mail -->
						  <div class="modal fade" id="myModal" role="dialog">
						    <div class="modal-dialog">
						    
						      <!-- sadrzaj modala -->
						      <div class="modal-content">
						        <div class="modal-header">
						          <button type="button" class="close" data-dismiss="modal">&times;</button>
						          <h4 class="modal-title">Poruka poslana!</h4>
						        </div>
						        <div class="modal-body">
						          <p>Vaša je poruka uspješno zaprimljena.</p>
						        </div>
						      </div>
						      
						    </div>
						  </div>

								<input type="hidden" name="captcha" id="captcha" value="">
								<!-- <button type="button" id="contact_submit" class="btn btn-primary">Pošalji poruku</button> -->
								<input type="submit" class="btn btn-primary" name="send" value="Pošalji poruku">
							</div>
						</div>
					</form>
					<!-- /kontakt forma -->

				</div>
				<!-- /kontakt stupac -->


				<!-- lokacija stupac -->
				<div class="col-md-3">
					<h3>Lokacija</h3>

					<!-- lokacija -->
					<address>
						<ul class="list-unstyled fsize15">
							<li class="address-sprite address">
								
								Ilirska ulica 29<br />
								10 000 Zagreb<br />
								Republika Hrvatska<br />
								<a href="#dno" class="btn btn-primary btn-xs" role="button">Pogledaj lokaciju</a>
							</li>
							<li class="address-sprite phone">
								Telefon: 098 3218 432
							</li>
							<li class="address-sprite email">
								salonnova@gmail.com
							</li>
						</ul>
					</address>
					<!-- /lokacija -->

				</div>
				<!-- /lokacija stupac -->


				<!-- stupac informacije -->
				<div class="col-md-4">
					<h3>Informacije</h3>

					<!-- infomracije -->
					<p>
						Naš salon je otvoren već niz godina; U svom radu nudi niz usluga i tretmana za njegu lica i tijela. 
					</p>

					<p>
						Usluga je individualna za svakog klijenta i prilagođena njegovim potrebama. Kombinacijom beauty i relaksacijskih tretmana zadovoljit ćemo Vaše potrebe kroz brojne masaže lica i tijela.
					</p>
					<p>
					Naši tretmani su namjenjeni za sve one koji žele najbolje za sebe i druge. Poklonite tretman sebi i prijateljima, poslovnim partnerima, naručite masažu kao poklon za rođendan ili neku drugu prigodu. Očekujemo Vas!
					</p>
					<!-- /informaicje -->

				</div>
				<!-- /stupac informacije -->



			</div>


		
		</section>
		<!-- /sadrzaj sredine ekana -->


<div id="map"></div>
<a name="dno"></a>

<!-- <div style="margin-bottom: 50px"></div> -->


		<!-- footer -->
		<footer>


		<!-- scroll -->
		<a href="#toTop" class="fa fa-arrow-up toTop"></a>

		<div class="container">

			<div class="row">

				<div class="col-md-6 copyright">
					Salon masaže Nova<br />
					2017. &copy; 
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
	<!-- /footer -->


		<!-- javascript datoteke -->
		<script type="text/javascript" src="assets/plugins/jquery-2.0.3.min.js"></script>
		<script type="text/javascript" src="assets/plugins/bootstrap.min.js"></script>
		<script type="text/javascript" src="assets/plugins/jquery.magnific-popup.min.js"></script>
		<script type="text/javascript" src="assets/plugins/owl.carousel.min.js"></script>
		<script type="text/javascript" src="assets/plugins/jquery.cycle.all.min.js"></script>
		<script type="text/javascript" src="assets/plugins/jquery.maximage.min.js"></script>

		<script type="text/javascript" src="assets/plugins/scripts.js"></script>

	
	</body>

</html>


<?php

error_reporting(-1);
ini_set('display_errors', 'On');

// provjera jesu li uneseni svi podatci
if(empty($_POST['ime'])  		||
   empty($_POST['mejl']) 		||
   empty($_POST['poruka']))	
   // || !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
   {
	//echo "Podaci nisu uneseni!";
	?>
	<!-- <script type="text/javascript">document.getElementById('sent_ok').style.visibility = 'hidden';</script> -->
	<?php
	return false;
   }

else {
?>
<!-- <script type="text/javascript">document.getElementById('uspjesnoPoslano').style.visibility = 'visible';
</script> -->

<?php

echo ("<script language='javascript'>
        $( document ).ready(function() {
          $('#myModal').modal('show');
        });
        </script>");

$name = $_POST['ime'];
$email_address = $_POST['mejl'];
$message = $_POST['poruka'];
	
// stvaranje i slanje maila	
$to = 'example@gmail.com'; // email na koji se salju svi mailovi
$email_subject = "Nova poruka od:  $name";
$email_body = "Ime i prezime: $name \n".
			  "Email: $email_address \n" . 
			  "Poruka: \n$message";
$headers = "From: " . $email_address . "\r\n";
$headers .= "Reply-To: " . $email_address . "\r\n";
$headers .= "Return-Path: " . $email_address . "\r\n";
$headers .= "CC: sombodyelse@example.com\r\n";
$headers .= "BCC: hidden@example.com\r\n";
mail($to,$email_subject,$email_body,$headers);
echo "<meta http-equiv='refresh' content='2;url=kontakt.php'>";
return true;			
}
?>
