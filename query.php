<html>
<body>
<title>Query</title>
<?php require("menu.php"); ?>
</body>
</html>
<?php
	$dbhost = 'localhost';
	$dbuser = 'DB_USERNAME';
	$dbpass = 'DB_PASSWORD';
if (isset($_POST['add'])){
	$conn = mysqli_connect($dbhost, $dbuser, $dbpass);
	if(! $conn )
		{
		die('Could not connect: ' . mysql_error());
		}
	//echo '<br />Connected successfully<br /><br />';
	// $q=$_POST[''].$_POST['tablica'];
	// $_POST['']
	mysql_select_db('bolnica');
	if (isset($_POST['query'])){ 
		$q=$_POST['query'];
		}
	elseif (isset($_POST['add1'])){
		$q="SELECT * FROM ".$_POST['tablica'];
		}
	elseif (isset($_POST['add2'])){
		$q=$_POST['query2'].$_POST['tablica'];
		}
	elseif (isset($_POST['add3'])){
		$q="SELECT count(*) FROM ".$_POST['tablica'];
		}
	
	echo "Last query: ".$q."<br />";
	$x = mysql_query($q,$conn);
	if ($x) echo "Query successfully complete. <br />"; else die("Query fail: ".mysql_error()."<br />");
	//}
	mysql_close($conn);
	}
?>
<html>
<body>
<br />
<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
<table width="100" border="0" cellspacing="0" cellpadding="2">
	<tr>
		<td width="100">Query:</td>
		<td width="500"> <textarea name="query" type="text" id="query"></textarea> </td>
		<td> <input name="add" type="submit" id="add" value="Do query"></td>
	</tr>
</table>
</form>
<table border="0" cellspacing="0" cellpadding="2">
	<tr>
		<td>Odaberi tablicu:</td>
	</tr>
	<tr>
		<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
		<input name="add" hidden>
		<td valign="top">
		<?php
		$conn = mysqli_connect($dbhost, $dbuser, $dbpass);
		if(! $conn )
			{
			die('Could not connect: ' . mysql_error());
			}
		//echo '<br />Connected successfully<br /><br />';
		mysql_select_db('bolnica');
		//if ($_POST['query']!='') echo "Last query: ".$_POST['query']."<br />";
		$x1 = mysql_query("show tables",$conn);
		mysql_close($conn);
		?><select name="tablica"><?php
		while ($row1 = mysql_fetch_array($x1)){
				echo '<option value="'.$row1[0].'">'.$row1[0].'</option>';
				}
		?></select>
		</td>
		<td width="10" />
		<td>
			<!-- <input value="SELECT * FROM " name="query1" hidden> -->
			<input title="SELECT * FROM " type="submit" name="add1" value="Select all">
			<!-- <input value="SELECT count(*) FROM " name="query3" hidden> -->
			<input title="Ispisuje ukupan broj entrya u specijalizacija tablici&#10SELECT count(*) FROM `specijalizacija`"
				value="Count(*)" type="submit" name="add3">
		</td>
		</form>
	</tr>
</table>
	<!----------------
	---- NOVI RED ----
	------------------ -->
<table border="0" cellspacing="0" cellpadding="2">
	<tr>
		<td><br />Odaberi query:</td>
	</tr>
	<tr> 
		<td>
		<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
			<input value="SELECT idPacijenta, ime, prezime, nazivPregleda, trajanje FROM pacijent NATURAL JOIN narudzba NATURAL JOIN tippregleda" name="query" hidden>
			<input title="Ispisuje sve preglede i njihova trajanja za sve pacijente.&#10&#10SELECT idPacijenta, ime, prezime, nazivPregleda, trajanje FROM pacijent NATURAL JOIN narudzba NATURAL JOIN tippregleda"
				type="submit" name="add" value="Pregledi pacijenata">
		</form>
		</td>
		<td>
		<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
			<input value="SELECT imeDoktora AS `Ime doktora`,prezimeDoktora AS `Prezime doktora`,nazivSpecijalizacije as `Specijalizacija` FROM doktor NATURAL JOIN doktorspecijalizacija NATURAL JOIN specijalizacija ORDER BY prezimeDoktora" name="query" hidden>
			<input title="Ispisuje sve doktore i njihove specijalizacije.&#10&#10SELECT imeDoktora AS `Ime doktora`,prezimeDoktora AS `Prezime doktora`,nazivSpecijalizacije as `Specijalizacija` FROM doktor NATURAL JOIN doktorspecijalizacija NATURAL JOIN specijalizacija ORDER BY prezimeDoktora"
				type="submit" name="add" value="Doktor-specijalizacija">
		</form>
		</td>
		<td>
		<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
			<input value="SELECT imeDoktora AS `Ime doktora`,prezimeDoktora AS `Prezime doktora`,placa AS `Placa` FROM doktor WHERE placa>(SELECT AVG(placa) FROM doktor) ORDER BY placa DESC" name="query" hidden>
			<input title="Ispisuje imena i place doktora sa placom vecom od prosjecne&#10&#10SELECT imeDoktora AS `Ime doktora`,prezimeDoktora AS `Prezime doktora`,placa AS `Placa` FROM doktor WHERE placa>(SELECT AVG(placa) FROM doktor) ORDER BY placa DESC"
				type="submit" name="add" value="Iznadprosječne plaće">
		</form>
		</td>
		<td>
		<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
			<input value="SELECT imeDoktora AS `Ime doktora`,prezimeDoktora AS `Prezime doktora`,nazivSpecijalizacije as `Specijalizacija` FROM doktor NATURAL JOIN doktorspecijalizacija NATURAL JOIN specijalizacija WHERE doktor.idDoktora IN (SELECT idDoktora FROM doktorspecijalizacija GROUP BY idDoktora HAVING count(*)>1) ORDER BY prezimeDoktora,imeDoktora" name="query" hidden>
			<input title="Ispisuje imena doktora sa dvije ili više specijalizacija.&#10&#10SELECT imeDoktora AS `Ime doktora`,prezimeDoktora AS `Prezime doktora`,nazivSpecijalizacije as `Specijalizacija` FROM doktor NATURAL JOIN doktorspecijalizacija NATURAL JOIN specijalizacija WHERE doktor.idDoktora IN (SELECT idDoktora FROM doktorspecijalizacija GROUP BY idDoktora HAVING count(*)>1) ORDER BY prezimeDoktora,imeDoktora
"
				type="submit" name="add" value="Više specijalizacija">
		</form>
		</td>
		<td>
		<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
			<input value="SELECT nazivSpecijalizacije as `Specijalizacija`,count(*) AS `Broj doktora` FROM doktorspecijalizacija NATURAL JOIN specijalizacija GROUP BY doktorspecijalizacija.idSpecijalizacije HAVING count(*)=(SELECT count(*) FROM doktorspecijalizacija GROUP BY idSpecijalizacije ORDER BY count(*) DESC LIMIT 1)" name="query" hidden>
			<input title="Ispisuje najzastupljeniju specijalizaciju (onu sa najviše doktora).&#10&#10SELECT nazivSpecijalizacije as `Specijalizacija`,count(*) AS `Broj doktora` FROM doktorspecijalizacija NATURAL JOIN specijalizacija GROUP BY doktorspecijalizacija.idSpecijalizacije HAVING count(*)=(SELECT count(*) FROM doktorspecijalizacija GROUP BY idSpecijalizacije ORDER BY count(*) DESC LIMIT 1)"
				type="submit" name="add" value="Najzastupljenija specijalizacija">
		</form>
		</td>
		<td>
		<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
			<input value="SELECT ime AS `Ime`,prezime AS `Prezime`,count(*) AS `Broj razlicitih doktora` FROM pacijent NATURAL JOIN narudzba GROUP BY idPacijenta HAVING count(*)=(SELECT count(*) FROM narudzba GROUP BY idPacijenta ORDER BY count(*) DESC LIMIT 1)" name="query" hidden>
			<input title="Pacijent(i) s najviše različitih doktora.&#10&#10SELECT ime AS `Ime`,prezime AS `Prezime`,count(*) AS `Broj razlicitih doktora` FROM pacijent NATURAL JOIN narudzba GROUP BY idPacijenta HAVING count(*)=(SELECT count(*) FROM narudzba GROUP BY idPacijenta ORDER BY count(*) DESC LIMIT 1)"
			type="submit" name="add" value="Pacijent s najvise doktora">
		</form>
		</td>
	</tr>
	<tr>
	<td>
		<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
			<input value="SELECT imeLijeka AS `Naziv lijeka`,count(*) AS `Kolicina` FROM lijekpregled NATURAL JOIN lijek GROUP BY lijekpregled.idLijeka HAVING count(*)=(SELECT count(*) FROM lijekpregled GROUP BY idLijeka ORDER BY count(*) DESC LIMIT 1)" name="query" hidden>
			<input title="Ime najizdavanjijeg(najizdavanijih) lijekova.&#10&#10SELECT imeLijeka AS `Naziv lijeka`,count(*) AS `Kolicina` FROM lijekpregled NATURAL JOIN lijek GROUP BY lijekpregled.idLijeka HAVING count(*)=(SELECT count(*) FROM lijekpregled GROUP BY idLijeka ORDER BY count(*) DESC LIMIT 1)" 
				type="submit" name="add" value="Najizdavaniji lijek">
		</form>
		</td>
		<td>
		<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
			<input value="SELECT nazivPregleda as `Naziv pregleda` FROM tippregleda WHERE idTipPregleda IN(SELECT idTipPregleda FROM narudzba GROUP BY idTipPregleda HAVING count(*)=(SELECT count(*) FROM narudzba GROUP BY idTipPregleda ORDER BY count(*) DESC  LIMIT 1))" name="query" hidden>
			<input title="Najviše zastupljen tip/tipovi pregleda.&#10&#10SELECT nazivPregleda as `Naziv pregleda` FROM tippregleda WHERE idTipPregleda IN(SELECT idTipPregleda FROM narudzba GROUP BY idTipPregleda HAVING count(*)=(SELECT count(*) FROM narudzba GROUP BY idTipPregleda ORDER BY count(*) DESC  LIMIT 1))"
				type="submit" name="add" value="Najzastupljeniji tip pregleda">
		</form>
		</td>
		<td>
		<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
			<input value="SELECT nazivPregleda as `Naziv pregleda` FROM tippregleda WHERE idTipPregleda IN(SELECT idTipPregleda FROM narudzba GROUP BY idTipPregleda HAVING count(*)=(SELECT count(*) FROM narudzba GROUP BY idTipPregleda ORDER BY count(*) ASC  LIMIT 1))" name="query" hidden>
			<input title="Najmanje zastupljen tip/tipovi pregleda.&#10&#10SELECT nazivPregleda as `Naziv pregleda` FROM tippregleda WHERE idTipPregleda IN(SELECT idTipPregleda FROM narudzba GROUP BY idTipPregleda HAVING count(*)=(SELECT count(*) FROM narudzba GROUP BY idTipPregleda ORDER BY count(*) ASC  LIMIT 1))"
				type="submit" name="add" value="Najmanje zastupljen tip pregleda">
		</form>
		</td>
		<td>
		<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
			<input value="SELECT ime AS `Ime`,prezime AS `Prezime` FROM pacijent WHERE idPacijenta IN (SELECT idPacijenta FROM narudzba GROUP BY idPacijenta HAVING count(*)=(SELECT count(*) FROM narudzba GROUP BY idPacijenta ORDER BY count(*) DESC LIMIT 1))" name="query" hidden>
			<input title="Pacijent sa najviše narudžbi.&#10&#10SELECT ime AS `Ime`,prezime AS `Prezime` WHERE idPacijenta IN (SELECT idPacijenta FROM narudzba GROUP BY idPacijenta HAVING count(*)=(SELECT count(*) FROM narudzba GROUP BY idPacijenta ORDER BY count(*) DESC LIMIT 1))"
				type="submit" name="add" value="Najčešći pacijent">
		</form>
		</td>
		<td>
		<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
			<input value="SELECT nazivSpecijalizacije AS `Naziv specijalizacije`,count(*) AS `Broj tipova pregleda` FROM tippregleda JOIN specijalizacija WHERE idSpecijalizacija=idSpecijalizacije GROUP BY idSpecijalizacija HAVING count(*)=(SELECT count(*) FROM tippregleda GROUP BY idSpecijalizacija ORDER BY count(*) DESC LIMIT 1)" name="query" hidden>
			<input title="Ispisuje specijalizaciju sa najvećim brojem tipova pregleda.&#10&#10SELECT nazivSpecijalizacije AS `Naziv specijalizacije`,count(*) AS `Broj tipova pregleda` FROM tippregleda JOIN specijalizacija WHERE idSpecijalizacija=idSpecijalizacije GROUP BY idSpecijalizacija HAVING count(*)=(SELECT count(*) FROM tippregleda GROUP BY idSpecijalizacija ORDER BY count(*) DESC LIMIT 1)"
				type="submit" name="add" value="Specijalizacija s najviše tipova pregleda">
		</form>
		</td>
	</tr>
</table>
</body>
</html>
<?php
if (isset($_POST['add'])){    //izvrsi ako postoji query
	echo "Prikaz ".mysql_num_rows($x)." rezultata:";
	$fw=mysql_num_fields($x);     //broj header fieldova
	?>
	<table width="<?php if ($fw<7) echo $fw*250; else echo $fw*100;?>" 
		border="1" cellspacing="0" cellpadding="2">
	<tr>
	<?php
	$s=NULL;
	while ($row = mysql_fetch_field($x)){
	?>	<td><?php echo $row->name; ?></td>
	<?php
	}
	?></tr><?php
	//ispis podataka
	while($row = mysql_fetch_row($x)){
		?><tr><?php
		for($i=0;$i<count($row);$i++){
			?><td><?php echo $row[$i]?></td><?php
			}
		?></tr><?php
		}
	?></table><?php
	}		
?>	
