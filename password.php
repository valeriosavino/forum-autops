<!--

	Pagina per il cambiamento della password

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
		// Funzione per il controllo del form
		function controlloFormCambioPW() 
		{
			$(".alt1").hide();
			$(".alt2").hide();
			$(".alt3").hide();
			$(".alt4").hide();
			

			var invia = true;
			var hiddenoldpass = document.modulo.hiddenoldpass.value;
			var oldpass = document.modulo.oldpass.value;
			var newpass = document.modulo.newpass.value;
			var confpass = document.modulo.confpass.value;

			if(oldpass != hiddenoldpass)
				$(".alt1").css("display","inline-block"),invia=false;
			
			if(newpass.length < 8)
				$(".alt2").css("display","inline-block"),invia=false;

			if(newpass != confpass)
				$(".alt3").css("display","inline-block"),invia=false;	

			if(newpass == oldpass)
				$(".alt4").css("display","inline-block"),invia=false;

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

		if(!(isset($_SESSION['entrato'])))
      		echo '<script>window.location.href = "accesso.php";</script>';

    	if(!isset($_POST['conferma']))
    	{
	?>
	<div id="visualeDati" class="container">
		<center>
			<div class="alert alert-danger alt1">
				<H1><b>X</b></H1>La vecchia password non corrisponde a quella inserita 
			</div>
			<div class="alert alert-danger alt2">
				<H1><b>X</b></H1>La nuova password deve contenere almeno 8 caratteri
			</div>
			<div class="alert alert-danger alt3">
				<H1><b>X</b></H1>Le nuove password non coincidono
			</div>
			<div class="alert alert-danger alt4">
				<H1><b>X</b></H1>La nuova e la vecchia password coincidono
			</div>
		</center>

        <!-- Form cambio password -->
        <form name="modulo" method="POST" action="#" onsubmit="return controlloFormCambioPW();">
        	<div class="col-md-6 offset-md-3">
          		<div class="panel-heading panel-heading-input">
            		<center><p class="panel-title"><font size="6">Cambia la password</font></p></center>
          		</div>
        		<div class="panel-body panel-body-input">
        			<div class="container" style="margin-top: 20px;">
        			<div class="mb-3 col-md-10 offset-md-1">
						<input type="password" name="oldpass" class="form-control" maxlength="32" required placeholder="Vecchia password">
					</div>
					<div class="mb-3 col-md-10 offset-md-1">
						<input type="password" name="newpass" class="form-control" maxlength="32" required placeholder="Nuova Password">
					</div>
					<div class="mb-4 col-md-10 offset-md-1">
						<input type="password" name="confpass" class="form-control" maxlength="32" required placeholder="Conferma Password">
					</div>
					<div class="mb-3 col-md-6 offset-md-3">
						<input type="submit" class="btn btn-primary col-md-12" value="Conferma" name="conferma">
					</div>
				</div>
        		</div>
        	</div>
        	<input type="hidden" name="hiddenoldpass" value="<?php echo $_SESSION['pw'] ?>">
        </form>
    </div>
    <?php 
    	} 
    	else 
    	{
			// Modifica della password dell'utente nel DB
    		$sql = "UPDATE Utenti 
    				SET PassUtente='".sha1($_POST['newpass'])."' 
    				WHERE CodUtente='".$_SESSION['cod']."';";

    		$result = mysqli_query($connessione1, $sql);
      		if(!$result) 
      			echo "Problemi nell'update dei dati";
      		else
      		{
      	        $_SESSION['pw'] = $_POST['newpass'];
       			echo '<script>window.location.href = "caricamento.php?pg=password";</script>';
      		}
	    }

    	include 'footer.html';
    ?>
</body>
</html>