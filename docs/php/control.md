# PHP Web Development
## Kontrollstrukturen

Kontrollstrukturen erlauben uns, Code nur unter bestimmten Bedingungen auszuführen. Daher
werden diese Strukturen auch als Algorithmen bezeichnet.

## Vergleichsoperatoren

|Operator|Bedeutung|
| -------- | ------- |
|$a$ ``==`` $b$|a gleich b|
|$a$ `===` $b$|a gleich b und gleiche Datentypen (strikt)|
|$a$ `!=` $b$ oder $a$ `<>` $b$|a ungleich b|
|$a$ `!==` $b$|a ungleich b und gleiche Datentypen (strikt)|
|$a$ `<` $b$|a kleiner als b|
|$a$ `<=` $b$|a kleiner gleich b|
|$a$ `>` $b$|a größer b|
|$a$ ``>=`` $b$|a größer gleich b|
|$a$ ``and`` $b$|a und b|
|~~$a$ ``xand`` $b$~~|~~weder a noch b~~ *gibt es nicht in PHP*|
|$a$ ``or`` $b$|a oder b|
|$a$ ``xor`` $b$|entweder a oder b (exklusives oder)|
|``!`` $a$|nicht a|


## if-Strukturen

````php
<?php

$a = 2;
$b = 3;

# einseitig
if ($a == $b) {
    echo "$a ist gleich $b";
}

# zweiseitig
if ($a == $b) {
    echo "$a ist gleich $b";
    } else {
        echo "$a ist ungleich $b";
}

# mehrseitig
if($a < $b) {
    echo "$a ist kleiner als $b";
    } elseif ($a > $b) {
        echo "$a ist größer als $b";
    } else {
        echo "$a ist gleich $b";
}
````

## switch-Strukturen

````php
<?php

# Standardnotation if-else
if( array_key_exists('action', $_POST) ) {
    $action = $_POST['action'];
    } else {
        $action = null;
}

# Kurzschreibweise if-else
$action = array_key_exists('action', $_POST) ? $_POST['action'] : null;

# mehrseitiger switch-Algorithmus
switch ($action) {
        
    case 'create':
        $myObject->new();
        break;
    
    case 'read':
        $myObject->show();
        break;
        
    case 'update':
        $myObject->update();
        break;
        
    case 'delete':
        $myObject->delete();
        break;
        
    default:
        $myObject->index();    
}
````

