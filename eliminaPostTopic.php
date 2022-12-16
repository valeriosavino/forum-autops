<!-- 

	Pagina per l'eliminazione di un Post o di un Topic

	$_GET['risp'] = Identificazione del post (se è risposta o post principale del topic);
	$_GET['id'] = Id del post di provenienza;
	$_GET['id2'] = Id del topic di provenienza;
	$_GET['cat'] = Id della categoria del topic di provenienza.

-->
<?php
	session_start();
?>
<html>
<head>
<?php
	require 'imports.html';
?>
</head>
<body class="d-flex flex-column h-100">
	<?php
	include 'nav.php'; 
	require 'connessioneDB.php';
	if(!isset($_GET['risp']) || !isset($_GET['id']) || !isset($_GET['id2']))
		echo '<script>window.location.href = "index.php";</script>';
	if(!isset($_POST['si']))
	{
	?>
			<!-- Richiesta di conferma dell'eliminazione del Post o del Topic -->
			<center>
				<div class="alert alert-info" style="display: inline-block;">
        			<?php 
        				if($_GET['risp'] != '0') 
        					echo '<b>Sei sicuro di voler eliminare il post?</b><br>';
        				else 
        					echo "<b>Sei sicuro di voler eliminare l'intero topic?</b><br>";
        			?>
        			<form name="g" method="POST" action="#">
        				<input type="submit" name="si" id="si" class="btn btn-danger" value="Si">
        				<a href="visioneTopic.php?id=<?php echo $_GET['id2']; ?>" class="btn btn-danger" id="no">No</a>
        			</form>
    			</div>
			</center>
	<?php
	}
	else 
	{
		if($_GET['risp'] != '0') 
		{
			// Sostituzione del contenuto del Post nel DB
			$sql = "UPDATE Posts SET Contenuto='*messaggio eliminato*' WHERE CodPost='".$_GET['id']."'";
			$result = mysqli_query($connessione1, $sql);
			if(!$result)
				echo 'No query';
			else
				echo '<script>window.location.href = "caricamento.php?pg=eliminaPost&id='.htmlentities($_GET['id2']).'";</script>';
		}
		else 
		{
			// Eliminazione intero Topic e Post correlati dal DB
			$sql = "DELETE P, T FROM Posts P JOIN Topics T ON P.TopicPost=T.CodTopic WHERE CodTopic='".$_GET['id2']."'";
			$result = mysqli_query($connessione1, $sql);
			if(!$result)
				echo 'No query';
			else
				echo '<script>window.location.href = "caricamento.php?pg=eliminaTopic&id='.htmlentities($_GET['cat']).'";</script>';
		}

	}
	include 'footer.html';
?>

</body>
</html>
