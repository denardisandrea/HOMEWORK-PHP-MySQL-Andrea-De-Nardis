<!DOCTYPE html>
<html lang="it">
    
<?php
    session_start();

    if (isset($_GET['action']) && $_GET['action'] == 'logout') {
        session_destroy(); // Distruggi i dati
        header('Location: '.$_SERVER['PHP_SELF']); // Ricarica la pagina pulita
        exit();
    }
?>
    

    <head>
        <meta charset="UTF-8">
        <title>🎮 GamingZone - Recensioni</title>
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

            <h1>Recensioni degli utenti</h1>

            <p class="intro">
             Leggi cosa pensano gli utenti del sito GamingZone.
            </p>

            <div class="gioco">
                <h2>Lorena</h2>
                <p>⭐ ⭐ ⭐ ⭐ ⭐</p>
                <p>“Sito molto chiaro e facile da usare, mi piace come sono organizzati i giochi.”</p>
            </div>

            <div class="gioco">
                <h2>Gabriele</h2>
                <p>⭐ ⭐ ⭐ ⭐</p>
                <p>“Design semplice ma efficace, ottimo per trovare informazioni sui giochi.”</p>
            </div>

            <div class="gioco">
                <h2>Giulia</h2>
                <p>⭐ ⭐ ⭐ ⭐ ⭐</p>
                <p>“Mi piace molto la sezione dettagli, è ben fatta e interessante.”</p>
            </div>

            <div class="gioco">
                <h2>Andrea</h2>
                <p>⭐ ⭐ ⭐ ⭐</p>
                <p>“Navigazione intuitiva e sito ben strutturato.”</p>
            </div>

            <h2>Lascia un commento</h2>

            <form action="#" method="post">

                <p>
                Nome:<br />
                <input type="text" name="nome" />
                </p>

                <p>
                Commento:<br />
                <textarea name="commento" rows="4" cols="30"></textarea>
                </p>

                <p>
                <input type="submit" value="Invia" />
                </p>

            </form>

            <div class="menu">
                <a href="index.php">Home</a>
                <a href="giochi.php">Giochi</a>
            </div>

        </div>

        <div class="footer">
            <p>
                <a href="contatti.php">Contatti</a> | 
                <a href="privacy.php">Privacy</a>
            </p>
        </div>

    </body>
</html>