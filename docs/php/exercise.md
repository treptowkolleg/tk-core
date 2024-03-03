# PHP
## Übung 1

### Voraussetzungen

- Aufbau von Klassen 
- Namenskonventionen 
- Umgang mit Konstruktoren 
- Umgang mit Arrays 
- Verwenden einseitiger Kontrollstrukturen

### Aufgabenstellung

1. Erstellen Sie die Klasse ``Form``
2. Mit Instantiierung des ``Form``-Objekts soll einem `$data`-Attribut die PHP-Konstante (array) ``$_POST`` zugewiesen werden (constructor).
3. Die Klasse soll über einen Getter verfügen, mit dem der Wert (string) eines bestimmten Schlüssels von ``$_POST`` zurückgegeben werden kann.
4. Speichere die Datei entsprechend PSR-0 unter ``src/Form.php``.

Kurze Erinnerung zu Arrays und Verwendung einer einseitigen Kontrollstruktur:
````php
<?php

$myArray = []; // neues leeres Array
$myArray[] = $value; // Dem nächsten Schlüssel den Wert $value geben
$myArray['meinSchlüssel'] = 'Wert'; // Dem Schlüssel 'meinSchlüssel' den Wert 'Wert' zuweisen

// mit isset($element) prüfen, ob ein bestimmter Schlüssel existiert.
if( isset($myArray[$key]) ) {
    $myString = $myArray[$key]; // der Variable $myString den Wert aus dem Array zuweisen
}
````


### ClientCode

Die erstellte Klasse ``Form`` soll beispielsweise in folgenden ClientCode eingearbeitet werden.

````php
<?php
# index.php

require 'src/Form.php';

// testweise Zuweisung
$_POST['username'] = 'Ingo';

$myForm = new Form();
$myUsername = $myForm->getField('username');

echo "Der Benutzername lautet: $myUsername";
// Ausgabe: Der Benutzername lautet: Ingo
````

### Tipps und Hinweise

Nutzt alle verfügbaren Ressourcen wie die Dokumentationen über
[Arrays](https://www.php.net/manual/de/language.types.array.php),
[Kontrollstrukturen](https://www.php.net/manual/de/control-structures.if.php) und
[isset()](https://www.php.net/manual/de/function.isset.php)
oder euer gemeinsames Wissen. Im schlimmsten Fall erarbeiten wir die Lösung in der nächsten
Stunde zusammen.

Wir werden die ``Form``-Klasse dann für unsere ersten richtigen Formularabfragen nutzen.

## Übung 2

Algorithmen lassen sich übersichtlich in Flussdiagrammen (Ablaufdiagramme) darstellen.
Im Folgenden ist eine zweiseitige Kontrollstruktur (``if-else``) dargestellt:

![Flowchart](/docs/img/flowchart_01.png)

### Aufgaben

1. Zeichne zur besseren Übersicht einen Ablaufplan des Programms.
2. Markiere die zueinander gehörenden Klammerpaare jeweils farbig.
3. Bestimme die Werte, die für die variablen ``$d`` und ``$e`` ausgegeben werden.

````php
<?php

function calculate($a, $b, $c) {
    $d = 0;
    $e = 0;    
    if($a < $b) {
        $d = $a + $b;
    }

    if($a > $c) {        
        if($b > $c) {
            $d = $a * $b;
        } else {
            $d = $a * $c;
        }        
    } else {
        $e = $a + $b + $c;
    }
    echo "D = $d" . PHP_EOL;
    echo "E = $e";
}

# Funktion ausführen:
calculate(7,3,4);
````

|a|b|c|d|e
| -------- | ------- | ------- | ------- | ------- |
|$7$|$3$|$4$|$28$|$0$|
|$-3$|$11$|$46$|$8$|$54$|
|$9$|$-5$|$5$|$45$|$0$|
|$12$|$4$|$2$|$48$|$0$|

### Ablaufdiagramm Musterlösung

![Musterloesung](/docs/img/ue2_php_control.png)

## Übung 3

Ermittle die Ausgabe folgenden Programms.

````php
<?php
$a = 5;
$b = 3;
$c = 99;

function printText($a, $b, $c) {
    $string = '';
    if($a == $b or $b > 2)
        $string .= "Ich ";
    if($a < 5 and $b > 2)
        $string .= "Du ";
    if($a == 5 and $b == 2)
        $string .= "hatten ";
    if($c != 6 and $b > 10)
        $string .= "hast ";
        else
            $string .= "habe ";
    if($b == 3 and $c == 99)
        $string .= "viel ";
    if($a == 1 and $b == 2)
        $string .= "keinen ";
    if(!($a < 5 and $b > 2))
        $string .= "Spaß! ";
}

printText($a,$b,$c);
````

## Übung 4

Für eine Website soll ein geschützter Bereich für registrierte Nutzer realisiert werden.
Dazu wird die PHP-eigene globale Konstante ``$_SESSION`` genutzt. Hier können Werte abgelegt
werden, die während der aktuellen Browser-Sitzung erhalten bleiben.

- Analysiere den folgenden Quellcode und erstelle ein Ablaufdiagramm.

````php
<?php

class AuthenticationController extends AbstractController
{

    public function login(): string
    {
        if($this->session->get('login')) $this->response->redirectToRoute(302,'app_index');

        $tryLoginLastError = null;

        if($this->request->isFormSubmitted() and $this->request->isPostRequest()) {
            $encryptionService = new EncryptionService();

            $loginData = [
                'username' => $encryptionService->encryptString($this->request->getFieldAsString('username')),
                'password' => $this->request->getFieldAsString('password')
            ];

            if($loginData['username'] and $loginData['password']) {
                if (0 === ($tryLoginLastError = UserService::tryLogin($this->repository, $loginData))) {
                    $user = $this->repository->findOneBy(['username' => $loginData['username']]);
                    if ($user) {
                        $this->session->set('user', $user->getId());
                        $this->session->set('login', true);
                        $this->setFlash(200);
                    }

                    $this->response->redirectToRoute(302, 'app_index');
                }
            }
            $this->setFlash($tryLoginLastError,'danger');
            $this->response->redirectToRoute(302, 'authentication_login');
        }

        return $this->render('authentication/login.html',[
            'lastError' => $tryLoginLastError
        ]);

    }

}
````

## Übung 5 - Login-Formular

### Überprüfen, ob Client eingeloggt ist oder nicht.

![formularAnzeigen](/docs/img/loginformular.svg)

### Überprüfen, ob Logout angefordert wurde.

![formularAnzeigen](/docs/img/logout.svg)
