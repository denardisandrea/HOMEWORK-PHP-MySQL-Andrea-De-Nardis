<?php
$host = "localhost";
$user = "root";
$pass = "";
$db_name = "Andrea.DeNardis.PHP-MySQL";

$conn = mysqli_connect($host, $user, $pass);

if (!$conn) {
    die("Connessione fallita: " . mysqli_connect_error());
}

$check_db = mysqli_query($conn, "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$db_name'");

if (mysqli_num_rows($check_db) > 0) {
    mysqli_select_db($conn, $db_name);
    echo "Database esistente trovato.<br>";
    
    $query_se_esiste = "SELECT * FROM gioco LIMIT 1"; 
    mysqli_query($conn, $query_se_esiste);

} else {
    echo "Database non trovato. Inizio installazione completa con tutti i dati...<br>";
    
    mysqli_query($conn, "CREATE DATABASE `$db_name` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_bin");
    mysqli_select_db($conn, $db_name);

    mysqli_query($conn, "SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO'");

    $setup_queries = [
        "CREATE TABLE `ruolo` (
          `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
          `testo` varchar(32) NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin",

        "CREATE TABLE `gioco` (
          `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
          `titolo` varchar(255) NOT NULL,
          `descrizione` varchar(8192) NOT NULL,
          `pegi` int(2) NOT NULL,
          `sviluppatore` varchar(512) NOT NULL,
          `immagine` varchar(255) NOT NULL,
          `link` varchar(1024) NOT NULL,
          `data_rilascio` date NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin",

        "CREATE TABLE `utente` (
          `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
          `username` varchar(128) NOT NULL UNIQUE,
          `email` varchar(255) NOT NULL UNIQUE,
          `password` varchar(32) NOT NULL,
          `id_ruolo` int(11) NOT NULL,
          CONSTRAINT `utente_ibfk_1` FOREIGN KEY (`id_ruolo`) REFERENCES `ruolo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin",

        "CREATE TABLE `commento` (
          `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
          `testo` varchar(1024) NOT NULL,
          `id_utente` int(11) NOT NULL,
          `id_gioco` int(11) NOT NULL,
          CONSTRAINT `commento_ibfk_1` FOREIGN KEY (`id_utente`) REFERENCES `utente` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
          CONSTRAINT `commento_ibfk_2` FOREIGN KEY (`id_gioco`) REFERENCES `gioco` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin",

        "INSERT INTO `ruolo` (`id`, `testo`) VALUES (0, 'admin'), (1, 'cliente')",

        "INSERT INTO `gioco` (`id`, `titolo`, `descrizione`, `pegi`, `sviluppatore`, `immagine`, `link`, `data_rilascio`) VALUES
        (2, 'Grand Theft Auto VI', 'Vice City, Stati Uniti.\\r\\n\\r\\nJason e Lucia sanno da sempre che la vita non ha dato loro le carte migliori. Quando, però, un lavoro semplice va per il verso sbagliato, si ritrovano nella parte più oscura del luogo più soleggiato d\'America, invischiati in una cospirazione criminale che si estende in tutto lo Stato della Leonida. Se vogliono sopravvivere saranno costretti a contare più che mai l’uno sull’altra.', 18, 'Rockstar Games', 'img_giochi/gta-vi.png', 'https://www.rockstargames.com/VI', '2026-11-19'),
        (3, 'Marvel\'s Wolverine', 'Da Insomniac Games, sviluppatore dell\'acclamata serie Marvel\'s Spider-Man , arriva Marvel\'s Wolverine.\\r\\n\\r\\nPer svelare i segreti del suo passato, Wolverine è disposto a tutto. I suoi artigli e la sua furia riusciranno a squarciare il velo che cela l\'uomo che era un tempo? \\r\\n\\r\\nSviluppato in collaborazione con Marvel Games e Sony Interactive Entertainment, Marvel\'s Wolverine è in arrivo su console PlayStation®5 nell\'autunno 2026.', 18, 'Sony', 'img_giochi/wolverine_game.png', 'https://www.playstation.com/it-it/games/marvels-wolverine/', '2026-09-15'),
        (4, '007 First Light', 'Segui James Bond durante i suoi anni da giovane recluta avventata ma piena di risorse nel programma di addestramento dell\'MI6.\\r\\n\\r\\nDopo un atto eroico, al giovane aviere della Marina Bond viene offerta l\'opportunità di unirsi al programma Doppio Zero, rilanciato da poco.\\r\\n\\r\\nMa quando una missione per fermare un agente ribelle si conclude in tragedia, deve unirsi al suo riluttante mentore Greenway per smascherare un complotto inquietante e fermare un imminente golpe nel cuore dello Stato.\\r\\n\\r\\nImmergiti completamente in un mondo di inganni e pericoli, alimentato dal motore proprietario di IO Interactive, Glacier.', 18, 'IO Interactive', 'img_giochi/first-light-007.png', 'https://www.playstation.com/it-it/games/007-first-light/', '2026-05-27'),
        (5, 'Gears of War: E-Day', 'La storia dell\'E-Day\\r\\nQuattordici anni prima di Gears of War, gli eroi di guerra Marcus Fenix e Dom Santiago tornano a casa per affrontare un nuovo incubo: l\'Orda delle Locuste. Questi mostri sotterranei, grotteschi e implacabili, emergono dal basso, mettendo sotto assedio il genere umano.\\r\\n\\r\\nNuove basi\\r\\nSviluppato da zero con Unreal Engine 5, Gears of War: E-Day offre una precisione grafica senza precedenti.', 18, 'Xbox Game Studios', 'img_giochi/gears-of-war-eday.jpg', 'https://www.xbox.com/it-IT/games/gears-of-war-eday', '2026-12-31')",

        "INSERT INTO `utente` (`id`, `username`, `email`, `password`, `id_ruolo`) VALUES
        (10, 'Andrea', 'andrea.andrei415@gmail.com', '4d8dd2e8a3fbfd25f71c43385afa7ca0', 0),
        (11, 'Gabriele', 'gabryfoletto28@gmail.com', 'ccf3eca233b67623d3a291830de886b4', 0),
        (12, 'Luca', 'lucadeluchi@gmail.com', 'b556f226100c3f4055f4e8dda73c1858', 1),
        (13, 'Matteo', 'matteomattei@gmail.com', '405c22438e8763df273ecab796667beb', 1)",

        "INSERT INTO `commento` (`id`, `testo`, `id_utente`, `id_gioco`) VALUES
        (7, 'DAJE\\r\\n\\r\\nDAJE\\r\\n\\r\\nDAJE DAJE', 10, 2)"
    ];

    foreach ($setup_queries as $sql) {
        if (!mysqli_query($conn, $sql)) {
            echo "Errore query: " . mysqli_error($conn) . "<br>";
        }
    }
    echo "Installazione, struttura e tutti i dati inseriti con successo!";
}

mysqli_close($conn);
?>
