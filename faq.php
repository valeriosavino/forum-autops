<!--

    Pagina per la visualizzazione delle domande frequenti (=FAQ)

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
            margin-left: 5px;
            margin-right: 5px;              /* Riaddattamento della classe "col" */
            text-align: justify;
        }
        .col>li
        {
            font-weight: bold;              /* Riaddattamento del tag <li> all'interno della classe "col" */
        }
    </style>
</head>
<body class="d-flex flex-column h-100">
	<?php
        include 'nav.php'; 
        require 'connessioneDB.php';
    ?>
    <!-- Visualizzazione domande frequenti -->
    <div class="container" style="margin-bottom: 30px; position: relative;">
        <div class="panel-heading panel-heading-view">
            <center><p class="panel-title"><font size="6">Domande frequenti</font></p></center>
        </div>
        <div class="panel-body panel-body-view" style="border-top: 0px solid #bce8f1; color: black;">
            <ul>
                <div class="row row-no-line">
                    <div class="col">
                        <li><big>Che cosa è AutoPS?</big></li>
                    </div>
                </div>
                <div class="row row-no-line">
                    <div class="col">È un forum all'interno del quale puoi porre domande e rispondere ad altre persone sul mondo delle auto.</div>
                </div>
                <div class="row row-no-line">
                    <div class="col">
                        <li><big>Perché non riesco a registrarmi?</big></li>
                    </div>
                </div>
                <div class="row row-no-line">
                    <div class="col">Controlla se al momento della registrazione tutti i dati siano stati inseriti correttamente e che la check al trattamento dei dati e l'età sia stata spuntata. In caso contrario, verranno mostrati dei messaggi di errore. </div>
                </div>
                <div class="row row-no-line">
                    <div class="col">
                        <li><big>Mi sono registrato ma non riesco a connettermi!</big></li>
                    </div>
                </div>
                <div class="row row-no-line">
                    <div class="col">Probabilmente hai problemi di connessione oppure il database del sito è in manutenzione/non è connesso alla rete. Se cosi non fosse, riprova a effettuare l'accesso nell'apposita pagina con username e password scelti al momento della registrazione.</div>
                </div>
                <div class="row row-no-line">
                    <div class="col">
                        <li><big>Posso rispondere ai post senza registrarmi?</big></li>
                    </div>
                </div>
                <div class="row row-no-line">
                    <div class="col">No, non è possibile, occorre essere registrati.</div>
                </div>
                <div class="row row-no-line">
                    <div class="col">
                        <li><big>Posso creare più di un account?</big></li>
                    </div>
                </div>
                <div class="row row-no-line">
                    <div class="col">Si, basta che abbiano username diversi.</div>
                </div>
                <div class="row row-no-line">
                    <div class="col">
                        <li><big>Vorrei cambiare la mia password, come posso fare?</big></li>
                    </div>
                </div>
                <div class="row row-no-line">
                    <div class="col">È possibile cambiare la password in un pagina apposita dopo aver effettuato l'accesso, raggiungibile attraverso un bottone di una lista sulla navbar.</div>
                </div>
                <div class="row row-no-line">
                    <div class="col">
                        <li><big>Come posso cambiare i miei dati?</big></li>
                    </div>
                </div>
                <div class="row row-no-line">
                    <div class="col">È possibile cambiare i propri dati attraverso una pagina apposita dopo aver effettuato l'accesso, raggiungibile attraverso un bottone di una lista sulla navbar.</div>
                </div>
                <div class="row row-no-line">
                    <div class="col">
                        <li><big>Posso eliminare il mio account?</big></li>
                    </div>
                </div>
                <div class="row row-no-line">
                    <div class="col">Si, è possibile eliminare il proprio account attraverso una pagina apposita dopo aver effettuato l'accesso e aver inserito nuovamente la propria password. A seguito di ciò, tutti i tuoi post e i tuoi dati saranno cancellati dal database.</div>
                </div>
                <div class="row row-no-line">
                    <div class="col">
                        <li><big>Come apro un argomento/topic o invio un messaggio in un forum?</big></li>
                    </div>
                </div>
                <div class="row row-no-line">
                    <div class="col">Ci sono 2 vie possibili per creare un topic:<br>La prima è cliccare sul bottone "Crea Topic" della Navbar; dopodichè, si potrà scegliere la categoria corrispondente per quel Topic.<br>La seconda via è visibile solo se la categoria è vuota; in tal caso, l'utente (registrato) potrà cliccare direttamente al link per creare il primo topic della categoria corrispondente.<br>Per rispondere ai vari post/messaggi, basta cliccare direttamente il link "Rispondi" presente a destra di ogni Post.</div>
                </div>
                <div class="row row-no-line">
                    <div class="col">
                        <li><big>Come posso modificare o eliminare le mie risposte/post?</big></li>
                    </div>
                </div>
                <div class="row row-no-line">
                    <div class="col">È possibile modificare o eliminare i propri post/risposte attraverso dei link appositi a destra del proprio post/risposta.</div>
                </div>
                <div class="row row-no-line">
                    <div class="col">
                        <li><big>Perché non visualizzo più il mio post/risposta?</big></li>
                    </div>
                </div>
                <div class="row row-no-line">
                    <div class="col">È possibile che sia stato cancellato da un moderatore o che l'abbia cancellato tu stesso.</div>
                </div>
                <div class="row row-no-line">
                    <div class="col">
                        <li><big>Se una categoria è vuota, cosa visualizzo?</big></li>
                    </div>
                </div>
                <div class="row row-no-line">
                    <div class="col">Comparirà un messaggio avvertendoti che non ci sono topic disponibili in quella determinata categoria e (Solo se sei registrato) un link per creare un topic (in questo caso il primo) nella categoria.</div>
                </div>
                <div class="row row-no-line">
                    <div class="col">
                        <li><big>Posso modificare, aggiungere o eliminare le categorie?</big></li>
                    </div>
                </div>
                <div class="row row-no-line">
                    <div class="col">No, non è possibile. Le categorie sono state create appositamente dagli sviluppatori del forum.</div>
                </div>
                <div class="row row-no-line">
                    <div class="col">
                        <li><big>Come posso capire chi sono i moderatori del forum?</big></li>
                    </div>
                </div>
                <div class="row row-no-line">
                    <div class="col">All'interno dei topic gli utenti contrassegnati da &starf; sono i moderatori del forum.</div>
                </div>
                <div class="row row-no-line">
                    <div class="col">
                        <li><big>Posso diventare moderatore del forum?</big></li>
                    </div>
                </div>
                <div class="row row-no-line">
                    <div class="col">A meno di eventuali scelte da parte dei creatori del forum o dello staff, non è possibile diventare moderatore in nessun altro modo.</div>
                </div>
                <div class="row row-no-line">
                    <div class="col">
                        <li><big>Come posso capire se un topic è attivo?</big></li>
                    </div>
                </div>
                <div class="row row-no-line">
                    <div class="col">È presente un numero risposte e la data dell'ultimo post nella visualizzazione della categoria per ogni topic; se ha molte risposte e la data dell'ultimo post è relativamente recente, il topic è attivo.</div>
                </div>
            </ul>
        </div> 
    </div>
    <?php
        include 'footer.html';
    ?>
</body>
</html>