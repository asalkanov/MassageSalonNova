  
// pocetne vrijednosti varijabli i pocetni query (koji uzima sve iz tablice)
$linkAscDescID = "desc";
$linkAscDescDatum= "desc";
$redoslijed = "SELECT idRezervacija, pocetakTerminaDatum, pocetakTerminaVrijeme, krajTerminaVrijeme, naziv, usluge.trajanje, ime, prezime, kontakt FROM rezervacija JOIN usluge WHERE rezervacija.idUsluge = usluge.idUsluge";
$result = izvrsiQuery($redoslijed);

// provjera asc/desc za ID 
if (isset($_GET['sortID'])) {
    $linkAscDescID= $_GET['sortID'];
    if(isset($linkAscDescID) and $linkAscDescID=="asc"){
        $linkAscDescID="desc";
    } else { 
        $linkAscDescID="asc";
    }
}

// provjera asc/desc za datum
if (isset($_GET['sortDatum'])) {
    $linkAscDescDatum= $_GET['sortDatum'];
    if(isset($linkAscDescDatum) and $linkAscDescDatum=="asc"){
        $linkAscDescDatum="desc";
    } else { 
        $linkAscDescDatum="asc";
    }
}


// sortiraj iz baze po ID-evima i posalji query u izvrsiQuery funkciju
if (isset($_GET['sortID'])) {

    switch ($_GET['sortID']) {
            
               case "asc":
                    $redoslijed = "SELECT idRezervacija, pocetakTerminaDatum, pocetakTerminaVrijeme, krajTerminaVrijeme, naziv, usluge.trajanje, ime, prezime, kontakt FROM rezervacija JOIN usluge WHERE rezervacija.idUsluge = usluge.idUsluge ORDER BY idRezervacija ASC";
                    break;
               case "desc":
                     $redoslijed = "SELECT idRezervacija, pocetakTerminaDatum, pocetakTerminaVrijeme, krajTerminaVrijeme, naziv, usluge.trajanje, ime, prezime, kontakt FROM rezervacija JOIN usluge WHERE rezervacija.idUsluge = usluge.idUsluge ORDER BY idRezervacija DESC";
                     break;
               default:
                    $redoslijed = "SELECT idRezervacija, pocetakTerminaDatum, pocetakTerminaVrijeme, krajTerminaVrijeme, naziv, usluge.trajanje, ime, prezime, kontakt FROM rezervacija JOIN usluge WHERE rezervacija.idUsluge = usluge.idUsluge ORDER BY idRezervacija ASC";
                    break;
    }

    $result = izvrsiQuery($redoslijed);
} 


// sortiraj iz baze po datumima 
if (isset($_GET['sortDatum'])) {

    switch ($_GET['sortDatum']) {
            
               case "asc":
                    $redoslijed = "SELECT idRezervacija, pocetakTerminaDatum, pocetakTerminaVrijeme, krajTerminaVrijeme, naziv, usluge.trajanje, ime, prezime, kontakt FROM rezervacija JOIN usluge WHERE rezervacija.idUsluge = usluge.idUsluge ORDER BY pocetakTerminaDatum ASC";
                    break;
               case "desc":
                     $redoslijed = "SELECT idRezervacija, pocetakTerminaDatum, pocetakTerminaVrijeme, krajTerminaVrijeme, naziv, usluge.trajanje, ime, prezime, kontakt FROM rezervacija JOIN usluge WHERE rezervacija.idUsluge = usluge.idUsluge ORDER BY pocetakTerminaDatum DESC";
                     break;
               default:
                    $redoslijed = "SELECT idRezervacija, pocetakTerminaDatum, pocetakTerminaVrijeme, krajTerminaVrijeme, naziv, usluge.trajanje, ime, prezime, kontakt FROM rezervacija JOIN usluge WHERE rezervacija.idUsluge = usluge.idUsluge ORDER BY pocetakTerminaDatum ASC";
                    break;
    }

    $result = izvrsiQuery($redoslijed);
} 



function izvrsiQuery($query)
{
    $conn = mysql_connect("localhost", "root", "5u2jCs39") 
    or die("Pogreska spajanja: " . mysql_error()); 

    mysql_select_db("salon");

    $result = mysql_query($query);
    return $result;
}



// ako je odabran update termina - posalji usera na update stranicu
if (isset($_GET['radioUpdate'])) {
    $idRezer = $_GET['radioUpdate'];
    echo "<meta http-equiv=\"refresh\" content=\"0;URL=update.php?radioUpdate=$idRezer\">";
} else {
    //echo "Odaberite termin za izmjenu podataka.";
}



//brisanje iz baze check-iranih redova u tablici rezervacija
$count=mysql_num_rows($result);
$successDel = false;
// provjera je li Delete button pretisnut, tj. poslan zahtjev za brisanjem
if (isset($_GET['delete']) and isset($_GET['checkboxDelete'])) {
      
      for($i=0;$i<$count;$i++){
         $del_id = $_GET['checkboxDelete'][$i];
         $sql = "DELETE FROM rezervacija WHERE idRezervacija = '$del_id'";
         $successDel = mysql_query($sql);
       }
  
    
    // ako je delete uspjesan, preusmjeri nazad na pregled.php 
    if($successDel){
       echo "<meta http-equiv=\"refresh\" content=\"0;URL=pregled.php\">";
    }
}

?>


<?php
    if (isset($_GET['update'])) {
        $idStudenta = $_GET['idStudenta'];
        $ime = $_GET['ime'];
        $prezime = $_GET['prezime'];
        $jmbag = $_GET['jmbag'];
        $godRod = $_GET['godRod'];
        $mob = $_GET['mob'];
        $email = $_GET['email'];
        $idTema = $_GET['idTemaDropDown'];
        if ($ime and $prezime and $jmbag and $idTema) {
            $sql = "UPDATE `student` SET ime='$ime', prezime='$prezime', JMBAG='$jmbag', godRod='$godRod', mob='$mob', email='$email', idTema='$idTema' WHERE student.idStudent='$idStudenta';";
            $resultUpdate = mysql_query($sql);
            if ($resultUpdate) {
                echo 'Podaci su uspjesno izmjenjeni!';
                echo "<meta http-equiv=\"refresh\" content=\"0;URL=sort_student.php\">";
            } else {
                echo "Neispravan unos podataka:" . mysql_error();
            }
        } else  {
            echo "<b>";
            echo "Obavezna polja: ime, prezime, jmbag i broj teme!";
            echo "</b>";
        }
    }
?>




<!DOCTYPE html>
<html>
    <head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
        <title> Sort/edit/delete</title>

      <!-- Bootstrap -->
      <link href = "//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel = "stylesheet">
       

       <style>
            table,tr,th,td
            {
                border: 1px solid black;
            }
        </style>

       <nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="home.php">Rezervacije</a>
        </div>
        <ul class="nav navbar-nav">
          <li class="active"><a href="sort_student.php">Pregled rezervacija</a></li>
      <li><a href="table_mentor.php">Pregled mentora</a></li>
         <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="unos_raspored.php">Unos
            <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="unos_student.php">Unos studenata</a></li>
              <li><a href="unos_mentor.php">Unos mentora</a></li>
              <li><a href="unos_tema.php">Unos tema</a></li>
              <li><a href="unos_raspored.php">Unos rasporeda</a></li>
            </ul>
        </li>
          <li><a href="find_student.php">Pretraga studenata</a></li>
        </ul>
        <form class="navbar-form navbar-left" action="find_student.php" method="GET">
            <div class="form-group">
             <input type="text" name="searching" class="form-control" placeholder="Search">
            </div> 
           <input type="submit" value="Search" class="btn btn-default">
           <!--<a class="btn btn-default" type="submit" href="find_student.php">Search</a>
           -->
          </form>
      </div>
    </nav>

    </head>
    <body>
      
        <form action="" method="GET">
          
        <!--    <input type="submit" name="sortPrezime" value="asc"><br><br>
            <input type="submit" name="sortPrezime" value="desc"><br><br>    -->
          
            <table class="table table-bordered table-hover">
                <tr>
                    <td align="center"><span class="glyphicon glyphicon-trash"></span> Izbrisi</td>
                    <td align="center"><span class="glyphicon glyphicon-edit"></span> Uredi</td>
                    <?php echo "<th><a href='pregled.php?sortID=$linkAscDescID'>Broj rezervacije</a></th>" ?>
                    <?php echo "<th><a href='pregled.php?sortDatum=$linkAscDescDatum'>Datum</a></th>" ?>
                    <?php echo "<th>Pocetak</th>" ?>
                    <th>Kraj</th>
                    <th>Naziv</th>
                    <th>Trajanje</th>
                    <th>Ime</th>
                    <th>Prezime</th>
                     <?php echo "<th>Kontakt</th>" ?>
                </tr>
                <!-- popuni tablicu iz sql baze -->
                <?php while ($row = mysql_fetch_array($result)):?>	
                <tr>
                <td align="center"><input name="checkboxDelete[]" type="checkbox" id="checkbox" value="<?php echo $row['idRezervacija']?>"></td>
                 <td align="center"><input name="radioUpdate" type="radio" id="radio" value="<?php echo $row['idRezervacija']?>"></td>
                    <td><?php echo $row['idRezervacija'];?></td>
                    <td><?php echo $row['pocetakTerminaDatum'];?></td>
                    <td><?php echo $row['pocetakTerminaVrijeme'];?></td>
                    <td><?php echo $row['krajTerminaVrijeme'];?></td>
                    <td><?php echo $row['naziv'];?></td>
                    <td><?php echo $row['trajanje'];?></td>
                    <td><?php echo $row['ime'];?></td>
                    <td><?php echo $row['prezime'];?></td>
                    <td><?php echo $row['kontakt'];?></td>
					<?php endwhile;?>

				
				</tr>
            </table>

            <div class="container pull-left">
             <div class="row">
                <div class="col-lg-5">
                                         
                <input class="btn btn-danger" name="delete" type="submit" id="delete" value="Delete"></input>
                <input class="btn btn-info" type ="submit" value="Update"></input>

                 </div>
                 </div>
             </div>

        </form>

        
      <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
      <script src = "https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
      
      <!-- Include all compiled plugins (below), or include individual files as needed -->
      <script src = "//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>

    </body>
</html>