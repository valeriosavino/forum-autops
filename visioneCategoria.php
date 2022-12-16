<!--

    Pagina per la visualizzazione della categoria selezionata

    $_GET['id'] = Id della categoria di provenienza;

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
        margin: auto;
    }
  </style>
</head>
<body class="d-flex flex-column h-100">
	<?php
        include 'nav.php'; 
        require 'connessioneDB.php';

        $sql = "SELECT CodCategoria, NomeCategoria, DescrCategoria
        		FROM Categorie 
        		WHERE CodCategoria = '".mysqli_real_escape_string($connessione1, $_GET['id'])."'";

        $query = mysqli_query($connessione1, $sql);
        if(!$query)
            echo 'Errore nella richiesta al DB della categoria';        	
        else
        {
            if(mysqli_num_rows($query) == 0)
                echo 'Questa categoria non esiste';
            else
            {
                while($row = mysqli_fetch_assoc($query))
                {
    ?>
        <!-- Visualizzazione dei topics della categoria -->
        <div class="container" style="margin-bottom: 30px; position: relative;">
            <div class="panel-heading panel-heading-view">
                <center><p class="panel-title"><font size="6">Topic nella categoria <?php echo $row['NomeCategoria']; ?></font></p></center>
            </div>
    <?php   
                }
                $sql = "SELECT CodTopic, TitoloTopic, DataTopic, CatTopic, count(Posts.CodPost) as NumPost
                        FROM Topics, Posts
                        WHERE Topics.CodTopic = Posts.TopicPost and CatTopic = '".mysqli_real_escape_string($connessione1, $_GET['id'])."'
                        GROUP BY CodTopic
                        ORDER BY DataTopic DESC;";

                $query = mysqli_query($connessione1, $sql);
                if(!$query)
                    echo 'Errore nella richiesta al DB dei topic della categoria';            
                else
                {
                    // Caso in cui la categoria è vuota
                    if(mysqli_num_rows($query) == 0)
                    {
                        echo '<div class="alert alert-danger alt1" style="border-top-left-radius: 0px; border-top-right-radius: 0px;">';
                        if(isset($_SESSION['entrato']) && $_SESSION['entrato'] == true)
                            echo '<center><H1><b>X</b></H1>Non ci sono topics. Se vuoi, <a href="creaTopic.php?c='.$_GET['id'].'">creane uno tu!</a></center>';
                        else
                            echo '<center><H1><b>X</b></H1>Non ci sono topics.</center>';
                        echo '</div></div>';
                    }
                    else
                    {
                    // Visualizzazione dati estratti
    ?>
                    <div class="panel-body panel-body-view" style="border-top: 0px solid #bce8f1; color: black;">
                        <div class="row" style="background: #03A9F4; border-radius: 2px;">
                            <div class="col col-md-4 col-title"><center><big><b>Titolo del topic</b></big></center></div>
                            <div class="col col-md-3 col-title"><center><big><b>Data creazione del topic</b></big></center></div>
                            <div class="col col-md-3 col-title"><center><big><b>Ultimo Post</b></big></center></div>
                            <div class="col col-md-2 col-title"><center><big><b>N° Risposte</b></big></center></div>
                        </div>

    <?php
                        while($row = mysqli_fetch_assoc($query))
                        {
                            echo '<div class="row">';
                                echo '<div class="col col-md-4" style="margin-top: 8px; margin-bottom: 8px;">';
                                    echo '<a href="visioneTopic.php?id='.$row['CodTopic'].'">'.$row['TitoloTopic'].'</a>'; 
                                echo '</div>';
                                echo '<div class="col col-md-3" style="margin-top: 8px; margin-bottom: 8px;">';
                                    echo '<center>'.date('d/m/Y H:i', strtotime($row['DataTopic'])).'</center>';
                                echo '</div>';
                                echo '<div class="col col-md-3" style="margin-top: 8px; margin-bottom: 8px;">';
                                    $x=$row['CodTopic'];
                                    $sql = "SELECT P.DataPost, U.NomeUtente
                                            FROM Posts P, Topics T, Utenti U
                                            WHERE P.TopicPost = T.CodTopic AND
                                                  CodTopic = '$x' AND
                                                  P.UtPost = U.CodUtente AND
                                                  T.CatTopic = '".mysqli_real_escape_string($connessione1, $_GET['id'])."'
                                            ORDER BY P.DataPost DESC;";
                                    $queryPost = mysqli_query($connessione1, $sql);
                                    if(!$queryPost)
                                        echo 'Errore nella richiesta al DB dei post';
                                    else
                                    {
                                        if(mysqli_num_rows($queryPost) == 0)
                                            echo '<center> - </center>';
                                        else
                                        {
                                            $p=mysqli_fetch_assoc($queryPost);
                                            echo '<center><b>'.$p['NomeUtente'].'</b> in data '.date('d/m/Y H:i', strtotime($p['DataPost'])).'</center>';
                                        }
                                    }
                                echo '</div>';
                                echo '<div class="col col-md-2" style="margin-top: 8px; margin-bottom: 8px;">';
                                    $risp = $row['NumPost']-1;
                                    echo '<center>'.$risp.'</center>';
                                echo '</div>';
                            echo '</div>';
                        }
    ?>
                    </div>
                </div>
    <?php
                    }
                }
            }
        }
        include 'footer.html';
    ?>
</body>
</html>