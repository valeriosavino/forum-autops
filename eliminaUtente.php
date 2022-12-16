<!--

	Pagina per l'eliminazione dell'utente

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
		// Script per il controllo della password
		$(document).ready(function() {
      		$("#elimina").click(function() {
      			$("#cont").hide();
        		if($("#pass").val() == $("#hiddenpass").val())
        		{
        			$("#eliminaUser").attr("style", "display: inline-block");
					$("html, body").animate({scrollTop: 0}, 0);
        		}
        		else
        		{
        			$("#errore").attr("style", "display: inline-block");
        			setTimeout(function () {window.location.href = "eliminaUtente.php"; }, 2000);
        		}
        	});
    	});
	</script>
</head>
<body class="d-flex flex-column h-100">
<?php
	include 'nav.php'; 
	require 'connessioneDB.php';
	if(!isset($_POST['si']))
	{
?>
	<!-- Visualizzazione inserimento password -->
	<div id="cont" class="container">
		<div class="col-md-6 offset-md-3">
			<div class="mb-4">
				<div class="panel-heading panel-heading-input">
		   			<center><h3 class="panel-title">Eliminazione dell'account <?php echo $_SESSION['username']; ?></h3></center>
				</div>
				<div class="panel-body panel-body-input">
					<div class="container" style="margin-top: 20px;">
						<div class="mb-3 col-md-10 offset-md-1">
							<h4><center>Inserisci la password</center></h4>
						</div>
						<div class="mb-4 col-md-10 offset-md-1">
							<input type="password" name="pass" id="pass" class="form-control" maxlength="32" required placeholder="Password">
						</div>
						<div class="row row-no-line" style="margin-top: 25px; margin-bottom: 20px;">
            				<div class="col"><center><a href="account.php" class="btn btn-outline-primary">Annulla</a></center></div>
              				<div class="col"><center><button type="button" class="btn btn-danger" id="elimina">Elimina</button></center></div>
            			</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<center>
		<!-- Visualizzazione conferma eliminazione utente -->
		<div id="eliminaUser" class="alert alert-info">
        	<b>Sei sicuro di voler eliminare l'account?</b><br>
        	<form name="g" method="POST" action="#">
        		<input type="submit" name="si" id="si" class="btn btn-danger" value="Si">
        		<a href="account.php" class="btn btn-danger" id="no">No</a>
        		<input type="hidden" id="hiddenpass" value="<?php echo $_SESSION['pw'] ?>">
        	</form>
    	</div>

    	<div id="errore" class="alert alert-danger">
    		<H1><b>X</b></H1>Password sbagliata, reinseriscila.
    	</div>
    </center>
<?php
	}
	else
	{
		// Modifica dei contenuti dei Post dell'utente nel DB
		$sql = "UPDATE Posts SET UtPost='0', Contenuto='*messaggio eliminato*' WHERE UtPost='".$_SESSION['cod']."'";
		
		$result = mysqli_query($connessione1, $sql);
		if(!$result)
			echo 'No query';

		else 
		{
			// Eliminazione Topics utente dal DB
			$sql = "DELETE P, T FROM Posts P JOIN Topics T ON P.TopicPost=T.CodTopic WHERE UtTopic='".$_SESSION['cod']."'";
			$result = mysqli_query($connessione1, $sql);

			if(!$result)
				echo 'No query';
			
			// Eliminazione utente dal DB
			$sql = "DELETE FROM Utenti WHERE CodUtente = '".$_SESSION['cod']."'";
	
			$result = mysqli_query($connessione1, $sql);
			if(!$result)
				echo 'No query';
			else
			{
				session_destroy();
				echo '<script>window.location.href = "caricamento.php?pg=eliminaUtente";</script>';
			}
		}
	}
	include 'footer.html';
?>
</body>
</html>