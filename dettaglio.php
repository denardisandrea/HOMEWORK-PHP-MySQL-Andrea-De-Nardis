<?php
    include("connessione.php");
    session_start();
    mysqli_set_charset($conn, "utf8");

    if (isset($_GET['action']) && $_GET['action'] == 'logout') {
        session_destroy();
        header('Location: index.php');
        exit();
    }

    $id_gioco = isset($_GET['id']) ? mysqli_real_escape_string($conn, $_GET['id']) : 0;

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['invia_commento'])) {
        
        if (isset($_SESSION['id_utente'])) {
            $testo = mysqli_real_escape_string($conn, $_POST['testo_commento']);
            $id_utente = $_SESSION['id_utente'];

            $query_check = "SELECT id FROM commento WHERE id_utente = '$id_utente' AND id_gioco = '$id_gioco'";
            $res_check = mysqli_query($conn, $query_check);

            if (mysqli_num_rows($res_check) == 0) {
                if (!empty($testo)) {
                    $insert = "INSERT INTO commento (testo, id_utente, id_gioco) VALUES ('$testo', '$id_utente', '$id_gioco')";
                    mysqli_query($conn, $insert);
                    header("Location: dettaglio.php?id=$id_gioco");
                    exit();
                }
            }
        }
    }

    $query_gioco = "SELECT * FROM gioco WHERE id = '$id_gioco'";
    $risultato_gioco = mysqli_query($conn, $query_gioco);
    $gioco = mysqli_fetch_assoc($risultato_gioco);
?>

<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="UTF-8">
        <title>🎮 Dettagli - GamingZone</title>
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
        <?php if($gioco): ?>
            <h1><?php echo $gioco['titolo']; ?></h1>
            
            <div class="gioco-dettaglio" style="display: flex; gap: 20px; text-align: left; background: rgba(2, 6, 23, 0.8); padding: 20px; border-radius: 10px; border: 1px solid #38bdf8;">
                <img src="<?php echo $gioco['immagine']; ?>" style="width: 200px; border-radius: 8px;">
                <div>
                    <p><?php echo $gioco['descrizione']; ?></p>
                    <p><strong>Sviluppatore:</strong> <?php echo $gioco['sviluppatore']; ?></p>
                </div>
            </div>

            <hr style="border: 1px solid #38bdf8; margin: 40px 0;">

            <div class="sezione-commenti" style="text-align: left;">
                <h2>Commenti della Community</h2>

                <?php 

                if (isset($_SESSION['userName'])) {
                    $id_u = $_SESSION['id_utente'];
                    $check_u = mysqli_query($conn, "SELECT id FROM commento WHERE id_utente = '$id_u' AND id_gioco = '$id_gioco'");
                    
                    if (mysqli_num_rows($check_u) == 0) {
                        ?>
                        <div class="form-commento" style="margin-bottom: 30px;">
                            <form action="" method="POST">
                                <textarea name="testo_commento" placeholder="Scrivi la tua recensione..." required style="width: 100%; height: 80px; background: #1e293b; color: white; border: 1px solid #38bdf8; border-radius: 8px; padding: 10px;"></textarea>
                                <input type="submit" name="invia_commento" value="Pubblica Commento" style="margin-top: 10px; width: auto; padding: 10px 20px;">
                            </form>
                        </div>
                        <?php
                    } else {
                        echo '<p style="color: #22c55e;">✨ Hai già lasciato una recensione per questo gioco.</p>';
                    }
                } else {
                    echo '<p>👉 <a href="login.php">Accedi</a> per lasciare un commento.</p>';
                }
                ?>

                <div class="lista-commenti">
                    <?php
                    $query_comm = "SELECT commento.testo, utente.username 
                                   FROM commento 
                                   JOIN utente ON commento.id_utente = utente.id
                                   WHERE commento.id_gioco = '$id_gioco'";
                    $ris_comm = mysqli_query($conn, $query_comm);

                    if (mysqli_num_rows($ris_comm) > 0) {
                        while($comm = mysqli_fetch_assoc($ris_comm)) {
                            ?>
                            <div class="box-commento" style="background: rgba(30, 41, 59, 0.5); padding: 15px; border-radius: 8px; margin-bottom: 15px; border-left: 4px solid #22c55e;">
                                <strong style="color: #38bdf8;">@<?php echo $comm['username']; ?></strong>
                               <p style="font-size: 1em; margin-top: 5px; white-space: pre-wrap;"><?php echo htmlspecialchars($comm['testo']); ?></p>
                            </div>
                            <?php
                        }
                    } else {
                        echo '<p style="color: #94a3b8;">Nessun commento presente. Sii il primo a scrivere!</p>';
                    }
                    ?>
                </div>
            </div>
        <?php else: ?>
            <p>Gioco non trovato.</p>
        <?php endif; ?>
    </div>

    <div class="menu" style="margin-top: 50px;">
        <a href="index.php">Home</a>
        <a href="giochi.php">Giochi</a>
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