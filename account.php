<!--

      Pagina per visualizzare i dati dell'utente; Inizialmente, La visualizzazione del form di modifica dati viene effettuata tramite JQuery

-->

<?php
  session_start();
?>
<html>
<head>
<?php
  require 'imports.html';
?>
  <style type="text/css">
    .row
    {                             
        margin: 10px;                                             /* Riadattamento classe 'row' */
    }       
    .row-last
    {
        border: white;                                            /* Aggiunta classe 'row-last' */
    }
  </style>
  
  <script>
    function controlloUtente() 
    {
      $(".alt").hide();

      var invia=true;

      var user = document.modulo.username.value;

      if(user.length < 3 && user.length > 0)
        $(".alt").css("display","inline-block"),invia=false;

      if(!invia)
        $("html, body").animate({scrollTop: 0}, 0);

      return invia;
    }

    // Visualizzazione form per la modifica dei dati al click del bottone "modifica"
    $(document).ready(function() {

      $("#modifica").click(function() {
        $(".dati").hide();                                          
        $("#bottoni1").hide();      
        $("#username").show();                                
        $("#email").show();
        $("#auto").show();
        $("#bottoni2").show();
      });

    // Alla pressione del bottone "annulla", si nasconde il form e si visualizzano i dati
      $("#annulla").click(function() {
        $(".alt").hide();
        $("#username").hide();
        $("#email").hide();
        $("#auto").hide();
        $("#bottoni2").hide();
        $(".dati").show();
        $("#bottoni1").show();
      });

    // Ritorno alla visualizzazione dei dati dopo l'annullamento della modifica
      $("#no").click(function() {
        $("#visualeDati").show();
        $("#eliminaUser").hide();
      });
    });

  </script>
</head>
<body class="d-flex flex-column h-100">
	<?php
		include 'nav.php'; 
		require 'connessioneDB.php';
    // Controllo sessione
    if(!(isset($_SESSION['entrato'])))
      echo '<script>window.location.href = "accesso.php";</script>'; //reindirizzamento forzato all'accesso
		
    // Query selezione dati utente
    $sql = "SELECT U.NomeUtente, U.EmailUtente, U.DataIscrizioneUtente, M.NomeModello, U.ModUtente
				FROM Utenti U, Modelli M
				WHERE U.ModUtente = M.CodModello AND CodUtente = '".$_SESSION['cod']."';";

		$result = mysqli_query($connessione1, $sql);

		if(!$result)
		{
        ?>
          
          <center>
            <div class="alert alert-danger" style="display:inline-block;">
              <H1><b>X</b></H1>Qualcosa è andato storto; riprova più tardi
              <script>
                setTimeout(function () { window.location.href = "index.php"; }, 2000);
              </script>
            </div>
          </center>
        
        <?php
    }
		else
		{
      $p = mysqli_fetch_assoc($result);
      $oldUsername = $p['NomeUtente'];
      $oldEMail = $p['EmailUtente'];
      $oldModello = $p['ModUtente'];
      
	?>
			<!-- Visualizzazione dati con eventuale form di modifica dati -->
      <div id="visualeDati" class="container">
        <center>
          <div class="alert alert-danger alt">
            <H1><b>X</b></H1>Il nome utente deve contenere almeno 3 caratteri
          </div>
        </center>
        <form name="modulo" method="post" onsubmit="return controlloUtente();" action="#">
        <div class="col-md-6 offset-md-3">
          <div class="panel-heading panel-heading-view">
            <center><p class="panel-title"><font size="6">Account di </font><b><font size="6" style="color: black;"><?php echo $_SESSION['username']; ?></font></b></p></center>
          </div>
          <div class="panel-body panel-body-view">
            <div class="row">
              <div class="col">Username:</div>
              <div class="col">
                <span class="dati"><?php echo $p['NomeUtente']; ?></span>
                <input type="text" name="username" id="username" maxlength="40" style="display: none;" placeholder="<?php echo $p['NomeUtente']; ?>">
                </div>
            </div>
            <div class="row">
              <div class="col">E-Mail:</div>
              <div class="col">
                <span class="dati"><?php echo $p['EmailUtente']; ?></span>
                <input type="email" name="email" id="email" style="display: none;" placeholder="<?php echo $p['EmailUtente']; ?>">
              </div>
            </div>
            <div class="row">
              <div class="col">Iscritto da: </div>
              <div class="col"><?php echo date('d/m/Y', strtotime($p['DataIscrizioneUtente'])); ?></div>
            </div>
            <div class="row row-last">
              <div class="col">Modello di auto:</div>
              <div class="col">
                <span class="dati"><?php echo $p['NomeModello']; ?></span>
                <?php
                  // Query per prelevare i modelli dal DB (Il modello corrente viene visualizzato per primo)
                  $sql = "SELECT CodModello, NomeModello FROM Modelli WHERE CodModello <> ".$p['ModUtente']." AND CodModello <> '0' ORDER BY NomeModello";
                  $queryAuto = mysqli_query($connessione1, $sql);
                  if(mysqli_num_rows($queryAuto))
                  {
                    $select = '<select class="form-select" name="auto" id="auto" style="display: none;">';
                    $select.= '<option value="'.$p['ModUtente'].'">'.$p['NomeModello'].'</option>';
                    while($rs=mysqli_fetch_assoc($queryAuto)) 
                      $select.= '<option value="'.$rs['CodModello'].'">'.$rs['NomeModello'].'</option>';
                  }
                  $select.='</select>';
                  echo $select;
                ?>
              </div>
            </div>
            <div id="bottoni1" class="row row-last" style="margin-top: 25px; margin-bottom: 20px;">
              <div class="col"><center><button type="button" class="btn btn-outline-primary" id="modifica">Modifica dati</button></center></div>
              <div class="col"><center><a href="eliminaUtente.php" class="btn btn-danger">Elimina utente</a></center></div>
            </div>
            <div id="bottoni2" class="row row-last" style="margin-top: 25px; margin-bottom: 20px; display: none;">
              <div class="col"><center><button type="button" class="btn btn-outline-primary" id="annulla">Annulla modifica</button></center></div>
              <div class="col"><center><input type="submit" class="btn btn-primary" id="invio" name="invio" value="Invia Dati"></center></div>
            </div>
          </div>          
        </div>
      </form>
      </div>   
	<?php
		}
    // Invio dei nuovi dati compilati nel form al DB
    if(isset($_POST['invio']))
    {
      if(!empty($_POST['username']))
        $username = mysqli_real_escape_string($connessione1, $_POST['username']);
      else
        $username=mysqli_real_escape_string($connessione1, $oldUsername);
      if(!empty($_POST['email']))
        $email=mysqli_real_escape_string($connessione1, $_POST['email']);
      else
        $email=mysqli_real_escape_string($connessione1, $oldEMail);
      if($_POST['auto'] != $oldModello)
        $modello=mysqli_real_escape_string($connessione1, $_POST['auto']);
      else
        $modello=mysqli_real_escape_string($connessione1, $oldModello);
                
      $sql = 'UPDATE Utenti
              SET NomeUtente = "'.$username.'",
                  EmailUtente="'.$email.'",
                  ModUtente="'.$modello.'"                       
                  WHERE CodUtente="'.$_SESSION['cod'].'";';
      $result = mysqli_query($connessione1, $sql);
      if(!$result) echo "Problemi nell'update dei dati";
      else
      {
        $_SESSION['username'] = $username;
        echo '<script>window.location.href = "caricamento.php?pg=modificaUtente";</script>';
      }
    }
    include 'footer.html';
	?>
</body>
</html>