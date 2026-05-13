<?php
    include("connessione.php");
    session_start();

    $errore = "";

    if(isset($_POST['invio'])) { 
        $user = mysqli_real_escape_string($conn, $_POST['userName']);
        $pass = $_POST['password']; 
        
        $query = "SELECT * FROM utente WHERE username = '$user' OR email = '$user'";
        $risultato = mysqli_query($conn, $query);

        if($risultato && mysqli_num_rows($risultato) > 0) {
            $riga = mysqli_fetch_assoc($risultato);
            $cript = md5($pass);
            
            if($cript == $riga['password']) {
                $_SESSION['id_utente'] = $riga['id'];
                $_SESSION['userName'] = $riga['username'];
                $_SESSION['id_ruolo'] = $riga['id_ruolo'];

                header("Location: index.php");
                exit();
            } else {
                $errore = "Password errata!";
            }
        } else {
            $errore = "Utente non trovato!";
        }
    }
?>

<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="UTF-8">
        <title>Login - 🎮 GamingZone</title>
        <link rel="stylesheet" href="style.css" />
        <link rel="icon" type="image/png" href="img_giochi/gaming_zone.png" />
    </head>

    <body>
        <div class="container">
            <h1>Login</h1>

            <p class="intro">
                Accedi al tuo account GamingZone per lasciare recensioni e interagire con la community.
            </p>

            <div class="login-box">
                <form id="loginForm" action="#" method="POST">
                    <label for="username">Username o Email</label>
                    <input type="text"
                        name="userName"
                        value="<?php echo isset($_POST['userName']) ? htmlspecialchars($_POST['userName']) : ''; ?>"
                        id="username"
                        required
                    />

                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required />

                    <?php
                        if(!empty($errore)) {
                            echo "<h3 style='color:red; font-size: 0.9em;'>⚠️ $errore</h3>";
                        }  
                    ?>
                    
                    <input type="submit" name="invio" value="Accedi" />
                </form>

                <p class="register-link">
                    Non hai un account? <a href="register.php">Registrati qui</a>.
                </p>
            </div>

            <div class="menu">
                <a href="index.php">Torna alla Home</a>
            </div>
        </div>
    </body>
</html>