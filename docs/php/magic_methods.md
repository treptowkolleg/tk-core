# PHP Web Development
## Magische Methoden

Magische Methoden sind Methoden, die PHPs Standardverhalten überschreiben, wenn bestimmte Aktionen mit einem Objekt durchgeführt werden.

Die folgenden Methodennamen werden als magisch betrachtet: ``__construct()``,
``__destruct()``, ``__call()``, ``__callStatic()``,`` __get()``, ``__set()``,
``__isset()``, ``__unset()``, ``__sleep()``, ``__wakeup()``, ``__serialize()``,
``__unserialize()``, ``__toString()``, ``__invoke()``, ``__set_state()``,
``__clone()`` und ``__debugInfo()``.

**Ein Beispiel**: *Sleep- und Wakeup-Beispiel*

````php
<?php # Connection.php

class Connection
{
    protected $link;
    private $dsn, $username, $password;

    public function __construct($dsn, $username, $password)
    {
        $this->dsn = $dsn;
        $this->username = $username;
        $this->password = $password;
        $this->connect();
    }

    private function connect()
    {
        $this->link = new PDO($this->dsn, $this->username, $this->password);
    }

    public function __sleep()
    {
        return array('dsn', 'username', 'password');
    }

    public function __wakeup()
    {
        $this->connect();
    }
}
````

Der Zweck von von ``__sleep()`` ist, nicht gespeicherte Daten zu sichern oder ähnliche Aufräumarbeiten zu erledigen. Die Funktion ist ebenfalls nützlich, wenn ein sehr großes Objekt nicht komplett gespeichert werden muss.

Umgekehrt überprüft ``unserialize()``, ob eine Funktion mit dem magischen Namen ``__wakeup()`` vorhanden ist. Falls vorhanden, kann diese Funktion alle Ressourcen, die das Objekt möglicherweise hat, wiederherstellen.

Der Zweck von ``__wakeup()`` ist es, alle Datenbankverbindungen, die bei der Serialisierung verlorengegangen sind, wiederherzustellen und andere Aufgaben der erneuten Initialisierung durchzuführen.

### __construct()

Mit Konstruktoren kann im **Client Code** ein Objekt dazu gezwungen werden, bestimmte Attributwerte
anzunehmen und Methoden auszuführen. Im folgenden Beispiel werden bei Instantiierung eines
``Connection``-Objekts die Zugangsdaten für die Herstellung einer Datenbankverbindung zwingend
erwartet, da die nachgestellte Instantiierung des ``PDO``-Objekts genau diese Angaben benötigt.

````php
<?php # Connection.php

class Connection
{
    protected $link;
    private $dsn, $username, $password;

    public function __construct($dsn, $username, $password)
    {
        $this->dsn = $dsn;
        $this->username = $username;
        $this->password = $password;
        $this->connect();
    }

    private function connect()
    {
        $this->link = new PDO($this->dsn, $this->username, $this->password);
    }

}
````

Nachdem die drei Parameter den Klassenattributen zugewiesen wurden, wird die Klassenmethode
``connect()`` ausgeführt, die dem Attribut ``$link`` das neue ``PDO``-Objekt zuweist.

### __toString()

Manchmal wollen wir einen bestimmten Inhalt eines Objekts ausgeben (``echo``), ohne erst zu überlegen,
welche Methoden die vielen Objekte haben, um gewisse Informationen auszugeben. Mithilfe der
magischen Methode ``toString()`` können wir dieses Problem umgehen. Denn jede Instanz (Objekt)
einer Klasse, die diese Methode implementiert, nutzt genau diese Methode zur Ausgabe eines
ebensolchen Strings:

````php
<?php 

# Person.php
class Person
{
    protected $firstname = 'Susi';
    protected $lastname = 'Sorglos';

    public function __toString()
    {
        return $this->firstname . " " . $this->lastname;
    }

}

# index.php
$myObject = new Person();

echo $myObject; // gibt zurück: Susi Sorglos
````

### __invoke()

Mit dieser magischen Methode ist es möglich, ein Objekt als Callable zu behandeln. Die Prüfung
``is_callable($meinObjekt)`` ergibt immer dann ``true``, wenn die Methode ``__invoke()`` implementiert
wurde.

````php
<?php 

# Beispiel OHNE __invoke()
class myClass
{
    /**
    * Methode, die User-Objekte nach Nachnamen sortiert.
    * x < 0 => a vor b;
    * x == 0 => a = a;
    * x > 0 => b nach a; 
     */
    protected function sort($a,$b): int
        {
            if($a instanceof User and $b instanceof User)
            {
                return strcmp($a->getLastName(true),$b->getLastName(true));
            }
            return 0;
        }
    
    public function main()
    {
        // Array mit Objekten
        $supervisorList = [$obj1, $obj2, $obj3, $obj4];
        
        // Methode zum Sortieren von Arrays
        // uasort(array &$array, callable $callback);
        uasort($supervisorList, Array($this,'sort')); 
    }
    
}
````

````php
<?php 

# Beispiel MIT __invoke()
class Sort
{
    private string $method;

    public function __construct(string $attribute)
    {
        $this->method = 'get' . ucfirst($attribute);
    }

    public function __invoke($a,$b): int
    {
        if(method_exists($a,$this->method) and method_exists($b,$this->method)) {
            return $a->{$this->method}() <=> $b->{$this->method}();
        }
        return 0;
    }

    public function __toString()
    {
        return $this->method;
    }
}

class CPU
{
    private string $name;
    
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

}
    
// Array mit Objekten
$array = [new CPU("Intel"), new CPU("AMD"), new CPU("Texas Instruments"), new CPU("Analog Devices")];

// Methode zum Sortieren von Arrays
// uasort(array &$array, callable $callback);
uasort($array, new Sort('name'));

// Gibt Objekte sortiert nach Name aus.
print_r($array);
````