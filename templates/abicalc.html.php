<?php
$courses = [
        '1. Leistungskurs',
        '2. Leistungskurs',
        '1. Grundkurs (schriftlich)',
        '2. Grundkurs (mündlich)',
        '3. Grundkurs',
        '4. Grundkurs',
        '5. Grundkurs',
];
$exams = [
    '1. Prüfung (LK1)',
    '2. Prüfung (LK2)',
    '3. Prüfung (GK1, schriftlich)',
    '4. Prüfung (GK2, mündlich)',
    '5. Prüfungskomponente',
];
$pi = 1;
$ci = 1;

?>

<div class="l-docs__title" id="main-content">
    <div class="p-section--shallow">
        <div class="row">
            <div class="col-12">
                <h1>Abi-Rechner</h1>
            </div>
        </div>
    </div>
</div>

<div class="l-docs__meta">

</div>

<main>
    <form id="reset" method="post"></form>
    <section class="p-section">
        <div class="row">
            <hr class="p-rule">
        </div>
        <div class="row--25-75-on-large">
            <div class="col">
                <h3 class="p-muted-heading">Berechnung</h3>
            </div>
            <div class="col">
                <div class="row">
                    <div class="col-medium-2 col-3">
                        <hr class="p-rule--highlight">
                        <h4 class="p-heading--2"><strong><?=$_SESSION['course'] ?? 0?>/600</strong><br>Kursblock</h4>
                    </div>
                    <div class="col-medium-2 col-3">
                        <hr class="p-rule--highlight">
                        <h4 class="p-heading--2"><strong><?=$_SESSION['exam'] ?? 0?>/300</strong><br>Prüfungsblock</h4>
                    </div>
                    <div class="col-medium-2 col-3">
                        <hr class="p-rule--highlight">
                        <h4 class="p-heading--2">
                            <strong>
                            <?php if(isset($_SESSION['course']) and isset($_SESSION['exam'])): ?>
                                <?=round(17/3 - ($_SESSION['course'] + $_SESSION['exam'])/180,1,PHP_ROUND_HALF_DOWN)?>
                            <?php else:?>
                            -
                            <?php endif;?>
                            </strong><br>Endnote
                        </h4>
                    </div>
                </div>
            </div>

            <?php if(isset($_SESSION['message'])): ?>
            <div class="col">
                <div class="p-notification--caution">
                    <div class="p-notification__content">
                        <h5 class="p-notification__title">Warnung</h5>
                        <p class="p-notification__message"><?=$_SESSION['message']?></p>
                    </div>
                </div>
            </div>
            <?php unset($_SESSION['message']);?>
            <?php endif;?>

            <?php if(isset($_SESSION['course']) and isset($_SESSION['exam'])): ?>
                <div class="p-strip">
                    <div class="p-article-pagination">
                        <button type="submit" name="calc_course" disabled class="p-article-pagination__link--previous p-button is-disabled u-hide">
                            <span class="p-article-pagination__label">Neustart</span>
                            <span class="p-article-pagination__title">Kursblock berechnen</span>
                        </button>

                            <button type="submit" form="reset" name="calc_reset" class="p-article-pagination__link--next p-button">
                                <span class="p-article-pagination__label">Neustart</span>
                                <span class="p-article-pagination__title">Neue Berechnung</span>
                            </button>
                    </div>
                </div>
            <?php endif;?>
        </div>
    </section>

    <?php if(!isset($_SESSION['course'])): ?>
    <section class="p-section" id="courseblock">
        <div class="row">
            <div class="col">
                <h3>Kursblock</h3>
            </div>
                <div class="col">
                <form method="post" class="p-form p-form--stacked">
                    <div class="col-12">
                        <div class="p-notification--positive">
                            <div class="p-notification__content">
                                <h5 class="p-notification__title">Hinweis</h5>
                                <p class="p-notification__message">Wenn noch nicht alle Notenpunkte bekannt sind, gib bitte einen Wert an, den du für wahrscheinlich hältst. Nur mit vollständigen Angaben kann die Berechnung erfolgen.</p>
                            </div>
                        </div>
                    </div>

                    <?php foreach($courses as $course): ?>
                        <div class="p-form__group row--25-75">
                            <div class="col">
                                <h5><?=$course?></h5>
                            </div>
                            <div class="col">
                                <div class="row--25-25-25-25">
                                    <?php for($i = 1; $i <= 4; $i++): ?>
                                        <div class="col">
                                            <label for="<?="$pi-$i"?>"><?="Q$i"?></label>
                                            <input type="number" min="0" max="15" maxlength="2" id="<?="$pi-$i"?>" name="<?="$pi-$i"?>" required>
                                        </div>
                                    <?php endfor;?>
                                </div>
                            </div>
                        </div>
                    <hr class="u-hide--small">
                    <?php $pi++; ?>
                    <?php endforeach;?>
                    <div class="p-strip">
                        <div class="p-article-pagination">
                            <button type="submit" form="reset" name="calc_course" disabled class="p-article-pagination__link--previous p-button is-disabled">
                                <span class="p-article-pagination__label">Neustart</span>
                                <span class="p-article-pagination__title">Kursblock berechnen</span>
                            </button>
                            <button type="submit" name="calc_course" class="p-article-pagination__link--next p-button">
                                <span class="p-article-pagination__label">Weiter</span>
                                <span class="p-article-pagination__title">Zum Prüfungsblock</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <?php if(isset($_SESSION['course']) and !isset($_SESSION['exam'])): ?>
    <section class="p-section" id="examblock">
        <div class="row">

                <div class="col">
                    <h3>Prüfungsblock</h3>
                </div>
                <div class="col">
                <form method="post" id="exams" class="p-form p-form--stacked">
                    <?php foreach($exams as $exam): ?>
                        <div class="p-form__group row--25-75">
                            <div class="col">
                                <h5><?=$exam?></h5>
                            </div>
                            <div class="col">
                                <label for="<?=$ci?>">Punkte</label>
                                <input type="number" min="0" max="15" maxlength="2" id="<?=$ci?>" name="<?=$ci?>" required>
                            </div>
                        </div>
                        <hr class="u-hide--small">
                        <?php $ci++; ?>
                    <?php endforeach;?>
                </form>
                    <div class="p-strip">
                        <div class="p-article-pagination">
                            <button type="submit" name="calc_reset" form="reset"  class="p-article-pagination__link--previous p-button p-button--base">
                                <span class="p-article-pagination__label">Neustart</span>
                                <span class="p-article-pagination__title">Kursblock berechnen</span>
                            </button>
                            <button type="submit" name="calc_exam" form="exams" class="p-article-pagination__link--next p-button">
                                <span class="p-article-pagination__label">Fertig</span>
                                <span class="p-article-pagination__title">Endnote berechnen</span>
                            </button>
                        </div>
                    </div>

            </div>
        </div>
    </section>
    <?php endif; ?>
</main>