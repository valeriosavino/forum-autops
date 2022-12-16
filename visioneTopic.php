<!--

    Pagina per la visualizzazione dei post del topic selezionato

    $_GET['id'] = Id del topic di provenienza;

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

        /* 

            Funzione ricorsiva per la visualizzazione indentata dei vari post:
                $commenti = Matrice contenente i dati delle risposte di un post ad un altro (Riga = Id risposta; Colonna = Id codice post); 
                $c = Categoria del Topic;
                $rispostaPost = Id del post da rispondere;
                $m = Margine da settare per ogni risposta.

        */
        function getPost(&$commenti, $c, $rispostaPost=0, $m=0)
        {
            //caso base ricorsione
            if (!isset($commenti[$rispostaPost])) 
                return "";

            foreach($commenti[$rispostaPost] as $curid => $post) // Cicliamo la matrice partendo dalla risposta e, dai vari id ($curid), prendiamo i dati ($post)
            {
                echo '<div class="row row-no-line">';
                if($m == 0)
                    echo '<div class="col col-md-3" style="margin-left: '.$m.'px;">'; 
                else
                    echo '<div class="col col-md-3" style="margin-left: '.$m.'px; border-left: 1px solid #cacaca;">';
                        if($post["AutorizzazioneUtente"] == 1) 
                            echo '<b>'.$post["NomeUtente"].'&starf; </b> · ';
                        else 
                            echo '<b>'.$post["NomeUtente"].'</b> · ';
                        echo date('d/m/Y H:i', strtotime($post["DataPost"])).'<br>'.$post["NomeModello"];
                    echo "</div>";

                    echo '<div class="col" style="margin-left: '.$m.'px; white-space: pre-wrap;">';
                        echo $post['Contenuto'].'<br><p style="text-align: right;">';
                        if($post["Contenuto"] != "*messaggio eliminato*")
                        {
                            if(isset($_SESSION['entrato']) && $_SESSION['entrato'] == true)
                                echo '<a href="risposta.php?id='.$post['CodPost'].'&id2='.$post['TopicPost'].'"><small>Rispondi</small></a>';
                            else 
                                echo '<a href="accesso.php?id='.$post['TopicPost'].'"><small>Rispondi</small></a>';
                            if(isset($_SESSION['cod']) && $_SESSION['cod'] == $post['UtPost'])
                                echo ' | <a href="modificaPost.php?id='.$post['CodPost'].'&id2='.$post['TopicPost'].'"><small>Modifica Post</small></a>';
                            if(isset($_SESSION['autorizzazione']) && isset($_SESSION['cod']) && ($_SESSION['autorizzazione'] == 1 || $_SESSION['cod'] == $post['UtPost']))
                            {
                                echo ' | <a href="eliminaPostTopic.php?id='.$post['CodPost'].'&id2='.$post['TopicPost'].'&risp='.$post['RispostaPost'].'&cat='.$c.'">';
                                if($post['RispostaPost'] == 0) 
                                    echo '<small>Elimina Topic</small></a>';
                                else 
                                    echo '<small>Elimina Post</small></a>';
                            }
                        }
                    echo "</p></div>";
                echo "</div>";
                getPost($commenti, $c, $curid, $m+30);
            }
        }

        $sql = "SELECT CodTopic, TitoloTopic, CatTopic
        		FROM Topics
        		WHERE CodTopic = '".mysqli_real_escape_string($connessione1, $_GET['id'])."'";

        $query = mysqli_query($connessione1, $sql);
        if(!$query)
        	echo 'Errore nella richiesta al DB dei Topic';
        else
        {
            if(mysqli_num_rows($query) == 0)
                echo 'Questo topic non esiste';
            else
            { 
                while($row = mysqli_fetch_assoc($query))
                {
                    $c = $row['CatTopic'];
    ?>
            <div class="container" style="margin-bottom: 30px; position: relative;">
                <div class="panel-heading panel-heading-view">
                    <center><p class="panel-title"><font size="6"><?php echo $row['TitoloTopic']; ?></font></p></center>
                </div>
    <?php 
                }  
                
                $sql = "SELECT P.CodPost, P.TopicPost, P.Contenuto, P.RispostaPost, P.DataPost, P.UtPost, U.CodUtente, U.NomeUtente, M.NomeModello, U.AutorizzazioneUtente
                        FROM Posts P, Utenti U, Modelli M
                        WHERE P.UtPost = U.CodUtente AND
                              U.ModUtente = M.CodModello AND
                              P.TopicPost = '".mysqli_real_escape_string($connessione1, $_GET['id'])."'
                        ORDER BY DataPost";
                        
                $query = mysqli_query($connessione1, $sql);
                if(!$query)
                    echo 'Errore nella richiesta dei post del topic';
                else
                {
                    if(mysqli_num_rows($query) == 0)
                        echo 'Non sono presenti posts in questo topic</div>';
                    else
                    {
                        echo '<div class="panel-body panel-body-view" style="border-top: 0px solid #bce8f1; color: black;">';

                        // Salviamo le varie righe all'interno della matrice $commenti
                        while($row = mysqli_fetch_assoc($query))
                            $commenti[$row["RispostaPost"]][$row["CodPost"]] = $row;
                        
                        // Richiamo alla funzione ricorsiva
                        getPost($commenti, $c);

                        echo '</div>';    
                    }
                            
                }
            echo '</div>';
            }
        }
        include 'footer.html';
    ?>
</body>
</html>