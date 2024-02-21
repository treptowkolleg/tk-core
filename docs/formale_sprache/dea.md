# Formale Sprache

## Deterministische endliche Automaten

### Mealy-Automaten

Ein Mealy Automat ist ein endlicher Automat, der sich durch eine Besonderheit auszeichnet: Die Ausgaben sind nicht nur vom aktuellen Zustand abhängig, sondern auch vom aktuellen Eingabewert. Dies unterscheidet ihn von anderen Automatenarten, wie dem Moore-Automaten, bei dem die Ausgabe ausschließlich vom Zustand abhängig ist.

#### Formale Definition

$A=(X,Y,Z,\delta,z_0)$

- $X$ Eingabealphabet
- $Y$ Ausgabealphabet
- $Z$ Zustandsmenge
- $\phi: Z \times X \rightarrow Z \times Y$ Überführungs- und Ausgabefunktion
- $z_0$ Startzustand

#### Überführungsfunktion

Zustand / Eingabe | $0$ | $1$
--------|---------|------------------
$z_0$  |   $z_0$   |      $z_1$
$z_1$   |   $z_1$  |      $z_0$

#### Ausgabefunktion

Zustand / Eingabe | $0$ | $1$
--------|---------|------------------
$z_0$ |   $0$   |      $1$
$z_1$   |   $0$  |      $1$

#### Impulsdiagramm

Zustand | Eingabe | Nächster Zustand | Ausgabe
--------|---------|------------------|--------
$z_0$  |   $0$   |      $z_0$      |   $0$
$z_0$   |   $1$   |      $z_1$       |   $1$
$z_1$   |   $0$   |      $z_1$       |   $0$
$z_1$   |   $1$   |      $z_0$      |   $1$


$$
A(m, n) =
\begin{cases}
n + 1 & \text{wenn } m = 0 \\
A(m-1, 1) & \text{wenn } m > 0 \text{ und } n = 0 \\
A(m-1, A(m, n-1)) & \text{wenn } m > 0 \text{ und } n > 0 \\
\end{cases}
$$
