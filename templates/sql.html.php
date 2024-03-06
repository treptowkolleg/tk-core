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
                <a href="/docs/img/world.pdf" target="_blank">Struktur</a> der World-Datenbank.
            </div>
            <div class="col">
                <?php if (isset($message)): ?>
                    <div class="p-notification--information">
                        <div class="p-notification__content">
                            <h5 class="p-notification__title">Rückmeldung</h5>
                            <p class="p-notification__message"><?= $message ?></p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col">
                <form method="post" class="p-form p-form--stacked">
                    <div class="p-form__group row">
                        <div class="col-6">
                            <label for="query">SQl-Query</label>
                            <input type="text" id="query" name="query"
                                   value="<?= $response['origin']['query'] ?? '' ?>" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <button type="submit" class="p-button--positive" name="sql">SQL-Query ausführen</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col">
                <pre>
                    <code class="language-sql" style="background: none"><?php print_r($response['query'] ?? []) ?></code>
                </pre>
            </div>
            <div class="col">
                <table>
                    <thead>
                        <tr>
                        <?php foreach ($columns ?? [] as $column): ?>
                            <th><?=$column?></th>
                        <?php endforeach; ?>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($response['response'] ?? [] as $row): ?>
                        <tr>
                            <?php foreach ($row as $value): ?>
                                <td><?=$value?></td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="col">
                <pre>
                    <code class="language-sql" style="background: none"><?php print_r($response['query'] ?? []) ?></code>
                </pre>
            </div>
        </div>
    </section>

</main>