<?php
    include("connessione.php");
    session_start();

    $messaggio = "";

    $insert_user = "";
    $insert_email = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $insert_user = mysqli_real_escape_string($conn, $_POST['username']);

        $insert_email = mysqli_real_escape_string($conn, $_POST['email']);

        $insert_password = $_POST['password']; 

        if(!empty($insert_user) && !empty($insert_email) && !empty($insert_password)){

            $query_check = "SELECT * FROM utente 
                            WHERE email='$insert_email' 
                            OR username='$insert_user'";

            $risultato_check = mysqli_query($conn, $query_check);

            if(mysqli_num_rows($risultato_check) > 0){

                $messaggio = "Username o Email già in uso!";

            } else {
                $cript = md5($insert_password);

                $insert = "INSERT INTO utente 
                          (username, email, password, id_ruolo)

                          VALUES 
                          ('$insert_user', 
                           '$insert_email', 
                           '$cript', 
                           1)";
                
                if(mysqli_query($conn, $insert)){

                    $messaggio = "Registrazione completata! Verrai reindirizzato...";

                    $insert_user = "";
                    $insert_email = "";

                } else {

                    $messaggio = "Errore durante la registrazione.";

                }    
            }

        } else {

            $messaggio = "Compila tutti i campi!";

        }
    }
?>

<!DOCTYPE html>

<html lang="it">

    <head>

        <meta charset="UTF-8">

        <title>Registrazione - 🎮 GamingZone</title>

        <link rel="stylesheet" type="text/css" href="style.css" />

        <link rel="icon" type="image/png" href="img_giochi/gaming_zone.png" />

    </head>

    <body>

        <div class="container">

            <h1>Registrazione</h1>

            <p class="intro">
                Crea un account GamingZone per commentare i giochi e accedere alle funzionalità della community.
            </p>

            <div class="login-box">

                <form action="#" method="post">

                    <label>Username</label>

                    <input type="text"
                           name="username"

                           value="<?php echo htmlspecialchars($insert_user); ?>"

                           required />

                    <label>Email</label>

                    <input type="email"
                           name="email"

                           value="<?php echo htmlspecialchars($insert_email); ?>"

                           required />

                    <label>Password</label>

                    <input type="password"
                           name="password"
                           required />

                    <?php
                        if(!empty($messaggio)) {

                            if(strpos($messaggio, 'Registrazione completata') !== false) {
                                echo "<h3 style='color:#22c55e; font-size:0.95em; text-align:center;'>✅ $messaggio</h3>";
                                echo "<meta http-equiv='refresh' content='3;url=login.php'>";
                            } else {

                                echo "<h3 style='color:red; font-size:0.95em; text-align:center;'>⚠️ $messaggio</h3>";

                            }
                        }
                    ?>

                    <input type="submit" value="Registrati" />

                </form>

                <p class="register-link">
                    Hai già un account?
                    <a href="login.php">Accedi qui</a>.
                </p>

            </div>

            <div class="menu">
                <a href="index.php">Torna alla Home</a>
            </div>

        </div>

    </body>

</html>