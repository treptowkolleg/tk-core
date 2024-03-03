# Klassen

## Definition

Eine Klasse stellt den Bauplan von Objekten dar. Objekte werden daher auch als Klasseninstanz
bezeichnet.

````php
<?php # MyClass.php

class MyClass
{
    // Attribute und Methoden
}
````

## Attribute

Jeder Klasse können beliebige Attribute hinzugefügt werden.

````php
<?php # MyClass.php

class MyClass
{
    public int $myInteger;
    public string $myString = 'Zeichenkette';
}
````

Ist die Sichtbarkeit auf ``public`` gesetzt, können **Client Code** oder andere Objekte auf
diese Attribute direkt zugreifen:

````php
<?php # index.php

$class = new MyClass(); // Instanz erzeugen

$class->myInteger = 5; // Klassenattribut ändern
echo $class->myString; // Klassenattribut ausgeben
````

Dies ist nicht immer ratsam, da vielleicht die Attribute nach bestimmten Algorithmen
gespeichert und ausgelesen werden sollen. Ein Beispiel:

Wir speichern eine natürliche Zahl nach folgendem Algorithmus: $ f(x) = -(x+1); x\in\mathbb{N}_U $ und
$ f(x) = x; x\in 2\mathbb{N} $

````php
<?php # MyClass.php

class MyClass
{
    private int $myInteger;
    
    public function setInteger(int $newInteger): void
    {
        if($newInteger >= 0) {
            if($newInteger % 2 == 0) {
                $this->myInteger = $newInteger;
                } else {
                    $this->myInteger = -($newInteger + 1);
            }
        }        
    }
    
    public function getInteger(): int
    {
        $integer = 0;
        if($this->myInteger < 0) {
                $integer = -($this->myInteger + 1);
            } else {
                $integer = $this->myInteger;
        }
        return $integer;
    }

}
````

Das obige Beispiel zeigt eine Klasse, die ganze Zahlen speichern kann. Ist eine Zahl
gerade, wird sie normal im Attribut ``$myInteger`` abgelegt. Ist die Zahl jedoch
ungerade, wird sie um eins erhöht und ihr Spiegelwert gespeichert. Dieser Algorithmus
könnte umgangen werden, wenn das Attribut auf ``public`` gesetzt worden wäre.

