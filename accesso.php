<!--

	Pagina di accesso al sito; Questa pagina può essere raggiunta in vari modi:
		- Classico (Utilizzato nella maggior parte), ovvero l'utente preme sul bottone "Accedi" della navbar o di "index.php"; 
		- Tramite reindirizzamento da link "rispondi" di "visioneTopic.php" (Nel caso in cui l'accesso non è stato effettuato);
		- Tramite reindirizzamento da link "creaTopic" di "visioneCategoria.php" (Nel caso in cui l'accesso non è stato effettuato).
	
	$_GET["id"] = Id del topic di provenienza.
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

			var invia=true;

			var user = document.modulo.username.value;
			var password = document.modulo.pass.value;
			
			if(user.length < 3)
				$(".alt1").css("display","inline-block"),invia=false;

			if(password.length < 8)
				$(".alt2").css("display","inline-block"),invia=false;

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

		//Controllo sessione
		if(isset($_SESSION['entrato']) && $_SESSION['entrato'] == true)
    		echo '<script>window.location.href = "index.php";</script>'; //reindirizzamento forzato alla home
		else
		{
			// Nel caso in cui le variabili del form sono state settate, effettuiamo l'accesso selezionando l'utente dal DB
			if(isset($_POST['username']) && isset($_POST['pass']))
			{
				$sql = "SELECT CodUtente, NomeUtente, PassUtente, AutorizzazioneUtente
						FROM Utenti
						WHERE BINARY NomeUtente='".mysqli_real_escape_string($connessione1, $_POST['username'])."' AND
								PassUtente='".sha1($_POST['pass'])."'";

				$result = mysqli_query($connessione1, $sql); // Interrogazione al DB
				if(!$result) 
					echo 'Errore nella query al DB';
				else
				{
					// Caso in cui le credenziali sono errate (La SELECT non seleziona nulla)
					if(mysqli_num_rows($result) == 0)
					{
		?>
						<center>
							<div id="errore" class="alert alert-danger" style="display:inline-block;"><H1><b>X</b></H1>Username o password sbagliate, reinserisci le credenziali.</div>
						</center>
		<?php
						if(isset($_GET['id']))
							echo '<script>setTimeout(function () {window.location.href = "accesso.php?id='.$_GET['id'].'" }, 2000);</script>';
						else 
							echo '<script>setTimeout(function () {window.location.href = "accesso.php"; }, 2000);</script>';
					}
					else
					{ 
						// Inizializzazione sessione
						$_SESSION['entrato'] = true;
                     
                    	$row = mysqli_fetch_assoc($result);
                        
                        $_SESSION['cod'] = $row['CodUtente'];
                        $_SESSION['username'] = $row['NomeUtente'];
                        $_SESSION['pw'] = $_POST['pass'];
                        $_SESSION['autorizzazione'] = $row['AutorizzazioneUtente'];
                    	
                    	// Ritorno alla pagina "index.php", o di provenienza
                    	if(isset($_GET['id']))
                    		echo '<script>window.location.href = "caricamento.php?pg=accesso&id='.$_GET['id'].'";</script>';
            			else
            				echo '<script>window.location.href = "caricamento.php?pg=accesso";</script>';
            		}
				}
			}
			// Nel caso in cui le variabili del form non sono state settate, visualizziamo il form
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
		</center>
		<div class="col-md-6 offset-md-3">
			<div class="mb-4">
				<div class="panel-heading panel-heading-input">
		   			<center><h3 class="panel-title">Accedi al sito inserendo le tue credenziali</h3></center>
				</div>
				<div class="panel-body panel-body-input">
					<div class="container" style="margin-top: 30px;">
						<form name="modulo" method="POST" onsubmit="return controlloForm();" action="#">
							<div class="mb-3 col-md-10 offset-md-1">
								<input type="text" name="username" class="form-control" maxlength="40" required placeholder="Username">
							</div>
							<div class="mb-4 col-md-10 offset-md-1">
								<input type="password" name="pass" class="form-control" maxlength="32" required placeholder="Password">
							</div>
							<div class="mb-3 col-md-6 offset-md-3">
								<input type="submit" class="btn btn-primary col-md-12" value="Accedi">
							</div>
							<center>
								Non hai un'account? <a href="iscriviti.php">Clicca qui per iscriverti</a> <!-- Link ad "iscriviti.php" -->
							</center>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
			}
		}
		include 'footer.html';
	?>
</body>
</html>