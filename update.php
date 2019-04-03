<!DOCTYPE html>

<?php

ini_set('display_errors', 1);

    $servername = "localhost";
 
    $username = "DB_USERNAME";
    $password = "DB_PASSWORD";
    $dbname = "DB_NAME";

    // Stvaranje veze s bazom podataka
    $veza = new mysqli($servername, $username, $password, $dbname);
    // Provjera je li veza uspjesna
    if ($veza->connect_error) {
        die("Pogreska spajanja na bazu: " . $conn->connect_error);
    } 
?>

<html>
    <head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
        <title> Unos </title>
        
      <nav class="navbar navbar-inverse">
        <div class="container-fluid">
          <div class="navbar-header">
            <a class="navbar-brand" href="index.php">Rezervacije</a>
          </div>
          <ul class="nav navbar-nav">
            <li class="active"><a href="">Izmjena podataka</a></li>
            <li><a href="pregled.php">Pregled rezervacija</a></li>
			<li><a href=""></a><li>
			<li><a href=""></a><li>
			<li><a href=""></a></li>
			<li><a href=""></a></li>
            <li><a href=""></a></li>
          </ul>
          <form class="navbar-form navbar-left" action="" method="GET">
              <div class="form-group">
               <input type="text" name="searching" class="form-control" placeholder="Pretraga">
              </div> 
             <input type="submit" value="Pretrazi" class="btn btn-default">
             <!--<a class="btn btn-default" type="submit" href="find_student.php">Search</a>
             -->
            </form>
            </div>
      </nav>

        <!-- Bootstrap -->
      <link href = "//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel = "stylesheet">
      

       <style>
            table,tr,th,td
            {
                border: 1px solid black;
            }
        </style>

       

    </head>
    <body>

    <?php

        $errorMsg = 0;

    ?>

    <div class="container pull-left">
       <div class="row">
          <div class="col-lg-6">

        <form class="well" action ="update.php" method="GET">
                
        <?php
          if (isset($_GET['radioUpdate'])) {

             $idRezervacije = $_GET['radioUpdate'];
             $query = "SELECT * FROM rezervacija JOIN usluge WHERE idRezervacija = '$idRezervacije';";
             $result = $veza->query($query);
             $cijeliArray = mysqli_fetch_array($result);
        
             $datum = $cijeliArray['pocetakTerminaDatum']; 
             $datumFormat = date("d. m. Y", strtotime($datum));
             echo $datumFormat;
             $pocetak = $cijeliArray['pocetakTerminaVrijeme']; 
             $kraj = $cijeliArray['krajTerminaVrijeme'];
             $naziv = $cijeliArray['naziv'];
             $ime = $cijeliArray['ime'];                   
             $prezime = $cijeliArray['prezime'];
             $kontakt = $cijeliArray['kontakt'];
             
             $sql1 = "SELECT idUsluge FROM rezervacija WHERE idRezervacija = '$idRezervacije'";
             $result1 = $veza->query($sql1);
              while ($row1 = mysqli_fetch_array($result1)) {
                    $ajdiUsluge = $row1['idUsluge'];
              }

           } 

        ?>

         <?php
            if ( isset( $_GET['update']) && !empty( $_GET['update']) and isset( $_GET['pocetak']) && !empty( $_GET['pocetak']) and isset( $_GET['datum']) && !empty( $_GET['datum']) and isset( $_GET['idUslugeDropdown']) && !empty( $_GET['idUslugeDropdown']) and isset( $_GET['ime']) && !empty( $_GET['ime']) and isset( $_GET['prezime']) && !empty( $_GET['prezime']) and isset( $_GET['kontakt']) && !empty( $_GET['kontakt']) ) {
              $errorMsg = 0;
              $vrijeme = $_GET["pocetak"];
              $vrijeme = new DateTime($vrijeme);
              $vrijeme = $vrijeme->format('H:i');
              
              $url = "rezervacija.php?idRezervacije=" . $_GET['idRezervacije'] . "&datumVrijeme=" . $_GET['datum'] . " " . $vrijeme . "&usluge=" . $_GET['idUslugeDropdown'] . "&ime=" . $_GET['ime'] . "&prezime=" . $_GET['prezime'] . "&kontakt=" . $_GET['kontakt'] . "&rezerviraj=Rezerviraj termin&poslanoUpdate=true";
              echo "<meta http-equiv=\"refresh\" content=\"0;URL=$url\">";
              echo $url;
             // header('Location: rezervacija.php');
            }
        ?>
          <?php
             if (isset($_GET['update'])) {
                $sql = "SELECT * FROM usluge ORDER BY idUsluge";
                $result = mysql_query($sql);
                 while ($row = mysql_fetch_array($result)) {
                    $naziv = $row['naziv'];
                 }
             }
          ?>

         <p class="h5">Izmjena podataka za rezervaciju: <?php  if (isset($_GET['radioUpdate'])) { echo "<b>"; echo $idRezervacije . " " . $naziv; echo "</b>";} else if (isset($_GET['update'])) { echo "<b>"; echo $_GET["idRezervacije"] . " " . $naziv; echo "</b>";}?> </p> 

         <?php
         if (isset($_GET['idRezervacije'])) {
            $idRezervacije = $_GET['idRezervacije'];
          }
          if (isset($_GET['datum'])) {
            $datum = $_GET['datum'];
            $datumFormat = date("d.m.Y", strtotime($datum));
          }
           if (isset($_GET['pocetak'])) {
            $pocetak = $_GET['pocetak'];
          }
           if (isset($_GET['kraj'])) {
            $kraj = $_GET['kraj'];
          }
           if (isset($_GET['naziv'])) {
            $naziv = $_GET['naziv'];
          }
           if (isset($_GET['ime'])) {
            $ime = $_GET['ime'];
          }
           if (isset($_GET['prezime'])) {
            $prezime = $_GET['prezime'];
          }
           if (isset($_GET['kontakt'])) {
            $kontakt = $_GET['kontakt'];
          }
          if (isset($_GET['idUsluge'])) {
            $idUsluge = $_GET['idUsluge'];
          }

        ?>      


            <table style="width: auto"; class="table table-bordered">
                <?php if(isset($_GET['idRezervacije'])) $idRezervacije = $_GET['idRezervacije'];?>
                <tr><th>ID</th><td><input class='form-control' id="idRezervacije" name="idRezervacije" readonly="true" value="<?php echo $idRezervacije;?>"></input></td></tr>
                <tr><th>Datum</th><td><input class='form-control' type="textbox" name="datum" value="<?php if (isset($_GET['radioUpdate']) or isset($_GET['datum'])) { echo $datumFormat;}?>"></td></tr>
                <tr><th>Pocetak</th><td><input class='form-control' type="textbox" name="pocetak" value="<?php if (isset($_GET['radioUpdate']) or isset($_GET['pocetak'])) { echo $pocetak;}?>"></td></tr>
                <tr><th>Usluge</th><td>
                   <?php 
                   $sql = "SELECT * FROM usluge ORDER BY idUsluge";
                   $result = $veza->query($sql);
                   echo "<select class='form-control' name='idUslugeDropdown'>";
                   while ($row = mysqli_fetch_array($result)) {
                          if ($row['idUsluge'] == $ajdiUsluge or $row['idUsluge'] == $_GET['usluge']) {
                          echo "<option selected = 'selected' value='" . $row['idUsluge'] . "'>" . $row['idUsluge'] . " - " . $row['naziv'] . " - " . $row['trajanje'] . " minuta" . "</option>";
                          } else {
                            echo "<option value='" . $row['idUsluge'] . "'>" . $row['idUsluge'] . " - " . $row['naziv'] . " - " . $row['trajanje'] . " minuta" . "</option>";
                          }
                            
                   }    
                    echo "</select>";?></td></tr>
                <tr><th>Ime</th><td><input class='form-control' type="textbox" name="ime" value="<?php if (isset($_GET['radioUpdate']) or isset($_GET['ime'])) { echo $ime;}?>"></td></tr>
                <tr><th>Prezime</th><td><input class='form-control' type="textbox" name="prezime" value="<?php if (isset($_GET['radioUpdate']) or isset($_GET['prezime'])) { echo $prezime;}?>"></td></tr>
                <tr><th>Kontakt</th><td><input class='form-control' type="textbox" name="kontakt" value="<?php if (isset($_GET['radioUpdate']) or isset($_GET['kontakt'])) { echo $kontakt;}?>"></td></tr>
            </table>

            <input class="btn btn-info" name="update" type="submit" id="update" value="Izmjeni">

        </form>

        </div>
      </div>
    </div>

    <?php
     
     if (!isset($_GET['radioUpdate'])) {
        if (empty($_GET['idRezervacije']) or empty($_GET['datum']) or empty($_GET['pocetak']) or empty($_GET['idUslugeDropdown']) or empty($_GET['ime']) or empty($_GET['prezime']) or empty($_GET['kontakt']) ) {
            $errorMsg = 0;
        $msg2='<div class="container pull-left">
                     <div class="row">
                        <div class="col-lg-5">
                      <div class="alert alert-danger col-md-5">Sva su polja obavezna!</div>
                   </div>
                  </div>
                   </div>';
                      echo $msg2;
        }
    }
    ?>

      <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src = "//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
            
    </body>
</html>