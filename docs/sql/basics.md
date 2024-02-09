# Simple Query Language

![sql-logo](/docs/img/Sql_data_base_with_logo.png)

## Grundlagen

Um ein Gefühl für SQL zu bekommen, erstmal eine *Select-Query* üblichen Ausmaßes:
`````sql
SELECT person.name AS Name, election.label AS Wahl, COUNT(*) AS Stimmen
FROM person
    INNER JOIN election_result_person
        ON person.id = election_result_person.person_id
    INNER JOIN election_result_election
        ON election_result_person.election_result_id = election_result_election.election_result_id
    INNER JOIN election
        ON election_result_election.election_id = election.id
GROUP BY election_result_person.person_id;
`````

Die obige Abfrage ergibt folgendes Ergebnis (als Diagramm dargestellt):

![Diagramm](/docs/img/diagramm.jpg)

Unter manchen Konfigurationen gibt das obige Beispiel eine Fehlermeldung aus, da es
sich nicht um ein vollständig qualifiziertes ``GROUP BY`` handelt (ohne ``HAVING``). Die Konfiguration
kann folgendermaßen geändert werden:

````sql
mysql > SET GLOBAL sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));
````

Um diese Konfiguration auch nach einem Neustart des Datenbankservice zu behalten,
wird folgendes Kommando benötigt:

````sql
mysql > SET PERSIST sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));
````

## Bestandteile eines Datenbanksystems

Ein Datenbanksystem ist eine systematische und strukturierte Zusammenfassung von Daten eines Problembereichs. Diese umfasst die sogenannte **Datenbasis**. Aufgaben eines Datenbanksystems sind:

- Eingabe
- Verwaltung
- Auswertung
- Ausgabe

Diese Aufgaben werden durch ein **Datenbankmanagementsystem** erledigt *(DBMS)*.
Ein DBMS dient der zentralen Speicherung und einheitlichen Verwaltung einer Datenbasis. Außerdem kontrolliert es den Zugriff und überwacht die Zugangsberechtigungen als Maßnahme zur Datensicherheit.

Für relationale Datenbanken, die für uns eine wesentliche Rolle spielen werden, kann
folgende Administration verwendet werden:

<a class="pf-v5-c-button pf-m-control pf-m-small" href="https://it.treptowkolleg.de/admin" target="_blank">phpMyAdmin</a>

## Datenbankarchitektur

### Externe Ebene

Die externe Ebene stellt die Benutzersicht auf die Daten dar. Für verschiedene Benutzer kann es verschiedene Benutzersichten geben.

### Konzeptionelle Ebene

Die konzeptionelle Ebene stellt die logische Ebene, also das Datenmodell dar. Das Datenmodell besteht genau einmal.

### Interne Ebene

Die interne Ebene beschreibt die Implementierung des konzeptionellen Schemas. Für diese Ebene ist das DBMS zuständig.

## Datenbankarten

### Hierarchische Datenbank

Hierarchische Datenbanken weisen eine Baumstruktur auf. Sie werden heutzutage kaum noch verwendet, da die Verwaltung sehr starr und unflexibel ist. Die Verbindungen werden Parent-Child-Verbindugen genannt.

### Netzwerkdatenbank

Netzwerkdatenbanken

### Relationale Datenbank