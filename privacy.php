<!--

    Pagina per la visualizzazione dell'informativa della privacy (=Trattamento dei dati personali)

-->
<?php
    session_start();
?>
<html>
<head>
    <?php
        require 'imports.html';
    ?>
    <style>
        .col
        {
            margin-left: 10px;
            margin-right: 10px;                     /* Riaddattamento della classe "col" */
            text-align: justify;
        }
        .col>li
        {
            font-weight: bold;                     /* Riaddattamento del tag <li> all'interno della classe "col" */
        }
    </style>
</head>
<body class="d-flex flex-column h-100">
	<?php
        include 'nav.php'; 
        require 'connessioneDB.php';
    ?>
    <!-- Visualizzazione trattamento dati personali -->
    <div class="container" style="margin-bottom: 30px; position: relative;">
        <div class="panel-heading panel-heading-view">
            <center><p class="panel-title"><font size="6">Privacy</font></p></center>
        </div>
        <div class="panel-body panel-body-view" style="border-top: 0px solid #bce8f1; color: black;">
            <div class="row row-no-line">
                <div class="col">
                    I dati personali forniti con la registrazione o successivamente raccolti sono trattati secondo quanto disposto dal GDPR 2018 ("General Data Protection Regulation"), che prevede la tutela delle persone e di altri soggetti rispetto al trattamento dei dati personali. Secondo la normativa indicata, tale trattamento sarà improntato ai principi di correttezza, liceità e trasparenza e di tutela della riservatezza e dei diritti dell'utente.<br>
                    Ai sensi del GDPR 2018, pertanto, il Gestore fornisce le seguenti informazioni:
                </div>
            </div>
            <ol>
                <div class="row row-no-line">
                    <div class="col"><li>Legge</li></div>
                </div>
                <div class="row row-no-line">
                    <div class="col">
                        I dati raccolti sono quelli riportati nella pagina del proprio profilo, cioè:
                        <ul>
                            <li>username</li>
                            <li>password (memorizzata in modalità codificata)</li>
                            <li>indirizzo e-mail</li>
                            <li>modello di auto</li>
                        </ul>
                    </div>
                </div>
                <div class="row row-no-line">
                    <div class="col"><li>Legge</li></div>
                </div>
                <div class="row row-no-line">
                    <div class="col">Il trattamento sarà effettuato con le seguenti modalità: manuale e informatizzato. Il conferimento dei dati è obbligatorio e l'eventuale rifiuto a fornire tali dati comporta la mancata registrazione al sito.</div>
                </div>
                <div class="row row-no-line">
                    <div class="col"><li>Legge</li></div>
                </div>
                <div class="row row-no-line">
                    <div class="col">Il titolare del trattamento è: AutoPS S.r.l., con sede legale in Varco Via Brombeis 12, 80135 Napoli (NA).</div>
                </div>
                <div class="row row-no-line">
                    <div class="col"><li>Legge</li></div>
                </div>
                <div class="row row-no-line">
                    <div class="col"> Il responsabile del trattamento è il Signor Giampiero Mughini.</div>
                </div>
                <div class="row row-no-line">
                    <div class="col"><li>Legge</li></div>
                </div>
                <div class="row row-no-line">
                    <div class="col"> In ogni momento, l'utente potrà esercitare i diritti nei confronti del titolare del trattamento (accesso, cancellazione, limitazione del trattamento), scrivendo a: AutoPS S.r.l., Varco Via Brombeis 12, 80135 Napoli (NA), via mail a "info@autops.it".</div>
                </div>
                <div class="row row-no-line">
                    <div class="col"><li>Legge</li></div>
                </div>
                <div class="row row-no-line">
                    <div class="col">I dati verranno conservati per tutto il tempo in cui l'utente resterà registrato al sito e saranno cancellati nel momento in cui l'utente richiederà la cancellazione dallo stesso.</div>
                </div>
            </ol>
        </div> 
    </div>
    <?php
        include 'footer.html';
    ?>
</body>
</html>