<!--

    Pagina iniziale del sito

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
    ?>
    <div class="container">
        <div class="p-5 mb-4 rounded-3" style="background-color: #bce8f1; ">
            <div class="container">
                <center>
                    <h1 class="display-3">Benvenuto nel forum AutoPS!</h1>
                <?php
                    // Controllo sessione; Nel caso in cui l'utente non è entrato, visualizzerà i 2 bottoni "Accedi" e "Iscriviti"
                    if(!isset($_SESSION['entrato']) || $_SESSION['entrato'] == false) 
                    {
                ?>
                    <h5 style="margin-top: 10px;">Clicca su "Iscriviti" o "Accedi" per partecipare alle discussioni</h5>
                    <p style="margin-bottom: 30px; margin-top: 20px;">
                        <a href="iscriviti.php" class="btn btn-danger btn-lg" role="button">Iscriviti</a> 
                        <a href="accesso.php" class="btn btn-danger btn-lg" role="button">Accedi</a> 
                    </p>
                    <hr>
                <?php
                    }
                ?>
                    <h5 style="margin-top: 10px;">Esplora le categorie e i topic del sito</h5>
                    <p style="margin-top: 20px;"><a href="categorie.php" class="btn btn-primary btn-lg" role="button">Visualizza Categorie</a></p> 
                </center>
            </div>
        </div>
        <br>
        <!-- Visualizzazione "call to action" con relativa descrizione del sito -->
        <div class="col-sm-12">
            <div class="bs-calltoaction bs-calltoaction-default" style="background-color: white;">
                <div class="row row-no-line">
                    <div class="col-md-2 cta-contents">
                        <h1 class="cta-img"><img src="logo1.png"></h1>
                    </div>
                    <div class="col-md-10 cta-text">
                        <h3>Una piccola descrizione...</h3>
                        <p>AutoPS è un forum dove puoi condividere tutte le tue conoscenze sulle auto e discutere delle tue opinioni in modo libero. Esplora le categorie, crea nuovi topic e partecipa alle discussioni!</p>
                    </div>
                </div>
            </div>
        </div>
        <br>
    </div>
    <?php
        include 'footer.html';
    ?>
</body>
</html>