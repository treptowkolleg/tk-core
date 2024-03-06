<?php
/**
 * @var Session $session;
 */

use TreptowKolleg\Api\Session;

?>
<div class="l-docs__title" id="main-content">
    <div class="p-section--shallow">
        <div class="row">
            <div class="col-12">
                <h1>Formular verarbeiten</h1>
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
                In diesem Beispiel werden die eingegebenen Formularangaben über eine API <i>(Application Programming
                    Interface)</i> an einen Webserver übermittelt
                und mit den Einträgen einer Datenbank verglichen. Stimmen Benutzername und Passwort überein, wird eine
                Erfolgsmeldung zurückgegeben. Diese Anwendung
                kann dann den Login durchführen.
            </p>
            <p>
                Der Vorteil einer API liegt darin, dass sich diese Anwendung nicht um die Datenbankverbindung kümmern muss.
                Diese Anwendung authentifiziert sich mit
                einem API-Schlüssel. So können unbefugte Zugriffe unterbunden werden.

            </p>
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
            <?php if (!$session->get('login')): ?>
                <h4>Anmelden zum fortsetzen</h4>
                <form method="post" class="p-form p-form--stacked">
                    <div class="p-form__group row">
                        <div class="col-6">
                            <label for="user">Benutzername</label>
                            <input type="text" id="user" name="user" autocomplete="current-username"
                                   value="<?= $response['origin']['user'] ?? '' ?>" required>
                        </div>
                        <div class="col-6">
                            <label for="pass">Passwort</label>
                            <input type="password" id="pass" name="pass" autocomplete="current-password"
                                       value="<?= $response['origin']['pass'] ?? '' ?>" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <button type="submit" class="p-button--positive" name="login">Anmelden</button>
                        </div>
                    </div>
                </form>
            <?php else: ?>
                <h2>Geschützter Login-Bereich</h2>
                <p>Sie wurden eingeloggt. <a href="/?page=docs-form&logout=true">Ausloggen</a></p>
            <?php endif; ?>
        </div>
    </div>
</section>
<div class="u-fixed-width" style="border-bottom: 2px solid #ededed">
    <h5 class="p-muted-heading">API-Schnittstelle</h5>
</div>
<section class="p-section p-strip">
    <div class="row--25-75">
        <div class="col">
            <p class="p-heading--5">Nachricht</p>
            <p><?= $message ?? 'Keine Nachricht vorhanden.' ?></p>
        </div>
        <div class="col">
            <p class="p-heading--5">Debug Informationen</p>
            <div class="p-code-snippet">
                <pre>
                    <code class="language-php" style="background: none"><?php print_r($response ?? []) ?></code>
                </pre>
            </div>
        </div>
    </div>
</section>
</main>