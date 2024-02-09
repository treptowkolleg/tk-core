# HTML
## Tabellen
Tabellen können nicht nur Inhalte sortieren. Früher wurden sie auch für die Website-Gestaltung verwendet.

###Allgemeiner Aufbau
Allgemein gliedert sich eine Tabelle in Zeilen (rows) und Spalten (columns). Zusätzlich unterscheiden wir zwischen:

- Tabellenkopf
- Tabellenkörper
- Tabellenfuß
- 
Jedoch finden wir nicht immer all diese Bereiche vor. Insbesondere der Tabellenfuß wird häufig weggelassen.

````html
<table>
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">First</th>
      <th scope="col">Last</th>
      <th scope="col">Handle</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td colspan="2">Larry the Bird</td>
      <td>@twitter</td>
    </tr>
  </tbody>
</table>
````