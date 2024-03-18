# SQL-Anweisungen

## Basics

### Projektion von Spalten

Es sollen Vor- und Nachnamen aller Lehrkräfte angezeigt werden.

````SQL
SELECT Vorname, Nachname FROM Lehrkraft
````

Die Spaltennamen der Ergebnistabelle können mit ``AS`` umbenannt werden. Folgenden soll
die Spalte *Wohnort* der Relation *Lehrkraft* in *Ort* umbenannt werden:

````SQL
SELECT Vorname, Nachname, Wohnort AS Ort FROM lehrkraft
````