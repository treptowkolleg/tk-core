# SQL-Anweisungen

## Basics

### Projektion von Spalten

Es sollen Vor- und Nachnamen aller Lehrkräfte angezeigt werden.

````SQL
SELECT Vorname, Nachname FROM Lehrkraft
````

Die Spaltennamen der Ergebnistabelle können mit ``AS`` umbenannt werden. Im Folgenden soll
die Spalte *Wohnort* der Relation *Lehrkraft* in *Ort* umbenannt werden:

````SQL
SELECT Vorname, Nachname, Wohnort AS Ort FROM Lehrkraft
````

### Selektion von Tabellen

Mit der Anweisung ``FROM`` können Relationen selektiert werden. Im obigen Beispiel war das
die Relation *Lehrkraft*. Es ist jedoch auch möglich, mehrere Relationen zu selektieren.

### Verbund von Relationen

Im Folgenden sollen die Fächer neben jeder Lehrkraft angezeigt werden, in denen diese
eine Lehrbefähigung haben. Haben mehrere Relationen gleichnamige Attribute, müssen die
Tabellennamen vorangestellt werden. Für sehr lange Tabellennamen kann auch ein Alias erzeugt
werden, um Schreibarbeit zu sparen (``FROM Tabellenname t``).

````SQL
SELECT Lehrkraft.Name, Fach.Name
FROM lehrkraft l, hat_lehrbefaehigung_in lf, fach f
WHERE
      l.PersNr = lf.Lehrkraft
  AND 
      lf.Fach = f.Name
````