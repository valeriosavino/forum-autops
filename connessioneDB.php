<?php
	/*
	
		File per la connessione al database MYSQL.

	*/

	$server = "localhost";
	$user = "root";
	$database = "autops";
	$connessione1 = mysqli_connect($server, $user, "", $database);
	if(!$connessione1)
   		exit("Impossibile connettersi al DB, probabilmente devi avviare MySQL da XAMPP o verificare se è presente il DB AutoPS");
	if(!mysqli_select_db($connessione1, $database))
   		exit("Impossibile connettersi al DB AutoPS, probabilmente non è presente in PhpMyAdmin");
?>