# Hesse'sche Normalenform

## Beispiel 1:

$E\colon\; \vec{n} \circ \left[\vec{x} - \vec{a}\right] = \begin{pmatrix} 2 \\\ 1 \\\ -2 \end{pmatrix} \circ \left[\begin{pmatrix} x_1 \\\ x_2 \\\ x_3 \end{pmatrix} - \begin{pmatrix} 0 \\\ 1 \\\ 1 \end{pmatrix}\right] = 0$

### Normierter Normalenvektor

$\vec{n}_0 = \frac{\vec{n}}{|\vec{n}|}$

$|\vec{n}| = \sqrt{2^2 + 1^2 + (-2)^2} = \sqrt{9} = 3$

### Ebene in Hessescher Normalenform aufstellen

$E\colon\; \frac{\vec{n}}{|\vec{n}|} \circ \left[\vec{x} - \vec{a}\right] = \frac{1}{3} \cdot \begin{pmatrix} 2 \\\ 1 \\\ -2 \end{pmatrix} \circ \left[\begin{pmatrix} x_1 \\\ x_2 \\\ x_3 \end{pmatrix} - \begin{pmatrix} 0 \\\ 1 \\\ 1 \end{pmatrix}\right] = 0$

## Beispiel 2

Gegeben sei die Ebene $E$ in Koordinatenform mit:

$
E\colon\; \frac{1}{3} \cdot [2x_1 - x_2 - 2x_3 - 5] = 0
$

### Berechne den Abstand $|d|$ des Punktes $P(2|1|2)$ von der Ebene.

#### Normierten Normalenvektor berechnen

$\vec{n} = \begin{pmatrix} 2 \\\ -1 \\\ -2 \end{pmatrix}$

$|\vec{n}| = \sqrt{2^2 + (-1)^2 + (-2)^2} = \sqrt{9} = 3$

#### Ebene in Hessescher Normalenform aufstellen 

$E\colon\; \frac{1}{3} \cdot [2x_1 - x_2 - 2x_3 - 5] = 0$

#### Abstand berechnen

$
d = |\frac{1}{3} \cdot [2 \cdot 2 - 1 - 2 \cdot 2 - 5]| = |\frac{1}{3} \cdot (-6)| = |-2| = 2
$

Der Abstand des Punktes $P$ von der Ebene $E$ beträgt $2$ Längeneinheiten.

### Interpretation des Ergebnisses

- $d>0$: $P$ liegt auf der Ebene $E$
- $d=0$: $P$ und der Ursprung $O$ liegen auf verschiedenen Seiten der Ebene $E$
- $d<0$: $P$ und der Ursprung $O$ liegen auf der gleichen Seite der Ebene $E$