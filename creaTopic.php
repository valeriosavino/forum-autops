<!--

    Pagina per la creazione di un nuovo Topic

    $_GET['c'] = Eventuale categoria di provenienza;
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
        // Function per il controllo dei dati del form prima dell'invio al DB
        function controlloForm()
        { 
            $(".alt1").hide();
            $(".alt2").hide();

            var invia=true;

            var titolo = document.datiTopic.titolo.value;
            var contenuto = document.datiTopic.contenuto.value;

            if(titolo.length < 3)
                $(".alt1").css("display","inline-block"),invia=false;

            if(contenuto.length < 2)
                $(".alt2").css("display","inline-block"),invia=false;

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
 
        //Controllo sessione
        if(!(isset($_SESSION['entrato'])))
            echo '<script>window.location.href = "accesso.php"</script>';
        else
        {
            if(isset($_POST["titolo"]) && isset($_POST["categoria"]) && isset($_POST["contenuto"]))
            {
                //inizio transazione
                $partenza = mysqli_query($connessione1, "BEGIN WORK;");
                if(!$partenza)
                {
                    echo 'Errore nella creazione del topic, riprova più tardi';
                }
                else
                {
                    // Inserimento nella tabella Topic nel DB
                    $sql = "INSERT INTO Topics(TitoloTopic, DataTopic, CatTopic, UtTopic)
                            VALUES('".mysqli_real_escape_string($connessione1, $_POST["titolo"])."',
                                    NOW(),
                                    '".mysqli_real_escape_string($connessione1, $_POST["categoria"])."',
                                    '".$_SESSION['cod']."');";
                      
                    $result = mysqli_query($connessione1, $sql);
                    if(!$result)
                    {
                        echo "C'è stato un errore nell'inserimento dei dati, riprova più tardi";
                        $result = mysqli_query($connessione1, "ROLLBACK;");
                    }
                    else
                    {
                        //Prima query del topic andata a buon fine, inserimento nella tabella Post
                        $topicid = mysqli_insert_id($connessione1);
                 
                        $sql = "INSERT INTO Posts(Contenuto, DataPost, TopicPost, UtPost)
                                VALUES('".mysqli_real_escape_string($connessione1, $_POST["contenuto"])."',
                                        NOW(),
                                        '".$topicid."',
                                        '".$_SESSION['cod']."');";

                        $result = mysqli_query($connessione1, $sql);
                        if(!$result)
                        {
                            echo 'Errore nella creazione del post, riprova più tardi';
                            $result = mysqli_query($connessione1, "ROLLBACK;");
                        }
                        else
                        {
                            $result = mysqli_query($connessione1, "COMMIT;");
                            echo '<script>window.location.href = "caricamento.php?id='.$topicid.'&pg=creaTopic";</script>';
                        }
                    }
                }
            }
            else
            {

    ?>
    <!-- Visualizzazione form per la creazione del Topic -->
    <div class="container">
        <center>
            <div class="alert alert-danger alt1">
                <H1><b>X</b></H1>Non puoi inserire un titolo con un solo carattere
            </div>
            <div class="alert alert-danger alt2">
                <H1><b>X</b></H1>Non puoi inserire un post con un solo carattere
            </div>
        </center>
        <div class="mb-4">
            <div class="panel-heading panel-heading-input">
                <center><h3 class="panel-title">Crea un topic</h3></center>
            </div>
                <div class="panel-body panel-body-input">
                    <div class="container" style="margin-top: 20px;">
                        <form name="datiTopic" method="post" onsubmit="return controlloForm();" action="#">
                            <div class="row row-no-line">
                                <div class="col-md-2" style="margin-top: 4px;"><h5><b>Titolo topic:</b></h5></div>
                                <div class="col-md-10"><input type="text" name="titolo" class="form-control" maxlength="255" required></div>
                            </div>
                            <br>
                            <div class="mb-3 row row-no-line">
                                <div class="col-md-2" style="margin-top: 4px;"><h5><b>Categoria:</b></h5></div>
                                <div class="col-md-10">
                                <?php
                                    $queryCat = mysqli_query($connessione1, "SELECT CodCategoria, NomeCategoria FROM Categorie");
                                    if(!$queryCat)
                                        echo 'Errore nella richiesta al DB delle categorie';
                                    else
                                    {
                                        if(mysqli_num_rows($queryCat) == 0)
                                            echo 'Non sono presenti categorie al momento';
                                        else
                                        {
                                            $select = '<select class="form-select" name="categoria" required>';
                                            while($rs=mysqli_fetch_assoc($queryCat))
                                            {
                                                if(isset($_GET['c']) && $rs['CodCategoria'] == $_GET['c'])
                                                    $select.= '<option value = "'.$rs['CodCategoria'].'" selected>'.$rs['NomeCategoria'].'</option>';
                                                else
                                                    $select.= '<option value = "'.$rs['CodCategoria'].'">'.$rs['NomeCategoria'].'</option>';
                                            }
                                            $select.='</select>';
                                            echo $select;
                                        }
                                    }
                                ?>
                                </div>
                            </div>
                            <div class="mb-4">
                                <h5><b>Messaggio:</b></h5>
                                <textarea class="form-control" rows="3" name="contenuto" required></textarea>
                            </div>
                            <div class="mb-4 col-md-6 offset-md-3">
                                <input type="submit" class="btn btn-primary col-md-12" value="Crea topic!">
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