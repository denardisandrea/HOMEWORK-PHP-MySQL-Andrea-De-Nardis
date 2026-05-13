<!DOCTYPE html>
<html lang="it">


<?php
    include("connessione.php");
    session_start();

    if (isset($_GET['action']) && $_GET['action'] == 'logout') {
        session_destroy(); // Distruggi i dati
        header('Location: '.$_SERVER['PHP_SELF']); // Ricarica la pagina pulita
        exit();
    }
?>
   
    <head>
        <meta charset="UTF-8">
        <title>🎮 GamingZone - Giochi 2026</title>
        <link rel="stylesheet" type="text/css" href="style.css" />
        <link rel="icon" type="image/png" href="img_giochi/gaming_zone.png" />
    </head>

    <body>

         <div class="user-box">
            <?php
            if(isset($_SESSION['userName'])) {
                echo "<span class='user-name'>👤 " . $_SESSION['userName'] . "</span>";
                echo '<a class="logout-btn" href="' .$_SERVER['PHP_SELF']. '?action=logout">Logout</a>';
            } else {
                echo '<a href="login.php">Login</a>';
            }
            ?>
        </div>

        <div class="container">

            <h1>Esplora il mondo dei videogiochi</h1>

            <p class="intro">
             Scopri le ultime novità, recensioni e anticipazioni sui giochi più attesi del 2026.
             Non perderti le ultime uscite e le novità in arrivo sui tuoi titoli preferiti.
            </p>

            <h2>Giochi in evidenza</h2>


        </div>

        <div class="container">
            <?php
                $query = "SELECT * FROM gioco";
                $risultato = mysqli_query($conn, $query);

                if(mysqli_num_rows($risultato) > 0){
                    while($riga = mysqli_fetch_assoc($risultato)) {
                        ?>
                        <a class="gioco" href="dettaglio.php?id=<?php echo $riga['id']; ?>" style="text-decoration: none; color: inherit;">
                            <div>
                                <img src="<?php echo $riga['immagine']; ?>" alt="<?php echo $riga['titolo']; ?>" class="img_giochi" />
                                
                                <h2><?php echo $riga['titolo']; ?></h2>

                                <p><strong>PEGI:</strong> <?php echo $riga['pegi']; ?></p>
                                
                                <p><strong>Sviluppatore:</strong> <?php echo $riga['sviluppatore']; ?></p>

                                <div class="preorder">
                                    Vai ai dettagli
                                </div>
                            </div>
                        </a>
                        <?php
                    }
                } else {
                    echo "<p>Nessun gioco disponibile al momento.</p>";
                }
            ?>
        </div>

            <div class="menu">
                <a href="index.php">Home</a>
                <a href="forum.php">Recensioni</a>
            </div>

        

        <div class="footer">
            <p>
                <a href="contatti.php">Contatti</a> | 
                <a href="privacy.php">Privacy</a>
            </p>
        </div>
        
    </body>
</html>