<!--

	Pagina per la pubblicazione del post come risposta

	$_GET['id'] = Id del post di provenienza;
	$_GET['id2'] = Id del topic di provenienza;

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
		// Funzione per il controllo della risposta
		function controlloForm()
		{
			$(".alt1").hide();
            var invia=true;

  			if(document.risposta.contenutoPost.value.length < 2)
  				$(".alt1").css("display","inline-block"),invia=false;

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

    	//controllo sessione
        if(!(isset($_SESSION['entrato'])))
            echo '<script>window.location.href = "accesso.php";</script>';

        $sql2 = "SELECT U.NomeUtente, P.Contenuto
					 FROM Posts P, Utenti U
					 WHERE P.UtPost = U.CodUtente AND
					 	   P.CodPost = '".$_GET['id']."'";
		$postRif = mysqli_query($connessione1, $sql2);
		if(!$postRif)
			echo 'ERRORE';
		else
		{
			$r=mysqli_fetch_assoc($postRif);
			$ut=$r['NomeUtente'];
			$co=$r['Contenuto'];
			if(strlen($co) > 15) $co=substr($co, 0, 15).'...'; 
		}

        if(isset($_POST['contenutoPost']))
		{
    		// Inserimento risposta nel DB
    		$sql = "INSERT INTO Posts(Contenuto, DataPost, RispostaPost, TopicPost, UtPost)
                	VALUES('".mysqli_real_escape_string($connessione1, $_POST['contenutoPost'])."',
                       		NOW(),
                       		'".mysqli_real_escape_string($connessione1, $_GET['id'])."',
                        	'".mysqli_real_escape_string($connessione1, $_GET['id2'])."',
                        	'".mysqli_real_escape_string($connessione1, $_SESSION['cod'])."');";

        	$result = mysqli_query($connessione1, $sql);
        	if(!$result)
        	{
        		?>
		    	
		    		<center>
						<div class="alert alert-danger alt1" style="display:inline-block;">
							<H1><b>X</b></H1>Impossibile rispondere al post; riprova più tardi
							<script>
								setTimeout(function () { window.location.href = "visioneTopic.php?id=<?php echo $_GET['id2']; ?>"; }, 2000);
							</script>
						</div>
					</center>
				
				<?php
        	}
        	else
        		echo '<script>window.location.href = "caricamento.php?pg=risposta&id='.$_GET['id2'].'";</script>';
    	}
    	else
    	{

	?>
	<!-- Form risposta -->
	<div class="container">
		<center>
            <div class="alert alert-danger alt1">
                <H1><b>X</b></H1>Non puoi inserire una risposta con un solo carattere
            </div>
        </center>
        <div class="mb-4">
            <div class="panel-heading panel-heading-input">
                <center><h3 class="panel-title">Rispondi a <?php echo '<b>'.$ut.'</b>: '.$co?></h3></center>
            </div>
            <div class="panel-body panel-body-input">
            	<div class="container" style="margin-top: 20px;">
					<form name="risposta" method="post" action="#" onsubmit="return controlloForm();">
						<div class="mb-4">
							<textarea class="form-control" rows="3" name="contenutoPost" placeholder="Inserisci qui la risposta..." required></textarea>
						</div>
						<div class="mb-4 col-md-8 offset-md-3">
							<a href="visioneTopic.php?id=<?php echo $_GET['id2']; ?>" class="btn btn-outline-primary col-md-4">Torna indietro</a>
                            <input type="submit" class="btn btn-primary col-md-4 offset-md-1" value="Rispondi!">
                        </div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<?php
		}
		include 'footer.html';
	?>
</body>
</html>