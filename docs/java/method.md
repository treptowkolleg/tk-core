# Methoden

## Allgemein

Methoden werden im Klassenkörper notiert und haben denselben formalen Aufbau wie die Klassen
selbst. Sie bestehen also aus einem Methodenkopf und einem Methodenkörper.

````java
// Klassenname.java
public class Klassenname // Klassenkopf
{
    
    public Rückgabedatentyp methodenName // Methodenkopf
            (
                    Parameterdatentyp parameterBezeichner // Parameterliste (kommagetrennt)
            ) 
    {
        // Methodenkörper
    }    
    
}
````

Obwohl alle Methoden demselben Aufbau folgen, lassen sich mindestens drei Arten von Methoden
unterscheiden.

## Constructor

Constructor-Methoden werden beim Initialisieren einer Instanz ausgeführt. Sie sind daran
erkennbar, dass sie grundsätzlich großgeschrieben werden und denselben Namen haben wie ihre
Klasse.

Da Constructor-Methoden immer die eigene Klasse zurückgeben, fehlt hier der Rückgabetyp.

Unsere Klasse ``Agent`` könnte also folgenden Constructor haben:

````java
// Agent.java
public class Agent // Klassenkopf
{
    public String name; // Attribut
    
    public Agent() // Constructor, Methodenkopf
    {
        // Constructor, Methodenkörper
    }
}
````

Um zu verstehen, was die Constructor-Methode macht, könnten wir uns den Aufbau so vorstellen:

````java
public class Agent // Klassenkopf
{    
    public Agent constructor() // Constructor, Methodenkopf
    {
        // Constructor, Methodenkörper
    }
}
````

Da die Constructor-Methode nur ihre Klasse zurückgibt (ähnliches Verhalten wie ``void``),
handelt es sich hier also um einen sogenannten Auftrag. Denn es wurde mit ``Agent bond = new Agent()``
der Auftrag erteilt, eine neue Instanz vom Typ Agent zu erstellen.

Wir können also Methoden unterteilen in **Aufträge** und **Anfragen**.

## Auftrag

Aufträge sind dadurch gekennzeichnet, dass Sie:

1. keinen Rückgabewert (*void*)
2. meistens wenigstens einen Parameter

erwarten.

Setzen wir einmal das Attribut ``name`` auf **protected**.
Nun können wir nicht mehr direkt auf das Attribut zugreifen.
Stattdessen verwenden wir eine sogenannte Set-Methode (Auftrag),
um den Namen des Agentenobjekts festzulegen.

Warum eigentlich **protected**? Ich zwinge den Benutzer,
die Get- und Set-Methoden zu verwenden, da ich mir vorbehalte,
weitere Algorithmen zum Setzen und Auslesen des Attributs zu
implementieren.

````java
// Agent.java
public class Agent
{
    protected String name;
    
    public Agent()
    {
    }
    
    public void setName(String name)
    {
        this.name = name;
    }
}
````

Über die Set-Methode ``setName()`` können wir nun den
Namen des Agenten festlegen. Als Parameter wird derselbe
Datentyp übergeben, den das Attribut hat. Es wäre aber
auch eine andere Herangehensweise denkbar.

````java
// Agent.java
public class Agent
{
   protected String name;

   public Agent()
   {
   }

   public void setName(int code)
   {
      
      // Gegenbeispiel für den Fall, wo der Parameterdatentyp abweicht. 
      switch (code) {
         case 1 -> this.name = "Bond";
         case 2 -> this.name = "Goldfinger";
         case 3 -> this.name = "Batman";
         default -> {
            this.name = "Generischer Agent";
            System.err.println("Eingegebener Code '" + code + "' ist ungültig!");
         }
      }
      
   }
   
}
````

## Method-Chaining

Manchmal kann es sein, dass sehr viele Setter (*set-Methoden*) eines Objekts angestoßen werden
müssen. Dann bietet sich an, nicht **void** zurückzugeben, sondern das Objekt selbst.

Bisher:

````java
// Start.java
public class Start
{
    
   public void main(String[] vars) 
   {
       Agent bond = new Agent();
       
       // Setter geben void zurück
       bond.setName("Bond");
       bond.setVorname("James");
       bond.addFahrzeug(new Motorad());
       bond.addFahrzeug(new PKW());

   }   
   
}
````

Mit Method-Chaining:

````java
// Start.java
public class Start
{
    
   public void main(String[] vars) 
   {
       Agent bond = new Agent();

      // Setter geben Agent zurück
      bond
              .setName("Bond")
              .setVorname("James")
              .addFahrzeug(new Motorad())
              .addFahrzeug(new PWK())
      ;
   }   
   
}
````

Die Methode ``setName()`` sähe dann folgendermaßen aus:

````java
// Agent.java
public class Agent
{
    protected String name; 
    
    public Agent() 
    {
    }
    
    public Agent setName(String name)
    {
        this.name = name;
        
        return this; // statt void wird 'Agent' zurückgegeben.
    }
}
````

## Anfrage

Nun haben wir dem Agenten-Objekt einen Namen gegeben, allerdings fehlt uns noch eine Methode,
um diesen wieder auszulesen. Hier kommt unser Getter (Anfrage) zum tragen.

Im Gegensatz zum Auftrag wollen wir jetzt den Inhalt eines Attributs auslesen. Mit anderen Worten:
Die get-Methode gibt **nicht** void, sondern den Datentyp des Attributs zurück.

````java
// Agent.java
public class Agent
{
    protected String name; 
    
    public Agent() 
    {
    }
    
    public String getName() // Der Rückgabe-Datentyp ist 'String', da der Datentyp des Attributs auch 'String' ist
    {
        return this.name; // Gibt den Inhalt des Attributs 'name' zurück
    }
}
````

Die komplette Klasse ``Agent`` sieht bis hierher nun so aus:

````java
// Agent.java
public class Agent
{
    protected String name; 
    
    public Agent() 
    {
    }

   public vois setName(String name)
   {
      this.name = name;
   }
    
    public String getName()
    {
        return this.name;
    }
        
}
````

**Du bist dran**: implementiere weitere Attribute sowie dessen Setter und Getter

## Method Overloading

Jeder Agent soll bis zu zwei Fahrzeuge haben dürfen. Überlegen wir kurz, welchen Datentyp
wir dafür dem entsprechenden Attribut geben möchten.

````java
// Agent.Java
public class Agent
{

    // Variante A
    protected Fahrzeug[] fahrzeugListe = new Fahrzeug[2];
    
    // Variante B
    protected ArrayList<Fahrzeug> fahrzeugListe = new ArrayList<>();
   
}
````

**Du bist dran**: Überlege dir die Vor- und Nachteile des jeweiligen Datentyps.
Welcher Datentyp wäre besser geeignet und warum?

Gibt es weitere Möglichkeiten?

**Im Folgenden einmal zwei Vorschläge**:

### Variante A

````java
// Variante A
public class Agent
{
   protected Fahrzeug[] fahrzeugListe = new Fahrzeug[2];
   
   public void setFahrzeug(int position, Fahrzeug fahrzeug)
   {
       // Der Sammlung wird am index x ein Fahrzeug hinzugefügt
       this.fahrzeugListe[position] = fahrzeug;
   }
}
````

Eine Sammlung ist leicht implementiert, die Manipulation der Einträge ist jedoch wesentlich
komplizierter, da die Sammlung sehr statisch ist.

### Variante B

````java
// Variante B
public class Agent
{
   protected ArrayList<Fahrzeug> fahrzeugListe = new ArrayList<>();

   public void addFahrzeug(Fahrzeug fahrzeug)
   {
      // Der ArrayList wird ein Fahrzeug hinzugefügt
   }

   public void addFahrzeug(int position, Fahrzeug fahrzeug)
   {
      // Der ArrayList wird ein Fahrzeug an einer bestimmten Position hinzugefügt/ersetzt
   }
    
}
````

ArrayLists sind sehr dynamisch. Daher ist es hier erforderlich, einen Algorithmus zu entwickeln,
der die maximal mögliche Anzahl der Einträge steuert. Die Manipulation der Einträge ist
dagegen äußerst einfach.

**Achtung**: Ist dir aufgefallen, dass in Variante B eine Methode doppelt vorkommt?
Nein, keine Sorge, das ist kein Fehler. Denn, es werden jeweils unterschiedliche
Parameter erwartet. ``JAVA`` unterscheidet nämlich nicht zwischen Methodennamen allein,
sondern zieht den gesamten Methoden-Kopf zum Vergleich heran.

Genau dieses mehrfache Vergeben von Methodennamen nennen wir auch **Überladen von Methoden**.
Durch das Überladen von Methoden schaffen uns eine Möglichkeit, mit optionalen Parametern zu arbeiten.

In Variante B können wir quasi derselben Methode entweder nur ein Fahrzeug, oder ein Fahrzeug sowie
eine Zahl als Positionsparameter übergeben.

Variante A allerdings benötigt aufgrund der Struktur des Datentyps immer beides: Das Objekt
und eine Zahl, die sagt, welchem Index dieses Objekt zugeordnet werden soll.