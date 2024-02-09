# Objekt-relationales Modell

Das objekt-relationale Modell **ORM** wird verwendet, um für Entitäten (*DB*) Objekte zu
generieren. Die Attribute der Objekte entsprechen den Spalten der Datenbanktabellen. Je
nach Modell kann so die Verwaltung der Entitäten und Tabellen auf Datenbankebene vollständig vernachlässigt
werden.

## Client Layer

````php
public class Pupil {

    // einzelne Spalte, Fremdschlüssel liegt hier
    @Join(entity=Tutor.class, column = "firstname", on = "tutorId")
    protected String tutorFirstname;    
    
    @Join(entity=Tutor.class, column = "lastname", on = "tutorId")
    protected String tutorLastname;
    
    // einzelne Spalte, Fremdschlüssel in Fremdtabelle
    @InverseJoin(entity = Exam.class, column = "SUM(exam.points * 4)", on = "pupilId")
    protected Integer summedExamPoints;
    
    // einfache Spalte
    @ORM
    protected int id;
    
    // komplettes Entity-Objekt, Fremdschlüssel liegt hier
    @ManyToOne(entity=Tutor.class, origin = "id")
    protected Integer tutorId;
    
    @ORM
    protected String firstname;
    
    @ORM
    protected String lastname;
    
    @ORM
    protected String birthDate;
    
    @ORM
    protected String examDate;
    
    @ORM
    protected Integer coursePoints;
}
````

Dabei werden folgende MySQL-Tabllen verknüpft:

**pupil**

![Pupil-Table](/docs/img/tbl-pupil.png)

**tutor**

![Tutor-Table](/docs/img/tbl-tutor.png)

**exam**

![Exam-Table](/docs/img/tbl-exam.png)

Das ORM generiert nun aus den Attributen der ``Pupil``-Klasse die folgende *SQL-Abfrage*,
um die gezeigten Tabellen so zu verknüpfen, dass alle zusammenhängenden Datensätze je
Zeile (*Tupel*) ausgegeben werden.

````sql
SELECT
       tutor.firstname AS tutorFirstname,
       tutor.lastname AS tutorLastname,
       SUM(exam.points * 4) AS summedExamPoints,
       pupil.id AS id,

        /* Spalte führt zu neuer Instanz eines Tutor-Objekts */
       pupil.tutor_id AS tutorId,
       
       pupil.firstname AS firstname,
       pupil.lastname AS lastname,
       pupil.birth_date AS birthDate,
       pupil.exam_date AS examDate,
       pupil.course_points AS coursePoints 
FROM pupil 
    LEFT JOIN tutor 
        ON (tutor.id = pupil.tutor_id)
    LEFT JOIN exam
        ON (exam.pupil_id = pupil.id)
GROUP BY id
ORDER BY examDate DESC
````