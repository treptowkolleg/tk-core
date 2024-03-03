# Klassen

[Gailer Net - Wissensdatenbank](http://www.gailer-net.de)

Jede Java Klasse besteht aus einem Klassenkopf und einem Klassenkörper.

## Klassenkopf

Der Klassenkopf enthält
mindestens:

- Sichtbarkeit (_public, private_)
- Typ (_class, enum, interface_)
- Bezeichnung (_selbstgewählter Name_)

Der Klassenname wird grundsätzlich am Anfang großgeschrieben und sollte
nur ASCII-Zeichen enthalten.

## Klassenkörper

Die Attribute und Methoden der Klassen werden innerhalb der geschweiften
Klammern notiert. Der Klassenkörper folgt unmittelbar dem Klassenkopf.

````java
// Klassenname.java
public class Klassenname // Klassenkopf
{    
    // Klassenkörper    
}
````

## Attribute

Jede Klasse kann mehrere Attribute besitzen, muss sie jedoch nicht.
Attribute werden - ebenso wie Methoden - innerhalb des Klassenkörpers
notiert.

Im Folgenden ist die Klasse ``Agent`` beispielhaft dargestellt. Jede Instanz
der Klasse Agent soll einen **Namen** haben.

Wie bei den Klassenkörpern erwartet jedes Attribut drei Schlüsselwörter:

- Sichtbarkeit (_public,_protected_, private_)
- Typ (_Datentyp_)
- Bezeichnung (_selbstgewählter Name_)

Attribute werden, ebenso wie Variablen, stets kleingeschrieben. So lässt sich
besser zwischen Variable und Datentyp unterscheiden. Der Datentyp wird immer großgeschrieben.
Ausnahmen stellen nur die sogenannten primitiven Datentypen dar, wie etwa ``int``, da diese
keiner Datentypklasse entspringen und deshalb auch keine eigenen Methoden besitzen.
Mehr dazu auch unter [Datentypen]()

Um das Attribut manipulieren zu können, setzen wir die Sichtbarkeit auf public.
Warum das nicht immer sinnvoll ist, wird im Abschnitt **Methoden** erläutert.

Da der Agentenname eine Zeichenkette sein soll, setzen wir als Datentyp ``String``.


````java
// Agent.java
public class Agent // Klassenkopf
{
    public String name; // Attribut (Datentyp attributName)
}
````

