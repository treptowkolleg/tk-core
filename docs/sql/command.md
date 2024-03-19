# SQL-Anweisungen

## Basics

Reihenfolge der Notation von Anweisungen:

1. SELECT
2. FROM
3. JOIN
4. WHERE
5. GROUP BY
6. HAVING
7. ORDER BY
8. LIMIT

### Projektion von Spalten

Es sollen Vor- und Nachnamen aller Lehrkräfte angezeigt werden.

````SQL
SELECT Name FROM lehrkraft
````

<form method="post" action="https://it.treptowkolleg.de/?page=docs-sql#result">
<input type="hidden" name="db" value="abitraining">
<input type="hidden" name="query" value="
SELECT Name FROM lehrkraft
">
<button type="submit" class="p-button--positive" name="sql">Ausprobieren</button>
</form>

Die Spaltennamen der Ergebnistabelle können mit ``AS`` umbenannt werden. Im Folgenden soll
die Spalte *Wohnort* der Relation *Lehrkraft* in *Ort* umbenannt werden:

````SQL
SELECT Name, Wohnort AS Ort FROM lehrkraft
````

<form method="post" action="https://it.treptowkolleg.de/?page=docs-sql#result">
<input type="hidden" name="db" value="abitraining">
<input type="hidden" name="query" value="
SELECT Name, Wohnort AS Ort FROM lehrkraft
">
<button type="submit" class="p-button--positive" name="sql">Ausprobieren</button>
</form>

Standardmäßig wird immer aufsteigend nach dem ersten Attribut sortiert (normalerweise der
Primärschlüssel). Die Sortierung lässt sich jedoch auch ändern.

#### Sortieren

Zuerst nach Wohnort und dann nach Name aufsteigend sortieren:

````SQL
SELECT Name, Wohnort AS Ort
FROM lehrkraft
ORDER BY Wohnort, Name
````

<form method="post" action="https://it.treptowkolleg.de/?page=docs-sql#result">
<input type="hidden" name="db" value="abitraining">
<input type="hidden" name="query" value="
SELECT Name, Wohnort AS Ort
FROM lehrkraft
ORDER BY Wohnort, Name
">
<button type="submit" class="p-button--positive" name="sql">Ausprobieren</button>
</form>

Nach Name absteigend sortieren:

````SQL
SELECT Name, Wohnort AS Ort
FROM lehrkraft
ORDER BY Name DESC
````

<form method="post" action="https://it.treptowkolleg.de/?page=docs-sql#result">
<input type="hidden" name="db" value="abitraining">
<input type="hidden" name="query" value="
SELECT Name, Wohnort AS Ort
FROM lehrkraft
ORDER BY Name DESC
">
<button type="submit" class="p-button--positive" name="sql">Ausprobieren</button>
</form>

#### Limitieren

Nur die ersten fünf Datensätze auswählen:

````SQL
SELECT Name, Wohnort AS Ort 
FROM lehrkraft
LIMIT 5
````

<form method="post" action="https://it.treptowkolleg.de/?page=docs-sql#result">
<input type="hidden" name="db" value="abitraining">
<input type="hidden" name="query" value="
SELECT Name, Wohnort AS Ort 
FROM lehrkraft
LIMIT 5
">
<button type="submit" class="p-button--positive" name="sql">Ausprobieren</button>
</form>

Nur fünf Datensätze ab dem fünften Datensatz auswählen:

````SQL
SELECT Name, Wohnort AS Ort 
FROM lehrkraft
LIMIT 5 OFFSET 4
````

<form method="post" action="https://it.treptowkolleg.de/?page=docs-sql#result">
<input type="hidden" name="db" value="abitraining">
<input type="hidden" name="query" value="
SELECT Name, Wohnort AS Ort 
FROM lehrkraft
LIMIT 5 OFFSET 4
">
<button type="submit" class="p-button--positive" name="sql">Ausprobieren</button>
</form>

### Selektion von Tabellen

Mit der Anweisung ``FROM`` können Relationen selektiert werden. Im obigen Beispiel war das
die Relation *Lehrkraft*. Es ist jedoch auch möglich, mehrere Relationen zu selektieren.

[Mehr zu Joins](#wherejoins)

Mit ``WHERE`` können Bedingungen festgelegt werden, nach denen Datensätze selektiert werden
sollen. Im obigen Beispiel würden nur Lehrkräfte angezeigt werden, die überhaupt eine
Lehrbefähigung haben. Mit ``AND`` und/oder ``OR`` können weitere Bedingungen festgelegt werden.

Soll geprüft werden, ob eine Spalte **nicht null** oder **null** ist, kann allerdings nicht
der Vergleichsoperator ``=`` verwendet werden. Stattdessen ist folgende Notation zu verwenden:

````SQL
SELECT Name, Geburtsjahr
FROM lehrkraft
WHERE Geburtsjahr IS NULL
````

<form method="post" action="https://it.treptowkolleg.de/?page=docs-sql#result">
<input type="hidden" name="db" value="abitraining">
<input type="hidden" name="query" value="
SELECT Name, Geburtsjahr
FROM lehrkraft
WHERE Geburtsjahr IS NULL
">
<button type="submit" class="p-button--positive" name="sql">Ausprobieren</button>
</form>

oder:

````SQL
SELECT Name, Geburtsjahr
FROM lehrkraft
WHERE Geburtsjahr IS NOT NULL
````

<form method="post" action="https://it.treptowkolleg.de/?page=docs-sql#result">
<input type="hidden" name="db" value="abitraining">
<input type="hidden" name="query" value="
SELECT Name, Geburtsjahr
FROM lehrkraft
WHERE Geburtsjahr IS NOT NULL
">
<button type="submit" class="p-button--positive" name="sql">Ausprobieren</button>
</form>

## Schnittmengen

### JOINS

#### Mit WHERE

<div id="wherejoins"></div>

Mit ``WHERE`` bzw. ``JOIN`` lassen sich Datensätze aus verschiedenen Relationen horizontal vereinigen.

![img.png](/docs/img/innerjoin.png)

Im Folgenden sollen die Fächer neben jeder Lehrkraft angezeigt werden, in denen diese
eine Lehrbefähigung haben. Haben mehrere Relationen gleichnamige Attribute, müssen die
Tabellennamen vorangestellt werden. Für sehr lange Tabellennamen kann auch ein Alias erzeugt
werden, um Schreibarbeit zu sparen (``FROM Tabellenname t``).

````SQL
SELECT l.Name AS Lehrkraft, f.Name AS Fach
FROM lehrkraft l, hat_lehrbefaehigung_in lf, fach f
WHERE
      l.PersNr = lf.Lehrkraft
  AND 
      lf.Fach = f.Name
````

<form method="post" action="https://it.treptowkolleg.de/?page=docs-sql#result">
<input type="hidden" name="db" value="abitraining">
<input type="hidden" name="query" value="
SELECT l.Name AS Lehrkraft, f.Name AS Fach
FROM lehrkraft l, hat_lehrbefaehigung_in lf, fach f
WHERE
      l.PersNr = lf.Lehrkraft
  AND 
      lf.Fach = f.Name
">
<button type="submit" class="p-button--positive" name="sql">Ausprobieren</button>
</form>

#### Mit INNER JOIN ON

Sind die zu vergleichenden Primär- und Fremdschlüssel unterschiedlich benannt, wird mit ``JOIN``
die Anweisung ``ON`` benötigt:

````SQL
SELECT l.Name AS Lehrkraft, f.Name AS Fach
FROM lehrkraft l
     INNER JOIN hat_lehrbefaehigung_in lf
                ON l.PersNr = lf.Lehrkraft
     INNER JOIN fach f
                ON lf.Fach = f.Name
````

<form method="post" action="https://it.treptowkolleg.de/?page=docs-sql#result">
<input type="hidden" name="db" value="abitraining">
<input type="hidden" name="query" value="
SELECT l.Name AS Lehrkraft, f.Name AS Fach
FROM lehrkraft l
    INNER JOIN hat_lehrbefaehigung_in lf
        ON l.PersNr = lf.Lehrkraft
    INNER JOIN fach f
        ON lf.Fach = f.Name
">
<button type="submit" class="p-button--positive" name="sql">Ausprobieren</button>
</form>

#### Mit INNER JOIN USING

Sind die zu vergleichenden Primär- und Fremdschlüssel identisch benannt, kann stattdessen
``USING`` verwendet werden:

````SQL
SELECT p.produkt AS Produkt, l.anzahl AS Anzahl
FROM preisliste p
    INNER JOIN liefervertrag l
        USING(produkt)
````

<form method="post" action="https://it.treptowkolleg.de/?page=docs-sql#result">
<input type="hidden" name="db" value="grosshandel">
<input type="hidden" name="query" value="
SELECT p.produkt AS Produkt, l.anzahl AS Anzahl
FROM preisliste p
    INNER JOIN liefervertrag l
        USING(produkt)
">
<button type="submit" class="p-button--positive" name="sql">Ausprobieren</button>
</form>

#### Mit LEFT JOIN

Mit ``LEFT JOIN`` werden alle Tupel der linken Relation selektiert, unabhängig davon,
ob es Verknüpfungen mit der rechten Relation gibt oder nicht.

![img.png](/docs/img/leftjoin.png)

Sollen auch die Datensätze selektiert werden, die im Verbund eine Schlüsselzuordnung
enthalten, kann das mit ``LEFT JOIN`` umgesetzt werden. Die Lehrkraft **Lovelace** hat
zum Beispiel keine Lehrbefähigung und würde mit ``INNER JOIN`` nicht angezeigt werden.

````SQL
SELECT l.Name AS Lehrkraft, f.Name AS Fach
FROM lehrkraft l
     LEFT JOIN hat_lehrbefaehigung_in lf
                ON l.PersNr = lf.Lehrkraft
     LEFT JOIN fach f
                ON lf.Fach = f.Name
````

<form method="post" action="https://it.treptowkolleg.de/?page=docs-sql#result">
<input type="hidden" name="db" value="abitraining">
<input type="hidden" name="query" value="
SELECT l.Name AS Lehrkraft, f.Name AS Fach
FROM lehrkraft l
     LEFT JOIN hat_lehrbefaehigung_in lf
                ON l.PersNr = lf.Lehrkraft
     LEFT JOIN fach f
                ON lf.Fach = f.Name
">
<button type="submit" class="p-button--positive" name="sql">Ausprobieren</button>
</form>

#### Mit RIGHT JOIN

Sollen nun alle Datensätze der rechten Relation unabhängig von Zuordnungen mit der
linken Relation selektiert werden, kann das mit ``RIGHT JOIN`` bewerkstelligt werden.

![img.png](/docs/img/rightjoin.png)

Beim Ausprobieren folgender Abfrage stellt sich in der resultierenden Relation heraus,
dass niemand eine Lehrbefähigung für das Fach *Englisch* hat.

````SQL
SELECT l.Name AS Lehrkraft, f.Name AS Fach
FROM lehrkraft l
     RIGHT JOIN hat_lehrbefaehigung_in lf
                ON l.PersNr = lf.Lehrkraft
     RIGHT JOIN fach f
                ON lf.Fach = f.Name
````

<form method="post" action="https://it.treptowkolleg.de/?page=docs-sql#result">
<input type="hidden" name="db" value="abitraining">
<input type="hidden" name="query" value="
SELECT l.Name AS Lehrkraft, f.Name AS Fach
FROM lehrkraft l
     RIGHT JOIN hat_lehrbefaehigung_in lf
                ON l.PersNr = lf.Lehrkraft
     RIGHT JOIN fach f
                ON lf.Fach = f.Name
">
<button type="submit" class="p-button--positive" name="sql">Ausprobieren</button>
</form>

#### Vereinigung mit UNION

Mit ``UNION`` lassen sich Datensätze aus verschiedenen Relationen vertikal vereinigen.
Das ist immer dann sinnvoll, wenn Spalten gleichen Datentyps verschiedener Relationen
in Zusammenhang gebracht werden sollen.

![img.png](/docs/img/union.png)

````SQL
SELECT 'Schüler' AS Typ, Name FROM schueler
UNION
SELECT 'Lehrkraft', Name FROM lehrkraft
````
<form method="post" action="https://it.treptowkolleg.de/?page=docs-sql#result">
<input type="hidden" name="db" value="abitraining">
<input type="hidden" name="query" value="SELECT 'Schüler' AS Typ, Name FROM schueler
UNION
SELECT 'Lehrkraft', Name FROM lehrkraft">
<button type="submit" class="p-button--positive" name="sql">Ausprobieren</button>
</form>

## Rechnen und Zählen

Mit ``+``, ``-``, ``*`` und ``/`` können Werte addiert, subtrahiert, multipliziert und
dividert werden.

````SQL
SELECT p.produkt, p.preis * l.anzahl AS Gesamt
FROM preisliste p
JOIN liefervertrag l
USING(produkt)
````
<form method="post" action="https://it.treptowkolleg.de/?page=docs-sql#result">
<input type="hidden" name="db" value="grosshandel">
<input type="hidden" name="query" value="
SELECT p.produkt, p.preis * l.anzahl AS Gesamt
FROM preisliste p
JOIN liefervertrag l
USING(produkt)
">
<button type="submit" class="p-button--positive" name="sql">Ausprobieren</button>
</form>

Nutze ``SUM()``, um die Werte einer Spalte der selektierten Datensätze aufzusummieren.
Bedenke, dass ``SUM()`` oder auch ``COUNT()`` Aggregatfunktionen sind, die ein ``GROUP BY``
erfordern.

[Mehr zur Gruppierung](#groups)

````SQL
SELECT p.produkt, SUM(p.preis * l.anzahl) AS 'Gesamt/Produktgruppe'
FROM preisliste p
JOIN liefervertrag l
USING(produkt)
GROUP BY p.produkt
````
<form method="post" action="https://it.treptowkolleg.de/?page=docs-sql#result">
<input type="hidden" name="db" value="grosshandel">
<input type="hidden" name="query" value="
SELECT p.produkt, SUM(p.preis * l.anzahl) AS 'Gesamt/Produktgruppe'
FROM preisliste p
JOIN liefervertrag l
USING(produkt)
GROUP BY p.produkt
">
<button type="submit" class="p-button--positive" name="sql">Ausprobieren</button>
</form>

Die Ausgabe der Summe funktioniert zwar einwandfrei, jedoch passt die Formatierung nicht
zur landestypischen Darstellung von Währungen. Dank Funktionen für Formatierungen lässt
sich die Darstellung jedoch bei Bedarf anpassen.

## Formatieren

### Dezimalzahlen

Zahlen können mit ``FORMAT(Spalte,Nachkommastellen,Land)`` formatiert werden. Die
Länderkennung ist insofern wichtig, als in Deutschland das **Komma** als Dezimaltrennzeichen
verwendet wird. In anderen Ländern ist das jedoch möglicherweise der **Punkt**.

````SQL
SELECT produkt, FORMAT(preis,2,'de_DE') AS Preis FROM preisliste
````
<form method="post" action="https://it.treptowkolleg.de/?page=docs-sql#result">
<input type="hidden" name="db" value="grosshandel">
<input type="hidden" name="query" value="
SELECT produkt, FORMAT(preis,2,'de_DE') AS Preis FROM preisliste
">
<button type="submit" class="p-button--positive" name="sql">Ausprobieren</button>
</form>

### Zeichenketten

Das Ergebnis des obigen Beispiels kann sich schon sehen lassen, jedoch wäre es
noch besser, wenn auch das Symbol der Währung angezeigt werden würde. Das lässt
sich mit der Funktion ``CONCAT()`` umsetzen:

````SQL
SELECT produkt, CONCAT( FORMAT(preis,2,'de_DE') , ' €' ) AS Preis FROM preisliste
````
<form method="post" action="https://it.treptowkolleg.de/?page=docs-sql#result">
<input type="hidden" name="db" value="grosshandel">
<input type="hidden" name="query" value="
SELECT produkt, CONCAT( FORMAT(preis,2,'de_DE') , ' €' ) AS Preis FROM preisliste
">
<button type="submit" class="p-button--positive" name="sql">Ausprobieren</button>
</form>

## Gruppieren

<div id="groups"></div>

Gruppierungen sind immer dann sinnvoll, wenn bestimmte Datensätze zusammengefasst werden
sollen. Etwa, wenn gezählt oder summiert werden soll. Schauen wir uns nochmals das Beispiel
aus dem ``UNION``-Verbund an: Es gibt $x$ Schüler und $y$ Lehrkräfte. Mit ``UNION`` haben
wir die Datensätze beider Relationen vertikal vereinigt, da beide vergleichbare Datentypen
enthalten (Namen).

Indem wir die ursprüngliche Ergebnistabelle als Zwischenabfrage betrachten, können wir nun
nach Personentyp gruppieren und die jeweilige Anzahl an Datensätzen zählen:

````SQL
SELECT Typ AS Personenkreis, COUNT(Name) AS 'Anzahl der Personen' FROM
                             
(SELECT 'Schüler' AS Typ, Name FROM schueler
UNION
SELECT 'Lehrkraft', Name FROM lehrkraft) ergebnis

GROUP BY Typ
````
<form method="post" action="https://it.treptowkolleg.de/?page=docs-sql#result">
<input type="hidden" name="db" value="abitraining">
<input type="hidden" name="query" value="
SELECT Typ AS Personenkreis, COUNT(Name) AS 'Anzahl der Personen' FROM

(SELECT 'Schüler' AS Typ, Name FROM schueler
UNION
SELECT 'Lehrkraft', Name FROM lehrkraft) ergebnis

GROUP BY Typ
">
<button type="submit" class="p-button--positive" name="sql">Ausprobieren</button>
</form>