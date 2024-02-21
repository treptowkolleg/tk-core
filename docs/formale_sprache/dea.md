# Formale Sprache

## Deterministische endliche Automaten

### Mealy-Automaten

Ein Mealy Automat ist ein endlicher Automat, der sich durch eine Besonderheit auszeichnet: Die Ausgaben sind nicht nur vom aktuellen Zustand abhängig, sondern auch vom aktuellen Eingabewert. Dies unterscheidet ihn von anderen Automatenarten, wie dem Moore-Automaten, bei dem die Ausgabe ausschließlich vom Zustand abhängig ist.

#### Formale Definition

$A=(Q,\Sigma,\Delta,\phi,z_0)$

- $Z$ Zustandsmenge
- $\Sigma$ Eingabealphabet
- $\Delta$ Ausgabealphabet
- $\phi: Z \times \Sigma \rightarrow Q \times \Delta$ Überführungs- und Ausgabefunktion
- $z_0$ Startzustand

#### Überführungsfunktion

Zustand / Eingabe | $0$ | $1$
--------|---------|------------------
$z_0$  |   $z_0$   |      $z_1$
$z_1$   |   $z_1$  |      $z_0$

#### Ausgabefunktion

Eingabe / Zustand | $z_0$ | $z_1$
--------|---------|------------------
$0$ |   $0$   |      $0$
$1$   |   $1$  |      $1$

#### Impulsdiagramm

Zustand | Eingabe | Nächster Zustand | Ausgabe
--------|---------|------------------|--------
$z_0$  |   $0$   |      $z_0$      |   $0$
$z_0$   |   $1$   |      $z_1$       |   $1$
$z_1$   |   $0$   |      $z_1$       |   $0$
$z_1$   |   $1$   |      $z_0$      |   $1$


