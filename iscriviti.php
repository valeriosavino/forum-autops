<!--

	Pagina per l'iscrizione al forum

-->
<?php
    session_start();
?>
<html>
<head>
<?php
	require 'imports.html';
?>
	<script>
		// Funzione per il controllo dei dati del form prima dell'invio al DB
		function controlloForm()
		{

			$(".alt1").hide();
			$(".alt2").hide();
			$(".alt3").hide();

			var invia=true;

			var user = document.modulo.username.value;
			var password = document.modulo.pass.value;
			var password2 = document.modulo.pass2.value;
			
			if(user.length < 3)
				$(".alt1").css("display","inline-block"),invia=false;

			if(password.length < 8)
				$(".alt2").css("display","inline-block"),invia=false;

			if(password != password2)
				$(".alt3").css("display","inline-block"),invia=false;

			if(!invia)
				$("html, body").animate({scrollTop: 0}, 0);

			return invia;
		}
	</script>
</head>
<body class="d-flex flex-column h-100">
	<?php
		include 'nav.php'; 
		require 'connessioneDB.php';


		if(isset($_SESSION['entrato']) && $_SESSION['entrato'] == true)
    		echo '<script>window.location.href = "index.php";</script>';
		else
		{
	    	if(isset($_POST['username']) && isset($_POST['pass']) && isset($_POST['email']) && isset($_POST['auto']))
			{
	    		// Inserimento nuovo utente nel DB
	    		$sql = "INSERT INTO Utenti(NomeUtente, PassUtente, EmailUtente, DataIscrizioneUtente, AutorizzazioneUtente, ModUtente)
	                	VALUES('".mysqli_real_escape_string($connessione1, $_POST['username'])."',
	                       		'".sha1($_POST['pass'])."',
	                       		'".mysqli_real_escape_string($connessione1, $_POST['email'])."',
	                        	NOW(),
	                        	0,
	                        	'".mysqli_real_escape_string($connessione1, $_POST['auto'])."');";
	            try
	            {
	            	$result = mysqli_query($connessione1, $sql);

	            	if(!$result)
	        		{
	    ?>
	            	<center>
						<div id="errore" class="alert alert-danger" style="display:inline-block;"><H1><b>X</b></H1>Qualcosa è andato storto, prova a registrarti più tardi.</div>
					</center>
					<script>
						setTimeout(function () {window.location.href = "iscriviti.php";}, 2000);
					</script>
	    <?php    	
					}
	        		else
	        		{
		                // Accesso automatico dopo l'iscrizione con le nuove credenziali
		                $sql = "SELECT CodUtente, NomeUtente, PassUtente, AutorizzazioneUtente
								FROM Utenti
								WHERE NomeUtente='".mysqli_real_escape_string($connessione1, $_POST['username'])."' AND
										PassUtente='".sha1($_POST['pass'])."'";

						$result = mysqli_query($connessione1, $sql);
						if(!$result) 
							echo 'Errore nella query al DB';
						else 
						{
		                    $_SESSION['entrato'] = true;
		                    while($row = mysqli_fetch_assoc($result))
		                    {
	                        	$_SESSION['cod'] = $row['CodUtente'];
	                        	$_SESSION['username'] = $row['NomeUtente'];
	                        	$_SESSION['pw'] = $_POST['pass'];
	                        	$_SESSION['autorizzazione'] = $row['AutorizzazioneUtente'];
		                    }
		                	echo '<script>window.location.href = "caricamento.php?pg=iscrizione";</script>';
		                }
	        		}
	            }
	            catch(\mysqli_sql_exception $e)
	            {
	            	// Eccezione nel caso in cui l'username è giù utilizzato nel DB
	            	if ($e->getCode() === 1062) 
	            	{
	    ?>
	            		<center>
							<div id="errore" class="alert alert-danger" style="display:inline-block;"><H1><b>X</b></H1>Username già presente sul forum, usane un altro.</div>
						</center>
						<script>
							setTimeout(function () {window.location.href = "iscriviti.php";}, 2000);
						</script>
		<?php
    				} 
	            }
	    	}
	    	else
	    	{
	?>
	<div class="container">
		<center>
			<div class="alert alert-danger alt1">
				<H1><b>X</b></H1>Il nome utente deve contenere almeno 3 caratteri
			</div>
			<div class="alert alert-danger alt2">
				<H1><b>X</b></H1>La password deve contenere almeno 8 caratteri
			</div>
			<div class="alert alert-danger alt3">
				<H1><b>X</b></H1>Le password non sono uguali
			</div>
		</center>

		<!-- Form iscriviti -->
		<div class="col-md-6 offset-md-3">
			<div class="mb-4">
			<div class="panel-heading panel-heading-input">
		   		<center><h3 class="panel-title">Iscriviti al Forum</h3></center>
			</div>
				<div class="panel-body panel-body-input">
					<div class="container" style="margin-top: 20px;">
						<form name="modulo" method="post" onsubmit="return controlloForm();" action="#">
							<div class="mb-2 col-md-10 offset-md-1">
								<label for="username">Username:</label>
								<input type="text" name="username" class="form-control" maxlength="40" placeholder="Username" required>
							</div>
							<div class="mb-2 col-md-10 offset-md-1">
								<label for ="pass">Password (tra 8 e 32 caratteri):</label>
								<input type="password" name="pass" class="form-control" maxlength="32" placeholder="Password" required>
							</div>
							<div class="mb-2 col-md-10 offset-md-1">	
								<label for="pass2">Conferma Password:</label>
								<input type="password" name="pass2" class="form-control" maxlength="32" placeholder="Conferma password" required>
							</div>
							<div class="mb-2 col-md-10 offset-md-1">
								<label for="email">Email: </label>
								<input type="email" name="email" class="form-control" placeholder="nomeutente@dominio.com" required>
							</div>
							<div class="mb-4 col-md-10 offset-md-1">
								<label for="auto">Seleziona la tua Auto: </label>
								<?php
									// Prelievo modelli dal DB
									$queryAuto = mysqli_query($connessione1, "SELECT CodModello, NomeModello FROM Modelli WHERE CodModello <> '0' ORDER BY NomeModello");
									if(mysqli_num_rows($queryAuto))
									{
										$select = '<select class="form-select" name="auto">';
										while($rs=mysqli_fetch_assoc($queryAuto)) 
											$select.= '<option value="'.$rs['CodModello'].'">'.$rs['NomeModello'].'</option>';
									}
									$select.='</select>';
									echo $select;
								?>
							</div>					
							<div class="mb-4 col-md-12" style="margin-left: 4%;">
								<input type="checkbox" id="ck" class="form-check-input" required>
								<label class="form-check-label" for="ck"> Ho più di 14 anni e acconsento al <a href="privacy.php">trattamento dei miei dati personali</a></label>
							</div>
							<div class="mb-3 col-md-6 offset-md-3">
								<input type="submit" class="btn btn-primary col-md-12" value="Iscriviti!">
							</div>
							<center>
								Hai già un'account? <a href="accesso.php">Clicca qui per accedere</a> 	
							</center>
						</form>
					</div>
				</div>
			</div>	
		</div>
		<br>
	</div>
	<?php
			}
		}
		include 'footer.html';
	?>
</body>
</html>