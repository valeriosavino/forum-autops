<!--

	Pagina per la modifica del Post
	
	$_GET['id'] = Id del post di provenienza;
	$_GET['id2'] = Id del topic di provenienza.

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
		// Funzione per il controllo della nuova modifica del post
		function controlloForm()
		{
			$(".alt1").hide();
            var invia=true;
            var contenutoPost = document.risposta.contenutoPost.value;

  			if(contenutoPost.length < 2)
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

	    $sql = "SELECT Contenuto
				FROM Posts 
				WHERE UtPost = '".$_SESSION['cod']."' AND CodPost = '".$_GET['id']."'";
		
		$postRif = mysqli_query($connessione1, $sql);
		if(!$postRif)
			echo 'ERRORE';
		else
		{
			$r=mysqli_fetch_assoc($postRif);

			if(isset($_POST['contenutoPost']))
			{
				// Modifica del Post nel DB
				$sql = "UPDATE Posts
                		SET Contenuto = '".mysqli_real_escape_string($connessione1, $_POST['contenutoPost'])."',
                       		DataPost = NOW()
                       	WHERE UtPost = '".$_SESSION['cod']."' AND CodPost = '".$_GET['id']."'";
                $result = mysqli_query($connessione1, $sql);
		    	if(!$result)
		    	{
		    	?>
		    	
		    		<center>
						<div class="alert alert-danger alt1" style="display:inline-block;">
							<H1><b>X</b></H1>Impossibile modificare il post al momento; riprova più tardi
							<script>
								setTimeout(function () { window.location.href = "visioneTopic.php?id=<?php echo $_GET['id2']; ?>"; }, 2000);
							</script>
						</div>
					</center>
				
				<?php
		    	}
		    	else
        			echo '<script>window.location.href = "caricamento.php?pg=modificaPost&id='.$_GET['id2'].'";</script>';
			}
			else
			{
	?>
	<!-- Form modifica post -->
	<div class="container">
		<center>
            <div class="alert alert-danger alt1">
                <H1><b>X</b></H1>Non puoi inserire un post con un solo carattere
            </div>
        </center>
        <div class="mb-4">
            <div class="panel-heading panel-heading-input">
                <center><h3 class="panel-title">Modifica il tuo post</h3></center>
            </div>
            <div class="panel-body panel-body-input">
            	<div class="container" style="margin-top: 20px;">
					<form name="risposta" method="post" action="#" onsubmit="return controlloForm();">
						<div class="mb-4">
							<textarea class="form-control" rows="3" name="contenutoPost" placeholder="Inserisci qui il tuo nuovo post..."  required><?php echo $r['Contenuto']; ?></textarea>
						</div>
						<div class="mb-4 col-md-8 offset-md-3">
							<a href="visioneTopic.php?id=<?php echo $_GET['id2']; ?>" class="btn btn-outline-primary col-md-4">Annulla modifica</a>
                            <input type="submit" class="btn btn-primary col-md-4 offset-md-1" value="Modifica!">
                        </div>
					</form>
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
