# Elektronik und Elektrotechnik

Ziel ist es, dass wir in diesem Semester eine umfangreiche Ampelsteuerung entwickeln und programmieren.
Bis wir jedoch soweit sind, schauen wir uns die Grundlagen der Elektrotechnik, der Logik und der maschinennahen
Programmierung an.

Die geplante Ampelsteuerung soll insgesamt vier bis fünf Kreuzungen enthalten (je nach Anzahl der Teilnehmenden).
Wir entwerfen die Schaltungen anhand von LEGO-City-Straßenplatten. So, dass das Endergebnis als dauerhaftes Projekt
in der Schule ausgestellt werden kann.

Optional entwerfen wir außerdem eine Tag-/Nacht-Lichtsteuerung für die Straßenbeleuchtung.

## Bauelemente

| Element     | Schaltzeichen                                             |
|-------------|-----------------------------------------------------------|
| Widerstand  | ![img](/docs/img/analog-iec/core/resistor.svg)            |
| Kondensator | ![img](/docs/img/analog-iec/core/capacitor.svg)           |
| Spule       | ![img](/docs/img/analog-iec/core/inductor.svg)            |
| Diode       | ![img](/docs/img/analog-iec/semiconductors/diode.svg)     |
| LED         | ![img](/docs/img/analog-iec/semiconductors/diode-led.svg) |

## Der Stromkreis

### Grundlagen

Ein Stromkreis besteht aus einer **Spannungsquelle** und mindestens einem **Verbraucher**.
Damit ein Strom fließen kann, brauchen wir einen geschlossenen Stromkreis.

![img.png](/docs/img/circ000.png)
1. Spannungsquelle
2. Verbraucher (Widerstand)

Ein Widerstand begrenzt den Strom und wird dabei warm. Damit wir aber auch sehen, dass gerade
ein Strom fließt, schalten wir hinter den Widerstand noch eine **LED**.

**Schaltplan**

![img.png](/docs/img/circ001.png)
1. Spannungsquelle
2. Verbraucher (Vorwiderstand)
3. LED

**Steckbrett**

![img.png](/docs/img/circuit-a-001.png)

Eine LED verbraucht auch Strom. Sie ist also auch ein Verbraucher. **ABER:** Bekommt eine LED zu viel Strom,
brennt sie durch. Daher brauchen wir für eine LED immer einen **Vorwiderstand**.

## Logik

Bei logischen Schaltungen unterscheiden wir immer zwischen **JA** und **NEIN**.

- im Alltag sagen wir auch **AN** und **AUS**
- In der Computersprache ist das gleichbedeutend mit $1$ und $0$
- In der Elektronik spricht man auch von **HIGH** und **LOW**

### Identität-Schaltung

In der Logik sprechen wir immer dann von einer **Identität**, wenn Eingang $=$ Ausgang ist. Das bedeutet:

- wenn **INPUT** $= 0$, dann ist auch **OUTPUT** $ = 0$
- wenn **INPUT** $= 1$, dann ist auch **OUTPUT** $ = 1$

**Wahrheitstabelle**

| Input | Output |
|-------|--------|
| $0$   | $0$    |
| $1$   | $1$    |

**Ergebnis:** Wenn wir den Taster drücken, leuchtet die LED. Wenn wir den Taster *NICHT* drücken, leuchtet die LED ebenfalls *NICHT*.

**Schaltung**

![img.png](/docs/img/identity.png)

**Steckbrett**

![img.png](/docs/img/circuit-a-buffer.png)

**Logikdiagramm**

![img.png](/docs/img/buffer.png)

### NICHT-Schaltung

Die **NICHT**-Schaltung sorgt dafür, dass der Ausgang immer das Gegenteil vom Eingang ist. Das bedeutet:

- wenn **INPUT** $= 0$, dann ist **OUTPUT** $ = 1$
- wenn **INPUT** $= 1$, dann ist **OUTPUT** $ = 0$

**Wahrheitstabelle**

| Input | Output |
|-------|--------|
| $0$   | $1$    |
| $1$   | $0$    |

**Ergebnis:** Wenn wir den Taster drücken, geht die LED aus. Wenn wir den Taster *NICHT* drücken, leuchtet die LED.

**Schaltung**

![img.png](/docs/img/circuit-not.png)

**Erklärung:**
Der Widerstand R2 lässt den Strom viel einfacher durch als die LED. Der Widerstand ist hier also für den Strom viel geringer.
Daher fließt der Strom viel lieber durch R2. Die LED bekommt nun so wenig Strom, dass sie nicht mehr leuchtet.

**Steckbrett**

![img.png](/docs/img/circuit-a-not.png)

**Logikdiagramm**

![img.png](/docs/img/not.png)

### UND-Schaltung

Die **UND**-Schaltung sorgt dafür, dass wir immer alle Inputs auf **AN** schalten müssen, damit der Output auch auf
**AN** schaltet:


**Wahrheitstabelle**

| Input A | Input B | Output |
|---------|---------|--------|
| $0$     | $0$     | $0$    |
| $1$     | $0$     | $0$    |
| $0$     | $1$     | $0$    |
| $1$     | $1$     | $1$    |

**Ergebnis:** Die LED leuchtet nur, wenn wir **BEIDE** Taster drücken.

**Schaltung**

![img.png](/docs/img/circuit-and.png)

**Erklärung:**
Der Strom kann nur dann durch die LED fließen (Output), wenn wir beide Taster drücken (Input A und B). 

**Steckbrett**

![img.png](/docs/img/circuit-a-and.png)

**Logikdiagramm**

![img.png](/docs/img/and.png)

### ODER-Schaltung

Die **ODER**-Schaltung sorgt dafür, dass wir nur einen der beiden Taster drücken müssen, damit die LED leuchtet.
Wir können sogar beide Taster gleichzeitig drücken.


**Wahrheitstabelle**

| Input A | Input B | Output |
|---------|---------|--------|
| $0$     | $0$     | $0$    |
| $1$     | $0$     | $1$    |
| $0$     | $1$     | $1$    |
| $1$     | $1$     | $1$    |

**Ergebnis:** Die LED leuchtet, sobald wir mindestens **EINEN** Taster drücken.

**Schaltung**

![img.png](/docs/img/circuit-or.png)

**Erklärung:**
Der Strom kann immer dann durch die LED fließen (Output), sobald wir mindestens einen der Taster (Input A oder B) drücken.

**Steckbrett**

![img.png](/docs/img/circuit-a-or.png)

**Logikdiagramm**

![img.png](/docs/img/or.png)

## Ampel

![img.png](/docs/img/circuit-a-ampel-1.png)
![img.png](/docs/img/circuit-a-ampel-002.png)
![img.png](/docs/img/circuit-a-double-shift.png)