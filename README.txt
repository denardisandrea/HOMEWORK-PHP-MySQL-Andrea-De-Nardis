Descrizione del sito:
GamingZone è un sito web dedicato al mondo dei videogiochi, in particolare ai titoli più attesi del 2026. Il sito permette agli utenti di esplorare giochi in evidenza, leggere dettagli sui titoli, visualizzare recensioni e inserire commenti.
Il progetto implementa:

•⁠  ⁠gestione utenti;
•⁠  ⁠autenticazione tramite login;
•⁠  ⁠registrazione utenti;
•⁠  ⁠gestione delle sessioni;
•⁠  ⁠caricamento dinamico dei giochi dal database;
•⁠  ⁠visualizzazione dinamica delle pagine dedicate ai videogiochi;
•⁠  ⁠sistema di commenti associati ai giochi.


Tecnologie utilizzate

•⁠  ⁠HTML
•⁠  ⁠CSS
•⁠  ⁠PHP
•⁠  ⁠MySQL
•⁠  ⁠phpMyAdmin
•⁠  ⁠PHP


Struttura del progetto

index.php

Pagina principale del sito.
Gestisce la sessione utente e fornisce accesso alle principali sezioni del progetto.

giochi.php

Pagina dinamica che recupera i videogiochi dal database tramite query SQL e li visualizza tramite card.


dettaglio.php

Pagina dedicata al singolo videogioco.
Il gioco viene identificato tramite parametro id passato nell’URL.

La pagina mostra:

•⁠  ⁠titolo;
•⁠  ⁠immagine;
•⁠  ⁠descrizione;
•⁠  ⁠PEGI;
•⁠  ⁠sviluppatore;
•⁠  ⁠commenti associati.


login.php

Gestisce l’autenticazione degli utenti.

Funzionalità implementate:

•⁠  ⁠controllo credenziali;
•⁠  ⁠creazione sessione utente;

register.php

Gestisce la registrazione degli utenti.

Funzionalità implementate:

•⁠  ⁠verifica esistenza username/email;
•⁠  ⁠inserimento dati nel database;
•⁠  ⁠hashing password.

connessione.php

File dedicato alla connessione MySQL tramite mysqli_connect().


Database

Tabella utente

Contiene le informazioni relative agli utenti registrati nel sistema.

Campi principali:

•⁠  ⁠id
•⁠  ⁠username
•⁠  ⁠email
•⁠  ⁠password 
•⁠  ⁠id_ruolo


Tabella gioco

Contiene le informazioni relative ai videogiochi visualizzati nel sito.

Campi principali:

•⁠  ⁠id
•⁠  ⁠titolo
•⁠  ⁠immagine
•⁠  ⁠descrizione
•⁠  ⁠pegi
•⁠  ⁠sviluppatore


Tabella commento

Contiene i commenti associati ai videogiochi.

Campi principali:

•⁠  ⁠id
•⁠  ⁠testo
•⁠  ⁠id_utente
•⁠  ⁠id_gioco

Gestione sicurezza

Sono state implementate le seguenti soluzioni:

•⁠  ⁠utilizzo di password_hash() durante la registrazione e login.
•⁠  ⁠controllo dell’esistenza di username ed email;
•⁠  ⁠gestione sessioni tramite $_SESSION.

Le password non vengono salvate in chiaro all’interno del database.


Problemi affrontati e soluzioni adottate

Problema 1 – Memorizzazione password

Durante le prime versioni del progetto le password venivano salvate direttamente nel database in chiaro.

Soluzione adottata: md5() per la password in chiaro.

Questo ha permesso di memorizzare password cifrate e aumentare la sicurezza del sistema.


Problema 2 – Gestione statica dei giochi

Nella versione iniziale i giochi venivano inseriti manualmente tramite codice HTML statico.

Soluzione adottata

È stata realizzata una gestione dinamica tramite database MySQL.

I giochi vengono ora recuperati tramite query SQL e mostrati dinamicamente nelle pagine PHP.

Ogni gioco possiede inoltre una pagina dedicata identificata tramite parametro id.


UTENTI

(NAME, EMAIL, PASSWORD):
Andrea       andrea.andrei415@gmail.com  miaomiao
Gabriele     gabryfoletto28@gmail.com    gabriele123
Luca  lucadeluchi@gmail.com       unabellapassword
Matteo       matteomattei@gmail.com      sonomatteo


AUTORI: Gabriele Foletto 2106970, Andrea De Nardis 2149279
GITHUB: https://github.com/denardisandrea/HOMEWORK-PHP-MySQL-Andrea-De-Nardis.git
