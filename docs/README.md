# Dokumentation

## Bridge API

Aktivierung der Session-Umgebung für das Speichern von Zuständen
in der aktuellen Browser-Sitzung:

````php
$session = new \TreptowKolleg\Api\Session();
````

Beispielcode für Loginversuche

````php
// Schnittstelle instantiieren
$api = new \TreptowKolleg\Api\Bridge('apiKey');

// Login anfragen
$response = $api->requestLogin('username','password');
````

Der Server liefert ein Array mit folgendem Aufbau:

Element | Typ | Inhalt
-----|-----|-----
login | bool | 0 oder 1
origin | array | ursprüngliche POST-Daten
message | string | Servernachricht

````php
if($response['login']) {
    $session->set('login', true);
    
    // Daten aus unserem ursprüngliche POST können ebenfalls gespeichert werden. Z. B.:
    $session['username'] = $response['origin']['user'];
}
````

Wir können unser Login-Formular verstecken, wenn wir eingeloggt sind:

````php
<?php

// PHP-Code

?>
<!DOCTYPE HTML>
<html lang="de">
<head>
    <title>Titel</title>
</head>
<body>
    <?php if($session->get('login')): ?>
        <p>Sie sind eingeloggt als <?=$session->get('username')?>.</p>
    <?php else: ?>
        <form method="post">
            <!--- Formularfelder und Buttons /--->
        </form>
    <?php endif; ?>
</body>
````

