# Bildbearbeitung

Mit der <a href="https://www.php.net/manual/de/book.image.php" target="_blank">GD-Bibliothek</a>
können in PHP Grafiken und Bilder erstellt, manipuliert oder bearbeitet werden.

Überprüfe in deiner ``php.ini``, ob die Erweiterung aktiv ist.

````shell
;extension=gd
````

Dazu entfernst du einfach das eventuell vorhandene vorangestellte Semikolon in der
entsprechenden Zeile.

````shell
extension=gd
````

Nun kannst du die **GD**-Erweiterung verwenden.

## Beispiel

<img src="/captcha2.php?captcha=inf2024" alt="captcha">

``<img src="/captcha2.php?captcha=inf2024" alt="captcha">``

## Einfache Grafik

Erstelle ein neues php-Script. Der folgende Code erzeugt eine neue PNG-Bilddatei mit den Maßen
$320 \cdot 240$ Pixel. Die ``header()``-Funktion teilt dem Browser mit, dass die Anfrage eine
Bilddatei zurückerhält.

````php
<?php
# gd.php

$width = 320;
$height = 240;

$image = imagecreatetruecolor($width, $height);

header('Content-type: image/png');
imagepng($image);
imagedestroy($image);
````

Dieses wirst du später als Quelle im ``<img>``-Tag referenzieren:

````html
<html lang="de">
    <head>
        <title>PHP-generierte Grafiken und Bilder</title>
    </head>
    <body>
        <img src="/gd.php" alt="PHP-Grafik">
    </body>
</html>
````