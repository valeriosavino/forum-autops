<!--

    Pagina per la visualizzazione delle varie categorie presenti nel DB    

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
            margin: auto;               /* Riadattamento della classe 'row' */
        }
    </style>
</head>
<body class="d-flex flex-column h-100">
   <?php
        include 'nav.php'; 
        require 'connessioneDB.php';
    ?>
    
    <!-- Visualizzazione delle categorie presenti nel DB -->
    <div class="container" style="margin-bottom: 30px; position: relative;">
        <div class="panel-heading panel-heading-view">
            <center><p class="panel-title"><font size="6">Visualizza Categorie</font></p></center>
        </div>
    <?php
        $queryCat = mysqli_query($connessione1, "SELECT CodCategoria, NomeCategoria, DescrCategoria FROM Categorie ORDER BY NomeCategoria");
        if(!$queryCat)
        {
            echo 'Errore nella richiesta al DB delle categorie';
        }
        else
        {
            if(mysqli_num_rows($queryCat) == 0)
                echo 'Non sono presenti categorie al momento</div>';
            else
            {
                
    ?>
                <div class="panel-body panel-body-view" style="border-top: 0px solid #bce8f1; color: black;">
                    <div class="row" style="background: #03A9F4; border-radius: 2px;">
                        <div class="col col-md-5 col-title"><center><big><b>Categoria</b></big></center></div>
                        <div class="col col-md-4 col-title"><center><big><b>Ultimo Topic</b></big></center></div>
                        <div class="col col-md-3 col-title"><center><big><b>Data Ultimo Post</b></big></center></div>
                    </div>
    <?php
                // Prelievo dei dati dal DB con stampa
                while($rs=mysqli_fetch_assoc($queryCat))
                {
                    echo '<div class="row">';
                        echo '<div class="col col-md-5">';
                            echo '<a href="visioneCategoria.php?id='.$rs['CodCategoria'].'">'.$rs['NomeCategoria'].'</a><br><small>'.$rs['DescrCategoria'].'</small>';
                        echo '</div>';
                        echo '<div class="col col-md-4">';
                            $x=$rs['CodCategoria'];
                            $sql = "SELECT CodTopic, TitoloTopic, DataTopic
                                    FROM Topics 
                                    WHERE CatTopic = '$x'
                                    ORDER BY DataTopic DESC;";
                            $queryTopic = mysqli_query($connessione1, $sql);
                            if(!$queryTopic)
                                echo 'Errore nella richiesta al DB dei topic';
                            else
                            {
                                if(mysqli_num_rows($queryTopic) == 0)
                                    echo 'Nessun Topic';
                                else
                                {
                                    $t=mysqli_fetch_assoc($queryTopic);
                                    echo '<a href="visioneTopic.php?id='.$t['CodTopic'].'">'.$t['TitoloTopic'].'</a>';
                                }
                            }
                        echo '</div>';
                        echo '<div class="col col-md-3">';
                            $sql = "SELECT P.DataPost
                                    FROM Posts P, Topics T 
                                    WHERE P.TopicPost = T.CodTopic AND
                                          T.CatTopic = '".$rs['CodCategoria']."'
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
                                    echo '<center>'.date('d/m/Y H:i', strtotime($p['DataPost'])).'</center>';
                                }
                            }
                        echo '</div>';
                    echo '</div>';
                }
    ?>
                </div>
            
        </div>
    <?php
            }
        }
        include 'footer.html';
    ?> 
</body>
</html>