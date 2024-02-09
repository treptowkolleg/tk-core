# PHP Web Development
## Variablen

### Deklarieren

Variablen werden immer mit einem Dollar-Zeichen markiert. PHP ist Typen-dynamisch (im Gegensatz zu JAVA),
weshalb keine Angabe des Datentypen erfolgt. Die Art des Datentyps ergibt sich aufgrund der
Zuweisung eines Wertes.

````php
<?php

$myInt = 0; // int
$myFloat = 0.2; // float
$myString = '5';    // string
$myArray = [];  // array
$myArray = true;  // bool
````

### Dynamisch deklarieren

In PHP lässt sich etwas total verrücktes machen, was zum Beispiel in JAVA undenkbar wäre.
Wir können Variablen nämlich auch dynamisch während der Laufzeit deklarieren:

````php
<?php

/**
 * Dies ist ein sogenannter PHP-Docs-Block. Hier können Informationen an die
 * Entwickler weitergegeben werden.
 * 
 * @var $myVar int Variable, die wir gleich dynamisch deklarieren werden.
 */

// Erstmal eine normale Variable vom Typ String deklarieren und initialisieren.
$name = "myVar";

/*
 * Und jetzt deklarieren wir eine Variable, deren Bezeichnung der Wert der zuvor
 * deklarierten Variable ist. Klingt komisch, ist aber so. 
 */ 
${$name} = "Die Variable $name wurde jetzt deklariert.";

echo $myVar;
// Gibt aus: Die Variable myVar wurde jetzt deklariert.
````

Damit die IDE uns nicht aus Versehen warnt, dass die Variable nicht deklariert ist,
haben wir oben den Docs-Block benutzt. Diese Art der Deklaration kann verwendet werden,
um in PHP-Templates Variablen bereitzustellen, ohne vorher den Namen festlegen zu müssen.

Im folgenden Beispiel (Auszug) wird ein Template gerendert, das HTML-Code enthält. Dem Template
wird außerdem ein ``Exam``-Objekt übergeben.

````php
class ExamController extends AbstractController
{
    public function index(){

        if ($user){
            $this->session->set('user',$userSession);
            $this->security->denyAccessUntilGranted('ROLE_USER');
        }

        $categoryRepository = $this->getRepository(Category::class);
        $categories = $categoryRepository->findAllAndParentAsArray();

        $this->view->render('base/index.html.twig', [
            'flash' => $this->flash,
            'categories' => $categories,
            ]);
    }

}
````

Schauen wir uns das Template (Auszug) an:

````twig
<table class="tablesorter ts-index uk-table uk-table-expand uk-table-hover uk-table-small uk-table-striped">
        <caption class="uk-margin-bottom uk-padding-small">
            Tabelle Category <small>({{ categories|length }} {% if (categories|length == 1) %}Eintrag{% else %}Einträge{% endif %})</small>
        </caption>
        <thead>
        <tr>
            <th>#</th>
            <th>Titel</th>
            <th class="ts-title filter-select" data-placeholder="_ alle">Parent</th>
            <th>Beschreibung</th>
            <th>Erstellt</th>
            <th>Aktualisiert</th>
            <th data-sorter="false" data-filter="false" style="width: 150px!important;">Aktion</th>
        </tr>
        </thead>
        <tbody>
        {% if categories %}
            {% for category in categories %}
                <tr>
                    <td class="uk-text-middle">{{ category.id }}</td>
                    <td class="uk-text-middle uk-text-nowrap uk-text-left uk-text-bold"><a href="{{ route('base/view',{'id':category.id}) }}">{{ category.title }}</a></td>
                    <td class="uk-text-middle uk-text-nowrap uk-text-left uk-text-bold"><a class="{% if not category.parent %}uk-disabled uk-text-muted{% endif %}" href="{{ route('base/view',{'id':category.parent.id}) }}">{{ category.parent.title|default('_ ohne Parent') }}</a></td>
                    <td class="uk-text-middle uk-text-nowrap">{{ category.description }}</td>
                    <td class="uk-text-middle uk-text-nowrap">{{ category.created }}</td>
                    <td class="uk-text-middle uk-text-nowrap">{{ category.updated ? category.updated : '-' }}</td>
                    <td class="uk-flex">
                        <a href="{{ route('base/edit',{'id':category.id}) }}" class="uk-button uk-button-secondary uk-button-small uk-margin-small-right">EDIT</a>
                        {{ include('base/_delete_form.html.twig',{'class':'uk-button-danger uk-button-small','button':'entf'}) }}
                    </td>
                </tr>
            {% endfor %}
        {% else %}
            <tr>
                <td colspan="6">Es wurde kein Eintrag gefunden.</td>
            </tr>
        {% endif %}
        </tbody>
    </table>
````


## Gängige Operatoren

### Mathematische Operatoren

Aufgrund der Typen-Dynamik können wir sogar mit Zeichenketten rechnen. Zumindest, solange die
Zeichenkette einer Zahl entspricht.

````php
<?php

$myString = '5';    // string

$myResult = $myString * 2;  // Multiplikation ergibt 10. $myResult ist vom Typ int
$anotherResult = $myString + 5; // Addition ergibt 10. $anotherResult ist vom Typ int
````

### Zeichenkettenoperatoren

Mit dem Punkt (``.``) können Zeichenketten verknüpft werden. Zeichenketten, die in einfachen
Anführungszeichen notiert sind, werden 1:1 ausgegeben. Zeichenketten in doppelten Anführungszeichen
können Variablen enthalten. Wollen wir auf Attribute oder Methoden zugreifen, umschließen
wir den Ausdruck zusätzlich mit einer geschweiften Klammer:

````php
<?php

$stringA = 'Ich mag';
$stringB = 'Informatik';

$stringC = $stringA . ' ' . $stringB; // ergibt: Ich mag Informatik
$stringD = "$stringA $stringB";
$stringE = "Mein Objekt heißt {$myObject->getName()}";
````

### Ausgabe

Der Befehl ``echo`` gibt eine Zeichenkette aus.

````php
<?php

echo $myResult; // gibt 10 aus (siehe obiges Beispiel)
````

## Konstanten

Konstanten enthalten einmalig definierte feste Werte. Mit Konstanten kann genauso verfahren
werden wie mit Variablen, mit Ausnahme von Zuweisungsoperatoren natürlich.

Im Gegensatz zu Variablen wird kein Dollar-Zeichen vorangestellt. Konstanten werden immer groß
geschrieben.

### Deklarieren

Ein skalarer Wert kann mit dem Schlüsselwort ``const`` erfolgen:

````php
<?php

const MY_INT_CONST = 5;
const MY_STRING_CONST = 'Nummer: ' . MY_INT_CONST;
````

Für Zuweisung eines variablen Ausdrucks ist die Funktion ``define`` geeignet:

`````php
<?php

$myVar = 'Wert';

define('MY_CONST' , $myVar); // nicht mit 'const' erlaubt
`````

### Überprüfen

Jede Konstante darf nur einmal existieren. Daher sollten wir vor der Deklaration überprüfen,
ob eine Konstante bereits existiert:

`````php
<?php

$myVar = 'Wert';

if ( !defined(MY_CONST) ) {
    define('MY_CONST' , $myVar); // nicht mit 'const' erlaubt
}
`````


