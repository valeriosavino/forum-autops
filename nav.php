<!--

    File contenente la navbar che verrà mostrata su ogni pagina; A seconda della sessione, verranno visualizzati:
        - 2 bottoni se la sessione non è stata inizializzata;
        - 1 lista dropdown ed 1 bottone altrimenti.

-->

<nav class="navbar navbar-expand-lg sticky-top navbar-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php" title="Pagina Principale"><img src="logo1.png" style="max-width:45px;"></a> <!-- Icona NavBar -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>   <!-- Navbar menù tendina (visibile solamente se la pagina viene ridotta) -->
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" href="index.php">Home</span></a>  
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="categorie.php">Categorie</a> 
                </li>
               <?php
                    // Controllo sessione bottone "Crea Topic"

                    if(isset($_SESSION['entrato']) && $_SESSION['entrato'] == true)
                         echo '<li class="nav-item"><a class="nav-link active" href="creaTopic.php">Crea Topic</a></li>';
                ?>
            </ul>

            <ul class="navbar-nav navbar-right">
                <?php 
                    // Controllo sessione bottoni "Iscriviti/Accedi"
                    if(!(isset($_SESSION['entrato'])))
                    {
                        echo '<li class="nav-item"><a class="nav-link active" href="iscriviti.php">Iscriviti</a></li>';
                        echo '<li class="nav-item"><a class="nav-link active" href="accesso.php">Accedi</a></li>';
                    }
                    else
                    {
                        ?>
                        <!-- Lista dropdown -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Ciao <b><?php echo $_SESSION['username']; ?></b>
                                </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown" style="background-color: #d9edf7; border.color: rgba(51, 51, 51, 1);">
                                <li><a class="dropdown-item" href="account.php">Gestisci Profilo</a></li> 
                                <li><a class="dropdown-item" href="password.php">Cambia password</a></li> 
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="caricamento.php?pg=esci">Esci</a></li> 
                            </ul>
                        </li>
                <?php 
                    } 
                    ?>   
            </ul>
        </div>
    </div>
</nav>