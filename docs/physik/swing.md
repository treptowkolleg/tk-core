# Elektromagnetischer Schwingkreis

## Phasen

### Erste Phase

Der Kondensator wird mit der Gleichspannungsquelle geladen.

![img.png](/docs/img/sk1.png)

### Zweite Phase

Durch Umschalten wird der Stromkreislauf zwischen Kondensator und Spule geschlossen.
Die negative Ladung der einen Platte am Kondensator bewegt sich nun über die Spule zur
anderen Platte des Kondensators.

Durch den Strom entsteht an der Spule ein Magnetfeld und es wird ein Gegenstrom induziert.

Die zuvor positiv geladene Kondensatorplatte ist nun negativ geladen. Die negative Ladung bewegt sich nun
wieder zur ersten Kondensatorplatte.

![img.png](/docs/img/sk2.png)

### Dritte Phase

Die ursprüngliche Ladung am Kondensator ist wiederhergestellt und der Kreislauf beginnt von vorn.

![img.png](/docs/img/sk3.png)

## Grafische Auswertung

Misst man die Spannung an der Spule, ergibt sich folgender Zeit-Spannung-Graph:

![img.png](/docs/img/skGraph.png)

Bei ca. $t=1s$ wurde der Umschalter betätigt. Hier ist interessanterweise eine hohe
Spannungsspitze zu sehen.

Anschließend bewegt sich der Strom periodisch hin und her. Die Spannung liegt hier zwischen
$U=-4V$ und $U=4V$. Der Graph beschreibt eine Sinuskurve. Im EM-Schwingkreis besteht also
ein Wechselstrom.

### Gleichrichter

Über eine Gleichrichterschaltung mit vier Dioden lässt sich an einer Sekundärspule der
negative Stromfluss sperren.

![img.png](/docs/img/gleichrichter.png)

Misst man nun die Spannung am Ausgang der Gleichrichterschaltung ergibt sich folgender Graph:

![img.png](/docs/img/gleichrichterMessung.png)

- Hellblau: Spannung am Sekundärstromkreis
- Dunkelblau: Spannung am Primärstromkreis

Hier zeigt sich nun, dass mit der gleichen Frequenz wie am Primärstromkreis des Transformators nun
immer nur eine positive Spannung am Sekundärstromkreis anliegt.

## Anwendung

### Funkeninduktor

Der EM-Schwingkreis kann verwendet werden, um ein Morsegerät zu bauen. Das Morsesignal
wird über einen Wagner'schen Hammer (Unterbrecher) ausgelöst. 

![img.png](/docs/img/fiplan.png)

#### Grafische Darstellung

![img.png](/docs/img/figraph.png)

Beim Öffnen des Primärstromkreises wird der Kondensator geladen. Dabei fließt der Strom
von der Spule zum Kondensator. Am Sekundärstromkreis wird daher eine negative Spannungsspitze
gemessen.

Wird der Primärstromkreis wieder geschlossen, entlädt sich der Kondensator wieder. An der
Spule fließt der Strom wieder in die ursprüngliche Richtung. Am Sekundärstromkreis wird
nun eine positive Spannungsspitze gemessen.

Dieser Ausschlag kann beim Empfänger als Signalimpuls über einen Lautsprecher hörbar
gemacht werden.

Welches Wort wurde im dargestellten Graph gemorst?

<details> 
<summary>Lösung aufdecken</summary>
<p>Das Wort besteht aus den Buchstaben $k,k,k,l,l,l,k,k,k$ und entspricht $S-O-S$</p>
</details>