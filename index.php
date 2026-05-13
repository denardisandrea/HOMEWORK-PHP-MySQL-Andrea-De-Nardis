<!DOCTYPE html>
<html lang="it">

<?php
    session_start();

    if (isset($_GET['action']) && $_GET['action'] == 'logout') {
        session_destroy();
        header('Location: '.$_SERVER['PHP_SELF']);
        exit();
    }
?>

    <head>
        <meta charset="UTF-8">
        <title>🎮 GamingZone</title>
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

            <h1>GamingZone</h1>

            <p class="intro">
             Benvenuto su GamingZone, il tuo punto di riferimento per tutto ciò che riguarda il mondo dei videogiochi! 
             Scopri i titoli più attesi del 2026, leggi le recensioni e resta aggiornato sulle ultime novità.
            </p>

            <div class="hero">
                <img src="img_giochi/gaming_zone.png" alt="gaming" />
            </div>

            <div class="menu">
                <a href="giochi.php">Giochi</a>
                <a href="forum.php">Recensioni</a>
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