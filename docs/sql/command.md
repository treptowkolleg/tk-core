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

#### Vereinigung mit UNION

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

## Formatieren

## Aggregatfunktionen