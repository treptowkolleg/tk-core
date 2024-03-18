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
SELECT Vorname, Nachname FROM Lehrkraft
````

[Ausprobieren](https://it.treptowkolleg.de/?page=docs-sql&db=abitraining&query=SELECT%20Vorname,%20Nachname%20FROM%20Lehrkraft#formular)

Die Spaltennamen der Ergebnistabelle können mit ``AS`` umbenannt werden. Im Folgenden soll
die Spalte *Wohnort* der Relation *Lehrkraft* in *Ort* umbenannt werden:

````SQL
SELECT Vorname, Nachname, Wohnort AS Ort FROM Lehrkraft
````

Standardmäßig wird immer aufsteigend nach dem ersten Attribut sortiert. Die
Sortierung lässt sich jedoch auch ändern.

#### Sortieren

Zuerst nach Nachname und dann nach Vorname aufsteigend sortieren:

````SQL
SELECT Vorname, Nachname, Wohnort AS Ort
FROM Lehrkraft
ORDER BY Nachname, Vorname
````

Nach Nachname absteigend sortieren:

````SQL
SELECT Vorname, Nachname, Wohnort AS Ort
FROM Lehrkraft
ORDER BY Nachname DESC
````

#### Limitieren

Nur die ersten fünf Datensätze auswählen:

````SQL
SELECT Vorname, Nachname, Wohnort AS Ort 
FROM Lehrkraft
LIMIT 5
````

Nur fünf Datensätze ab dem fünften Datensatz auswählen:

````SQL
SELECT Vorname, Nachname, Wohnort AS Ort 
FROM Lehrkraft
LIMIT 5 OFFSET 4
````

### Selektion von Tabellen

Mit der Anweisung ``FROM`` können Relationen selektiert werden. Im obigen Beispiel war das
die Relation *Lehrkraft*. Es ist jedoch auch möglich, mehrere Relationen zu selektieren.

Mit ``WHERE`` können Bedingungen festgelegt werden, nach denen Datensätze selektiert werden
sollen. Im obigen Beispiel würden nur Lehrkräfte angezeigt werden, die überhaupt eine
Lehrbefähigung haben. Mit ``AND`` und/oder ``OR`` können weitere Bedingungen festgelegt werden.

Soll geprüft werden, ob eine Spalte **nicht null** oder **null** ist, kann allerdings nicht
der Vergleichsoperator ``=`` verwendet werden. Stattdessen ist folgende Notation zu verwenden:

````SQL
SELECT Name
FROM lehrkraft
WHERE Geburtsjahr IS NULL
````

oder:

````SQL
SELECT Name
FROM lehrkraft
WHERE Geburtsjahr IS NOT NULL
````

## Schnittmengen

### INNER JOIN

#### Mit WHERE

Im Folgenden sollen die Fächer neben jeder Lehrkraft angezeigt werden, in denen diese
eine Lehrbefähigung haben. Haben mehrere Relationen gleichnamige Attribute, müssen die
Tabellennamen vorangestellt werden. Für sehr lange Tabellennamen kann auch ein Alias erzeugt
werden, um Schreibarbeit zu sparen (``FROM Tabellenname t``).

````SQL
SELECT l.Name, f.Name
FROM lehrkraft l, hat_lehrbefaehigung_in lf, fach f
WHERE
      l.PersNr = lf.Lehrkraft
  AND 
      lf.Fach = f.Name
````

#### INNER JOIN ON


#### INNER JOIN USE

## Rechnen und Zählen

## Formatieren

## Aggregatfunktionen