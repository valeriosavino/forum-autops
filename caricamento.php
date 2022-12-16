<!--

	Pagina di "appoggio" che permette di visualizzare un'animazione di caricamento delle varie pagine

	$_GET['pg'] = Alias assegnato alla pagina di provenienza;
	$_GET['id'] = Id della Categoria o del Topic di provenienza;

-->

<?php
	session_start();
?>
<html>
<head>
<?php
	require 'imports.html';
?>
	<style>
		.loader 
		{
			margin-top: 10%;
			border: 9px solid transparent;
			border-radius: 50%;
			border-top: 9px solid #342e8a;
			border-left: 9px solid #342e8a;							/* Personalizzazione della classe 'loader' */
			border-right: 9px solid #342e8a;
			width: 70px;
			height: 70px;
			animation: spin 1s linear infinite;
		}

		@keyframes spin 
		{
			0% { transform: rotate(0deg); }							/* Animazione utilizzata successivamente nell'oggetto */
			100% { transform: rotate(360deg); }
		}
	</style>
</head>
	<body class="d-flex flex-column h-100">
		<?php
			include 'nav.php'; 
			require 'connessioneDB.php';
		?>

			<center>
				<div class="alert alert-info" style="display:inline-block;">
					<?php 
						// Reindirizzamento delle varie pagine in base alla pagina di provenienza 
						switch ($_GET['pg']) 
						{
							case "accesso":
								echo 'Benvenuto <b>'.$_SESSION['username'].'</b>';
								if(isset($_GET['id']))
									echo '<br>Reindirizzamento al topic...<script>setTimeout(function () {window.location.href="visioneTopic.php?id='.$_GET['id'].'";}, 2000);</script>';
								else
									echo '<br>Reindirizzamento alla home...<script>setTimeout(function () {window.location.href = "index.php"; }, 2000);</script>';								
								break;
							
							case "modificaUtente":
								echo '<b>Utente modificato con successo</b><br>Reindirizzamento ai dati utente...';
								echo '<script>setTimeout(function () {window.location.href = "account.php"; }, 2000);</script>';
								break;

							case "modificaPost":
								echo '<b>Post modificato con successo</b><br>Reindirizzamento al topic...';
								echo '<script>setTimeout(function () {window.location.href="visioneTopic.php?id='.$_GET['id'].'";}, 2000);</script>';
								break;
								
							case "eliminaUtente":
								echo '<b>Utente eliminato con successo.</b><br>Reindirizzamento alla home...';
								echo '<script>setTimeout(function () {window.location.href = "index.php"; }, 2000);</script>';
								break;

							case "eliminaPost":
								echo '<b>Post eliminato con successo.</b><br>Reindirizzamento al topic...';
								echo '<script>setTimeout(function () {window.location.href="visioneTopic.php?id='.$_GET['id'].'";}, 2000);</script>';
								break;

							case "eliminaTopic":
								echo '<b>Topic eliminato con successo.</b><br>Reindirizzamento alla categoria...';
								echo '<script>setTimeout(function () {window.location.href="visioneCategoria.php?id='.$_GET['id'].'";}, 2000);</script>';
								break;

							case "iscrizione":
								echo '<b>Iscrizione completata con successo</b><br>Accesso in corso...';
								echo '<script>setTimeout(function () {window.location.href = "index.php"; }, 3000);</script>';
								break;

							case "password":
								echo '<b>Password cambiata con successo</b><br>Reindirizzamento alla home...';
								echo '<script>setTimeout(function () {window.location.href = "index.php"; }, 3000);</script>';
								break;

							case "creaTopic":
								echo '<b>Hai creato con successo il tuo nuovo topic!</b><br>Reindirizzamento al tuo topic...';
								echo '<script>setTimeout(function () {window.location.href="visioneTopic.php?id='.$_GET['id'].'";}, 3000);</script>';
								break;

							case "esci":
								session_destroy();
								echo '<b>Hai effettuato il logout</b><br>Reindirizzamento alla home...';
								echo '<script>setTimeout(function () {window.location.href = "index.php"; }, 1200);</script>';
								break;

							case "risposta":
								echo '<b>La tua risposta è stata inserita</b><br>Reindirizzamento al topic...';
								echo '<script>setTimeout(function () {window.location.href="visioneTopic.php?id='.$_GET['id'].'";}, 2000);</script>';
								break;
						}
					?>
					<div class="loader"></div>
				</div>
			</center>

	<?php
		include 'footer.html';
	?>
	</body>
</html>