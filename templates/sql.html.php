<?php

$tableCountry = [
    'Code',
    'Name',
    'Continent',
    'Region',
    'SurfaceArea',
    'IndepYear',
    'Population',
    'LifeExpectancy',
    'GNP',
    'GNPOld',
    'LocalName',
    'GovernmentForm',
    'HeadOfState',
    'Capital',
    'Code2'
];

?>

<div class="l-docs__title" id="main-content">
    <div class="p-section--shallow">
        <div class="row">
            <div class="col-12">
                <h1>SQL-Abfragen</h1>
            </div>
        </div>
    </div>
</div>

<div class="l-docs__meta">
    <div class="l-docs__sticky-container">
        <aside class="p-table-of-contents">
            <div class="p-table-of-contents__section p-strip is-shallow">
                <h2 class="p-table-of-contents__header">Auf dieser Seite</h2>
                <nav class="p-table-of-contents__nav" aria-label="Table of contents">
                    <ul class="p-table-of-contents__list">
                        <li class="p-table-of-contents__item"><a class="p-table-of-contents__link" href="#link1">Was ist SQL</a></li>
                        <li class="p-table-of-contents__item"><a class="p-table-of-contents__link" href="#link2">Wie funktioniert die API</a></li>
                        <li class="p-table-of-contents__item"><a class="p-table-of-contents__link is-active" href="#link3">Abfragen erstellen</a></li>
                        <li class="p-table-of-contents__item"><a class="p-table-of-contents__link" href="#link4">Weitere Informationen</a></li>
                    </ul>
                </nav>
            </div>
        </aside>
    </div>
</div>

<main>


<section class="p-section">
    <div class="row">
        <div class="col">
            <p>
                In diesem Beispiel können SQL-Abfragen über eine API an die angeschlossene Datenbank gestellt werden.
                Als Rückmeldung erhält man ein Array, das in Tabellenform dargestellt wird.
            </p>
            <a href="/docs/img/world.pdf">Struktur</a> der World-Datenbank.
        </div>
        <div class="col">
            <table>
                <caption>SQL-Tabelle "Country"</caption>
                <thead>
                    <tr>
                        <?php foreach ($tableCountry as $column): ?>
                            <th><?=$column?></th>
                        <?php endforeach;?>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</section>

</main>